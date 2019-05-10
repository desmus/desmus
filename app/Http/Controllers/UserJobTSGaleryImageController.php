<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateUserJobTSGaleryImageRequest;
use App\Http\Requests\UpdateUserJobTSGaleryImageRequest;
use App\Repositories\UserJobTSGaleryImageRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class UserJobTSGaleryImageController extends AppBaseController
{
    private $userJobTSGaleryImageRepository;

    public function __construct(UserJobTSGaleryImageRepository $userJobTSGaleryImageRepo)
    {
        $this->userJobTSGaleryImageRepository = $userJobTSGaleryImageRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userJobTSGaleryImageRepository->pushCriteria(new RequestCriteria($request));
            $userJobTSGaleryImages = $this->userJobTSGaleryImageRepository->all();
    
            return view('user_job_t_s_galery_images.index')
                ->with('userJobTSGaleryImages', $userJobTSGaleryImages);
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
            
            $userJobTSGImagesList = DB::table('user_job_t_s_galery_images')->join('users', 'user_job_t_s_galery_images.user_id', '=', 'users.id')->select('name', 'email', 'user_job_t_s_galery_images.description', 'permissions', 'user_job_t_s_galery_images.datetime', 'user_job_t_s_galery_images.id', 'job_t_s_g_image_id')->where('job_t_s_g_image_id', $id)->where(function ($query) {$query->where('user_job_t_s_galery_images.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
            $jobTSGaleryImageViewsList = DB::table('users')->join('job_t_s_galery_image_views', 'users.id', '=', 'job_t_s_galery_image_views.user_id')->where('job_t_s_g_image_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            $jobTSGaleryImageUpdatesList = DB::table('users')->join('job_t_s_galery_image_updates', 'users.id', '=', 'job_t_s_galery_image_updates.user_id')->where('job_t_s_g_image_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            
            return view('user_job_t_s_galery_images.create', compact('select'))
                ->with('id', $id)
                ->with('now', $now)
                ->with('userJobTSGImagesList', $userJobTSGImagesList)
                ->with('jobTSGaleryImageViewsList', $jobTSGaleryImageViewsList)
                ->with('jobTSGaleryImageUpdatesList', $jobTSGaleryImageUpdatesList);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserJobTSGaleryImageRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $user = DB::table('job_t_s_galery_images')->join('job_t_s_galeries', 'job_t_s_galery_images.job_t_s_g_id', '=', 'job_t_s_galeries.id')->join('job_topic_sections', 'job_t_s_galeries.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->where('job_t_s_galery_images.id', '=', $request -> job_t_s_g_image_id)->get();
            
            $userJobTSGaleryImageCheck = DB::table('user_job_t_s_galery_images')->where('user_id', '=', $request -> user_id)->where('job_t_s_g_image_id','=', $request -> job_t_s_g_image_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
    
            if($userJobTSGaleryImageCheck->isEmpty())
            {
                if($user[0] -> user_id == $user_id)
                {
                    $userJobTSGaleryImage = $this->userJobTSGaleryImageRepository->create($input);
                    $user = DB::table('user_job_t_s_galery_images')->join('users', 'users.id', '=', 'user_job_t_s_galery_images.user_id')->where('user_job_t_s_galery_images.id', '=', $userJobTSGaleryImage -> id)->select('name')->get();
            
                    DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_j_t_s_g_i_c', 'user_id' => $user_id, 'entity_id' => $userJobTSGaleryImage -> job_t_s_g_image_id, 'created_at' => $now]);
                    DB::table('user_job_t_s_galery_image_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_s_g_i_id' => $userJobTSGaleryImage -> id]);
                
                    Flash::success('User Job T S Galery Image saved successfully.');
                    return redirect(route('userJobTSGaleryImages.show', [$userJobTSGaleryImage -> job_t_s_g_image_id]));
                }
                
                else
                {
                    return view('deniedAccess');
                }
            }
    
            return redirect(route('userJobTSGaleryImages.show', [$request -> job_t_s_g_image_id]));
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
            $userJobTSGaleryImage = $this->userJobTSGaleryImageRepository->findWithoutFail($id);
            $userJobTSGaleryImages = DB::table('user_job_t_s_galery_images')->join('users', 'user_job_t_s_galery_images.user_id', '=', 'users.id')->select('name', 'email', 'user_job_t_s_galery_images.description', 'permissions', 'user_job_t_s_galery_images.datetime', 'user_job_t_s_galery_images.id', 'job_t_s_g_image_id')->where('job_t_s_g_image_id', $id)->where(function ($query) {$query->where('user_job_t_s_galery_images.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
    
            if(empty($userJobTSGaleryImages[0]))
            {
                return redirect(route('userJobTSGaleryImages.create', [$id]));
            }
            
            $user = DB::table('job_t_s_galery_images')->join('job_t_s_galeries', 'job_t_s_galery_images.job_t_s_g_id', '=', 'job_t_s_galeries.id')->join('job_topic_sections', 'job_t_s_galeries.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->where('job_t_s_galery_images.id', '=', $userJobTSGaleryImages[0] -> job_t_s_g_image_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $jobTSGaleryImage = DB::table('job_t_s_galery_images')->where('id', '=', $userJobTSGaleryImages[0] -> job_t_s_g_image_id)->get();
    
                $userJobTSGImagesList = DB::table('user_job_t_s_galery_images')->join('users', 'user_job_t_s_galery_images.user_id', '=', 'users.id')->select('name', 'email', 'user_job_t_s_galery_images.description', 'permissions', 'user_job_t_s_galery_images.datetime', 'user_job_t_s_galery_images.id', 'job_t_s_g_image_id')->where('job_t_s_g_image_id', $id)->where(function ($query) {$query->where('user_job_t_s_galery_images.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $jobTSGaleryImageViewsList = DB::table('users')->join('job_t_s_galery_image_views', 'users.id', '=', 'job_t_s_galery_image_views.user_id')->where('job_t_s_g_image_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $jobTSGaleryImageUpdatesList = DB::table('users')->join('job_t_s_galery_image_updates', 'users.id', '=', 'job_t_s_galery_image_updates.user_id')->where('job_t_s_g_image_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
    
                return view('user_job_t_s_galery_images.show')
                    ->with('userJobTSGaleryImages', $userJobTSGaleryImages)
                    ->with('id', $id)
                    ->with('jobTSGaleryImage', $jobTSGaleryImage)
                    ->with('userJobTSGImagesList', $userJobTSGImagesList)
                    ->with('jobTSGaleryImageViewsList', $jobTSGaleryImageViewsList)
                    ->with('jobTSGaleryImageUpdatesList', $jobTSGaleryImageUpdatesList);
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
            $userJobTSGaleryImage = DB::table('users')->join('user_job_t_s_galery_images', 'user_job_t_s_galery_images.user_id', '=', 'users.id')->where('user_job_t_s_galery_images.id', $id)->where(function ($query) {$query->where('user_job_t_s_galery_images.deleted_at', '=', null);})->get();
    
            if(empty($userJobTSGaleryImage))
            {
                Flash::error('User Job T S Galery Image not found');
                return redirect(route('userJobTSGaleryImages.index'));
            }
    
            $user = DB::table('job_t_s_galery_images')->join('job_t_s_galeries', 'job_t_s_galery_images.job_t_s_g_id', '=', 'job_t_s_galeries.id')->join('job_topic_sections', 'job_t_s_galeries.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->where('job_t_s_galery_images.id', '=', $userJobTSGaleryImage[0] -> job_t_s_g_image_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $userJobTSGImagesList = DB::table('user_job_t_s_galery_images')->join('users', 'user_job_t_s_galery_images.user_id', '=', 'users.id')->select('name', 'email', 'user_job_t_s_galery_images.description', 'permissions', 'user_job_t_s_galery_images.datetime', 'user_job_t_s_galery_images.id', 'job_t_s_g_image_id')->where('job_t_s_g_image_id', $id)->where(function ($query) {$query->where('user_job_t_s_galery_images.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $jobTSGaleryImageViewsList = DB::table('users')->join('job_t_s_galery_image_views', 'users.id', '=', 'job_t_s_galery_image_views.user_id')->where('job_t_s_g_image_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $jobTSGaleryImageUpdatesList = DB::table('users')->join('job_t_s_galery_image_updates', 'users.id', '=', 'job_t_s_galery_image_updates.user_id')->where('job_t_s_g_image_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();

                return view('user_job_t_s_galery_images.edit')
                    ->with('userJobTSGaleryImage', $userJobTSGaleryImage)
                    ->with('id', $userJobTSGaleryImage[0] -> job_t_s_g_image_id)
                    ->with('userJobTSGImagesList', $userJobTSGImagesList)
                    ->with('jobTSGaleryImageViewsList', $jobTSGaleryImageViewsList)
                    ->with('jobTSGaleryImageUpdatesList', $jobTSGaleryImageUpdatesList);
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

    public function update($id, UpdateUserJobTSGaleryImageRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $userJobTSGaleryImage = $this->userJobTSGaleryImageRepository->findWithoutFail($id);
    
            if(empty($userJobTSGaleryImage))
            {
                Flash::error('User Job T S Galery Image not found');
                return redirect(route('userJobTSGaleryImages.index'));
            }
    
            $user = DB::table('job_t_s_galery_images')->join('job_t_s_galeries', 'job_t_s_galery_images.job_t_s_g_id', '=', 'job_t_s_galeries.id')->join('job_topic_sections', 'job_t_s_galeries.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->where('job_t_s_galery_images.id', '=', $userJobTSGaleryImage -> job_t_s_g_image_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $userJobTSGaleryImage = $this->userJobTSGaleryImageRepository->update($request->all(), $id);
                $user = DB::table('user_job_t_s_galery_images')->join('users', 'users.id', '=', 'user_job_t_s_galery_images.user_id')->where('user_job_t_s_galery_images.id', '=', $userJobTSGaleryImage -> id)->select('name')->get();
            
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_j_t_s_g_i_u', 'user_id' => $user_id, 'entity_id' => $userJobTSGaleryImage -> job_t_s_g_image_id, 'created_at' => $now]);
                DB::table('user_job_t_s_galery_image_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_s_g_i_id' => $userJobTSGaleryImage -> id]);
            
                Flash::success('User Job T S Galery Image updated successfully.');
                return redirect(route('userJobTSGaleryImages.show', [$userJobTSGaleryImage -> job_t_s_g_image_id]));
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
            $userJobTSGaleryImage = $this->userJobTSGaleryImageRepository->findWithoutFail($id);
    
            if(empty($userJobTSGaleryImage))
            {
                Flash::error('User Job T S Galery Image not found');
                return redirect(route('userJobTSGaleryImages.index'));
            }
    
            $user = DB::table('job_t_s_galery_images')->join('job_t_s_galeries', 'job_t_s_galery_images.job_t_s_g_id', '=', 'job_t_s_galeries.id')->join('job_topic_sections', 'job_t_s_galeries.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->where('job_t_s_galery_images.id', '=', $userJobTSGaleryImage -> job_t_s_g_image_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $this->userJobTSGaleryImageRepository->delete($id);
                $user = DB::table('user_job_t_s_galery_images')->join('users', 'users.id', '=', 'user_job_t_s_galery_images.user_id')->where('user_job_t_s_galery_images.id', '=', $userJobTSGaleryImage -> id)->select('name')->get();
            
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_j_t_s_g_i_d', 'user_id' => $user_id, 'entity_id' => $userJobTSGaleryImage -> job_t_s_g_image_id, 'created_at' => $now]);
                DB::table('user_job_t_s_galery_image_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_j_t_s_g_i_id' => $userJobTSGaleryImage -> id]);
            
                Flash::success('User Job T S Galery Image deleted successfully.');
                return redirect(route('userJobTSGaleryImages.show', [$userJobTSGaleryImage -> job_t_s_g_image_id]));
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