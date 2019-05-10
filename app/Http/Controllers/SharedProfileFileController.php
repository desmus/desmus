<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateSharedProfileFileRequest;
use App\Http\Requests\UpdateSharedProfileFileRequest;
use App\Repositories\SharedProfileFileRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class SharedProfileFileController extends AppBaseController
{
    private $sharedProfileFileRepository;

    public function __construct(SharedProfileFileRepository $sharedProfileFileRepo)
    {
        $this->sharedProfileFileRepository = $sharedProfileFileRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->sharedProfileFileRepository->pushCriteria(new RequestCriteria($request));
            $sharedProfileFiles = $this->sharedProfileFileRepository->all();

            return view('shared_profile_files.index')
                ->with('sharedProfileFiles', $sharedProfileFiles);
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
            
            return view('shared_profile_files.create')
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

    public function store(CreateSharedProfileFileRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $sharedProfileFile = $this->sharedProfileFileRepository->create($input);
    
            $file = $request->file('file');
            $new_file = 'file_' . $sharedProfileFile -> id . '.' . $file -> getClientOriginalExtension();
            $file->move(public_path("files/shared_profile_files/"), $new_file);
            $fileType = $file -> getClientOriginalExtension();
            $size = $request->file('file')->getClientSize();
    
            DB::table('shared_profile_file')->where('id', $sharedProfileFile->id)->update(['file_type' => $fileType, 'file_size' => $size]);
            DB::table('recent_activities')->insert(['name' => $sharedProfileFile -> name, 'status' => 'active', 'type' => 'p_f_c', 'user_id' => $user_id, 'entity_id' => $sharedProfileFile -> id, 'created_at' => $now]);
            
            Flash::success('Shared Profile File saved successfully.');
            return redirect(route('sharedProfileFiles.show', [$sharedProfileFile -> id]));
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
            $sharedProfileFile = $this->sharedProfileFileRepository->findWithoutFail($id);
                    
            if(empty($sharedProfileFile))
            {
                Flash::error('Shared Profile File not found');
                return redirect(route('sharedProfileFiles.index'));
            }
            
            $userSharedProfiles = DB::table('user_shared_profile')->where('user_id', '=', $sharedProfileFile -> user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userSharedProfiles as $userSharedProfile)
            {
                if($userSharedProfile -> shared_user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            if($user_id == $sharedProfileFile -> user_id || $isShared)
            {
                $user = DB::table('shared_profile_file')->join('users', 'users.id', '=', 'shared_profile_file.user_id')->where('shared_profile_file.id', '=', $id)->get();
                
                DB::table('shared_profile_file_views')->insert(['datetime' => $now, 'user_id' => $user_id, 's_p_f_id' => $id]);
                DB::table('shared_profile_file')->where('id', $id)->update(['views_quantity' => DB::raw('views_quantity + 1')]);
                
                $actual_user = DB:: table('users')->where('id', '=', $user_id)->get();
                
                $sharedProfileFileViews = DB::table('users')->join('shared_profile_file_views', 'users.id', '=', 'shared_profile_file_views.user_id')->where('s_p_f_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
                $sharedProfileFileUpdates = DB::table('users')->join('shared_profile_file', 'users.id', '=', 'shared_profile_file.user_id')->where('shared_profile_file.id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
            
                $shared_profile_file_users = DB::table('shared_profile_file')->join('users', 'shared_profile_file.user_id', '=', 'users.id')->where('shared_profile_file.id', '=', $sharedProfileFile -> id)->where(function ($query) {$query->where('shared_profile_file.deleted_at', '=', null);})->orderBy('shared_profile_file.created_at', 'desc')->paginate(20, ['*'], 'file_user_p');
                $shared_profile_file_comments = DB::table('shared_profile_file_c')->where('s_p_f_id', '=', $sharedProfileFile -> id)->where(function ($query) {$query->where('shared_profile_file_c.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(20, ['*'], 'file_comment_p');
                $shared_profile_file_comment_counts = DB::table('shared_profile_file_c')->where('s_p_f_id', '=', $sharedProfileFile -> id)->where(function ($query) {$query->where('shared_profile_file_c.deleted_at', '=', null);})->orderBy('created_at', 'desc')->get()->count();
                $shared_profile_file_comment_users = DB::table('shared_profile_file_c')->join('users', 'shared_profile_file_c.user_id', '=', 'users.id')->select('users.name', 'users.image_type', 'shared_profile_file_c.user_id', 'shared_profile_file_c.id')->where('shared_profile_file_c.s_p_f_id', '=', $sharedProfileFile -> id)->where(function ($query) {$query->where('shared_profile_file_c.deleted_at', '=', null);})->orderBy('shared_profile_file_c.created_at', 'desc')->paginate(20, ['*'], 'file_comment_user_p');
                $shared_profile_file_likes = DB::table('shared_profile_file_like')->join('users', 'users.id', '=', 'shared_profile_file_like.user_id')->select('users.name', 'users.email', 'shared_profile_file_like.datetime')->where('s_p_f_id', '=', $sharedProfileFile -> id)->where(function ($query) {$query->where('shared_profile_file_like.deleted_at', '=', null);})->orderBy('shared_profile_file_like.created_at', 'desc')->get();
                $shared_profile_file_like_counts = DB::table('shared_profile_file_like')->join('users', 'users.id', '=', 'shared_profile_file_like.user_id')->select('users.name', 'users.email', 'shared_profile_file_like.datetime')->where('s_p_f_id', '=', $sharedProfileFile -> id)->where(function ($query) {$query->where('shared_profile_file_like.deleted_at', '=', null);})->orderBy('shared_profile_file_like.created_at', 'desc')->get()->count();
        
                $i = 0;
                $shared_profile_file_comment_responses = null;
                $shared_profile_file_comment_response_users = null;
        
                foreach($shared_profile_file_comments as $shared_profile_file_comment)
                {
                    $shared_profile_file_comment_responses[$i] = DB::table('shared_profile_file_c_response')->where('s_p_f_c_id', '=', $shared_profile_file_comment -> id)->where(function ($query) {$query->where('shared_profile_file_c_response.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(5, ['*'], 'file_comment_response_p');
                    $shared_profile_file_comment_response_users[$i] = DB::table('shared_profile_file_c_response')->join('users', 'shared_profile_file_c_response.user_id', '=', 'users.id')->select('users.name', 'users.image_type', 'shared_profile_file_c_response.user_id', 'shared_profile_file_c_response.id')->where('shared_profile_file_c_response.s_p_f_c_id', '=', $shared_profile_file_comment -> id)->where(function ($query) {$query->where('shared_profile_file_c_response.deleted_at', '=', null);})->orderBy('shared_profile_file_c_response.created_at', 'desc')->paginate(5, ['*'], 'file_comment_response_user_p');
                    $i += 1;
                }
                        
                $files_list = DB::table('shared_profile_file')->where(function ($query) {$query->where('shared_profile_file.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                $notes_list = DB::table('shared_profile_note')->where(function ($query) {$query->where('shared_profile_note.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                $images_list = DB::table('shared_profile_image')->where(function ($query) {$query->where('shared_profile_image.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                $audios_list = DB::table('shared_profile_audio')->where(function ($query) {$query->where('shared_profile_audio.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                $videos_list = DB::table('shared_profile_video')->where(function ($query) {$query->where('shared_profile_video.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
            
                return view('shared_profile_files.show')
                    ->with('sharedProfileFile', $sharedProfileFile)
                    ->with('sharedProfileFileViews', $sharedProfileFileViews)
                    ->with('sharedProfileFileUpdates', $sharedProfileFileUpdates)
                    ->with('sharedProfileFileUsers', $shared_profile_file_users)
                    ->with('sharedProfileFileComments', $shared_profile_file_comments)
                    ->with('sharedProfileFileCommentCounts', $shared_profile_file_comment_counts)
                    ->with('sharedProfileFileCommentUsers', $shared_profile_file_comment_users)
                    ->with('sharedProfileFileLikes', $shared_profile_file_likes)
                    ->with('sharedProfileFileLikeCounts', $shared_profile_file_like_counts)
                    ->with('sharedProfileFileCommentResponses', $shared_profile_file_comment_responses)
                    ->with('sharedProfileFileCommentResponseUsers', $shared_profile_file_comment_response_users)
                    ->with('user_id', $user_id)
                    ->with('now', $now)
                    ->with('user', $user)
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
            $sharedProfileFile = $this->sharedProfileFileRepository->findWithoutFail($id);
    
            if(empty($sharedProfileFile))
            {
                Flash::error('Shared Profile File not found');
                return redirect(route('sharedProfileFiles.index'));
            }
            
            $user = DB::table('shared_profile_file')->join('users', 'users.id', '=', 'shared_profile_file.user_id')->where('shared_profile_file.id', '=', $id)->get();
            
            if($user_id == $user[0] -> id)
            {
                $files_list = DB::table('shared_profile_file')->where(function ($query) {$query->where('shared_profile_file.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                $notes_list = DB::table('shared_profile_note')->where(function ($query) {$query->where('shared_profile_note.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                $images_list = DB::table('shared_profile_image')->where(function ($query) {$query->where('shared_profile_image.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                $audios_list = DB::table('shared_profile_audio')->where(function ($query) {$query->where('shared_profile_audio.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                $videos_list = DB::table('shared_profile_video')->where(function ($query) {$query->where('shared_profile_video.deleted_at', '=', null);})->orderBy('name', 'desc')->limit(10)->get();
                
                return view('shared_profile_files.edit')
                    ->with('sharedProfileFile', $sharedProfileFile)
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

    public function update($id, UpdateSharedProfileFileRequest $request)
    {
        if(isset(Auth::user()->id))
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $sharedProfileFile = $this->sharedProfileFileRepository->findWithoutFail($id);
        
            if(empty($sharedProfileFile))
            {
                Flash::error('Shared Profile File not found');
                return redirect(route('sharedProfileFiles.index'));
            }
            
            $user = DB::table('shared_profile_file')->join('users', 'users.id', '=', 'shared_profile_file.user_id')->where('shared_profile_file.id', '=', $id)->get();
            
            if($user_id == $user[0] -> id)
            {
                $sharedProfileFile = $this->sharedProfileFileRepository->update($request->all(), $id);
                DB::table('recent_activities')->insert(['name' => $sharedProfileFile -> name, 'status' => 'active', 'type' => 'p_f_u', 'user_id' => $user_id, 'entity_id' => $sharedProfileFile -> id, 'created_at' => $now]);
        
                Flash::success('Shared Profile File updated successfully.');
                return redirect(route('sharedProfileFiles.show', [$sharedProfileFile -> id]));
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
            $sharedProfileFile = $this->sharedProfileFileRepository->findWithoutFail($id);
    
            if(empty($sharedProfileFile))
            {
                Flash::error('Shared Profile File not found');
                return redirect(route('sharedProfileFiles.index'));
            }
            
            $user = DB::table('shared_profile_file')->join('users', 'users.id', '=', 'shared_profile_file.user_id')->where('shared_profile_file.id', '=', $id)->get();
            
            if($user_id == $user[0] -> id)
            {
                $this->sharedProfileFileRepository->delete($id);
                
                DB::table('recent_activities')->insert(['name' => $sharedProfileFile -> name, 'status' => 'active', 'type' => 'p_f_d', 'user_id' => $user_id, 'entity_id' => $sharedProfileFile -> id, 'created_at' => $now]);
            
                Flash::success('Shared Profile File deleted successfully.');
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