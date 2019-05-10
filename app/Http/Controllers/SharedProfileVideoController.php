<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateSharedProfileVideoRequest;
use App\Http\Requests\UpdateSharedProfileVideoRequest;
use App\Repositories\SharedProfileVideoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class SharedProfileVideoController extends AppBaseController
{
    /** @var  SharedProfileVideoRepository */
    private $sharedProfileVideoRepository;

    public function __construct(SharedProfileVideoRepository $sharedProfileVideoRepo)
    {
        $this->sharedProfileVideoRepository = $sharedProfileVideoRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->sharedProfileVideoRepository->pushCriteria(new RequestCriteria($request));
            $sharedProfileVideos = $this->sharedProfileVideoRepository->all();
    
            return view('shared_profile_videos.index')
                ->with('sharedProfileVideos', $sharedProfileVideos);
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
            
            return view('shared_profile_videos.create')
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

    public function store(CreateSharedProfileVideoRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $sharedProfileVideo = $this->sharedProfileVideoRepository->create($input);
            
            $file = $request->file('file');
            $new_file = 'video_' . $sharedProfileVideo -> id . '.' . $file -> getClientOriginalExtension();
            $file->move(public_path("videos/shared_profile_videos/"), $new_file);
            $fileType = $file -> getClientOriginalExtension();
            $size = $request->file('file')->getClientSize();
    
            DB::table('shared_profile_video')->where('id', $sharedProfileVideo->id)->update(['file_type' => $fileType, 'file_size' => $size]);
            DB::table('recent_activities')->insert(['name' => $sharedProfileVideo -> name, 'status' => 'active', 'type' => 'p_v_c', 'user_id' => $user_id, 'entity_id' => $sharedProfileVideo -> id, 'created_at' => $now]);
    
            Flash::success('Shared Profile Video saved successfully.');
            return redirect(route('sharedProfileVideos.show', [$sharedProfileVideo -> id]));
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
            $sharedProfileVideo = $this->sharedProfileVideoRepository->findWithoutFail($id);
                
            if(empty($sharedProfileVideo))
            {
                Flash::error('Shared Profile Video not found');
                return redirect(route('sharedProfileVideos.index'));
            }
            
            $userSharedProfiles = DB::table('user_shared_profile')->where('user_id', '=', $sharedProfileVideo -> user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userSharedProfiles as $userSharedProfile)
            {
                if($userSharedProfile -> shared_user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            if($user_id == $sharedProfileVideo -> user_id || $isShared)
            {
                
                $user = DB::table('shared_profile_video')->join('users', 'users.id', '=', 'shared_profile_video.user_id')->where('shared_profile_video.id', '=', $id)->get();
                    
                DB::table('shared_profile_video_views')->insert(['datetime' => $now, 'user_id' => $user_id, 's_p_v_id' => $id]);
                DB::table('shared_profile_video')->where('id', $id)->update(['views_quantity' => DB::raw('views_quantity + 1')]);
                
                $actual_user = DB:: table('users')->where('id', '=', $user_id)->get();
                
                $sharedProfileVideoViews = DB::table('users')->join('shared_profile_video_views', 'users.id', '=', 'shared_profile_video_views.user_id')->where('s_p_v_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
                $sharedProfileVideoUpdates = DB::table('users')->join('shared_profile_video', 'users.id', '=', 'shared_profile_video.user_id')->where('shared_profile_video.id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
            
                $shared_profile_video_users = DB::table('shared_profile_video')->join('users', 'shared_profile_video.user_id', '=', 'users.id')->where('shared_profile_video.id', '=', $sharedProfileVideo -> id)->where(function ($query) {$query->where('shared_profile_video.deleted_at', '=', null);})->orderBy('shared_profile_video.created_at', 'desc')->paginate(20, ['*'], 'video_user_p');
                $shared_profile_video_comments = DB::table('shared_profile_video_c')->where('s_p_v_id', '=', $sharedProfileVideo -> id)->where(function ($query) {$query->where('shared_profile_video_c.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(20, ['*'], 'video_comment_p');
                $shared_profile_video_comment_counts = DB::table('shared_profile_video_c')->where('s_p_v_id', '=', $sharedProfileVideo -> id)->where(function ($query) {$query->where('shared_profile_video_c.deleted_at', '=', null);})->orderBy('created_at', 'desc')->get()->count();
                $shared_profile_video_comment_users = DB::table('shared_profile_video_c')->join('users', 'shared_profile_video_c.user_id', '=', 'users.id')->select('users.name', 'users.image_type', 'shared_profile_video_c.user_id', 'shared_profile_video_c.id')->where('shared_profile_video_c.s_p_v_id', '=', $sharedProfileVideo -> id)->where(function ($query) {$query->where('shared_profile_video_c.deleted_at', '=', null);})->orderBy('shared_profile_video_c.created_at', 'desc')->paginate(20, ['*'], 'video_comment_user_p');
                $shared_profile_video_likes = DB::table('shared_profile_video_like')->join('users', 'users.id', '=', 'shared_profile_video_like.user_id')->select('users.name', 'users.email', 'shared_profile_video_like.datetime')->where('s_p_v_id', '=', $sharedProfileVideo -> id)->where(function ($query) {$query->where('shared_profile_video_like.deleted_at', '=', null);})->orderBy('shared_profile_video_like.created_at', 'desc')->get();
                $shared_profile_video_like_counts = DB::table('shared_profile_video_like')->join('users', 'users.id', '=', 'shared_profile_video_like.user_id')->select('users.name', 'users.email', 'shared_profile_video_like.datetime')->where('s_p_v_id', '=', $sharedProfileVideo -> id)->where(function ($query) {$query->where('shared_profile_video_like.deleted_at', '=', null);})->orderBy('shared_profile_video_like.created_at', 'desc')->get()->count();
        
                $i = 0;
                $shared_profile_video_comment_responses = null;
                $shared_profile_video_comment_response_users = null;
        
                foreach($shared_profile_video_comments as $shared_profile_video_comment)
                {
                    $shared_profile_video_comment_responses[$i] = DB::table('shared_profile_video_c_response')->where('s_p_v_c_id', '=', $shared_profile_video_comment -> id)->where(function ($query) {$query->where('shared_profile_video_c_response.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(5, ['*'], 'video_comment_response_p');
                    $shared_profile_video_comment_response_users[$i] = DB::table('shared_profile_video_c_response')->join('users', 'shared_profile_video_c_response.user_id', '=', 'users.id')->select('users.name', 'users.image_type', 'shared_profile_video_c_response.user_id', 'shared_profile_video_c_response.id')->where('shared_profile_video_c_response.s_p_v_c_id', '=', $shared_profile_video_comment -> id)->where(function ($query) {$query->where('shared_profile_video_c_response.deleted_at', '=', null);})->orderBy('shared_profile_video_c_response.created_at', 'desc')->paginate(5, ['*'], 'video_comment_response_user_p');
                    $i += 1;
                }
                
                $files_list = DB::table('shared_profile_file')->where(function ($query) {$query->where('shared_profile_file.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                $notes_list = DB::table('shared_profile_note')->where(function ($query) {$query->where('shared_profile_note.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                $images_list = DB::table('shared_profile_image')->where(function ($query) {$query->where('shared_profile_image.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                $audios_list = DB::table('shared_profile_audio')->where(function ($query) {$query->where('shared_profile_audio.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                $videos_list = DB::table('shared_profile_video')->where(function ($query) {$query->where('shared_profile_video.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                
                return view('shared_profile_videos.show')
                    ->with('sharedProfileVideo', $sharedProfileVideo)
                    ->with('sharedProfileVideoViews', $sharedProfileVideoViews)
                    ->with('sharedProfileVideoUpdates', $sharedProfileVideoUpdates)
                    ->with('sharedProfileVideoUsers', $shared_profile_video_users)
                    ->with('sharedProfileVideoComments', $shared_profile_video_comments)
                    ->with('sharedProfileVideoCommentCounts', $shared_profile_video_comment_counts)
                    ->with('sharedProfileVideoCommentUsers', $shared_profile_video_comment_users)
                    ->with('sharedProfileVideoLikes', $shared_profile_video_likes)
                    ->with('sharedProfileVideoLikeCounts', $shared_profile_video_like_counts)
                    ->with('sharedProfileVideoCommentResponses', $shared_profile_video_comment_responses)
                    ->with('sharedProfileVideoCommentResponseUsers', $shared_profile_video_comment_response_users)
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
            $sharedProfileVideo = $this->sharedProfileVideoRepository->findWithoutFail($id);
    
            if(empty($sharedProfileVideo))
            {
                Flash::error('Shared Profile Video not found');
                return redirect(route('sharedProfileVideos.index'));
            }
            
            $user = DB::table('shared_profile_video')->join('users', 'users.id', '=', 'shared_profile_video.user_id')->where('shared_profile_video.id', '=', $id)->get();
            
            if($user_id == $user[0] -> id)
            {
                $files_list = DB::table('shared_profile_file')->where(function ($query) {$query->where('shared_profile_file.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                $notes_list = DB::table('shared_profile_note')->where(function ($query) {$query->where('shared_profile_note.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                $images_list = DB::table('shared_profile_image')->where(function ($query) {$query->where('shared_profile_image.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                $audios_list = DB::table('shared_profile_audio')->where(function ($query) {$query->where('shared_profile_audio.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                $videos_list = DB::table('shared_profile_video')->where(function ($query) {$query->where('shared_profile_video.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                
                return view('shared_profile_videos.edit')
                    ->with('sharedProfileVideo', $sharedProfileVideo)
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

    public function update($id, UpdateSharedProfileVideoRequest $request)
    {
        if(isset(Auth::user()->id))
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $sharedProfileVideo = $this->sharedProfileVideoRepository->findWithoutFail($id);
    
            if(empty($sharedProfileVideo))
            {
                Flash::error('Shared Profile Video not found');
                return redirect(route('sharedProfileVideos.index'));
            }
            
            $user = DB::table('shared_profile_video')->join('users', 'users.id', '=', 'shared_profile_video.user_id')->where('shared_profile_video.id', '=', $id)->get();
    
            if($user_id == $user[0] -> id)
            {
                $sharedProfileVideo = $this->sharedProfileVideoRepository->update($request->all(), $id);
            
                DB::table('recent_activities')->insert(['name' => $sharedProfileVideo -> name, 'status' => 'active', 'type' => 'p_v_u', 'user_id' => $user_id, 'entity_id' => $sharedProfileVideo -> id, 'created_at' => $now]);
    
                Flash::success('Shared Profile Video updated successfully.');
                return redirect(route('sharedProfileVideos.show', [$sharedProfileVideo -> id]));
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
            $sharedProfileVideo = $this->sharedProfileVideoRepository->findWithoutFail($id);
    
            if(empty($sharedProfileVideo))
            {
                Flash::error('Shared Profile Video not found');
                return redirect(route('sharedProfileVideos.index'));
            }
            
            $user = DB::table('shared_profile_video')->join('users', 'users.id', '=', 'shared_profile_video.user_id')->where('shared_profile_video.id', '=', $id)->get();
            
            if($user_id == $user[0] -> id)
            {
                $this->sharedProfileVideoRepository->delete($id);
                
                DB::table('recent_activities')->insert(['name' => $sharedProfileVideo -> name, 'status' => 'active', 'type' => 'p_v_d', 'user_id' => $user_id, 'entity_id' => $sharedProfileVideo -> id, 'created_at' => $now]);
            
                Flash::success('Shared Profile Video deleted successfully.');
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