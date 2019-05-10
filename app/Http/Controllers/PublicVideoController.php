<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePublicVideoRequest;
use App\Http\Requests\UpdatePublicVideoRequest;
use App\Repositories\PublicVideoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PublicVideoController extends AppBaseController
{
    private $publicVideoRepository;

    public function __construct(PublicVideoRepository $publicVideoRepo)
    {
        $this->publicVideoRepository = $publicVideoRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->publicVideoRepository->pushCriteria(new RequestCriteria($request));
            $publicVideos = $this->publicVideoRepository->all();
    
            return view('public_videos.index')
                ->with('publicVideos', $publicVideos);
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

            return view('public_videos.create')
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

    public function store(CreatePublicVideoRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $publicVideo = $this->publicVideoRepository->create($input);
            
            $file = $request->file('file');
            $new_file = 'video_' . $publicVideo -> id . '.' . $file -> getClientOriginalExtension();
            $file->move(public_path("videos/public_videos/"), $new_file);
            $fileType = $file -> getClientOriginalExtension();
            $size = $request->file('file')->getClientSize();
    
            DB::table('public_video')->where('id', $publicVideo->id)->update(['file_type' => $fileType, 'file_size' => $size]);
            DB::table('recent_activities')->insert(['name' => $publicVideo -> name, 'status' => 'active', 'type' => 'p_v_c', 'user_id' => $user_id, 'entity_id' => $publicVideo -> id, 'created_at' => $now]);
    
            Flash::success('Public Video saved successfully.');
            return redirect(route('publicVideos.show', [$publicVideo -> id]));
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
            
        $publicVideo = $this->publicVideoRepository->findWithoutFail($id);
            
        if(empty($publicVideo))
        {
            Flash::error('Public Video not found');
            return redirect(route('publicVideos.index'));
        }
            
        $user = DB::table('public_video')->join('users', 'users.id', '=', 'public_video.user_id')->where('public_video.id', '=', $id)->get();
            
        if(isset(Auth::user()->id))
        {
            DB::table('public_video_views')->insert(['datetime' => $now, 'user_id' => $user_id, 'public_video_id' => $id]);
        }
        
        DB::table('public_video')->where('id', $id)->update(['views_quantity' => DB::raw('views_quantity + 1')]);
        
        if(isset(Auth::user()->id))
        {
            $actual_user = DB:: table('users')->where('id', '=', $user_id)->get();
        }
        
        $publicVideoViews = DB::table('users')->join('public_video_views', 'users.id', '=', 'public_video_views.user_id')->where('public_video_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
        $publicVideoUpdates = DB::table('users')->join('public_video', 'users.id', '=', 'public_video.user_id')->where('public_video.id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
    
        $public_video_users = DB::table('public_video')->join('users', 'public_video.user_id', '=', 'users.id')->where('public_video.id', '=', $publicVideo -> id)->where(function ($query) {$query->where('public_video.deleted_at', '=', null);})->orderBy('public_video.created_at', 'desc')->paginate(20, ['*'], 'video_user_p');
        $public_video_comments = DB::table('public_video_comment')->where('public_video_id', '=', $publicVideo -> id)->where(function ($query) {$query->where('public_video_comment.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(20, ['*'], 'video_comment_p');
        $public_video_comment_counts = DB::table('public_video_comment')->where('public_video_id', '=', $publicVideo -> id)->where(function ($query) {$query->where('public_video_comment.deleted_at', '=', null);})->orderBy('created_at', 'desc')->get()->count();
        $public_video_comment_users = DB::table('public_video_comment')->join('users', 'public_video_comment.user_id', '=', 'users.id')->select('users.name', 'users.image_type', 'public_video_comment.user_id', 'public_video_comment.id')->where('public_video_comment.public_video_id', '=', $publicVideo -> id)->where(function ($query) {$query->where('public_video_comment.deleted_at', '=', null);})->orderBy('public_video_comment.created_at', 'desc')->paginate(20, ['*'], 'video_comment_user_p');
        $public_video_likes = DB::table('public_video_like')->join('users', 'users.id', '=', 'public_video_like.user_id')->select('users.name', 'users.email', 'public_video_like.datetime')->where('public_video_id', '=', $publicVideo -> id)->where(function ($query) {$query->where('public_video_like.deleted_at', '=', null);})->orderBy('public_video_like.created_at', 'desc')->get();
        $public_video_like_counts = DB::table('public_video_like')->join('users', 'users.id', '=', 'public_video_like.user_id')->select('users.name', 'users.email', 'public_video_like.datetime')->where('public_video_id', '=', $publicVideo -> id)->where(function ($query) {$query->where('public_video_like.deleted_at', '=', null);})->orderBy('public_video_like.created_at', 'desc')->get()->count();

        $i = 0;
        $public_video_comment_responses = null;
        $public_video_comment_response_users = null;

        foreach($public_video_comments as $public_video_comment)
        {
            $public_video_comment_responses[$i] = DB::table('public_video_comment_response')->where('public_video_comment_id', '=', $public_video_comment -> id)->where(function ($query) {$query->where('public_video_comment_response.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(5, ['*'], 'video_comment_response_p');
            $public_video_comment_response_users[$i] = DB::table('public_video_comment_response')->join('users', 'public_video_comment_response.user_id', '=', 'users.id')->select('users.name', 'users.image_type', 'public_video_comment_response.user_id', 'public_video_comment_response.id')->where('public_video_comment_response.public_video_comment_id', '=', $public_video_comment -> id)->where(function ($query) {$query->where('public_video_comment_response.deleted_at', '=', null);})->orderBy('public_video_comment_response.created_at', 'desc')->paginate(5, ['*'], 'video_comment_response_user_p');
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
            return view('public_videos.show')
                ->with('publicVideo', $publicVideo)
                ->with('publicVideoViews', $publicVideoViews)
                ->with('publicVideoUpdates', $publicVideoUpdates)
                ->with('publicVideoUsers', $public_video_users)
                ->with('publicVideoComments', $public_video_comments)
                ->with('publicVideoCommentCounts', $public_video_comment_counts)
                ->with('publicVideoCommentUsers', $public_video_comment_users)
                ->with('publicVideoLikes', $public_video_likes)
                ->with('publicVideoLikeCounts', $public_video_like_counts)
                ->with('publicVideoCommentResponses', $public_video_comment_responses)
                ->with('publicVideoCommentResponseUsers', $public_video_comment_response_users)
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
            return view('public_videos.show')
                ->with('publicVideo', $publicVideo)
                ->with('publicVideoViews', $publicVideoViews)
                ->with('publicVideoUpdates', $publicVideoUpdates)
                ->with('publicVideoUsers', $public_video_users)
                ->with('publicVideoComments', $public_video_comments)
                ->with('publicVideoCommentCounts', $public_video_comment_counts)
                ->with('publicVideoCommentUsers', $public_video_comment_users)
                ->with('publicVideoLikes', $public_video_likes)
                ->with('publicVideoLikeCounts', $public_video_like_counts)
                ->with('publicVideoCommentResponses', $public_video_comment_responses)
                ->with('publicVideoCommentResponseUsers', $public_video_comment_response_users)
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
            $publicVideo = $this->publicVideoRepository->findWithoutFail($id);
    
            if(empty($publicVideo))
            {
                Flash::error('Public Video not found');
                return redirect(route('publicVideos.index'));
            }
            
            $user = DB::table('public_video')->join('users', 'users.id', '=', 'public_video.user_id')->where('public_video.id', '=', $id)->get();
            
            if($user_id == $user[0] -> id)
            {
                $files_list = DB::table('public_file')->where(function ($query) {$query->where('public_file.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                $notes_list = DB::table('public_note')->where(function ($query) {$query->where('public_note.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                $images_list = DB::table('public_image')->where(function ($query) {$query->where('public_image.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                $audios_list = DB::table('public_audio')->where(function ($query) {$query->where('public_audio.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                $videos_list = DB::table('public_video')->where(function ($query) {$query->where('public_video.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                $advertisements_list = DB::table('public_advertisement')->where(function ($query) {$query->where('public_advertisement.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();

                return view('public_videos.edit')
                    ->with('publicVideo', $publicVideo)
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

    public function update($id, UpdatePublicVideoRequest $request)
    {
        if(isset(Auth::user()->id))
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $publicVideo = $this->publicVideoRepository->findWithoutFail($id);
    
            if(empty($publicVideo))
            {
                Flash::error('Public Video not found');
                return redirect(route('publicVideos.index'));
            }
            
            $user = DB::table('public_video')->join('users', 'users.id', '=', 'public_video.user_id')->where('public_video.id', '=', $id)->get();
    
            if($user_id == $user[0] -> id)
            {
                $publicVideo = $this->publicVideoRepository->update($request->all(), $id);
            
                DB::table('recent_activities')->insert(['name' => $publicVideo -> name, 'status' => 'active', 'type' => 'p_v_u', 'user_id' => $user_id, 'entity_id' => $publicVideo -> id, 'created_at' => $now]);
    
                Flash::success('Public Video updated successfully.');
                return redirect(route('publicVideos.show', [$publicVideo -> id]));
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
            $publicVideo = $this->publicVideoRepository->findWithoutFail($id);
    
            if(empty($publicVideo))
            {
                Flash::error('Public Video not found');
                return redirect(route('publicVideos.index'));
            }
            
            $user = DB::table('public_video')->join('users', 'users.id', '=', 'public_video.user_id')->where('public_video.id', '=', $id)->get();
            
            if($user_id == $user[0] -> id)
            {
                $this->publicVideoRepository->delete($id);
                
                DB::table('recent_activities')->insert(['name' => $publicVideo -> name, 'status' => 'active', 'type' => 'p_v_d', 'user_id' => $user_id, 'entity_id' => $publicVideo -> id, 'created_at' => $now]);
            
                Flash::success('Public Video deleted successfully.');
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