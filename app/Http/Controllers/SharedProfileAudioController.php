<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateSharedProfileAudioRequest;
use App\Http\Requests\UpdateSharedProfileAudioRequest;
use App\Repositories\SharedProfileAudioRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class SharedProfileAudioController extends AppBaseController
{
    private $sharedProfileAudioRepository;

    public function __construct(SharedProfileAudioRepository $sharedProfileAudioRepo)
    {
        $this->sharedProfileAudioRepository = $sharedProfileAudioRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->sharedProfileAudioRepository->pushCriteria(new RequestCriteria($request));
            $sharedProfileAudios = $this->sharedProfileAudioRepository->all();
    
            return view('shared_profile_audios.index')
                ->with('sharedProfileAudios', $sharedProfileAudios);
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
            
            return view('shared_profile_audios.create')
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

    public function store(CreateSharedProfileAudioRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $sharedProfileAudio = $this->sharedProfileAudioRepository->create($input);
            
            $file = $request->file('file');
            $new_file = 'audio_' . $sharedProfileAudio -> id . '.' . $file -> getClientOriginalExtension();
            $file->move(public_path("audios/shared_profile_audios/"), $new_file);
            $fileType = $file -> getClientOriginalExtension();
            $size = $request->file('file')->getClientSize();
    
            DB::table('shared_profile_audio')->where('id', $sharedProfileAudio->id)->update(['file_type' => $fileType, 'file_size' => $size]);
            DB::table('recent_activities')->insert(['name' => $sharedProfileAudio -> name, 'status' => 'active', 'type' => 'p_a_c', 'user_id' => $user_id, 'entity_id' => $sharedProfileAudio -> id, 'created_at' => $now]);
    
            Flash::success('Shared Profile Audio saved successfully.');
            return redirect(route('sharedProfileAudios.show', [$sharedProfileAudio -> id]));
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
            $sharedProfileAudio = $this->sharedProfileAudioRepository->findWithoutFail($id);
                
            if(empty($sharedProfileAudio))
            {
                Flash::error('Shared Profile Audio not found');
                return redirect(route('sharedProfileAudios.index'));
            }
            
            $userSharedProfiles = DB::table('user_shared_profile')->where('user_id', '=', $sharedProfileAudio -> user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userSharedProfiles as $userSharedProfile)
            {
                if($userSharedProfile -> shared_user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            if($user_id == $sharedProfileAudio -> user_id || $isShared)
            {
                $user = DB::table('shared_profile_audio')->join('users', 'users.id', '=', 'shared_profile_audio.user_id')->where('shared_profile_audio.id', '=', $id)->get();
                
                DB::table('shared_profile_audio_views')->insert(['datetime' => $now, 'user_id' => $user_id, 's_p_a_id' => $id]);
                DB::table('shared_profile_audio')->where('id', $id)->update(['views_quantity' => DB::raw('views_quantity + 1')]);
                
                $actual_user = DB:: table('users')->where('id', '=', $user_id)->get();
                
                $sharedProfileAudioViews = DB::table('users')->join('shared_profile_audio_views', 'users.id', '=', 'shared_profile_audio_views.user_id')->where('s_p_a_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
                $sharedProfileAudioUpdates = DB::table('users')->join('shared_profile_audio', 'users.id', '=', 'shared_profile_audio.user_id')->where('shared_profile_audio.id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
            
                $shared_profile_audio_users = DB::table('shared_profile_audio')->join('users', 'shared_profile_audio.user_id', '=', 'users.id')->where('shared_profile_audio.id', '=', $sharedProfileAudio -> id)->where(function ($query) {$query->where('shared_profile_audio.deleted_at', '=', null);})->orderBy('shared_profile_audio.created_at', 'desc')->paginate(20, ['*'], 'audio_user_p');
                $shared_profile_audio_comments = DB::table('shared_profile_audio_c')->where('s_p_a_id', '=', $sharedProfileAudio -> id)->where(function ($query) {$query->where('shared_profile_audio_c.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(20, ['*'], 'audio_comment_p');
                $shared_profile_audio_comment_counts = DB::table('shared_profile_audio_c')->where('s_p_a_id', '=', $sharedProfileAudio -> id)->where(function ($query) {$query->where('shared_profile_audio_c.deleted_at', '=', null);})->orderBy('created_at', 'desc')->get()->count();
                $shared_profile_audio_comment_users = DB::table('shared_profile_audio_c')->join('users', 'shared_profile_audio_c.user_id', '=', 'users.id')->select('users.name', 'users.image_type', 'shared_profile_audio_c.user_id', 'shared_profile_audio_c.id')->where('shared_profile_audio_c.s_p_a_id', '=', $sharedProfileAudio -> id)->where(function ($query) {$query->where('shared_profile_audio_c.deleted_at', '=', null);})->orderBy('shared_profile_audio_c.created_at', 'desc')->paginate(20, ['*'], 'audio_comment_user_p');
                $shared_profile_audio_likes = DB::table('shared_profile_audio_like')->join('users', 'users.id', '=', 'shared_profile_audio_like.user_id')->select('users.name', 'users.email', 'shared_profile_audio_like.datetime')->where('s_p_a_id', '=', $sharedProfileAudio -> id)->where(function ($query) {$query->where('shared_profile_audio_like.deleted_at', '=', null);})->orderBy('shared_profile_audio_like.created_at', 'desc')->get();
                $shared_profile_audio_like_counts = DB::table('shared_profile_audio_like')->join('users', 'users.id', '=', 'shared_profile_audio_like.user_id')->select('users.name', 'users.email', 'shared_profile_audio_like.datetime')->where('s_p_a_id', '=', $sharedProfileAudio -> id)->where(function ($query) {$query->where('shared_profile_audio_like.deleted_at', '=', null);})->orderBy('shared_profile_audio_like.created_at', 'desc')->get()->count();
        
                $i = 0;
                $shared_profile_audio_comment_responses = null;
                $shared_profile_audio_comment_response_users = null;
        
                foreach($shared_profile_audio_comments as $shared_profile_audio_comment)
                {
                    $shared_profile_audio_comment_responses[$i] = DB::table('shared_profile_audio_c_response')->where('s_p_a_c_id', '=', $shared_profile_audio_comment -> id)->where(function ($query) {$query->where('shared_profile_audio_c_response.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(5, ['*'], 'audio_comment_response_p');
                    $shared_profile_audio_comment_response_users[$i] = DB::table('shared_profile_audio_c_response')->join('users', 'shared_profile_audio_c_response.user_id', '=', 'users.id')->select('users.name', 'users.image_type', 'shared_profile_audio_c_response.user_id', 'shared_profile_audio_c_response.id')->where('shared_profile_audio_c_response.s_p_a_c_id', '=', $shared_profile_audio_comment -> id)->where(function ($query) {$query->where('shared_profile_audio_c_response.deleted_at', '=', null);})->orderBy('shared_profile_audio_c_response.created_at', 'desc')->paginate(5, ['*'], 'audio_comment_response_user_p');
                    $i += 1;
                }
                        
                $files_list = DB::table('shared_profile_file')->where(function ($query) {$query->where('shared_profile_file.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                $notes_list = DB::table('shared_profile_note')->where(function ($query) {$query->where('shared_profile_note.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                $images_list = DB::table('shared_profile_image')->where(function ($query) {$query->where('shared_profile_image.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                $audios_list = DB::table('shared_profile_audio')->where(function ($query) {$query->where('shared_profile_audio.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                $videos_list = DB::table('shared_profile_video')->where(function ($query) {$query->where('shared_profile_video.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                
                return view('shared_profile_audios.show')
                    ->with('sharedProfileAudio', $sharedProfileAudio)
                    ->with('sharedProfileAudioViews', $sharedProfileAudioViews)
                    ->with('sharedProfileAudioUpdates', $sharedProfileAudioUpdates)
                    ->with('sharedProfileAudioUsers', $shared_profile_audio_users)
                    ->with('sharedProfileAudioComments', $shared_profile_audio_comments)
                    ->with('sharedProfileAudioCommentCounts', $shared_profile_audio_comment_counts)
                    ->with('sharedProfileAudioCommentUsers', $shared_profile_audio_comment_users)
                    ->with('sharedProfileAudioLikes', $shared_profile_audio_likes)
                    ->with('sharedProfileAudioLikeCounts', $shared_profile_audio_like_counts)
                    ->with('sharedProfileAudioCommentResponses', $shared_profile_audio_comment_responses)
                    ->with('sharedProfileAudioCommentResponseUsers', $shared_profile_audio_comment_response_users)
                    ->with('user', $user)
                    ->with('user_id', $user_id)
                    ->with('now', $now)
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
            $sharedProfileAudio = $this->sharedProfileAudioRepository->findWithoutFail($id);
    
            if(empty($sharedProfileAudio))
            {
                Flash::error('Shared Profile Audio not found');
                return redirect(route('sharedProfileAudios.index'));
            }
            
            $user = DB::table('shared_profile_audio')->join('users', 'users.id', '=', 'shared_profile_audio.user_id')->where('shared_profile_audio.id', '=', $id)->get();
            
            if($user_id == $user[0] -> id)
            {
                $files_list = DB::table('shared_profile_file')->where(function ($query) {$query->where('shared_profile_file.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                $notes_list = DB::table('shared_profile_note')->where(function ($query) {$query->where('shared_profile_note.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                $images_list = DB::table('shared_profile_image')->where(function ($query) {$query->where('shared_profile_image.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                $audios_list = DB::table('shared_profile_audio')->where(function ($query) {$query->where('shared_profile_audio.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                $videos_list = DB::table('shared_profile_video')->where(function ($query) {$query->where('shared_profile_video.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                
                return view('shared_profile_audios.edit')
                    ->with('sharedProfileAudio', $sharedProfileAudio)
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

    public function update($id, UpdateSharedProfileAudioRequest $request)
    {
        if(isset(Auth::user()->id))
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $sharedProfileAudio = $this->sharedProfileAudioRepository->findWithoutFail($id);
    
            if(empty($sharedProfileAudio))
            {
                Flash::error('Shared Profile Audio not found');
                return redirect(route('sharedProfileAudios.index'));
            }
            
            $user = DB::table('shared_profile_audio')->join('users', 'users.id', '=', 'shared_profile_audio.user_id')->where('shared_profile_audio.id', '=', $id)->get();
    
            if($user_id == $user[0] -> id)
            {
                $sharedProfileAudio = $this->sharedProfileAudioRepository->update($request->all(), $id);
            
                DB::table('recent_activities')->insert(['name' => $sharedProfileAudio -> name, 'status' => 'active', 'type' => 'p_a_u', 'user_id' => $user_id, 'entity_id' => $sharedProfileAudio -> id, 'created_at' => $now]);
    
                Flash::success('Shared Profile Audio updated successfully.');
                return redirect(route('sharedProfileAudios.show', [$sharedProfileAudio -> id]));
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
            $sharedProfileAudio = $this->sharedProfileAudioRepository->findWithoutFail($id);
    
            if(empty($sharedProfileAudio))
            {
                Flash::error('Shared Profile Audio not found');
                return redirect(route('sharedProfileAudios.index'));
            }
            
            $user = DB::table('shared_profile_audio')->join('users', 'users.id', '=', 'shared_profile_audio.user_id')->where('shared_profile_audio.id', '=', $id)->get();
            
            if($user_id == $user[0] -> id)
            {
                //DB::table('shared_profile_audio')->where('id', $sharedProfileAudio -> id)->update(['deleted_at' => $now]);
                
                $this->sharedProfileAudioRepository->delete($id);
                
                DB::table('recent_activities')->insert(['name' => $sharedProfileAudio -> name, 'status' => 'active', 'type' => 'p_a_d', 'user_id' => $user_id, 'entity_id' => $sharedProfileAudio -> id, 'created_at' => $now]);
            
                Flash::success('Shared Profile Audio deleted successfully.');
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