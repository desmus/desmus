<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePublicNoteRequest;
use App\Http\Requests\UpdatePublicNoteRequest;
use App\Repositories\PublicNoteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;
use GoogleCloudVision\GoogleCloudVision;
use GoogleCloudVision\Request\AnnotateImageRequest;

class PublicNoteController extends AppBaseController
{
    private $publicNoteRepository;

    public function __construct(PublicNoteRepository $publicNoteRepo)
    {
        $this->publicNoteRepository = $publicNoteRepo;
    }
    
    public function annotateImage($id, Request $request)
    {
        $now = Carbon::now();
        
        if(isset(Auth::user()->id))
        {
            $user_id = Auth::user()->id;
        }
        
        $publicNote = $this->publicNoteRepository->findWithoutFail($id);
            
        if(empty($publicNote))
        {
            Flash::error('Public Note not found');
            return redirect(route('publicNote.index'));
        }
            
        $user = DB::table('public_note')->join('users', 'users.id', '=', 'public_note.user_id')->where('public_note.id', '=', $id)->get();
        
        if(isset(Auth::user()->id))
        {
            DB::table('public_note_views')->insert(['datetime' => $now, 'user_id' => $user_id, 'public_note_id' => $id]);
        }
        
        DB::table('public_note')->where('id', $id)->update(['views_quantity' => DB::raw('views_quantity + 1')]);
        
        if(isset(Auth::user()->id))
        {
            $actual_user = DB:: table('users')->where('id', '=', $user_id)->get();
        }
        
        $publicNoteViews = DB::table('users')->join('public_note_views', 'users.id', '=', 'public_note_views.user_id')->where('public_note_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
        $publicNoteUpdates = DB::table('users')->join('public_note', 'users.id', '=', 'public_note.user_id')->where('public_note.id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
                
        $public_note_users = DB::table('public_note')->join('users', 'public_note.user_id', '=', 'users.id')->where('public_note.id', '=', $publicNote -> id)->where(function ($query) {$query->where('public_note.deleted_at', '=', null);})->orderBy('public_note.created_at', 'desc')->paginate(20, ['*'], 'note_user_p');
        $public_note_comments = DB::table('public_note_comment')->where('public_note_id', '=', $publicNote -> id)->where(function ($query) {$query->where('public_note_comment.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(20, ['*'], 'note_comment_p');
        $public_note_comment_counts = DB::table('public_note_comment')->where('public_note_id', '=', $publicNote -> id)->where(function ($query) {$query->where('public_note_comment.deleted_at', '=', null);})->orderBy('created_at', 'desc')->get()->count();
        $public_note_comment_users = DB::table('public_note_comment')->join('users', 'public_note_comment.user_id', '=', 'users.id')->select('users.name', 'users.image_type','public_note_comment.user_id', 'public_note_comment.id')->where('public_note_comment.public_note_id', '=', $publicNote -> id)->where(function ($query) {$query->where('public_note_comment.deleted_at', '=', null);})->orderBy('public_note_comment.created_at', 'desc')->paginate(20, ['*'], 'note_comment_user_p');
        $public_note_likes = DB::table('public_note_like')->join('users', 'users.id', '=', 'public_note_like.user_id')->select('users.name', 'users.email', 'public_note_like.datetime')->where('public_note_id', '=', $publicNote -> id)->where(function ($query) {$query->where('public_note_like.deleted_at', '=', null);})->orderBy('public_note_like.created_at', 'desc')->get();
        $public_note_like_counts = DB::table('public_note_like')->join('users', 'users.id', '=', 'public_note_like.user_id')->select('users.name', 'users.email', 'public_note_like.datetime')->where('public_note_id', '=', $publicNote -> id)->where(function ($query) {$query->where('public_note_like.deleted_at', '=', null);})->orderBy('public_note_like.created_at', 'desc')->get()->count();

        $i = 0;
        $public_note_comment_responses = null;
        $public_note_comment_response_users = null;

        foreach($public_note_comments as $public_note_comment)
        {
            $public_note_comment_responses[$i] = DB::table('public_note_comment_response')->where('public_note_comment_id', '=', $public_note_comment -> id)->where(function ($query) {$query->where('public_note_comment_response.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(5, ['*'], 'note_comment_response_p');
            $public_note_comment_response_users[$i] = DB::table('public_note_comment_response')->join('users', 'public_note_comment_response.user_id', '=', 'users.id')->select('users.name', 'users.image_type','public_note_comment_response.user_id', 'public_note_comment_response.id')->where('public_note_comment_response.public_note_comment_id', '=', $public_note_comment -> id)->where(function ($query) {$query->where('public_note_comment_response.deleted_at', '=', null);})->orderBy('public_note_comment_response.created_at', 'desc')->paginate(5, ['*'], 'note_comment_response_user_p');
            $i += 1;
        }
                
        $text = $publicNote -> content;
            
        if($request->file('image'))
        {
            $image = base64_encode(file_get_contents($request->file('image')));
            $request = new AnnotateImageRequest();
            $request->setImage($image);
            $request->setFeature("TEXT_DETECTION");
            $gcvRequest = new GoogleCloudVision([$request], 'AIzaSyCiYAx75dCXDnjUNPIOzlqTp0H7Up9AQh8');
            $response = $gcvRequest->annotate();
            
            $text = $text . $response->responses[0]->fullTextAnnotation->text;
        }
            
        $files_list = DB::table('public_file')->where(function ($query) {$query->where('public_file.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
        $notes_list = DB::table('public_note')->where(function ($query) {$query->where('public_note.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
        $images_list = DB::table('public_image')->where(function ($query) {$query->where('public_image.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
        $audios_list = DB::table('public_audio')->where(function ($query) {$query->where('public_audio.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
        $videos_list = DB::table('public_video')->where(function ($query) {$query->where('public_video.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
        $advertisements_list = DB::table('public_advertisement')->where(function ($query) {$query->where('public_advertisement.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
        
        if(isset(Auth::user()->id))
        {
            return view('public_notes.show')
                ->with('publicNote', $publicNote)
                ->with('publicNoteViews', $publicNoteViews)
                ->with('publicNoteUpdates', $publicNoteUpdates)
                ->with('publicNoteUsers', $public_note_users)
                ->with('publicNoteComments', $public_note_comments)
                ->with('publicNoteCommentCounts', $public_note_comment_counts)
                ->with('publicNoteCommentUsers', $public_note_comment_users)
                ->with('publicNoteLikes', $public_note_likes)
                ->with('publicNoteLikeCounts', $public_note_like_counts)
                ->with('publicNoteCommentResponses', $public_note_comment_responses)
                ->with('publicNoteCommentResponseUsers', $public_note_comment_response_users)
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
                ->with('videos_list', $videos_list)
                ->with('advertisements_list', $advertisements_list);
        }
        
        else
        {
            return view('public_notes.show')
                ->with('publicNote', $publicNote)
                ->with('publicNoteViews', $publicNoteViews)
                ->with('publicNoteUpdates', $publicNoteUpdates)
                ->with('publicNoteUsers', $public_note_users)
                ->with('publicNoteComments', $public_note_comments)
                ->with('publicNoteCommentCounts', $public_note_comment_counts)
                ->with('publicNoteCommentUsers', $public_note_comment_users)
                ->with('publicNoteLikes', $public_note_likes)
                ->with('publicNoteLikeCounts', $public_note_like_counts)
                ->with('publicNoteCommentResponses', $public_note_comment_responses)
                ->with('publicNoteCommentResponseUsers', $public_note_comment_response_users)
                ->with('text', $text)
                ->with('user', $user)
                ->with('now', $now)
                ->with('id', $id)
                ->with('files_list', $files_list)
                ->with('notes_list', $notes_list)
                ->with('images_list', $images_list)
                ->with('audios_list', $audios_list)
                ->with('videos_list', $videos_list)
                ->with('advertisements_list', $advertisements_list);
        }
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->publicNoteRepository->pushCriteria(new RequestCriteria($request));
            $publicNotes = $this->publicNoteRepository->all();
    
            return view('public_notes.index')
                ->with('publicNotes', $publicNotes);
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
            
            $files_list = DB::table('public_file')->where(function ($query) {$query->where('public_file.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
            $notes_list = DB::table('public_note')->where(function ($query) {$query->where('public_note.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
            $images_list = DB::table('public_image')->where(function ($query) {$query->where('public_image.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
            $audios_list = DB::table('public_audio')->where(function ($query) {$query->where('public_audio.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
            $videos_list = DB::table('public_video')->where(function ($query) {$query->where('public_video.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
            $advertisements_list = DB::table('public_advertisement')->where(function ($query) {$query->where('public_advertisement.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();

            return view('public_notes.create')
                ->with('user_id', $user_id)
                ->with('files_list', $files_list)
                ->with('notes_list', $notes_list)
                ->with('images_list', $images_list)
                ->with('audios_list', $audios_list)
                ->with('videos_list', $videos_list)
                ->with('advertisements_list', $advertisements_list);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreatePublicNoteRequest $request)
    {
        if(Auth::user() != null)
        {
            if(isset(Auth::user()->id))
            {
                $now = Carbon::now();
                $user_id = Auth::user()->id;
                $input = $request->all();
                $publicNote = $this->publicNoteRepository->create($input);
            
                DB::table('recent_activities')->insert(['name' => $publicNote -> name, 'status' => 'active', 'type' => 'p_n_c', 'user_id' => $user_id, 'entity_id' => $publicNote -> id, 'created_at' => $now]);
    
                Flash::success('Public Note saved successfully.');
                return redirect(route('publicNotes.show', [$publicNote -> id]));
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
        }
        
        $publicNote = $this->publicNoteRepository->findWithoutFail($id);
            
        if(empty($publicNote))
        {
            Flash::error('Public Note not found');
            return redirect(route('publicNote.index'));
        }
            
        $user = DB::table('public_note')->join('users', 'users.id', '=', 'public_note.user_id')->where('public_note.id', '=', $id)->get();
        
        if(isset(Auth::user()->id))
        {
            DB::table('public_note_views')->insert(['datetime' => $now, 'user_id' => $user_id, 'public_note_id' => $id]);
        }
        
        DB::table('public_note')->where('id', $id)->update(['views_quantity' => DB::raw('views_quantity + 1')]);
        
        if(isset(Auth::user()->id))
        {
            $actual_user = DB:: table('users')->where('id', '=', $user_id)->get();
        }
        
        $publicNoteViews = DB::table('users')->join('public_note_views', 'users.id', '=', 'public_note_views.user_id')->where('public_note_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
        $publicNoteUpdates = DB::table('users')->join('public_note', 'users.id', '=', 'public_note.user_id')->where('public_note.id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
                
        $public_note_users = DB::table('public_note')->join('users', 'public_note.user_id', '=', 'users.id')->where('public_note.id', '=', $publicNote -> id)->where(function ($query) {$query->where('public_note.deleted_at', '=', null);})->orderBy('public_note.created_at', 'desc')->paginate(20, ['*'], 'note_user_p');
        $public_note_comments = DB::table('public_note_comment')->where('public_note_id', '=', $publicNote -> id)->where(function ($query) {$query->where('public_note_comment.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(20, ['*'], 'note_comment_p');
        $public_note_comment_counts = DB::table('public_note_comment')->where('public_note_id', '=', $publicNote -> id)->where(function ($query) {$query->where('public_note_comment.deleted_at', '=', null);})->orderBy('created_at', 'desc')->get()->count();
        $public_note_comment_users = DB::table('public_note_comment')->join('users', 'public_note_comment.user_id', '=', 'users.id')->select('users.name', 'users.image_type','public_note_comment.user_id', 'public_note_comment.id')->where('public_note_comment.public_note_id', '=', $publicNote -> id)->where(function ($query) {$query->where('public_note_comment.deleted_at', '=', null);})->orderBy('public_note_comment.created_at', 'desc')->paginate(20, ['*'], 'note_comment_user_p');
        $public_note_likes = DB::table('public_note_like')->join('users', 'users.id', '=', 'public_note_like.user_id')->select('users.name', 'users.email', 'public_note_like.datetime')->where('public_note_id', '=', $publicNote -> id)->where(function ($query) {$query->where('public_note_like.deleted_at', '=', null);})->orderBy('public_note_like.created_at', 'desc')->get();
        $public_note_like_counts = DB::table('public_note_like')->join('users', 'users.id', '=', 'public_note_like.user_id')->select('users.name', 'users.email', 'public_note_like.datetime')->where('public_note_id', '=', $publicNote -> id)->where(function ($query) {$query->where('public_note_like.deleted_at', '=', null);})->orderBy('public_note_like.created_at', 'desc')->get()->count();

        $i = 0;
        $public_note_comment_responses = null;
        $public_note_comment_response_users = null;

        foreach($public_note_comments as $public_note_comment)
        {
            $public_note_comment_responses[$i] = DB::table('public_note_comment_response')->where('public_note_comment_id', '=', $public_note_comment -> id)->where(function ($query) {$query->where('public_note_comment_response.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(5, ['*'], 'note_comment_response_p');
            $public_note_comment_response_users[$i] = DB::table('public_note_comment_response')->join('users', 'public_note_comment_response.user_id', '=', 'users.id')->select('users.name', 'users.image_type','public_note_comment_response.user_id', 'public_note_comment_response.id')->where('public_note_comment_response.public_note_comment_id', '=', $public_note_comment -> id)->where(function ($query) {$query->where('public_note_comment_response.deleted_at', '=', null);})->orderBy('public_note_comment_response.created_at', 'desc')->paginate(5, ['*'], 'note_comment_response_user_p');
            $i += 1;
        }
                
        $text = '';
            
        $files_list = DB::table('public_file')->where(function ($query) {$query->where('public_file.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
        $notes_list = DB::table('public_note')->where(function ($query) {$query->where('public_note.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
        $images_list = DB::table('public_image')->where(function ($query) {$query->where('public_image.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
        $audios_list = DB::table('public_audio')->where(function ($query) {$query->where('public_audio.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
        $videos_list = DB::table('public_video')->where(function ($query) {$query->where('public_video.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
        $advertisements_list = DB::table('public_advertisement')->where(function ($query) {$query->where('public_advertisement.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
        
        if(isset(Auth::user()->id))
        {
            return view('public_notes.show')
                ->with('publicNote', $publicNote)
                ->with('publicNoteViews', $publicNoteViews)
                ->with('publicNoteUpdates', $publicNoteUpdates)
                ->with('publicNoteUsers', $public_note_users)
                ->with('publicNoteComments', $public_note_comments)
                ->with('publicNoteCommentCounts', $public_note_comment_counts)
                ->with('publicNoteCommentUsers', $public_note_comment_users)
                ->with('publicNoteLikes', $public_note_likes)
                ->with('publicNoteLikeCounts', $public_note_like_counts)
                ->with('publicNoteCommentResponses', $public_note_comment_responses)
                ->with('publicNoteCommentResponseUsers', $public_note_comment_response_users)
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
                ->with('videos_list', $videos_list)
                ->with('advertisements_list', $advertisements_list);
        }
        
        else
        {
            return view('public_notes.show')
                ->with('publicNote', $publicNote)
                ->with('publicNoteViews', $publicNoteViews)
                ->with('publicNoteUpdates', $publicNoteUpdates)
                ->with('publicNoteUsers', $public_note_users)
                ->with('publicNoteComments', $public_note_comments)
                ->with('publicNoteCommentCounts', $public_note_comment_counts)
                ->with('publicNoteCommentUsers', $public_note_comment_users)
                ->with('publicNoteLikes', $public_note_likes)
                ->with('publicNoteLikeCounts', $public_note_like_counts)
                ->with('publicNoteCommentResponses', $public_note_comment_responses)
                ->with('publicNoteCommentResponseUsers', $public_note_comment_response_users)
                ->with('text', $text)
                ->with('user', $user)
                ->with('now', $now)
                ->with('id', $id)
                ->with('files_list', $files_list)
                ->with('notes_list', $notes_list)
                ->with('images_list', $images_list)
                ->with('audios_list', $audios_list)
                ->with('videos_list', $videos_list)
                ->with('advertisements_list', $advertisements_list);
        }
    }

    public function edit($id)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $publicNote = $this->publicNoteRepository->findWithoutFail($id);
    
            if(empty($publicNote))
            {
                Flash::error('Public Note not found');
                return redirect(route('publicNotes.index'));
            }
            
            $user = DB::table('public_note')->join('users', 'users.id', '=', 'public_note.user_id')->where('public_note.id', '=', $id)->get();
            
            if($user_id == $user[0] -> id)
            {
                $files_list = DB::table('public_file')->where(function ($query) {$query->where('public_file.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                $notes_list = DB::table('public_note')->where(function ($query) {$query->where('public_note.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                $images_list = DB::table('public_image')->where(function ($query) {$query->where('public_image.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                $audios_list = DB::table('public_audio')->where(function ($query) {$query->where('public_audio.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                $videos_list = DB::table('public_video')->where(function ($query) {$query->where('public_video.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                $advertisements_list = DB::table('public_advertisement')->where(function ($query) {$query->where('public_advertisement.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                
                return view('public_notes.edit')
                    ->with('publicNote', $publicNote)
                    ->with('id', $id)
                    ->with('files_list', $files_list)
                    ->with('notes_list', $notes_list)
                    ->with('images_list', $images_list)
                    ->with('audios_list', $audios_list)
                    ->with('videos_list', $videos_list)
                    ->with('advertisements_list', $advertisements_list);
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

    public function update($id, UpdatePublicNoteRequest $request)
    {
        if(isset(Auth::user()->id))
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $publicNote = $this->publicNoteRepository->findWithoutFail($id);
    
            if(empty($publicNote))
            {
                Flash::error('Public Note not found');
                return redirect(route('publicNotes.index'));
            }
            
            $user = DB::table('public_note')->join('users', 'users.id', '=', 'public_note.user_id')->where('public_note.id', '=', $id)->get();
    
            if($user_id == $user[0] -> id)
            {
                $publicNote = $this->publicNoteRepository->update($request->all(), $id);
            
                DB::table('recent_activities')->insert(['name' => $publicNote -> name, 'status' => 'active', 'type' => 'p_n_u', 'user_id' => $user_id, 'entity_id' => $publicNote -> id, 'created_at' => $now]);
    
                Flash::success('Public Note updated successfully.');
                return redirect(route('publicNotes.show', [$publicNote -> id]));
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
            $publicNote = $this->publicNoteRepository->findWithoutFail($id);
    
            if(empty($publicNote))
            {
                Flash::error('Public Note not found');
                return redirect(route('publicNote.index'));
            }
            
            $user = DB::table('public_note')->join('users', 'users.id', '=', 'public_note.user_id')->where('public_note.id', '=', $id)->get();
            
            if($user_id == $user[0] -> id)
            {
                $this->publicNoteRepository->delete($id);
                
                DB::table('recent_activities')->insert(['name' => $publicNote -> name, 'status' => 'active', 'type' => 'p_n_d', 'user_id' => $user_id, 'entity_id' => $publicNote -> id, 'created_at' => $now]);
            
                Flash::success('Public Note deleted successfully.');
                return redirect(route('publicProfile.index'));
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