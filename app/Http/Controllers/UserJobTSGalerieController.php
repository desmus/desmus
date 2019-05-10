<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateUserJobTSGalerieRequest;
use App\Http\Requests\UpdateUserJobTSGalerieRequest;
use App\Repositories\UserJobTSGalerieRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class UserJobTSGalerieController extends AppBaseController
{
    private $userJobTSGalerieRepository;

    public function __construct(UserJobTSGalerieRepository $userJobTSGalerieRepo)
    {
        $this->userJobTSGalerieRepository = $userJobTSGalerieRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userJobTSGalerieRepository->pushCriteria(new RequestCriteria($request));
            $userJobTSGaleries = $this->userJobTSGalerieRepository->all();
    
            return view('user_job_t_s_galeries.index')
                ->with('userJobTSGaleries', $userJobTSGaleries);
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
            
            $jobTSGImagesList = DB::table('job_t_s_galery_images')->where('job_t_s_g_id' , '=', $id)->orderBy('id', 'desc')->limit(10)->get();
            $userJobTSGaleriesList = DB::table('user_job_t_s_galeries')->join('users', 'user_job_t_s_galeries.user_id', '=', 'users.id')->select('name', 'email', 'user_job_t_s_galeries.description', 'permissions', 'user_job_t_s_galeries.datetime', 'user_job_t_s_galeries.id', 'job_t_s_galery_id')->where('job_t_s_galery_id', $id)->where(function ($query) {$query->where('user_job_t_s_galeries.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
            $jobTSGaleryViewsList = DB::table('users')->join('job_t_s_galery_views', 'users.id', '=', 'job_t_s_galery_views.user_id')->where('job_t_s_galery_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            $jobTSGaleryUpdatesList = DB::table('users')->join('job_t_s_galery_updates', 'users.id', '=', 'job_t_s_galery_updates.user_id')->where('job_t_s_galery_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();

            return view('user_job_t_s_galeries.create', compact('select'))
                ->with('id', $id)
                ->with('now', $now)
                ->with('jobTSGImagesList', $jobTSGImagesList)
                ->with('userJobTSGaleriesList', $userJobTSGaleriesList)
                ->with('jobTSGaleryViewsList', $jobTSGaleryViewsList)
                ->with('jobTSGaleryUpdatesList', $jobTSGaleryUpdatesList);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserJobTSGalerieRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $user = DB::table('job_t_s_galeries')->join('job_topic_sections', 'job_t_s_galeries.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->where('job_t_s_galeries.id', '=', $request -> job_t_s_galery_id)->get();
            
            $userJobTSGaleryCheck = DB::table('user_job_t_s_galeries')->where('user_id', '=', $request -> user_id)->where('job_t_s_galery_id', '=', $request -> job_t_s_galery_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
    
            if($userJobTSGaleryCheck->isEmpty())
            {
                if($user[0] -> user_id == $user_id)
                {
                    $userJobTSGalerie = $this->userJobTSGalerieRepository->create($input);
                    $jobTSGaleryImages = DB::table('job_t_s_galery_images')->where('job_t_s_g_id', '=', $userJobTSGalerie -> job_t_s_galery_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                    
                    DB::table('user_job_t_s_galerie_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_s_g_id' => $userJobTSGalerie -> id]);
                       
                    foreach($jobTSGaleryImages as $jobTSGaleryImage)
                    {
                        DB::table('user_job_t_s_galery_images')->insert(['datetime' => $now, 'user_id' => $userJobTSGalerie -> user_id, 'description' => $userJobTSGalerie -> description, 'job_t_s_g_image_id' => $jobTSGaleryImage -> id]);
                                                
                        $userJobTSGaleryImage = DB::table('user_job_t_s_galery_images')->where('job_t_s_g_image_id', '=', $jobTSGaleryImage -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                                
                        if(isset($userJobTSGalery[0]))
                        {
                            DB::table('user_job_t_s_galery_image_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_s_g_i_id' => $userJobTSGaleryImage[0] -> id]);
                        }        
                    }
                    
                    $user = DB::table('user_job_t_s_galeries')->join('users', 'users.id', '=', 'user_job_t_s_galeries.user_id')->where('user_job_t_s_galeries.id', '=', $userJobTSGalerie -> id)->select('name')->get();
                    
                    DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_j_t_s_g_c', 'user_id' => $user_id, 'entity_id' => $userJobTSGalerie -> job_t_s_galery_id, 'created_at' => $now]);
                
                    Flash::success('User Job T S Galerie saved successfully.');
                    return redirect(route('userJobTSGaleries.show', [$userJobTSGalerie -> job_t_s_galery_id]));
                }
                
                else
                {
                    return view('deniedAccess');
                }
            }
            
            return redirect(route('userJobTSGaleries.show', [$request -> job_t_s_galery_id]));
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
            $userJobTSGalerie = $this->userJobTSGalerieRepository->findWithoutFail($id);
            $userJobTSGaleries = DB::table('user_job_t_s_galeries')->join('users', 'user_job_t_s_galeries.user_id', '=', 'users.id')->select('name', 'email', 'user_job_t_s_galeries.description', 'permissions', 'user_job_t_s_galeries.datetime', 'user_job_t_s_galeries.id', 'job_t_s_galery_id')->where('job_t_s_galery_id', $id)->where(function ($query) {$query->where('user_job_t_s_galeries.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
    
            if(empty($userJobTSGaleries[0]))
            {
                Flash::error('User Job T S Galerie not found');
                return redirect(route('userJobTSGaleries.create', [$id]));
            }
            
            $user = DB::table('job_t_s_galeries')->join('job_topic_sections', 'job_t_s_galeries.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->where('job_t_s_galeries.id', '=', $userJobTSGaleries[0] -> job_t_s_galery_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $jobTSGalerie = DB::table('job_t_s_galeries')->where('id', '=', $userJobTSGaleries[0] -> job_t_s_galery_id)->get();
    
                $jobTSGImagesList = DB::table('job_t_s_galery_images')->where('job_t_s_g_id' , '=', $id)->orderBy('id', 'desc')->limit(10)->get();
                $userJobTSGaleriesList = DB::table('user_job_t_s_galeries')->join('users', 'user_job_t_s_galeries.user_id', '=', 'users.id')->select('name', 'email', 'user_job_t_s_galeries.description', 'permissions', 'user_job_t_s_galeries.datetime', 'user_job_t_s_galeries.id', 'job_t_s_galery_id')->where('job_t_s_galery_id', $id)->where(function ($query) {$query->where('user_job_t_s_galeries.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $jobTSGaleryViewsList = DB::table('users')->join('job_t_s_galery_views', 'users.id', '=', 'job_t_s_galery_views.user_id')->where('job_t_s_galery_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $jobTSGaleryUpdatesList = DB::table('users')->join('job_t_s_galery_updates', 'users.id', '=', 'job_t_s_galery_updates.user_id')->where('job_t_s_galery_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();

                return view('user_job_t_s_galeries.show')->with('userJobTSGaleries', $userJobTSGaleries)
                    ->with('id', $id)
                    ->with('jobTSGalerie', $jobTSGalerie)
                    ->with('jobTSGImagesList', $jobTSGImagesList)
                    ->with('userJobTSGaleriesList', $userJobTSGaleriesList)
                    ->with('jobTSGaleryViewsList', $jobTSGaleryViewsList)
                    ->with('jobTSGaleryUpdatesList', $jobTSGaleryUpdatesList);
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
            $userJobTSGalerie = DB::table('users')->join('user_job_t_s_galeries', 'user_job_t_s_galeries.user_id', '=', 'users.id')->where('user_job_t_s_galeries.id', $id)->where(function ($query) {$query->where('user_job_t_s_galeries.deleted_at', '=', null);})->get();
    
            if(empty($userJobTSGalerie[0]))
            {
                Flash::error('User Job T S Galerie not found');
                return redirect(route('userJobTSGaleries.index'));
            }
    
            $user = DB::table('job_t_s_galeries')->join('job_topic_sections', 'job_t_s_galeries.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->where('job_t_s_galeries.id', '=', $userJobTSGalerie[0] -> job_t_s_galery_id)->get();
    
            if($user[0] -> user_id == $user_id)
            {
                $jobTSGImagesList = DB::table('job_t_s_galery_images')->where('job_t_s_g_id' , '=', $id)->orderBy('id', 'desc')->limit(10)->get();
                $userJobTSGaleriesList = DB::table('user_job_t_s_galeries')->join('users', 'user_job_t_s_galeries.user_id', '=', 'users.id')->select('name', 'email', 'user_job_t_s_galeries.description', 'permissions', 'user_job_t_s_galeries.datetime', 'user_job_t_s_galeries.id', 'job_t_s_galery_id')->where('job_t_s_galery_id', $id)->where(function ($query) {$query->where('user_job_t_s_galeries.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $jobTSGaleryViewsList = DB::table('users')->join('job_t_s_galery_views', 'users.id', '=', 'job_t_s_galery_views.user_id')->where('job_t_s_galery_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $jobTSGaleryUpdatesList = DB::table('users')->join('job_t_s_galery_updates', 'users.id', '=', 'job_t_s_galery_updates.user_id')->where('job_t_s_galery_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();

                return view('user_job_t_s_galeries.edit')
                    ->with('userJobTSGalerie', $userJobTSGalerie)
                    ->with('id', $userJobTSGalerie[0] -> job_t_s_galery_id)
                    ->with('jobTSGImagesList', $jobTSGImagesList)
                    ->with('userJobTSGaleriesList', $userJobTSGaleriesList)
                    ->with('jobTSGaleryViewsList', $jobTSGaleryViewsList)
                    ->with('jobTSGaleryUpdatesList', $jobTSGaleryUpdatesList);
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

    public function update($id, UpdateUserJobTSGalerieRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $userJobTSGalerie = $this->userJobTSGalerieRepository->findWithoutFail($id);
            $user_id = Auth::user()->id;
    
            if(empty($userJobTSGalerie))
            {
                Flash::error('User Job T S Galerie not found');
                return redirect(route('userJobTSGaleries.index'));
            }
            
            $user = DB::table('job_t_s_galeries')->join('job_topic_sections', 'job_t_s_galeries.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->where('job_t_s_galeries.id', '=', $userJobTSGalerie -> job_t_s_galery_id)->get();
    
            if($user[0] -> user_id == $user_id)
            {
                $user_id = $userJobTSGalerie -> user_id;
                $userJobTSGalerie = $this->userJobTSGalerieRepository->update($request->all(), $id);
                $jobTSGaleryImages = DB::table('job_t_s_galery_images')->where('job_t_s_g_id', '=', $userJobTSGalerie -> job_t_s_galery_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                
                DB::table('user_job_t_s_galerie_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_s_g_id' => $userJobTSGalerie -> id]);
    
                foreach($jobTSGaleryImages as $jobTSGaleryImage)
                {
                    DB::table('user_job_t_s_galery_images')->where('job_t_s_g_image_id', $jobTSGaleryImage -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userJobTSGalerie -> permissions]);
                                            
                    $userJobTSGaleryImage = DB::table('user_job_t_s_galery_images')->where('job_t_s_g_image_id', '=', $jobTSGaleryImage -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                            
                    if(isset($userJobTSGaleryImage[0]))
                    {
                        DB::table('user_job_t_s_galery_image_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_s_g_i_id' => $userJobTSGaleryImage[0] -> id]);
                    }
                }
                
                $user_id = Auth::user()->id;
                $user = DB::table('user_job_t_s_galeries')->join('users', 'users.id', '=', 'user_job_t_s_galeries.user_id')->where('user_job_t_s_galeries.id', '=', $userJobTSGalerie -> id)->select('name')->get();
                
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_j_t_s_g_u', 'user_id' => $user_id, 'entity_id' => $userJobTSGalerie -> job_t_s_galery_id, 'created_at' => $now]);
            
                Flash::success('User Job T S Galerie updated successfully.');
                return redirect(route('userJobTSGaleries.show', [$userJobTSGalerie -> job_t_s_galery_id]));
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
            $userJobTSGalerie = $this->userJobTSGalerieRepository->findWithoutFail($id);
    
            if(empty($userJobTSGalerie))
            {
                Flash::error('User Job T S Galerie not found');
                return redirect(route('userJobTSGaleries.index'));
            }
            
            $user = DB::table('job_t_s_galeries')->join('job_topic_sections', 'job_t_s_galeries.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->where('job_t_s_galeries.id', '=', $userJobTSGalerie -> job_t_s_galery_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $user_id = $userJobTSGalerie -> user_id;
                $jobTSGaleryImages = DB::table('job_t_s_galery_images')->where('job_t_s_g_id', '=', $userJobTSGalerie -> job_t_s_galery_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                
                DB::table('user_job_t_s_galerie_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_s_g_id' => $userJobTSGalerie -> id]);
                       
                foreach($jobTSGaleryImages as $jobTSGaleryImage)
                {
                    DB::table('user_job_t_s_galery_images')->where('job_t_s_g_image_id', $jobTSGaleryImage -> id)->where('user_id', '=', $user_id)->update(['deleted_at' => $now]);
                                            
                    $userJobTSGaleryImage = DB::table('user_job_t_s_galery_images')->where('job_t_s_g_image_id', '=', $jobTSGaleryImage -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                            
                    if(isset($userJobTSGaleryImage[0]))
                    {
                        DB::table('user_job_t_s_galery_image_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_s_g_i_id' => $userJobTSGaleryImage[0] -> id]);
                    }
                }
        
                $this->userJobTSGalerieRepository->delete($id);
                $user_id = Auth::user()->id;
                $user = DB::table('user_job_t_s_galeries')->join('users', 'users.id', '=', 'user_job_t_s_galeries.user_id')->where('user_job_t_s_galeries.id', '=', $userJobTSGalerie -> id)->select('name')->get();
                
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_j_t_s_g_d', 'user_id' => $user_id, 'entity_id' => $userJobTSGalerie -> job_t_s_galery_id, 'created_at' => $now]);
            
                Flash::success('User Job T S Galerie deleted successfully.');
                return redirect(route('userJobTSGaleries.show', [$userJobTSGalerie -> job_t_s_galery_id]));
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