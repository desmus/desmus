<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateSharedProfileImageRequest;
use App\Http\Requests\UpdateSharedProfileImageRequest;
use App\Repositories\SharedProfileImageRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class SharedProfileImageController extends AppBaseController
{
    /** @var  SharedProfileImageRepository */
    private $sharedProfileImageRepository;

    public function __construct(SharedProfileImageRepository $sharedProfileImageRepo)
    {
        $this->sharedProfileImageRepository = $sharedProfileImageRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->sharedProfileImageRepository->pushCriteria(new RequestCriteria($request));
            $sharedProfileImages = $this->sharedProfileImageRepository->all();
    
            return view('shared_profile_images.index')
                ->with('sharedProfileImages', $sharedProfileImages);
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
            
            return view('shared_profile_images.create')
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

    public function store(CreateSharedProfileImageRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $sharedProfileImage = $this->sharedProfileImageRepository->create($input);
            
            $file = $request->file('image');
            $new_file = 'image_' . $sharedProfileImage -> id . '.' . $file -> getClientOriginalExtension();
            $file->move(public_path("images/shared_profile_images/"), $new_file);
            $fileType = $file -> getClientOriginalExtension();
            $size = $request->file('image')->getClientSize();
    
            DB::table('shared_profile_image')->where('id', $sharedProfileImage->id)->update(['file_type' => $fileType, 'file_size' => $size]);
            DB::table('recent_activities')->insert(['name' => $sharedProfileImage -> name, 'status' => 'active', 'type' => 'p_i_c', 'user_id' => $user_id, 'entity_id' => $sharedProfileImage -> id, 'created_at' => $now]);
    
            Flash::success('Shared Profile Image saved successfully.');
            return redirect(route('sharedProfileImages.show', [$sharedProfileImage -> id]));
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
            $sharedProfileImage = $this->sharedProfileImageRepository->findWithoutFail($id);
                
            if(empty($sharedProfileImage))
            {
                Flash::error('Shared Profile Image not found');
                return redirect(route('sharedProfileImages.index'));
            }
        
            $userSharedProfiles = DB::table('user_shared_profile')->where('user_id', '=', $sharedProfileImage -> user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userSharedProfiles as $userSharedProfile)
            {
                if($userSharedProfile -> shared_user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            if($user_id == $sharedProfileImage -> user_id || $isShared)
            {
                $user = DB::table('shared_profile_image')->join('users', 'users.id', '=', 'shared_profile_image.user_id')->where('shared_profile_image.id', '=', $id)->get();
        
                DB::table('shared_profile_image_views')->insert(['datetime' => $now, 'user_id' => $user_id, 's_p_i_id' => $id]);
                DB::table('shared_profile_image')->where('id', $id)->update(['views_quantity' => DB::raw('views_quantity + 1')]);
                
                $actual_user = DB:: table('users')->where('id', '=', $user_id)->get();
    
                $sharedProfileImageViews = DB::table('users')->join('shared_profile_image_views', 'users.id', '=', 'shared_profile_image_views.user_id')->where('s_p_i_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
                $sharedProfileImageUpdates = DB::table('users')->join('shared_profile_image', 'users.id', '=', 'shared_profile_image.user_id')->where('shared_profile_image.id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
            
                $shared_profile_image_users = DB::table('shared_profile_image')->join('users', 'shared_profile_image.user_id', '=', 'users.id')->where('shared_profile_image.id', '=', $sharedProfileImage -> id)->where(function ($query) {$query->where('shared_profile_image.deleted_at', '=', null);})->orderBy('shared_profile_image.created_at', 'desc')->paginate(20, ['*'], 'image_user_p');
                $shared_profile_image_comments = DB::table('shared_profile_image_c')->where('s_p_i_id', '=', $sharedProfileImage -> id)->where(function ($query) {$query->where('shared_profile_image_c.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(20, ['*'], 'image_comment_p');
                $shared_profile_image_comment_counts = DB::table('shared_profile_image_c')->where('s_p_i_id', '=', $sharedProfileImage -> id)->where(function ($query) {$query->where('shared_profile_image_c.deleted_at', '=', null);})->orderBy('created_at', 'desc')->get()->count();
                $shared_profile_image_comment_users = DB::table('shared_profile_image_c')->join('users', 'shared_profile_image_c.user_id', '=', 'users.id')->select('users.name', 'users.image_type', 'shared_profile_image_c.user_id', 'shared_profile_image_c.id')->where('shared_profile_image_c.s_p_i_id', '=', $sharedProfileImage -> id)->where(function ($query) {$query->where('shared_profile_image_c.deleted_at', '=', null);})->orderBy('shared_profile_image_c.created_at', 'desc')->paginate(20, ['*'], 'image_comment_user_p');
                $shared_profile_image_likes = DB::table('shared_profile_image_like')->join('users', 'users.id', '=', 'shared_profile_image_like.user_id')->select('users.name', 'users.email', 'shared_profile_image_like.datetime')->where('s_p_i_id', '=', $sharedProfileImage -> id)->where(function ($query) {$query->where('shared_profile_image_like.deleted_at', '=', null);})->orderBy('shared_profile_image_like.created_at', 'desc')->get();
                $shared_profile_image_like_counts = DB::table('shared_profile_image_like')->join('users', 'users.id', '=', 'shared_profile_image_like.user_id')->select('users.name', 'users.email', 'shared_profile_image_like.datetime')->where('s_p_i_id', '=', $sharedProfileImage -> id)->where(function ($query) {$query->where('shared_profile_image_like.deleted_at', '=', null);})->orderBy('shared_profile_image_like.created_at', 'desc')->get()->count();
        
                $i = 0;
                $shared_profile_image_comment_responses = null;
                $shared_profile_image_comment_response_users = null;
        
                foreach($shared_profile_image_comments as $shared_profile_image_comment)
                {
                    $shared_profile_image_comment_responses[$i] = DB::table('shared_profile_image_c_response')->where('s_p_i_c_id', '=', $shared_profile_image_comment -> id)->where(function ($query) {$query->where('shared_profile_image_c_response.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(5, ['*'], 'image_comment_response_p');
                    $shared_profile_image_comment_response_users[$i] = DB::table('shared_profile_image_c_response')->join('users', 'shared_profile_image_c_response.user_id', '=', 'users.id')->select('users.name', 'users.image_type', 'shared_profile_image_c_response.user_id', 'shared_profile_image_c_response.id')->where('shared_profile_image_c_response.s_p_i_c_id', '=', $shared_profile_image_comment -> id)->where(function ($query) {$query->where('shared_profile_image_c_response.deleted_at', '=', null);})->orderBy('shared_profile_image_c_response.created_at', 'desc')->paginate(5, ['*'], 'image_comment_response_user_p');
                    $i += 1;
                }
                        
                $files_list = DB::table('shared_profile_file')->where(function ($query) {$query->where('shared_profile_file.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                $notes_list = DB::table('shared_profile_note')->where(function ($query) {$query->where('shared_profile_note.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                $images_list = DB::table('shared_profile_image')->where(function ($query) {$query->where('shared_profile_image.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                $audios_list = DB::table('shared_profile_audio')->where(function ($query) {$query->where('shared_profile_audio.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                $videos_list = DB::table('shared_profile_video')->where(function ($query) {$query->where('shared_profile_video.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                
                return view('shared_profile_images.show')
                    ->with('sharedProfileImage', $sharedProfileImage)
                    ->with('sharedProfileImageViews', $sharedProfileImageViews)
                    ->with('sharedProfileImageUsers', $shared_profile_image_users)
                    ->with('sharedProfileImageComments', $shared_profile_image_comments)
                    ->with('sharedProfileImageCommentCounts', $shared_profile_image_comment_counts)
                    ->with('sharedProfileImageCommentUsers', $shared_profile_image_comment_users)
                    ->with('sharedProfileImageLikes', $shared_profile_image_likes)
                    ->with('sharedProfileImageLikeCounts', $shared_profile_image_like_counts)
                    ->with('sharedProfileImageCommentResponses', $shared_profile_image_comment_responses)
                    ->with('sharedProfileImageCommentResponseUsers', $shared_profile_image_comment_response_users)
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
            $sharedProfileImage = $this->sharedProfileImageRepository->findWithoutFail($id);
    
            if (empty($sharedProfileImage))
            {
                Flash::error('Shared Profile Image not found');
                return redirect(route('sharedProfileImages.index'));
            }
            
            $user = DB::table('shared_profile_image')->join('users', 'users.id', '=', 'shared_profile_image.user_id')->where('shared_profile_image.id', '=', $id)->get();
            
            if($user_id == $user[0] -> id)
            {
                $files_list = DB::table('shared_profile_file')->where(function ($query) {$query->where('shared_profile_file.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                $notes_list = DB::table('shared_profile_note')->where(function ($query) {$query->where('shared_profile_note.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                $images_list = DB::table('shared_profile_image')->where(function ($query) {$query->where('shared_profile_image.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                $audios_list = DB::table('shared_profile_audio')->where(function ($query) {$query->where('shared_profile_audio.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                $videos_list = DB::table('shared_profile_video')->where(function ($query) {$query->where('shared_profile_video.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                
                return view('shared_profile_images.edit')
                    ->with('sharedProfileImage', $sharedProfileImage)
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

    public function update($id, UpdateSharedProfileImageRequest $request)
    {
        if(isset(Auth::user()->id))
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $sharedProfileImage = $this->sharedProfileImageRepository->findWithoutFail($id);
    
            if(empty($sharedProfileImage))
            {
                Flash::error('Shared Profile Image not found');
                return redirect(route('sharedProfileImages.index'));
            }
            
            $user = DB::table('shared_profile_image')->join('users', 'users.id', '=', 'shared_profile_image.user_id')->where('shared_profile_image.id', '=', $id)->get();
    
            if($user_id == $user[0] -> id)
            {
                $sharedProfileImage = $this->sharedProfileImageRepository->update($request->all(), $id);
            
                DB::table('recent_activities')->insert(['name' => $sharedProfileImage -> name, 'status' => 'active', 'type' => 'p_i_u', 'user_id' => $user_id, 'entity_id' => $sharedProfileImage -> id, 'created_at' => $now]);
    
                Flash::success('Shared Profile Image updated successfully.');
                return redirect(route('sharedProfileImages.show', [$sharedProfileImage -> id]));
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
            $sharedProfileImage = $this->sharedProfileImageRepository->findWithoutFail($id);
    
            if(empty($sharedProfileImage))
            {
                Flash::error('Shared Profile Image not found');
                return redirect(route('sharedProfileImages.index'));
            }
            
            $user = DB::table('shared_profile_image')->join('users', 'users.id', '=', 'shared_profile_image.user_id')->where('shared_profile_image.id', '=', $id)->get();
            
            if($user_id == $user[0] -> id)
            {
                $this->sharedProfileImageRepository->delete($id);
    
                DB::table('recent_activities')->insert(['name' => $sharedProfileImage -> name, 'status' => 'active', 'type' => 'p_i_d', 'user_id' => $user_id, 'entity_id' => $sharedProfileImage -> id, 'created_at' => $now]);
            
                Flash::success('Shared Profile Image deleted successfully.');
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