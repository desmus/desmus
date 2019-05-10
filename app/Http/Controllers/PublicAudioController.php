<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePublicAudioRequest;
use App\Http\Requests\UpdatePublicAudioRequest;
use App\Repositories\PublicAudioRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PublicAudioController extends AppBaseController
{
    private $publicAudioRepository;

    public function __construct(PublicAudioRepository $publicAudioRepo)
    {
        $this->publicAudioRepository = $publicAudioRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->publicAudioRepository->pushCriteria(new RequestCriteria($request));
            $publicAudios = $this->publicAudioRepository->all();
    
            return view('public_audios.index')
                ->with('publicAudios', $publicAudios);
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

            return view('public_audios.create')
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

    public function store(CreatePublicAudioRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $publicAudio = $this->publicAudioRepository->create($input);
            
            $file = $request->file('file');
            $new_file = 'audio_' . $publicAudio -> id . '.' . $file -> getClientOriginalExtension();
            $file->move(public_path("audios/public_audios/"), $new_file);
            $fileType = $file -> getClientOriginalExtension();
            $size = $request->file('file')->getClientSize();
    
            DB::table('public_audio')->where('id', $publicAudio->id)->update(['file_type' => $fileType, 'file_size' => $size]);
            DB::table('recent_activities')->insert(['name' => $publicAudio -> name, 'status' => 'active', 'type' => 'p_a_c', 'user_id' => $user_id, 'entity_id' => $publicAudio -> id, 'created_at' => $now]);
    
            Flash::success('Public Audio saved successfully.');
            return redirect(route('publicAudios.show', [$publicAudio -> id]));
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
            
        $publicAudio = $this->publicAudioRepository->findWithoutFail($id);
            
        if(empty($publicAudio))
        {
            Flash::error('Public Audio not found');
            return redirect(route('publicAudios.index'));
        }
            
        $user = DB::table('public_audio')->join('users', 'users.id', '=', 'public_audio.user_id')->where('public_audio.id', '=', $id)->get();
        
        if(isset(Auth::user()->id))
        {
            DB::table('public_audio_views')->insert(['datetime' => $now, 'user_id' => $user_id, 'public_audio_id' => $id]);
        }
        
        DB::table('public_audio')->where('id', $id)->update(['views_quantity' => DB::raw('views_quantity + 1')]);
        
        if(isset(Auth::user()->id))
        {
            $actual_user = DB:: table('users')->where('id', '=', $user_id)->get();
        }
        
        $publicAudioViews = DB::table('users')->join('public_audio_views', 'users.id', '=', 'public_audio_views.user_id')->where('public_audio_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
        $publicAudioUpdates = DB::table('users')->join('public_audio', 'users.id', '=', 'public_audio.user_id')->where('public_audio.id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
    
        $public_audio_users = DB::table('public_audio')->join('users', 'public_audio.user_id', '=', 'users.id')->where('public_audio.id', '=', $publicAudio -> id)->where(function ($query) {$query->where('public_audio.deleted_at', '=', null);})->orderBy('public_audio.created_at', 'desc')->paginate(20, ['*'], 'audio_user_p');
        $public_audio_comments = DB::table('public_audio_comment')->where('public_audio_id', '=', $publicAudio -> id)->where(function ($query) {$query->where('public_audio_comment.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(20, ['*'], 'audio_comment_p');
        $public_audio_comment_counts = DB::table('public_audio_comment')->where('public_audio_id', '=', $publicAudio -> id)->where(function ($query) {$query->where('public_audio_comment.deleted_at', '=', null);})->orderBy('created_at', 'desc')->get()->count();
        $public_audio_comment_users = DB::table('public_audio_comment')->join('users', 'public_audio_comment.user_id', '=', 'users.id')->select('users.name', 'users.image_type', 'public_audio_comment.user_id', 'public_audio_comment.id')->where('public_audio_comment.public_audio_id', '=', $publicAudio -> id)->where(function ($query) {$query->where('public_audio_comment.deleted_at', '=', null);})->orderBy('public_audio_comment.created_at', 'desc')->paginate(20, ['*'], 'audio_comment_user_p');
        $public_audio_likes = DB::table('public_audio_like')->join('users', 'users.id', '=', 'public_audio_like.user_id')->select('users.name', 'users.email', 'public_audio_like.datetime')->where('public_audio_id', '=', $publicAudio -> id)->where(function ($query) {$query->where('public_audio_like.deleted_at', '=', null);})->orderBy('public_audio_like.created_at', 'desc')->get();
        $public_audio_like_counts = DB::table('public_audio_like')->join('users', 'users.id', '=', 'public_audio_like.user_id')->select('users.name', 'users.email', 'public_audio_like.datetime')->where('public_audio_id', '=', $publicAudio -> id)->where(function ($query) {$query->where('public_audio_like.deleted_at', '=', null);})->orderBy('public_audio_like.created_at', 'desc')->get()->count();

        $i = 0;
        $public_audio_comment_responses = null;
        $public_audio_comment_response_users = null;

        foreach($public_audio_comments as $public_audio_comment)
        {
            $public_audio_comment_responses[$i] = DB::table('public_audio_comment_response')->where('public_audio_comment_id', '=', $public_audio_comment -> id)->where(function ($query) {$query->where('public_audio_comment_response.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(5, ['*'], 'audio_comment_response_p');
            $public_audio_comment_response_users[$i] = DB::table('public_audio_comment_response')->join('users', 'public_audio_comment_response.user_id', '=', 'users.id')->select('users.name', 'users.image_type', 'public_audio_comment_response.user_id', 'public_audio_comment_response.id')->where('public_audio_comment_response.public_audio_comment_id', '=', $public_audio_comment -> id)->where(function ($query) {$query->where('public_audio_comment_response.deleted_at', '=', null);})->orderBy('public_audio_comment_response.created_at', 'desc')->paginate(5, ['*'], 'audio_comment_response_user_p');
            $i += 1;
        }
                
        $files_list = DB::table('public_file')->where(function ($query) {$query->where('public_file.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
        $notes_list = DB::table('public_note')->where(function ($query) {$query->where('public_note.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
        $images_list = DB::table('public_image')->where(function ($query) {$query->where('public_image.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
        $audios_list = DB::table('public_audio')->where(function ($query) {$query->where('public_audio.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
        $videos_list = DB::table('public_video')->where(function ($query) {$query->where('public_video.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
        $advertisements_list = DB::table('public_advertisement')->where(function ($query) {$query->where('public_advertisement.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();

        if(isset(Auth::user()->id))
        {
            return view('public_audios.show')
                ->with('publicAudio', $publicAudio)
                ->with('publicAudioViews', $publicAudioViews)
                ->with('publicAudioUpdates', $publicAudioUpdates)
                ->with('publicAudioUsers', $public_audio_users)
                ->with('publicAudioComments', $public_audio_comments)
                ->with('publicAudioCommentCounts', $public_audio_comment_counts)
                ->with('publicAudioCommentUsers', $public_audio_comment_users)
                ->with('publicAudioLikes', $public_audio_likes)
                ->with('publicAudioLikeCounts', $public_audio_like_counts)
                ->with('publicAudioCommentResponses', $public_audio_comment_responses)
                ->with('publicAudioCommentResponseUsers', $public_audio_comment_response_users)
                ->with('user', $user)
                ->with('user_id', $user_id)
                ->with('now', $now)
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
            return view('public_audios.show')
                ->with('publicAudio', $publicAudio)
                ->with('publicAudioViews', $publicAudioViews)
                ->with('publicAudioUpdates', $publicAudioUpdates)
                ->with('publicAudioUsers', $public_audio_users)
                ->with('publicAudioComments', $public_audio_comments)
                ->with('publicAudioCommentCounts', $public_audio_comment_counts)
                ->with('publicAudioCommentUsers', $public_audio_comment_users)
                ->with('publicAudioLikes', $public_audio_likes)
                ->with('publicAudioLikeCounts', $public_audio_like_counts)
                ->with('publicAudioCommentResponses', $public_audio_comment_responses)
                ->with('publicAudioCommentResponseUsers', $public_audio_comment_response_users)
                ->with('user', $user)
                ->with('now', $now)
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
            $publicAudio = $this->publicAudioRepository->findWithoutFail($id);
    
            if(empty($publicAudio))
            {
                Flash::error('Public Audio not found');
                return redirect(route('publicAudios.index'));
            }
            
            $user = DB::table('public_audio')->join('users', 'users.id', '=', 'public_audio.user_id')->where('public_audio.id', '=', $id)->get();
            
            if($user_id == $user[0] -> id)
            {
                $files_list = DB::table('public_file')->where(function ($query) {$query->where('public_file.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                $notes_list = DB::table('public_note')->where(function ($query) {$query->where('public_note.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                $images_list = DB::table('public_image')->where(function ($query) {$query->where('public_image.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                $audios_list = DB::table('public_audio')->where(function ($query) {$query->where('public_audio.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                $videos_list = DB::table('public_video')->where(function ($query) {$query->where('public_video.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                $advertisements_list = DB::table('public_advertisement')->where(function ($query) {$query->where('public_advertisement.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();

                return view('public_audios.edit')
                    ->with('publicAudio', $publicAudio)
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

    public function update($id, UpdatePublicAudioRequest $request)
    {
        if(isset(Auth::user()->id))
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $publicAudio = $this->publicAudioRepository->findWithoutFail($id);
    
            if(empty($publicAudio))
            {
                Flash::error('Public Audio not found');
                return redirect(route('publicAudios.index'));
            }
            
            $user = DB::table('public_audio')->join('users', 'users.id', '=', 'public_audio.user_id')->where('public_audio.id', '=', $id)->get();
    
            if($user_id == $user[0] -> id)
            {
                $publicAudio = $this->publicAudioRepository->update($request->all(), $id);
            
                DB::table('recent_activities')->insert(['name' => $publicAudio -> name, 'status' => 'active', 'type' => 'p_a_u', 'user_id' => $user_id, 'entity_id' => $publicAudio -> id, 'created_at' => $now]);
    
                Flash::success('Public Audio updated successfully.');
                return redirect(route('publicAudios.show', [$publicAudio -> id]));
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
            $publicAudio = $this->publicAudioRepository->findWithoutFail($id);
    
            if(empty($publicAudio))
            {
                Flash::error('Public Audio not found');
                return redirect(route('publicAudios.index'));
            }
            
            $user = DB::table('public_audio')->join('users', 'users.id', '=', 'public_audio.user_id')->where('public_audio.id', '=', $id)->get();
            
            if($user_id == $user[0] -> id)
            {
                //DB::table('public_audio')->where('id', $publicAudio -> id)->update(['deleted_at' => $now]);
                
                $this->publicAudioRepository->delete($id);
                
                DB::table('recent_activities')->insert(['name' => $publicAudio -> name, 'status' => 'active', 'type' => 'p_a_d', 'user_id' => $user_id, 'entity_id' => $publicAudio -> id, 'created_at' => $now]);
            
                Flash::success('Public Audio deleted successfully.');
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