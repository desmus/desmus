<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePublicFileRequest;
use App\Http\Requests\UpdatePublicFileRequest;
use App\Repositories\PublicFileRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PublicFileController extends AppBaseController
{
    private $publicFileRepository;

    public function __construct(PublicFileRepository $publicFileRepo)
    {
        $this->publicFileRepository = $publicFileRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->publicFileRepository->pushCriteria(new RequestCriteria($request));
            $publicFiles = $this->publicFileRepository->all();

            return view('public_files.index')
                ->with('publicFiles', $publicFiles);
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

            return view('public_files.create')
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

    public function store(CreatePublicFileRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $publicFile = $this->publicFileRepository->create($input);
    
            $file = $request->file('file');
            $new_file = 'file_' . $publicFile -> id . '.' . $file -> getClientOriginalExtension();
            $file->move(public_path("files/public_files/"), $new_file);
            $fileType = $file -> getClientOriginalExtension();
            $size = $request->file('file')->getClientSize();
    
            DB::table('public_file')->where('id', $publicFile->id)->update(['file_type' => $fileType, 'file_size' => $size]);
            DB::table('recent_activities')->insert(['name' => $publicFile -> name, 'status' => 'active', 'type' => 'p_f_c', 'user_id' => $user_id, 'entity_id' => $publicFile -> id, 'created_at' => $now]);
            
            Flash::success('Public File saved successfully.');
            return redirect(route('publicFiles.show', [$publicFile -> id]));
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
        
        $publicFile = $this->publicFileRepository->findWithoutFail($id);
            
        if(empty($publicFile))
        {
            Flash::error('Public File not found');
            return redirect(route('publicFiles.index'));
        }
        
        $user = DB::table('public_file')->join('users', 'users.id', '=', 'public_file.user_id')->where('public_file.id', '=', $id)->get();
           
        if(isset(Auth::user()->id))
        {
            DB::table('public_file_views')->insert(['datetime' => $now, 'user_id' => $user_id, 'public_file_id' => $id]);
        }
        
        DB::table('public_file')->where('id', $id)->update(['views_quantity' => DB::raw('views_quantity + 1')]);
        
        if(isset(Auth::user()->id))
        {
            $actual_user = DB:: table('users')->where('id', '=', $user_id)->get();
        }
        
        $publicFileViews = DB::table('users')->join('public_file_views', 'users.id', '=', 'public_file_views.user_id')->where('public_file_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
        $publicFileUpdates = DB::table('users')->join('public_file', 'users.id', '=', 'public_file.user_id')->where('public_file.id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
    
        $public_file_users = DB::table('public_file')->join('users', 'public_file.user_id', '=', 'users.id')->where('public_file.id', '=', $publicFile -> id)->where(function ($query) {$query->where('public_file.deleted_at', '=', null);})->orderBy('public_file.created_at', 'desc')->paginate(20, ['*'], 'file_user_p');
        $public_file_comments = DB::table('public_file_comment')->where('public_file_id', '=', $publicFile -> id)->where(function ($query) {$query->where('public_file_comment.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(20, ['*'], 'file_comment_p');
        $public_file_comment_counts = DB::table('public_file_comment')->where('public_file_id', '=', $publicFile -> id)->where(function ($query) {$query->where('public_file_comment.deleted_at', '=', null);})->orderBy('created_at', 'desc')->get()->count();
        $public_file_comment_users = DB::table('public_file_comment')->join('users', 'public_file_comment.user_id', '=', 'users.id')->select('users.name', 'users.image_type', 'public_file_comment.user_id', 'public_file_comment.id')->where('public_file_comment.public_file_id', '=', $publicFile -> id)->where(function ($query) {$query->where('public_file_comment.deleted_at', '=', null);})->orderBy('public_file_comment.created_at', 'desc')->paginate(20, ['*'], 'file_comment_user_p');
        $public_file_likes = DB::table('public_file_like')->join('users', 'users.id', '=', 'public_file_like.user_id')->select('users.name', 'users.email', 'public_file_like.datetime')->where('public_file_id', '=', $publicFile -> id)->where(function ($query) {$query->where('public_file_like.deleted_at', '=', null);})->orderBy('public_file_like.created_at', 'desc')->get();
        $public_file_like_counts = DB::table('public_file_like')->join('users', 'users.id', '=', 'public_file_like.user_id')->select('users.name', 'users.email', 'public_file_like.datetime')->where('public_file_id', '=', $publicFile -> id)->where(function ($query) {$query->where('public_file_like.deleted_at', '=', null);})->orderBy('public_file_like.created_at', 'desc')->get()->count();

        $i = 0;
        $public_file_comment_responses = null;
        $public_file_comment_response_users = null;

        foreach($public_file_comments as $public_file_comment)
        {
            $public_file_comment_responses[$i] = DB::table('public_file_comment_response')->where('public_file_comment_id', '=', $public_file_comment -> id)->where(function ($query) {$query->where('public_file_comment_response.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(5, ['*'], 'file_comment_response_p');
            $public_file_comment_response_users[$i] = DB::table('public_file_comment_response')->join('users', 'public_file_comment_response.user_id', '=', 'users.id')->select('users.name', 'users.image_type', 'public_file_comment_response.user_id', 'public_file_comment_response.id')->where('public_file_comment_response.public_file_comment_id', '=', $public_file_comment -> id)->where(function ($query) {$query->where('public_file_comment_response.deleted_at', '=', null);})->orderBy('public_file_comment_response.created_at', 'desc')->paginate(5, ['*'], 'file_comment_response_user_p');
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
            return view('public_files.show')
                ->with('publicFile', $publicFile)
                ->with('publicFileViews', $publicFileViews)
                ->with('publicFileUpdates', $publicFileUpdates)
                ->with('publicFileUsers', $public_file_users)
                ->with('publicFileComments', $public_file_comments)
                ->with('publicFileCommentCounts', $public_file_comment_counts)
                ->with('publicFileCommentUsers', $public_file_comment_users)
                ->with('publicFileLikes', $public_file_likes)
                ->with('publicFileLikeCounts', $public_file_like_counts)
                ->with('publicFileCommentResponses', $public_file_comment_responses)
                ->with('publicFileCommentResponseUsers', $public_file_comment_response_users)
                ->with('user_id', $user_id)
                ->with('now', $now)
                ->with('user', $user)
                ->with('actualUser', $actual_user)
                ->with('files_list', $files_list)
                ->with('notes_list', $notes_list)
                ->with('images_list', $images_list)
                ->with('audios_list', $audios_list)
                ->with('videos_list', $videos_list)
                ->with('advertisements_list', $advertisements_list);
        }
        
        return view('public_files.show')
            ->with('publicFile', $publicFile)
            ->with('publicFileViews', $publicFileViews)
            ->with('publicFileUpdates', $publicFileUpdates)
            ->with('publicFileUsers', $public_file_users)
            ->with('publicFileComments', $public_file_comments)
            ->with('publicFileCommentCounts', $public_file_comment_counts)
            ->with('publicFileCommentUsers', $public_file_comment_users)
            ->with('publicFileLikes', $public_file_likes)
            ->with('publicFileLikeCounts', $public_file_like_counts)
            ->with('publicFileCommentResponses', $public_file_comment_responses)
            ->with('publicFileCommentResponseUsers', $public_file_comment_response_users)
            ->with('now', $now)
            ->with('user', $user)
            ->with('files_list', $files_list)
            ->with('notes_list', $notes_list)
            ->with('images_list', $images_list)
            ->with('audios_list', $audios_list)
            ->with('videos_list', $videos_list)
            ->with('advertisements_list', $advertisements_list);
    }

    public function edit($id)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $publicFile = $this->publicFileRepository->findWithoutFail($id);
    
            if(empty($publicFile))
            {
                Flash::error('Public File not found');
                return redirect(route('publicFiles.index'));
            }
            
            $user = DB::table('public_file')->join('users', 'users.id', '=', 'public_file.user_id')->where('public_file.id', '=', $id)->get();
            
            if($user_id == $user[0] -> id)
            {
                $files_list = DB::table('public_file')->where(function ($query) {$query->where('public_file.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                $notes_list = DB::table('public_note')->where(function ($query) {$query->where('public_note.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                $images_list = DB::table('public_image')->where(function ($query) {$query->where('public_image.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                $audios_list = DB::table('public_audio')->where(function ($query) {$query->where('public_audio.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                $videos_list = DB::table('public_video')->where(function ($query) {$query->where('public_video.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                $advertisements_list = DB::table('public_advertisement')->where(function ($query) {$query->where('public_advertisement.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                
                return view('public_files.edit')
                    ->with('publicFile', $publicFile)
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

    public function update($id, UpdatePublicFileRequest $request)
    {
        if(isset(Auth::user()->id))
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $publicFile = $this->publicFileRepository->findWithoutFail($id);
        
            if(empty($publicFile))
            {
                Flash::error('Public File not found');
                return redirect(route('publicFiles.index'));
            }
            
            $user = DB::table('public_file')->join('users', 'users.id', '=', 'public_file.user_id')->where('public_file.id', '=', $id)->get();
            
            if($user_id == $user[0] -> id)
            {
                $publicFile = $this->publicFileRepository->update($request->all(), $id);
                DB::table('recent_activities')->insert(['name' => $publicFile -> name, 'status' => 'active', 'type' => 'p_f_u', 'user_id' => $user_id, 'entity_id' => $publicFile -> id, 'created_at' => $now]);
        
                Flash::success('Public File updated successfully.');
                return redirect(route('publicFiles.show', [$publicFile -> id]));
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
            $publicFile = $this->publicFileRepository->findWithoutFail($id);
    
            if(empty($publicFile))
            {
                Flash::error('Public File not found');
                return redirect(route('publicFiles.index'));
            }
            
            $user = DB::table('public_file')->join('users', 'users.id', '=', 'public_file.user_id')->where('public_file.id', '=', $id)->get();
            
            if($user_id == $user[0] -> id)
            {
                $this->publicFileRepository->delete($id);
                
                DB::table('recent_activities')->insert(['name' => $publicFile -> name, 'status' => 'active', 'type' => 'p_f_d', 'user_id' => $user_id, 'entity_id' => $publicFile -> id, 'created_at' => $now]);
            
                Flash::success('Public File deleted successfully.');
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