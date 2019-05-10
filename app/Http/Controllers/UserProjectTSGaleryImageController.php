<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateUserProjectTSGaleryImageRequest;
use App\Http\Requests\UpdateUserProjectTSGaleryImageRequest;
use App\Repositories\UserProjectTSGaleryImageRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class UserProjectTSGaleryImageController extends AppBaseController
{
    private $userProjectTSGaleryImageRepository;

    public function __construct(UserProjectTSGaleryImageRepository $userProjectTSGaleryImageRepo)
    {
        $this->userProjectTSGaleryImageRepository = $userProjectTSGaleryImageRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userProjectTSGaleryImageRepository->pushCriteria(new RequestCriteria($request));
            $userProjectTSGaleryImages = $this->userProjectTSGaleryImageRepository->all();
    
            return view('user_project_t_s_galery_images.index')
                ->with('userProjectTSGaleryImages', $userProjectTSGaleryImages);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function create($id)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $users = DB::table('contacts')->join('users', 'users.id', '=', 'contacts.contact_id')->select('name', 'contacts.user_id', 'users.id')->where('contacts.user_id', '=', $user_id)->where(function ($query) {$query->where('contacts.deleted_at', '=', null);})->orderBy('name', 'asc')->get();
            $select = [];
                
            foreach($users as $user)
            {
                $select[$user->id] = $user->name;
            }
            
            $userProjectTSGImagesList = DB::table('user_project_t_s_galery_images')->join('users', 'user_project_t_s_galery_images.user_id', '=', 'users.id')->select('name', 'email', 'user_project_t_s_galery_images.description', 'permissions', 'user_project_t_s_galery_images.datetime', 'user_project_t_s_galery_images.id', 'project_t_s_g_image_id')->where('project_t_s_g_image_id', $id)->where(function ($query) {$query->where('user_project_t_s_galery_images.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
            $projectTSGaleryImageViewsList = DB::table('users')->join('project_t_s_galery_image_views', 'users.id', '=', 'project_t_s_galery_image_views.user_id')->where('project_t_s_g_image_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            $projectTSGaleryImageUpdatesList = DB::table('users')->join('project_t_s_galery_image_updates', 'users.id', '=', 'project_t_s_galery_image_updates.user_id')->where('project_t_s_g_image_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            
            return view('user_project_t_s_galery_images.create', compact('select'))
                ->with('id', $id)
                ->with('now', $now)
                ->with('userProjectTSGImagesList', $userProjectTSGImagesList)
                ->with('projectTSGaleryImageViewsList', $projectTSGaleryImageViewsList)
                ->with('projectTSGaleryImageUpdatesList', $projectTSGaleryImageUpdatesList);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserProjectTSGaleryImageRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $user = DB::table('project_t_s_galery_images')->join('project_t_s_galeries', 'project_t_s_galery_images.project_t_s_g_id', '=', 'project_t_s_galeries.id')->join('project_topic_sections', 'project_t_s_galeries.project_topic_section_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->where('project_t_s_galery_images.id', '=', $request -> project_t_s_g_image_id)->get();
            
            $userProjectTSGaleryImageCheck = DB::table('user_project_t_s_galery_images')->where('user_id', '=', $request -> user_id)->where('project_t_s_g_image_id', '=', $request -> project_t_s_g_image_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
    
            if($userProjectTSGaleryImageCheck->isEmpty())
            {
                if($user[0] -> user_id == $user_id)
                {
                    $userProjectTSGaleryImage = $this->userProjectTSGaleryImageRepository->create($input);
                    $user = DB::table('user_project_t_s_galery_images')->join('users', 'users.id', '=', 'user_project_t_s_galery_images.user_id')->where('user_project_t_s_galery_images.id', '=', $userProjectTSGaleryImage -> id)->select('name')->get();
            
                    DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_p_t_s_g_i_c', 'user_id' => $user_id, 'entity_id' => $userProjectTSGaleryImage -> project_t_s_g_image_id, 'created_at' => $now]);
                    DB::table('user_project_t_s_galery_image_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_g_i_id' => $userProjectTSGaleryImage -> id]);
                
                    Flash::success('User Project T S Galery Image saved successfully.');
                    return redirect(route('userProjectTSGaleryImages.show', [$userProjectTSGaleryImage -> project_t_s_g_image_id]));
                }
                
                else
                {
                    return view('deniedAccess');
                }
            }
    
            return redirect(route('userProjectTSGaleryImages.show', [$request -> project_t_s_g_image_id]));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function show($id)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userProjectTSGaleryImage = $this->userProjectTSGaleryImageRepository->findWithoutFail($id);
            $userProjectTSGaleryImages = DB::table('user_project_t_s_galery_images')->join('users', 'user_project_t_s_galery_images.user_id', '=', 'users.id')->select('name', 'email', 'user_project_t_s_galery_images.description', 'permissions', 'user_project_t_s_galery_images.datetime', 'user_project_t_s_galery_images.id', 'project_t_s_g_image_id')->where('project_t_s_g_image_id', $id)->where(function ($query) {$query->where('user_project_t_s_galery_images.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
    
            if(empty($userProjectTSGaleryImages[0]))
            {
                return redirect(route('userProjectTSGaleryImages.create', [$id]));
            }
            
            $user = DB::table('project_t_s_galery_images')->join('project_t_s_galeries', 'project_t_s_galery_images.project_t_s_g_id', '=', 'project_t_s_galeries.id')->join('project_topic_sections', 'project_t_s_galeries.project_topic_section_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->where('project_t_s_galery_images.id', '=', $userProjectTSGaleryImages[0] -> project_t_s_g_image_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $projectTSGaleryImage = DB::table('project_t_s_galery_images')->where('id', '=', $userProjectTSGaleryImages[0] -> project_t_s_g_image_id)->get();
    
                $userProjectTSGImagesList = DB::table('user_project_t_s_galery_images')->join('users', 'user_project_t_s_galery_images.user_id', '=', 'users.id')->select('name', 'email', 'user_project_t_s_galery_images.description', 'permissions', 'user_project_t_s_galery_images.datetime', 'user_project_t_s_galery_images.id', 'project_t_s_g_image_id')->where('project_t_s_g_image_id', $id)->where(function ($query) {$query->where('user_project_t_s_galery_images.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $projectTSGaleryImageViewsList = DB::table('users')->join('project_t_s_galery_image_views', 'users.id', '=', 'project_t_s_galery_image_views.user_id')->where('project_t_s_g_image_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $projectTSGaleryImageUpdatesList = DB::table('users')->join('project_t_s_galery_image_updates', 'users.id', '=', 'project_t_s_galery_image_updates.user_id')->where('project_t_s_g_image_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
    
                return view('user_project_t_s_galery_images.show')
                    ->with('userProjectTSGaleryImages', $userProjectTSGaleryImages)
                    ->with('id', $id)
                    ->with('projectTSGaleryImage', $projectTSGaleryImage)
                    ->with('userProjectTSGImagesList', $userProjectTSGImagesList)
                    ->with('projectTSGaleryImageViewsList', $projectTSGaleryImageViewsList)
                    ->with('projectTSGaleryImageUpdatesList', $projectTSGaleryImageUpdatesList);
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
            $userProjectTSGaleryImage = DB::table('users')->join('user_project_t_s_galery_images', 'user_project_t_s_galery_images.user_id', '=', 'users.id')->where('user_project_t_s_galery_images.id', $id)->where(function ($query) {$query->where('user_project_t_s_galery_images.deleted_at', '=', null);})->get();
    
            if(empty($userProjectTSGaleryImage))
            {
                Flash::error('User Project T S Galery Image not found');
                return redirect(route('userProjectTSGaleryImages.index'));
            }
    
            $user = DB::table('project_t_s_galery_images')->join('project_t_s_galeries', 'project_t_s_galery_images.project_t_s_g_id', '=', 'project_t_s_galeries.id')->join('project_topic_sections', 'project_t_s_galeries.project_topic_section_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->where('project_t_s_galery_images.id', '=', $userProjectTSGaleryImage[0] -> project_t_s_g_image_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $userProjectTSGImagesList = DB::table('user_project_t_s_galery_images')->join('users', 'user_project_t_s_galery_images.user_id', '=', 'users.id')->select('name', 'email', 'user_project_t_s_galery_images.description', 'permissions', 'user_project_t_s_galery_images.datetime', 'user_project_t_s_galery_images.id', 'project_t_s_g_image_id')->where('project_t_s_g_image_id', $id)->where(function ($query) {$query->where('user_project_t_s_galery_images.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $projectTSGaleryImageViewsList = DB::table('users')->join('project_t_s_galery_image_views', 'users.id', '=', 'project_t_s_galery_image_views.user_id')->where('project_t_s_g_image_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $projectTSGaleryImageUpdatesList = DB::table('users')->join('project_t_s_galery_image_updates', 'users.id', '=', 'project_t_s_galery_image_updates.user_id')->where('project_t_s_g_image_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();

                return view('user_project_t_s_galery_images.edit')
                    ->with('userProjectTSGaleryImage', $userProjectTSGaleryImage)
                    ->with('id', $userProjectTSGaleryImage[0] -> project_t_s_g_image_id)
                    ->with('userProjectTSGImagesList', $userProjectTSGImagesList)
                    ->with('projectTSGaleryImageViewsList', $projectTSGaleryImageViewsList)
                    ->with('projectTSGaleryImageUpdatesList', $projectTSGaleryImageUpdatesList);
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

    public function update($id, UpdateUserProjectTSGaleryImageRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $userProjectTSGaleryImage = $this->userProjectTSGaleryImageRepository->findWithoutFail($id);
    
            if(empty($userProjectTSGaleryImage))
            {
                Flash::error('User Project T S Galery Image not found');
                return redirect(route('userProjectTSGaleryImages.index'));
            }
    
            $user = DB::table('project_t_s_galery_images')->join('project_t_s_galeries', 'project_t_s_galery_images.project_t_s_g_id', '=', 'project_t_s_galeries.id')->join('project_topic_sections', 'project_t_s_galeries.project_topic_section_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->where('project_t_s_galery_images.id', '=', $userProjectTSGaleryImage -> project_t_s_g_image_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $userProjectTSGaleryImage = $this->userProjectTSGaleryImageRepository->update($request->all(), $id);
                $user = DB::table('user_project_t_s_galery_images')->join('users', 'users.id', '=', 'user_project_t_s_galery_images.user_id')->where('user_project_t_s_galery_images.id', '=', $userProjectTSGaleryImage -> id)->select('name')->get();
            
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_p_t_s_g_i_u', 'user_id' => $user_id, 'entity_id' => $userProjectTSGaleryImage -> project_t_s_g_image_id, 'created_at' => $now]);
                DB::table('user_project_t_s_galery_image_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_g_i_id' => $userProjectTSGaleryImage -> id]);
            
                Flash::success('User Project T S Galery Image updated successfully.');
                return redirect(route('userProjectTSGaleryImages.show', [$userProjectTSGaleryImage -> project_t_s_g_image_id]));
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
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $userProjectTSGaleryImage = $this->userProjectTSGaleryImageRepository->findWithoutFail($id);
    
            if(empty($userProjectTSGaleryImage))
            {
                Flash::error('User Project T S Galery Image not found');
                return redirect(route('userProjectTSGaleryImages.index'));
            }
    
            $user = DB::table('project_t_s_galery_images')->join('project_t_s_galeries', 'project_t_s_galery_images.project_t_s_g_id', '=', 'project_t_s_galeries.id')->join('project_topic_sections', 'project_t_s_galeries.project_topic_section_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->where('project_t_s_galery_images.id', '=', $userProjectTSGaleryImage -> project_t_s_g_image_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $this->userProjectTSGaleryImageRepository->delete($id);
                $user = DB::table('user_project_t_s_galery_images')->join('users', 'users.id', '=', 'user_project_t_s_galery_images.user_id')->where('user_project_t_s_galery_images.id', '=', $userProjectTSGaleryImage -> id)->select('name')->get();
            
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_p_t_s_g_i_d', 'user_id' => $user_id, 'entity_id' => $userProjectTSGaleryImage -> project_t_s_g_image_id, 'created_at' => $now]);
                DB::table('user_project_t_s_galery_image_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_g_i_id' => $userProjectTSGaleryImage -> id]);
            
                Flash::success('User Project T S Galery Image deleted successfully.');
                return redirect(route('userProjectTSGaleryImages.show', [$userProjectTSGaleryImage -> project_t_s_g_image_id]));
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