<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateUserProjectTSGalerieRequest;
use App\Http\Requests\UpdateUserProjectTSGalerieRequest;
use App\Repositories\UserProjectTSGalerieRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class UserProjectTSGalerieController extends AppBaseController
{
    private $userProjectTSGalerieRepository;

    public function __construct(UserProjectTSGalerieRepository $userProjectTSGalerieRepo)
    {
        $this->userProjectTSGalerieRepository = $userProjectTSGalerieRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userProjectTSGalerieRepository->pushCriteria(new RequestCriteria($request));
            $userProjectTSGaleries = $this->userProjectTSGalerieRepository->all();
    
            return view('user_project_t_s_galeries.index')
                ->with('userProjectTSGaleries', $userProjectTSGaleries);
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
            
            $projectTSGImagesList = DB::table('project_t_s_galery_images')->where('project_t_s_g_id' , '=', $id)->orderBy('id', 'desc')->limit(10)->get();
            $userProjectTSGaleriesList = DB::table('user_project_t_s_galeries')->join('users', 'user_project_t_s_galeries.user_id', '=', 'users.id')->select('name', 'email', 'user_project_t_s_galeries.description', 'permissions', 'user_project_t_s_galeries.datetime', 'user_project_t_s_galeries.id', 'project_t_s_galery_id')->where('project_t_s_galery_id', $id)->where(function ($query) {$query->where('user_project_t_s_galeries.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
            $projectTSGaleryViewsList = DB::table('users')->join('project_t_s_galery_views', 'users.id', '=', 'project_t_s_galery_views.user_id')->where('project_t_s_galery_id', $id)->orderBy('datetime', 'desc')->limit(5)->get();
            $projectTSGaleryUpdatesList = DB::table('users')->join('project_t_s_galery_updates', 'users.id', '=', 'project_t_s_galery_updates.user_id')->where('project_t_s_galery_id', $id)->orderBy('datetime', 'desc')->limit(5)->get();
            
            return view('user_project_t_s_galeries.create', compact('select'))
                ->with('id', $id)
                ->with('now', $now)
                ->with('projectTSGImagesList', $projectTSGImagesList)
                ->with('projectTSGaleryViewsList', $projectTSGaleryViewsList)
                ->with('projectTSGaleryUpdatesList', $projectTSGaleryUpdatesList)
                ->with('userProjectTSGaleriesList', $userProjectTSGaleriesList);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserProjectTSGalerieRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $user = DB::table('project_t_s_galeries')->join('project_topic_sections', 'project_t_s_galeries.project_topic_section_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->where('project_t_s_galeries.id', '=', $request -> project_t_s_galery_id)->get();
            
            $userProjectTSGaleryCheck = DB::table('user_project_t_s_galeries')->where('user_id', '=', $request -> user_id)->where('project_t_s_galery_id', '=', $request -> project_t_s_galery_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
    
            if($userProjectTSGaleryCheck->isEmpty())
            {
                if($user[0] -> user_id == $user_id)
                {
                    $userProjectTSGalerie = $this->userProjectTSGalerieRepository->create($input);
                    $projectTSGaleryImages = DB::table('project_t_s_galery_images')->where('project_t_s_g_id', '=', $userProjectTSGalerie -> project_t_s_galery_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                    
                    DB::table('user_project_t_s_galerie_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_g_id' => $userProjectTSGalerie -> id]);
                       
                    foreach($projectTSGaleryImages as $projectTSGaleryImage)
                    {
                        DB::table('user_project_t_s_galery_images')->insert(['datetime' => $now, 'user_id' => $userProjectTSGalerie -> user_id, 'description' => $userProjectTSGalerie -> description, 'project_t_s_g_image_id' => $projectTSGaleryImage -> id]);
                                                
                        $userProjectTSGaleryImage = DB::table('user_project_t_s_galery_images')->where('project_t_s_g_image_id', '=', $projectTSGaleryImage -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                                
                        if(isset($userProjectTSGalery[0]))
                        {
                            DB::table('user_project_t_s_galery_image_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_g_i_id' => $userProjectTSGaleryImage[0] -> id]);
                        }        
                    }
                    
                    $user = DB::table('user_project_t_s_galeries')->join('users', 'users.id', '=', 'user_project_t_s_galeries.user_id')->where('user_project_t_s_galeries.id', '=', $userProjectTSGalerie -> id)->select('name')->get();
                    
                    DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_p_t_s_g_c', 'user_id' => $user_id, 'entity_id' => $userProjectTSGalerie -> project_t_s_galery_id, 'created_at' => $now]);
                
                    Flash::success('User Project T S Galerie saved successfully.');
                    return redirect(route('userProjectTSGaleries.show', [$userProjectTSGalerie -> project_t_s_galery_id]));
                }
                
                else
                {
                    return view('deniedAccess');
                }
            }
            
            return redirect(route('userProjectTSGaleries.show', [$request -> project_t_s_galery_id]));
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
            $userProjectTSGalerie = $this->userProjectTSGalerieRepository->findWithoutFail($id);
            $userProjectTSGaleries = DB::table('user_project_t_s_galeries')->join('users', 'user_project_t_s_galeries.user_id', '=', 'users.id')->select('name', 'email', 'user_project_t_s_galeries.description', 'permissions', 'user_project_t_s_galeries.datetime', 'user_project_t_s_galeries.id', 'project_t_s_galery_id')->where('project_t_s_galery_id', $id)->where(function ($query) {$query->where('user_project_t_s_galeries.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
    
            if(empty($userProjectTSGaleries[0]))
            {
                Flash::error('User Project T S Galerie not found');
                return redirect(route('userProjectTSGaleries.create', [$id]));
            }
            
            $user = DB::table('project_t_s_galeries')->join('project_topic_sections', 'project_t_s_galeries.project_topic_section_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->where('project_t_s_galeries.id', '=', $userProjectTSGaleries[0] -> project_t_s_galery_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $projectTSGalerie = DB::table('project_t_s_galeries')->where('id', '=', $userProjectTSGaleries[0] -> project_t_s_galery_id)->get();
    
                $projectTSGImagesList = DB::table('project_t_s_galery_images')->where('project_t_s_g_id' , '=', $id)->orderBy('id', 'desc')->limit(10)->get();
                $userProjectTSGaleriesList = DB::table('user_project_t_s_galeries')->join('users', 'user_project_t_s_galeries.user_id', '=', 'users.id')->select('name', 'email', 'user_project_t_s_galeries.description', 'permissions', 'user_project_t_s_galeries.datetime', 'user_project_t_s_galeries.id', 'project_t_s_galery_id')->where('project_t_s_galery_id', $id)->where(function ($query) {$query->where('user_project_t_s_galeries.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $projectTSGaleryViewsList = DB::table('users')->join('project_t_s_galery_views', 'users.id', '=', 'project_t_s_galery_views.user_id')->where('project_t_s_galery_id', $id)->orderBy('datetime', 'desc')->limit(5)->get();
                $projectTSGaleryUpdatesList = DB::table('users')->join('project_t_s_galery_updates', 'users.id', '=', 'project_t_s_galery_updates.user_id')->where('project_t_s_galery_id', $id)->orderBy('datetime', 'desc')->limit(5)->get();
    
                return view('user_project_t_s_galeries.show')->with('userProjectTSGaleries', $userProjectTSGaleries)
                    ->with('id', $id)
                    ->with('projectTSGalerie', $projectTSGalerie)
                    ->with('projectTSGImagesList', $projectTSGImagesList)
                    ->with('projectTSGaleryViewsList', $projectTSGaleryViewsList)
                    ->with('projectTSGaleryUpdatesList', $projectTSGaleryUpdatesList)
                    ->with('userProjectTSGaleriesList', $userProjectTSGaleriesList);
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
            $userProjectTSGalerie = DB::table('users')->join('user_project_t_s_galeries', 'user_project_t_s_galeries.user_id', '=', 'users.id')->where('user_project_t_s_galeries.id', $id)->where(function ($query) {$query->where('user_project_t_s_galeries.deleted_at', '=', null);})->get();
    
            if(empty($userProjectTSGalerie[0]))
            {
                Flash::error('User Project T S Galerie not found');
                return redirect(route('userProjectTSGaleries.index'));
            }
    
            $user = DB::table('project_t_s_galeries')->join('project_topic_sections', 'project_t_s_galeries.project_topic_section_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->where('project_t_s_galeries.id', '=', $userProjectTSGalerie[0] -> project_t_s_galery_id)->get();
    
            $projectTSGImagesList = DB::table('project_t_s_galery_images')->where('project_t_s_g_id' , '=', $id)->orderBy('id', 'desc')->limit(10)->get();
            $userProjectTSGaleriesList = DB::table('user_project_t_s_galeries')->join('users', 'user_project_t_s_galeries.user_id', '=', 'users.id')->select('name', 'email', 'user_project_t_s_galeries.description', 'permissions', 'user_project_t_s_galeries.datetime', 'user_project_t_s_galeries.id', 'project_t_s_galery_id')->where('project_t_s_galery_id', $id)->where(function ($query) {$query->where('user_project_t_s_galeries.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
            $projectTSGaleryViewsList = DB::table('users')->join('project_t_s_galery_views', 'users.id', '=', 'project_t_s_galery_views.user_id')->where('project_t_s_galery_id', $id)->orderBy('datetime', 'desc')->limit(5)->get();
            $projectTSGaleryUpdatesList = DB::table('users')->join('project_t_s_galery_updates', 'users.id', '=', 'project_t_s_galery_updates.user_id')->where('project_t_s_galery_id', $id)->orderBy('datetime', 'desc')->limit(5)->get();
    
            if($user[0] -> user_id == $user_id)
            {
                return view('user_project_t_s_galeries.edit')
                    ->with('userProjectTSGalerie', $userProjectTSGalerie)
                    ->with('id', $userProjectTSGalerie[0] -> project_t_s_galery_id)
                    ->with('projectTSGImagesList', $projectTSGImagesList)
                    ->with('projectTSGaleryViewsList', $projectTSGaleryViewsList)
                    ->with('projectTSGaleryUpdatesList', $projectTSGaleryUpdatesList)
                    ->with('userProjectTSGaleriesList', $userProjectTSGaleriesList);
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

    public function update($id, UpdateUserProjectTSGalerieRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $userProjectTSGalerie = $this->userProjectTSGalerieRepository->findWithoutFail($id);
            $user_id = Auth::user()->id;
    
            if(empty($userProjectTSGalerie))
            {
                Flash::error('User Project T S Galerie not found');
                return redirect(route('userProjectTSGaleries.index'));
            }
            
            $user = DB::table('project_t_s_galeries')->join('project_topic_sections', 'project_t_s_galeries.project_topic_section_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->where('project_t_s_galeries.id', '=', $userProjectTSGalerie -> project_t_s_galery_id)->get();
    
            if($user[0] -> user_id == $user_id)
            {
                $user_id = $userProjectTSGalerie -> user_id;
                $userProjectTSGalerie = $this->userProjectTSGalerieRepository->update($request->all(), $id);
                $projectTSGaleryImages = DB::table('project_t_s_galery_images')->where('project_t_s_g_id', '=', $userProjectTSGalerie -> project_t_s_galery_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                
                DB::table('user_project_t_s_galerie_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_g_id' => $userProjectTSGalerie -> id]);
    
                foreach($projectTSGaleryImages as $projectTSGaleryImage)
                {
                    DB::table('user_project_t_s_galery_images')->where('project_t_s_g_image_id', $projectTSGaleryImage -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userProjectTSGalerie -> permissions]);
                                            
                    $userProjectTSGaleryImage = DB::table('user_project_t_s_galery_images')->where('project_t_s_g_image_id', '=', $projectTSGaleryImage -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                            
                    if(isset($userProjectTSGaleryImage[0]))
                    {
                        DB::table('user_project_t_s_galery_image_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_g_i_id' => $userProjectTSGaleryImage[0] -> id]);
                    }
                }
                
                $user_id = Auth::user()->id;
                $user = DB::table('user_project_t_s_galeries')->join('users', 'users.id', '=', 'user_project_t_s_galeries.user_id')->where('user_project_t_s_galeries.id', '=', $userProjectTSGalerie -> id)->select('name')->get();
                
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_p_t_s_g_u', 'user_id' => $user_id, 'entity_id' => $userProjectTSGalerie -> project_t_s_galery_id, 'created_at' => $now]);
            
                Flash::success('User Project T S Galerie updated successfully.');
                return redirect(route('userProjectTSGaleries.show', [$userProjectTSGalerie -> project_t_s_galery_id]));
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
            $userProjectTSGalerie = $this->userProjectTSGalerieRepository->findWithoutFail($id);
    
            if(empty($userProjectTSGalerie))
            {
                Flash::error('User Project T S Galerie not found');
                return redirect(route('userProjectTSGaleries.index'));
            }
            
            $user = DB::table('project_t_s_galeries')->join('project_topic_sections', 'project_t_s_galeries.project_topic_section_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->where('project_t_s_galeries.id', '=', $userProjectTSGalerie -> project_t_s_galery_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $user_id = $userProjectTSGalerie -> user_id;
                $projectTSGaleryImages = DB::table('project_t_s_galery_images')->where('project_t_s_g_id', '=', $userProjectTSGalerie -> project_t_s_galery_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                
                DB::table('user_project_t_s_galerie_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_g_id' => $userProjectTSGalerie -> id]);
                       
                foreach($projectTSGaleryImages as $projectTSGaleryImage)
                {
                    DB::table('user_project_t_s_galery_images')->where('project_t_s_g_image_id', $projectTSGaleryImage -> id)->where('user_id', '=', $user_id)->update(['deleted_at' => $now]);
                                            
                    $userProjectTSGaleryImage = DB::table('user_project_t_s_galery_images')->where('project_t_s_g_image_id', '=', $projectTSGaleryImage -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                            
                    if(isset($userProjectTSGaleryImage[0]))
                    {
                        DB::table('user_project_t_s_galery_image_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_p_t_s_g_i_id' => $userProjectTSGaleryImage[0] -> id]);
                    }
                }
        
                $this->userProjectTSGalerieRepository->delete($id);
                $user_id = Auth::user()->id;
                $user = DB::table('user_project_t_s_galeries')->join('users', 'users.id', '=', 'user_project_t_s_galeries.user_id')->where('user_project_t_s_galeries.id', '=', $userProjectTSGalerie -> id)->select('name')->get();
                
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_p_t_s_g_d', 'user_id' => $user_id, 'entity_id' => $userProjectTSGalerie -> project_t_s_galery_id, 'created_at' => $now]);
            
                Flash::success('User Project T S Galerie deleted successfully.');
                return redirect(route('userProjectTSGaleries.show', [$userProjectTSGalerie -> project_t_s_galery_id]));
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