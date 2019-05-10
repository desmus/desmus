<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePublicImageRequest;
use App\Http\Requests\UpdatePublicImageRequest;
use App\Repositories\PublicImageRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PublicImageController extends AppBaseController
{
    private $publicImageRepository;

    public function __construct(PublicImageRepository $publicImageRepo)
    {
        $this->publicImageRepository = $publicImageRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->publicImageRepository->pushCriteria(new RequestCriteria($request));
            $publicImages = $this->publicImageRepository->all();
    
            return view('public_images.index')
                ->with('publicImages', $publicImages);
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

            return view('public_images.create')
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

    public function store(CreatePublicImageRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $publicImage = $this->publicImageRepository->create($input);
            
            $file = $request->file('image');
            $new_file = 'image_' . $publicImage -> id . '.' . $file -> getClientOriginalExtension();
            $file->move(public_path("images/public_images/"), $new_file);
            $fileType = $file -> getClientOriginalExtension();
            $size = $request->file('image')->getClientSize();
    
            DB::table('public_image')->where('id', $publicImage->id)->update(['file_type' => $fileType, 'file_size' => $size]);
            DB::table('recent_activities')->insert(['name' => $publicImage -> name, 'status' => 'active', 'type' => 'p_i_c', 'user_id' => $user_id, 'entity_id' => $publicImage -> id, 'created_at' => $now]);
    
            Flash::success('Public Image saved successfully.');
            return redirect(route('publicImages.show', [$publicImage -> id]));
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
            
        $publicImage = $this->publicImageRepository->findWithoutFail($id);
            
        if(empty($publicImage))
        {
            Flash::error('Public Image not found');
            return redirect(route('publicImages.index'));
        }
            
        $user = DB::table('public_image')->join('users', 'users.id', '=', 'public_image.user_id')->where('public_image.id', '=', $id)->get();
    
        if(isset(Auth::user()->id))
        {
            DB::table('public_image_views')->insert(['datetime' => $now, 'user_id' => $user_id, 'public_image_id' => $id]);
        }
        
        DB::table('public_image')->where('id', $id)->update(['views_quantity' => DB::raw('views_quantity + 1')]);
        
        if(isset(Auth::user()->id))
        {
            $actual_user = DB:: table('users')->where('id', '=', $user_id)->get();
        }
        
        $publicImageViews = DB::table('users')->join('public_image_views', 'users.id', '=', 'public_image_views.user_id')->where('public_image_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
        $publicImageUpdates = DB::table('users')->join('public_image', 'users.id', '=', 'public_image.user_id')->where('public_image.id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
    
        $public_image_users = DB::table('public_image')->join('users', 'public_image.user_id', '=', 'users.id')->where('public_image.id', '=', $publicImage -> id)->where(function ($query) {$query->where('public_image.deleted_at', '=', null);})->orderBy('public_image.created_at', 'desc')->paginate(20, ['*'], 'image_user_p');
        $public_image_comments = DB::table('public_image_comment')->where('public_image_id', '=', $publicImage -> id)->where(function ($query) {$query->where('public_image_comment.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(20, ['*'], 'image_comment_p');
        $public_image_comment_counts = DB::table('public_image_comment')->where('public_image_id', '=', $publicImage -> id)->where(function ($query) {$query->where('public_image_comment.deleted_at', '=', null);})->orderBy('created_at', 'desc')->get()->count();
        $public_image_comment_users = DB::table('public_image_comment')->join('users', 'public_image_comment.user_id', '=', 'users.id')->select('users.name', 'users.image_type', 'public_image_comment.user_id', 'public_image_comment.id')->where('public_image_comment.public_image_id', '=', $publicImage -> id)->where(function ($query) {$query->where('public_image_comment.deleted_at', '=', null);})->orderBy('public_image_comment.created_at', 'desc')->paginate(20, ['*'], 'image_comment_user_p');
        $public_image_likes = DB::table('public_image_like')->join('users', 'users.id', '=', 'public_image_like.user_id')->select('users.name', 'users.email', 'public_image_like.datetime')->where('public_image_id', '=', $publicImage -> id)->where(function ($query) {$query->where('public_image_like.deleted_at', '=', null);})->orderBy('public_image_like.created_at', 'desc')->get();
        $public_image_like_counts = DB::table('public_image_like')->join('users', 'users.id', '=', 'public_image_like.user_id')->select('users.name', 'users.email', 'public_image_like.datetime')->where('public_image_id', '=', $publicImage -> id)->where(function ($query) {$query->where('public_image_like.deleted_at', '=', null);})->orderBy('public_image_like.created_at', 'desc')->get()->count();

        $i = 0;
        $public_image_comment_responses = null;
        $public_image_comment_response_users = null;

        foreach($public_image_comments as $public_image_comment)
        {
            $public_image_comment_responses[$i] = DB::table('public_image_comment_response')->where('public_image_comment_id', '=', $public_image_comment -> id)->where(function ($query) {$query->where('public_image_comment_response.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(5, ['*'], 'image_comment_response_p');
            $public_image_comment_response_users[$i] = DB::table('public_image_comment_response')->join('users', 'public_image_comment_response.user_id', '=', 'users.id')->select('users.name', 'users.image_type', 'public_image_comment_response.user_id', 'public_image_comment_response.id')->where('public_image_comment_response.public_image_comment_id', '=', $public_image_comment -> id)->where(function ($query) {$query->where('public_image_comment_response.deleted_at', '=', null);})->orderBy('public_image_comment_response.created_at', 'desc')->paginate(5, ['*'], 'image_comment_response_user_p');
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
            return view('public_images.show')
                ->with('publicImage', $publicImage)
                ->with('publicImageViews', $publicImageViews)
                ->with('publicImageUsers', $public_image_users)
                ->with('publicImageComments', $public_image_comments)
                ->with('publicImageCommentCounts', $public_image_comment_counts)
                ->with('publicImageCommentUsers', $public_image_comment_users)
                ->with('publicImageLikes', $public_image_likes)
                ->with('publicImageLikeCounts', $public_image_like_counts)
                ->with('publicImageCommentResponses', $public_image_comment_responses)
                ->with('publicImageCommentResponseUsers', $public_image_comment_response_users)
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
            return view('public_images.show')
                ->with('publicImage', $publicImage)
                ->with('publicImageViews', $publicImageViews)
                ->with('publicImageUsers', $public_image_users)
                ->with('publicImageComments', $public_image_comments)
                ->with('publicImageCommentCounts', $public_image_comment_counts)
                ->with('publicImageCommentUsers', $public_image_comment_users)
                ->with('publicImageLikes', $public_image_likes)
                ->with('publicImageLikeCounts', $public_image_like_counts)
                ->with('publicImageCommentResponses', $public_image_comment_responses)
                ->with('publicImageCommentResponseUsers', $public_image_comment_response_users)
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
            $publicImage = $this->publicImageRepository->findWithoutFail($id);
    
            if (empty($publicImage))
            {
                Flash::error('Public Image not found');
                return redirect(route('publicImages.index'));
            }
            
            $user = DB::table('public_image')->join('users', 'users.id', '=', 'public_image.user_id')->where('public_image.id', '=', $id)->get();
            
            if($user_id == $user[0] -> id)
            {
                $files_list = DB::table('public_file')->where(function ($query) {$query->where('public_file.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                $notes_list = DB::table('public_note')->where(function ($query) {$query->where('public_note.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                $images_list = DB::table('public_image')->where(function ($query) {$query->where('public_image.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                $audios_list = DB::table('public_audio')->where(function ($query) {$query->where('public_audio.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                $videos_list = DB::table('public_video')->where(function ($query) {$query->where('public_video.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                $advertisements_list = DB::table('public_advertisement')->where(function ($query) {$query->where('public_advertisement.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();

                return view('public_images.edit')
                    ->with('publicImage', $publicImage)
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

    public function update($id, UpdatePublicImageRequest $request)
    {
        if(isset(Auth::user()->id))
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $publicImage = $this->publicImageRepository->findWithoutFail($id);
    
            if(empty($publicImage))
            {
                Flash::error('Public Image not found');
                return redirect(route('publicImages.index'));
            }
            
            $user = DB::table('public_image')->join('users', 'users.id', '=', 'public_image.user_id')->where('public_image.id', '=', $id)->get();
    
            if($user_id == $user[0] -> id)
            {
                $publicImage = $this->publicImageRepository->update($request->all(), $id);
            
                DB::table('recent_activities')->insert(['name' => $publicImage -> name, 'status' => 'active', 'type' => 'p_i_u', 'user_id' => $user_id, 'entity_id' => $publicImage -> id, 'created_at' => $now]);
    
                Flash::success('Public Image updated successfully.');
                return redirect(route('publicImages.show', [$publicImage -> id]));
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
            $publicImage = $this->publicImageRepository->findWithoutFail($id);
    
            if(empty($publicImage))
            {
                Flash::error('Public Image not found');
                return redirect(route('publicImages.index'));
            }
            
            $user = DB::table('public_image')->join('users', 'users.id', '=', 'public_image.user_id')->where('public_image.id', '=', $id)->get();
            
            if($user_id == $user[0] -> id)
            {
                $this->publicImageRepository->delete($id);
    
                DB::table('recent_activities')->insert(['name' => $publicImage -> name, 'status' => 'active', 'type' => 'p_i_d', 'user_id' => $user_id, 'entity_id' => $publicImage -> id, 'created_at' => $now]);
            
                Flash::success('Public Image deleted successfully.');
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