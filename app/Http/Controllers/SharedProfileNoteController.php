<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateSharedProfileNoteRequest;
use App\Http\Requests\UpdateSharedProfileNoteRequest;
use App\Repositories\SharedProfileNoteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;
use GoogleCloudVision\GoogleCloudVision;
use GoogleCloudVision\Request\AnnotateImageRequest;

class SharedProfileNoteController extends AppBaseController
{
    /** @var  SharedProfileNoteRepository */
    private $sharedProfileNoteRepository;

    public function __construct(SharedProfileNoteRepository $sharedProfileNoteRepo)
    {
        $this->sharedProfileNoteRepository = $sharedProfileNoteRepo;
    }

    public function annotateImage($id, Request $request)
    {
        $now = Carbon::now();
        
        if(isset(Auth::user()->id))
        {
            $user_id = Auth::user()->id;
        }
        
        $sharedProfileNote = $this->sharedProfileNoteRepository->findWithoutFail($id);
            
        if(empty($sharedProfileNote))
        {
            Flash::error('Shared Profile Note not found');
            return redirect(route('sharedProfileNotes.index'));
        }
            
        $user = DB::table('shared_profile_note')->join('users', 'users.id', '=', 'shared_profile_note.user_id')->where('shared_profile_note.id', '=', $id)->get();
        
        if(isset(Auth::user()->id))
        {
            DB::table('shared_profile_note_views')->insert(['datetime' => $now, 'user_id' => $user_id, 's_p_n_id' => $id]);
        }
        
        DB::table('shared_profile_note')->where('id', $id)->update(['views_quantity' => DB::raw('views_quantity + 1')]);
        
        if(isset(Auth::user()->id))
        {
            $actual_user = DB:: table('users')->where('id', '=', $user_id)->get();
        }
        
        $sharedProfileNoteViews = DB::table('users')->join('shared_profile_note_views', 'users.id', '=', 'shared_profile_note_views.user_id')->where('s_p_n_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
        $sharedProfileNoteUpdates = DB::table('users')->join('shared_profile_note', 'users.id', '=', 'shared_profile_note.user_id')->where('shared_profile_note.id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
                
        $shared_profile_note_users = DB::table('shared_profile_note')->join('users', 'shared_profile_note.user_id', '=', 'users.id')->where('shared_profile_note.id', '=', $sharedProfileNote -> id)->where(function ($query) {$query->where('shared_profile_note.deleted_at', '=', null);})->orderBy('shared_profile_note.created_at', 'desc')->paginate(20, ['*'], 'note_user_p');
        $shared_profile_note_comments = DB::table('shared_profile_note_c')->where('s_p_n_id', '=', $sharedProfileNote -> id)->where(function ($query) {$query->where('shared_profile_note_c.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(20, ['*'], 'note_comment_p');
        $shared_profile_note_comment_counts = DB::table('shared_profile_note_c')->where('s_p_n_id', '=', $sharedProfileNote -> id)->where(function ($query) {$query->where('shared_profile_note_c.deleted_at', '=', null);})->orderBy('created_at', 'desc')->get()->count();
        $shared_profile_note_comment_users = DB::table('shared_profile_note_c')->join('users', 'shared_profile_note_c.user_id', '=', 'users.id')->select('users.name', 'users.image_type','shared_profile_note_c.user_id', 'shared_profile_note_c.id')->where('shared_profile_note_c.s_p_n_id', '=', $sharedProfileNote -> id)->where(function ($query) {$query->where('shared_profile_note_c.deleted_at', '=', null);})->orderBy('shared_profile_note_c.created_at', 'desc')->paginate(20, ['*'], 'note_comment_user_p');
        $shared_profile_note_likes = DB::table('shared_profile_note_like')->join('users', 'users.id', '=', 'shared_profile_note_like.user_id')->select('users.name', 'users.email', 'shared_profile_note_like.datetime')->where('s_p_n_id', '=', $sharedProfileNote -> id)->where(function ($query) {$query->where('shared_profile_note_like.deleted_at', '=', null);})->orderBy('shared_profile_note_like.created_at', 'desc')->get();
        $shared_profile_note_like_counts = DB::table('shared_profile_note_like')->join('users', 'users.id', '=', 'shared_profile_note_like.user_id')->select('users.name', 'users.email', 'shared_profile_note_like.datetime')->where('s_p_n_id', '=', $sharedProfileNote -> id)->where(function ($query) {$query->where('shared_profile_note_like.deleted_at', '=', null);})->orderBy('shared_profile_note_like.created_at', 'desc')->get()->count();

        $i = 0;
        $shared_profile_note_comment_responses = null;
        $shared_profile_note_comment_response_users = null;

        foreach($shared_profile_note_comments as $shared_profile_note_comment)
        {
            $shared_profile_note_comment_responses[$i] = DB::table('shared_profile_note_c_response')->where('s_p_n_c_id', '=', $shared_profile_note_comment -> id)->where(function ($query) {$query->where('shared_profile_note_c_response.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(5, ['*'], 'note_comment_response_p');
            $shared_profile_note_comment_response_users[$i] = DB::table('shared_profile_note_c_response')->join('users', 'shared_profile_note_c_response.user_id', '=', 'users.id')->select('users.name', 'users.image_type','shared_profile_note_c_response.user_id', 'shared_profile_note_c_response.id')->where('shared_profile_note_c_response.s_p_n_c_id', '=', $shared_profile_note_comment -> id)->where(function ($query) {$query->where('shared_profile_note_c_response.deleted_at', '=', null);})->orderBy('shared_profile_note_c_response.created_at', 'desc')->paginate(5, ['*'], 'note_comment_response_user_p');
            $i += 1;
        }
                
        $text = '';
            
        if($request->file('image'))
        {
            $image = base64_encode(file_get_contents($request->file('image')));
            $request = new AnnotateImageRequest();
            $request->setImage($image);
            $request->setFeature("TEXT_DETECTION");
            $gcvRequest = new GoogleCloudVision([$request], 'AIzaSyCiYAx75dCXDnjUNPIOzlqTp0H7Up9AQh8');
            $response = $gcvRequest->annotate();
            
            $text = $response->responses[0]->fullTextAnnotation->text;
        }
            
        $files_list = DB::table('shared_profile_file')->where(function ($query) {$query->where('shared_profile_file.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
        $notes_list = DB::table('shared_profile_note')->where(function ($query) {$query->where('shared_profile_note.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
        $images_list = DB::table('shared_profile_image')->where(function ($query) {$query->where('shared_profile_image.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
        $audios_list = DB::table('shared_profile_audio')->where(function ($query) {$query->where('shared_profile_audio.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
        $videos_list = DB::table('shared_profile_video')->where(function ($query) {$query->where('shared_profile_video.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
        
        if(isset(Auth::user()->id))
        {
            return view('shared_profile_notes.show')
                ->with('sharedProfileNote', $sharedProfileNote)
                ->with('sharedProfileNoteViews', $sharedProfileNoteViews)
                ->with('sharedProfileNoteUpdates', $sharedProfileNoteUpdates)
                ->with('sharedProfileNoteUsers', $shared_profile_note_users)
                ->with('sharedProfileNoteComments', $shared_profile_note_comments)
                ->with('sharedProfileNoteCommentCounts', $shared_profile_note_comment_counts)
                ->with('sharedProfileNoteCommentUsers', $shared_profile_note_comment_users)
                ->with('sharedProfileNoteLikes', $shared_profile_note_likes)
                ->with('sharedProfileNoteLikeCounts', $shared_profile_note_like_counts)
                ->with('sharedProfileNoteCommentResponses', $shared_profile_note_comment_responses)
                ->with('sharedProfileNoteCommentResponseUsers', $shared_profile_note_comment_response_users)
                ->with('text', $text)
                ->with('user', $user)
                ->with('user_id', $user_id)
                ->with('now', $now)
                ->with('id', $id)
                ->with('actualUser', $actual_user)
                ->with('files_list', $files_list)
                ->with('notes_list', $notes_list)
                ->with('images_list', $images_list)
                ->with('audios_list', $audios_list)
                ->with('videos_list', $videos_list);
        }
        
        else
        {
            return view('shared_profile_notes.show')
                ->with('sharedProfileNote', $sharedProfileNote)
                ->with('sharedProfileNoteViews', $sharedProfileNoteViews)
                ->with('sharedProfileNoteUpdates', $sharedProfileNoteUpdates)
                ->with('sharedProfileNoteUsers', $shared_profile_note_users)
                ->with('sharedProfileNoteComments', $shared_profile_note_comments)
                ->with('sharedProfileNoteCommentCounts', $shared_profile_note_comment_counts)
                ->with('sharedProfileNoteCommentUsers', $shared_profile_note_comment_users)
                ->with('sharedProfileNoteLikes', $shared_profile_note_likes)
                ->with('sharedProfileNoteLikeCounts', $shared_profile_note_like_counts)
                ->with('sharedProfileNoteCommentResponses', $shared_profile_note_comment_responses)
                ->with('sharedProfileNoteCommentResponseUsers', $shared_profile_note_comment_response_users)
                ->with('text', $text)
                ->with('user', $user)
                ->with('now', $now)
                ->with('id', $id)
                ->with('files_list', $files_list)
                ->with('notes_list', $notes_list)
                ->with('images_list', $images_list)
                ->with('audios_list', $audios_list)
                ->with('videos_list', $videos_list);
        }
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->sharedProfileNoteRepository->pushCriteria(new RequestCriteria($request));
            $sharedProfileNotes = $this->sharedProfileNoteRepository->all();
    
            return view('shared_profile_notes.index')
                ->with('sharedProfileNotes', $sharedProfileNotes);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function create()
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            
            $files_list = DB::table('shared_profile_file')->where(function ($query) {$query->where('shared_profile_file.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
            $notes_list = DB::table('shared_profile_note')->where(function ($query) {$query->where('shared_profile_note.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
            $images_list = DB::table('shared_profile_image')->where(function ($query) {$query->where('shared_profile_image.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
            $audios_list = DB::table('shared_profile_audio')->where(function ($query) {$query->where('shared_profile_audio.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
            $videos_list = DB::table('shared_profile_video')->where(function ($query) {$query->where('shared_profile_video.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
            
            return view('shared_profile_notes.create')
                ->with('user_id', $user_id)
                ->with('files_list', $files_list)
                ->with('notes_list', $notes_list)
                ->with('images_list', $images_list)
                ->with('audios_list', $audios_list)
                ->with('videos_list', $videos_list);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateSharedProfileNoteRequest $request)
    {
        if(Auth::user() != null)
        {
            if(isset(Auth::user()->id))
            {
                $now = Carbon::now();
                $user_id = Auth::user()->id;
                $input = $request->all();
                $sharedProfileNote = $this->sharedProfileNoteRepository->create($input);
            
                DB::table('recent_activities')->insert(['name' => $sharedProfileNote -> name, 'status' => 'active', 'type' => 'p_n_c', 'user_id' => $user_id, 'entity_id' => $sharedProfileNote -> id, 'created_at' => $now]);
    
                Flash::success('Shared Profile Note saved successfully.');
                return redirect(route('sharedProfileNotes.show', [$sharedProfileNote -> id]));
            }
            
            else
            {
                return view('deniedAccess');
            }
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function show($id)
    {
        $now = Carbon::now();
        
        if(isset(Auth::user()->id))
        {
            $user_id = Auth::user()->id;
            $sharedProfileNote = $this->sharedProfileNoteRepository->findWithoutFail($id);
                
            if(empty($sharedProfileNote))
            {
                Flash::error('Shared Profile Note not found');
                return redirect(route('sharedProfileNotes.index'));
            }
            
            $userSharedProfiles = DB::table('user_shared_profile')->where('user_id', '=', $sharedProfileNote -> user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userSharedProfiles as $userSharedProfile)
            {
                if($userSharedProfile -> shared_user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            if($user_id == $sharedProfileNote -> user_id || $isShared)
            {
                $user = DB::table('shared_profile_note')->join('users', 'users.id', '=', 'shared_profile_note.user_id')->where('shared_profile_note.id', '=', $id)->get();
                
                DB::table('shared_profile_note_views')->insert(['datetime' => $now, 'user_id' => $user_id, 's_p_n_id' => $id]);
                DB::table('shared_profile_note')->where('id', $id)->update(['views_quantity' => DB::raw('views_quantity + 1')]);
                
                $actual_user = DB:: table('users')->where('id', '=', $user_id)->get();
                
                $sharedProfileNoteViews = DB::table('users')->join('shared_profile_note_views', 'users.id', '=', 'shared_profile_note_views.user_id')->where('s_p_n_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
                $sharedProfileNoteUpdates = DB::table('users')->join('shared_profile_note', 'users.id', '=', 'shared_profile_note.user_id')->where('shared_profile_note.id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
                        
                $shared_profile_note_users = DB::table('shared_profile_note')->join('users', 'shared_profile_note.user_id', '=', 'users.id')->where('shared_profile_note.id', '=', $sharedProfileNote -> id)->where(function ($query) {$query->where('shared_profile_note.deleted_at', '=', null);})->orderBy('shared_profile_note.created_at', 'desc')->paginate(20, ['*'], 'note_user_p');
                $shared_profile_note_comments = DB::table('shared_profile_note_c')->where('s_p_n_id', '=', $sharedProfileNote -> id)->where(function ($query) {$query->where('shared_profile_note_c.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(20, ['*'], 'note_comment_p');
                $shared_profile_note_comment_counts = DB::table('shared_profile_note_c')->where('s_p_n_id', '=', $sharedProfileNote -> id)->where(function ($query) {$query->where('shared_profile_note_c.deleted_at', '=', null);})->orderBy('created_at', 'desc')->get()->count();
                $shared_profile_note_comment_users = DB::table('shared_profile_note_c')->join('users', 'shared_profile_note_c.user_id', '=', 'users.id')->select('users.name', 'users.image_type','shared_profile_note_c.user_id', 'shared_profile_note_c.id')->where('shared_profile_note_c.s_p_n_id', '=', $sharedProfileNote -> id)->where(function ($query) {$query->where('shared_profile_note_c.deleted_at', '=', null);})->orderBy('shared_profile_note_c.created_at', 'desc')->paginate(20, ['*'], 'note_comment_user_p');
                $shared_profile_note_likes = DB::table('shared_profile_note_like')->join('users', 'users.id', '=', 'shared_profile_note_like.user_id')->select('users.name', 'users.email', 'shared_profile_note_like.datetime')->where('s_p_n_id', '=', $sharedProfileNote -> id)->where(function ($query) {$query->where('shared_profile_note_like.deleted_at', '=', null);})->orderBy('shared_profile_note_like.created_at', 'desc')->get();
                $shared_profile_note_like_counts = DB::table('shared_profile_note_like')->join('users', 'users.id', '=', 'shared_profile_note_like.user_id')->select('users.name', 'users.email', 'shared_profile_note_like.datetime')->where('s_p_n_id', '=', $sharedProfileNote -> id)->where(function ($query) {$query->where('shared_profile_note_like.deleted_at', '=', null);})->orderBy('shared_profile_note_like.created_at', 'desc')->get()->count();
        
                $i = 0;
                $shared_profile_note_comment_responses = null;
                $shared_profile_note_comment_response_users = null;
        
                foreach($shared_profile_note_comments as $shared_profile_note_comment)
                {
                    $shared_profile_note_comment_responses[$i] = DB::table('shared_profile_note_c_response')->where('s_p_n_c_id', '=', $shared_profile_note_comment -> id)->where(function ($query) {$query->where('shared_profile_note_c_response.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(5, ['*'], 'note_comment_response_p');
                    $shared_profile_note_comment_response_users[$i] = DB::table('shared_profile_note_c_response')->join('users', 'shared_profile_note_c_response.user_id', '=', 'users.id')->select('users.name', 'users.image_type','shared_profile_note_c_response.user_id', 'shared_profile_note_c_response.id')->where('shared_profile_note_c_response.s_p_n_c_id', '=', $shared_profile_note_comment -> id)->where(function ($query) {$query->where('shared_profile_note_c_response.deleted_at', '=', null);})->orderBy('shared_profile_note_c_response.created_at', 'desc')->paginate(5, ['*'], 'note_comment_response_user_p');
                    $i += 1;
                }
                        
                $text = '';
                    
                $files_list = DB::table('shared_profile_file')->where(function ($query) {$query->where('shared_profile_file.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                $notes_list = DB::table('shared_profile_note')->where(function ($query) {$query->where('shared_profile_note.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                $images_list = DB::table('shared_profile_image')->where(function ($query) {$query->where('shared_profile_image.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                $audios_list = DB::table('shared_profile_audio')->where(function ($query) {$query->where('shared_profile_audio.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                $videos_list = DB::table('shared_profile_video')->where(function ($query) {$query->where('shared_profile_video.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
            
                return view('shared_profile_notes.show')
                    ->with('sharedProfileNote', $sharedProfileNote)
                    ->with('sharedProfileNoteViews', $sharedProfileNoteViews)
                    ->with('sharedProfileNoteUpdates', $sharedProfileNoteUpdates)
                    ->with('sharedProfileNoteUsers', $shared_profile_note_users)
                    ->with('sharedProfileNoteComments', $shared_profile_note_comments)
                    ->with('sharedProfileNoteCommentCounts', $shared_profile_note_comment_counts)
                    ->with('sharedProfileNoteCommentUsers', $shared_profile_note_comment_users)
                    ->with('sharedProfileNoteLikes', $shared_profile_note_likes)
                    ->with('sharedProfileNoteLikeCounts', $shared_profile_note_like_counts)
                    ->with('sharedProfileNoteCommentResponses', $shared_profile_note_comment_responses)
                    ->with('sharedProfileNoteCommentResponseUsers', $shared_profile_note_comment_response_users)
                    ->with('text', $text)
                    ->with('user', $user)
                    ->with('user_id', $user_id)
                    ->with('now', $now)
                    ->with('id', $id)
                    ->with('actualUser', $actual_user)
                    ->with('files_list', $files_list)
                    ->with('notes_list', $notes_list)
                    ->with('images_list', $images_list)
                    ->with('audios_list', $audios_list)
                    ->with('videos_list', $videos_list);
            }
            
            else
            {
                return view('deniedAccess');
            }
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function edit($id)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $sharedProfileNote = $this->sharedProfileNoteRepository->findWithoutFail($id);
    
            if(empty($sharedProfileNote))
            {
                Flash::error('Shared Profile Note not found');
                return redirect(route('sharedProfileNotes.index'));
            }
            
            $user = DB::table('shared_profile_note')->join('users', 'users.id', '=', 'shared_profile_note.user_id')->where('shared_profile_note.id', '=', $id)->get();
            
            if($user_id == $user[0] -> id)
            {
                $files_list = DB::table('shared_profile_file')->where(function ($query) {$query->where('shared_profile_file.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                $notes_list = DB::table('shared_profile_note')->where(function ($query) {$query->where('shared_profile_note.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                $images_list = DB::table('shared_profile_image')->where(function ($query) {$query->where('shared_profile_image.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                $audios_list = DB::table('shared_profile_audio')->where(function ($query) {$query->where('shared_profile_audio.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                $videos_list = DB::table('shared_profile_video')->where(function ($query) {$query->where('shared_profile_video.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                
                return view('shared_profile_notes.edit')
                    ->with('sharedProfileNote', $sharedProfileNote)
                    ->with('id', $id)
                    ->with('files_list', $files_list)
                    ->with('notes_list', $notes_list)
                    ->with('images_list', $images_list)
                    ->with('audios_list', $audios_list)
                    ->with('videos_list', $videos_list);
            }
            
            else
            {
                return view('deniedAccess');
            }
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function update($id, UpdateSharedProfileNoteRequest $request)
    {
        if(isset(Auth::user()->id))
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $sharedProfileNote = $this->sharedProfileNoteRepository->findWithoutFail($id);
    
            if(empty($sharedProfileNote))
            {
                Flash::error('Shared Profile Note not found');
                return redirect(route('sharedProfileNotes.index'));
            }
            
            $user = DB::table('shared_profile_note')->join('users', 'users.id', '=', 'shared_profile_note.user_id')->where('shared_profile_note.id', '=', $id)->get();
    
            if($user_id == $user[0] -> id)
            {
                $sharedProfileNote = $this->sharedProfileNoteRepository->update($request->all(), $id);
            
                DB::table('recent_activities')->insert(['name' => $sharedProfileNote -> name, 'status' => 'active', 'type' => 'p_n_u', 'user_id' => $user_id, 'entity_id' => $sharedProfileNote -> id, 'created_at' => $now]);
    
                Flash::success('Shared Profile Note updated successfully.');
                return redirect(route('sharedProfileNotes.show', [$sharedProfileNote -> id]));
            }
            
            else
            {
                return view('deniedAccess');
            }
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function destroy($id)
    {
        if(isset(Auth::user()->id))
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $sharedProfileNote = $this->sharedProfileNoteRepository->findWithoutFail($id);
    
            if(empty($sharedProfileNote))
            {
                Flash::error('Shared Profile Note not found');
                return redirect(route('sharedProfileNotes.index'));
            }
            
            $user = DB::table('shared_profile_note')->join('users', 'users.id', '=', 'shared_profile_note.user_id')->where('shared_profile_note.id', '=', $id)->get();
            
            if($user_id == $user[0] -> id)
            {
                $this->sharedProfileNoteRepository->delete($id);
                
                DB::table('recent_activities')->insert(['name' => $sharedProfileNote -> name, 'status' => 'active', 'type' => 'p_n_d', 'user_id' => $user_id, 'entity_id' => $sharedProfileNote -> id, 'created_at' => $now]);
            
                Flash::success('Shared Profile Note deleted successfully.');
                return redirect(route('sharedProfile.index'));
            }
            
            else
            {
                return view('deniedAccess');
            }
        }
        
        else
        {
            return view('deniedAccess');
        }
    }
}