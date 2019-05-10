<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePublicAdvertisementRequest;
use App\Http\Requests\UpdatePublicAdvertisementRequest;
use App\Repositories\PublicAdvertisementRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PublicAdvertisementController extends AppBaseController
{
    private $publicAdvertisementRepository;

    public function __construct(PublicAdvertisementRepository $publicAdvertisementRepo)
    {
        $this->publicAdvertisementRepository = $publicAdvertisementRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->publicAdvertisementRepository->pushCriteria(new RequestCriteria($request));
            $publicAdvertisement = $this->publicAdvertisementRepository->all();
    
            return view('public_advertisements.index')
                ->with('publicAdvertisements', $publicAdvertisement);
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
            
            return view('public_advertisements.create')
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

    public function store(CreatePublicAdvertisementRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $publicAdvertisement = $this->publicAdvertisementRepository->create($input);
            
            $image = $request->file('image');
            $new_image = 'image_' . $publicAdvertisement -> id . '.' . $image -> getClientOriginalExtension();
            $image->move(public_path("images/public_advertisement_images/"), $new_image);
            $imageType = $image -> getClientOriginalExtension();
            $image_size = $request->file('image')->getClientSize();
            
            $video = $request->file('video');
            $new_video = 'video_' . $publicAdvertisement -> id . '.' . $video -> getClientOriginalExtension();
            $video->move(public_path("videos/public_advertisement_videos/"), $new_video);
            $videoType = $video -> getClientOriginalExtension();
            $video_size = $request->file('video')->getClientSize();
    
            DB::table('public_advertisement')->where('id', $publicAdvertisement->id)->update(['video_type' => $videoType, 'video_size' => $video_size, 'image_type' => $imageType, 'image_size' => $image_size]);
            DB::table('recent_activities')->insert(['name' => $publicAdvertisement -> name, 'status' => 'active', 'type' => 'p_ad_c', 'user_id' => $user_id, 'entity_id' => $publicAdvertisement -> id, 'created_at' => $now]);
    
            Flash::success('Public Advertisement saved successfully.');
            return redirect(route('publicAdvertisements.show', [$publicAdvertisement -> id]));
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
        
        $publicAdvertisement = $this->publicAdvertisementRepository->findWithoutFail($id);
            
        if(empty($publicAdvertisement))
        {
            Flash::error('Public Advertisement not found');
            return redirect(route('publicAdvertisements.index'));
        }
            
        $user = DB::table('public_advertisement')->join('users', 'users.id', '=', 'public_advertisement.user_id')->where('public_advertisement.id', '=', $id)->get();
        
        if(isset(Auth::user()->id))
        {
            DB::table('public_advertisement_views')->insert(['datetime' => $now, 'user_id' => $user_id, 'public_advertisement_id' => $id]);
        }
        
        DB::table('public_advertisement')->where('id', $id)->update(['views_quantity' => DB::raw('views_quantity + 1')]);
        
        if(isset(Auth::user()->id))
        {
            $actual_user = DB:: table('users')->where('id', '=', $user_id)->get();
        }
        
        $publicAdvertisementViews = DB::table('users')->join('public_advertisement_views', 'users.id', '=', 'public_advertisement_views.user_id')->where('public_advertisement_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
        $publicAdvertisementUpdates = DB::table('users')->join('public_advertisement', 'users.id', '=', 'public_advertisement.user_id')->where('public_advertisement.id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
    
        $public_advertisement_users = DB::table('public_advertisement')->join('users', 'public_advertisement.user_id', '=', 'users.id')->where('public_advertisement.id', '=', $publicAdvertisement -> id)->where(function ($query) {$query->where('public_advertisement.deleted_at', '=', null);})->orderBy('public_advertisement.created_at', 'desc')->paginate(20, ['*'], 'advertisement_user_p');
        $public_advertisement_comments = DB::table('public_advertisement_comment')->where('public_advertisement_id', '=', $publicAdvertisement -> id)->where(function ($query) {$query->where('public_advertisement_comment.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(20, ['*'], 'advertisement_comment_p');
        $public_advertisement_comment_counts = DB::table('public_advertisement_comment')->where('public_advertisement_id', '=', $publicAdvertisement -> id)->where(function ($query) {$query->where('public_advertisement_comment.deleted_at', '=', null);})->orderBy('created_at', 'desc')->get()->count();
        $public_advertisement_comment_users = DB::table('public_advertisement_comment')->join('users', 'public_advertisement_comment.user_id', '=', 'users.id')->select('users.name', 'users.image_type', 'public_advertisement_comment.user_id', 'public_advertisement_comment.id')->where('public_advertisement_comment.public_advertisement_id', '=', $publicAdvertisement -> id)->where(function ($query) {$query->where('public_advertisement_comment.deleted_at', '=', null);})->orderBy('public_advertisement_comment.created_at', 'desc')->paginate(20, ['*'], 'advertisement_comment_user_p');
        $public_advertisement_likes = DB::table('public_advertisement_like')->join('users', 'users.id', '=', 'public_advertisement_like.user_id')->select('users.name', 'users.email', 'public_advertisement_like.datetime')->where('public_advertisement_id', '=', $publicAdvertisement -> id)->where(function ($query) {$query->where('public_advertisement_like.deleted_at', '=', null);})->orderBy('public_advertisement_like.created_at', 'desc')->get();
        $public_advertisement_like_counts = DB::table('public_advertisement_like')->join('users', 'users.id', '=', 'public_advertisement_like.user_id')->select('users.name', 'users.email', 'public_advertisement_like.datetime')->where('public_advertisement_id', '=', $publicAdvertisement -> id)->where(function ($query) {$query->where('public_advertisement_like.deleted_at', '=', null);})->orderBy('public_advertisement_like.created_at', 'desc')->get()->count();

        $i = 0;
        $public_advertisement_comment_responses = null;
        $public_advertisement_comment_response_users = null;

        foreach($public_advertisement_comments as $public_advertisement_comment)
        {
            $public_advertisement_comment_responses[$i] = DB::table('public_advertisement_c_response')->where('public_a_c_id', '=', $public_advertisement_comment -> id)->where(function ($query) {$query->where('public_advertisement_c_response.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(5, ['*'], 'advertisement_comment_response_p');
            $public_advertisement_comment_response_users[$i] = DB::table('public_advertisement_c_response')->join('users', 'public_advertisement_c_response.user_id', '=', 'users.id')->select('users.name', 'users.image_type', 'public_advertisement_c_response.user_id', 'public_advertisement_c_response.id')->where('public_advertisement_c_response.public_a_c_id', '=', $public_advertisement_comment -> id)->where(function ($query) {$query->where('public_advertisement_c_response.deleted_at', '=', null);})->orderBy('public_advertisement_c_response.created_at', 'desc')->paginate(5, ['*'], 'advertisement_comment_response_user_p');
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
            return view('public_advertisements.show')
                ->with('publicAdvertisement', $publicAdvertisement)
                ->with('publicAdvertisementViews', $publicAdvertisementViews)
                ->with('publicAdvertisementUpdates', $publicAdvertisementUpdates)
                ->with('publicAdvertisementUsers', $public_advertisement_users)
                ->with('publicAdvertisementComments', $public_advertisement_comments)
                ->with('publicAdvertisementCommentCounts', $public_advertisement_comment_counts)
                ->with('publicAdvertisementCommentUsers', $public_advertisement_comment_users)
                ->with('publicAdvertisementLikes', $public_advertisement_likes)
                ->with('publicAdvertisementLikeCounts', $public_advertisement_like_counts)
                ->with('publicAdvertisementCResponses', $public_advertisement_comment_responses)
                ->with('publicAdvertisementCResponseUsers', $public_advertisement_comment_response_users)
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
            return view('public_advertisements.show')
                ->with('publicAdvertisement', $publicAdvertisement)
                ->with('publicAdvertisementViews', $publicAdvertisementViews)
                ->with('publicAdvertisementUpdates', $publicAdvertisementUpdates)
                ->with('publicAdvertisementUsers', $public_advertisement_users)
                ->with('publicAdvertisementComments', $public_advertisement_comments)
                ->with('publicAdvertisementCommentCounts', $public_advertisement_comment_counts)
                ->with('publicAdvertisementCommentUsers', $public_advertisement_comment_users)
                ->with('publicAdvertisementLikes', $public_advertisement_likes)
                ->with('publicAdvertisementLikeCounts', $public_advertisement_like_counts)
                ->with('publicAdvertisementCResponses', $public_advertisement_comment_responses)
                ->with('publicAdvertisementCResponseUsers', $public_advertisement_comment_response_users)
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
            $publicAdvertisement = $this->publicAdvertisementRepository->findWithoutFail($id);
    
            if(empty($publicAdvertisement))
            {
                Flash::error('Public Advertisement not found');
                return redirect(route('publicAdvertisements.index'));
            }
            
            $user = DB::table('public_advertisement')->join('users', 'users.id', '=', 'public_advertisement.user_id')->where('public_advertisement.id', '=', $id)->get();
            
            if($user_id == $user[0] -> id)
            {
                $files_list = DB::table('public_file')->where(function ($query) {$query->where('public_file.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                $notes_list = DB::table('public_note')->where(function ($query) {$query->where('public_note.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                $images_list = DB::table('public_image')->where(function ($query) {$query->where('public_image.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                $audios_list = DB::table('public_audio')->where(function ($query) {$query->where('public_audio.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                $videos_list = DB::table('public_video')->where(function ($query) {$query->where('public_video.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                $advertisements_list = DB::table('public_advertisement')->where(function ($query) {$query->where('public_advertisement.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();

                return view('public_advertisements.edit')
                    ->with('publicAdvertisement', $publicAdvertisement)
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

    public function update($id, UpdatePublicAdvertisementRequest $request)
    {
        if(isset(Auth::user()->id))
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $publicAdvertisement = $this->publicAdvertisementRepository->findWithoutFail($id);

            if(empty($publicAdvertisement))
            {
                Flash::error('Public Advertisement not found');
                return redirect(route('publicAdvertisements.index'));
            }
            
            $user = DB::table('public_advertisement')->join('users', 'users.id', '=', 'public_advertisement.user_id')->where('public_advertisement.id', '=', $id)->get();

            if($user_id == $user[0] -> id)
            {
                $publicAdvertisement = $this->publicAdvertisementRepository->update($request->all(), $id);
        
                DB::table('recent_activities')->insert(['name' => $publicAdvertisement -> name, 'status' => 'active', 'type' => 'p_ad_u', 'user_id' => $user_id, 'entity_id' => $publicAdvertisement -> id, 'created_at' => $now]);

                Flash::success('Public Advertisement updated successfully.');
                return redirect(route('publicAdvertisements.show', [$publicAdvertisement -> id]));
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
            $publicAdvertisement = $this->publicAdvertisementRepository->findWithoutFail($id);
    
            if(empty($publicAdvertisement))
            {
                Flash::error('Public Advertisement not found');
                return redirect(route('publicAdvertisements.index'));
            }
            
            $user = DB::table('public_advertisement')->join('users', 'users.id', '=', 'public_advertisement.user_id')->where('public_advertisement.id', '=', $id)->get();
            
            if($user_id == $user[0] -> id)
            {
                $this->publicAdvertisementRepository->delete($id);
                
                DB::table('recent_activities')->insert(['name' => $publicAdvertisement -> name, 'status' => 'active', 'type' => 'p_ad_d', 'user_id' => $user_id, 'entity_id' => $publicAdvertisement -> id, 'created_at' => $now]);
            
                Flash::success('Public Advertisement deleted successfully.');
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