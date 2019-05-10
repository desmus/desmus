<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateUserCollegeTSGaleryImageRequest;
use App\Http\Requests\UpdateUserCollegeTSGaleryImageRequest;
use App\Repositories\UserCollegeTSGaleryImageRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class UserCollegeTSGaleryImageController extends AppBaseController
{
    private $userCollegeTSGaleryImageRepository;

    public function __construct(UserCollegeTSGaleryImageRepository $userCollegeTSGaleryImageRepo)
    {
        $this->userCollegeTSGaleryImageRepository = $userCollegeTSGaleryImageRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userCollegeTSGaleryImageRepository->pushCriteria(new RequestCriteria($request));
            $userCollegeTSGaleryImages = $this->userCollegeTSGaleryImageRepository->all();
    
            return view('user_college_t_s_galery_images.index')
                ->with('userCollegeTSGaleryImages', $userCollegeTSGaleryImages);
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
            
            $userCollegeTSGImagesList = DB::table('user_college_t_s_galery_images')->join('users', 'user_college_t_s_galery_images.user_id', '=', 'users.id')->select('name', 'email', 'user_college_t_s_galery_images.description', 'permissions', 'user_college_t_s_galery_images.datetime', 'user_college_t_s_galery_images.id', 'college_t_s_g_image_id')->where('college_t_s_g_image_id', $id)->where(function ($query) {$query->where('user_college_t_s_galery_images.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
            $collegeTSGaleryImageViewsList = DB::table('users')->join('college_t_s_galery_image_views', 'users.id', '=', 'college_t_s_galery_image_views.user_id')->where('college_t_s_g_image_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            $collegeTSGaleryImageUpdatesList = DB::table('users')->join('college_t_s_galery_image_updates', 'users.id', '=', 'college_t_s_galery_image_updates.user_id')->where('college_t_s_g_image_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            
            return view('user_college_t_s_galery_images.create', compact('select'))
                ->with('id', $id)
                ->with('now', $now)
                ->with('userCollegeTSGImagesList', $userCollegeTSGImagesList)
                ->with('collegeTSGaleryImageViewsList', $collegeTSGaleryImageViewsList)
                ->with('collegeTSGaleryImageUpdatesList', $collegeTSGaleryImageUpdatesList);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserCollegeTSGaleryImageRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $user = DB::table('college_t_s_galery_images')->join('college_t_s_galeries', 'college_t_s_galery_images.college_t_s_g_id', '=', 'college_t_s_galeries.id')->join('college_topic_sections', 'college_t_s_galeries.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->where('college_t_s_galery_images.id', '=', $request -> college_t_s_g_image_id)->get();
            
            $userCollegeTSGaleryImageCheck = DB::table('user_college_t_s_galery_images')->where('user_id', '=', $request -> user_id)->where('college_t_s_g_image_id', '=', $request -> college_t_s_g_image_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
    
            if($userCollegeTSGaleryImageCheck->isEmpty())
            {
                if($user[0] -> user_id == $user_id)
                {
                    $userCollegeTSGaleryImage = $this->userCollegeTSGaleryImageRepository->create($input);
                    $user = DB::table('user_college_t_s_galery_images')->join('users', 'users.id', '=', 'user_college_t_s_galery_images.user_id')->where('user_college_t_s_galery_images.id', '=', $userCollegeTSGaleryImage -> id)->select('name')->get();
            
                    DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_c_t_s_g_i_c', 'user_id' => $user_id, 'entity_id' => $userCollegeTSGaleryImage -> college_t_s_g_image_id, 'created_at' => $now]);
                    DB::table('user_college_t_s_galery_image_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_g_i_id' => $userCollegeTSGaleryImage -> id]);
                
                    Flash::success('User College T S Galery Image saved successfully.');
                    return redirect(route('userCollegeTSGaleryImages.show', [$userCollegeTSGaleryImage -> college_t_s_g_image_id]));
                }
                
                else
                {
                    return view('deniedAccess');
                }
            }
            
            return redirect(route('userCollegeTSGaleryImages.show', [$request -> college_t_s_g_image_id]));
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
            $userCollegeTSGaleryImage = $this->userCollegeTSGaleryImageRepository->findWithoutFail($id);
            $userCollegeTSGaleryImages = DB::table('user_college_t_s_galery_images')->join('users', 'user_college_t_s_galery_images.user_id', '=', 'users.id')->select('name', 'email', 'user_college_t_s_galery_images.description', 'permissions', 'user_college_t_s_galery_images.datetime', 'user_college_t_s_galery_images.id', 'college_t_s_g_image_id')->where('college_t_s_g_image_id', $id)->where(function ($query) {$query->where('user_college_t_s_galery_images.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
    
            if(empty($userCollegeTSGaleryImages[0]))
            {
                return redirect(route('userCollegeTSGaleryImages.create', [$id]));
            }
            
            $user = DB::table('college_t_s_galery_images')->join('college_t_s_galeries', 'college_t_s_galery_images.college_t_s_g_id', '=', 'college_t_s_galeries.id')->join('college_topic_sections', 'college_t_s_galeries.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->where('college_t_s_galery_images.id', '=', $userCollegeTSGaleryImages[0] -> college_t_s_g_image_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $collegeTSGaleryImage = DB::table('college_t_s_galery_images')->where('id', '=', $userCollegeTSGaleryImages[0] -> college_t_s_g_image_id)->get();
    
                $userCollegeTSGImagesList = DB::table('user_college_t_s_galery_images')->join('users', 'user_college_t_s_galery_images.user_id', '=', 'users.id')->select('name', 'email', 'user_college_t_s_galery_images.description', 'permissions', 'user_college_t_s_galery_images.datetime', 'user_college_t_s_galery_images.id', 'college_t_s_g_image_id')->where('college_t_s_g_image_id', $id)->where(function ($query) {$query->where('user_college_t_s_galery_images.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $collegeTSGaleryImageViewsList = DB::table('users')->join('college_t_s_galery_image_views', 'users.id', '=', 'college_t_s_galery_image_views.user_id')->where('college_t_s_g_image_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $collegeTSGaleryImageUpdatesList = DB::table('users')->join('college_t_s_galery_image_updates', 'users.id', '=', 'college_t_s_galery_image_updates.user_id')->where('college_t_s_g_image_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
    
                return view('user_college_t_s_galery_images.show')
                    ->with('userCollegeTSGaleryImages', $userCollegeTSGaleryImages)
                    ->with('id', $id)
                    ->with('collegeTSGaleryImage', $collegeTSGaleryImage)
                    ->with('userCollegeTSGImagesList', $userCollegeTSGImagesList)
                    ->with('collegeTSGaleryImageViewsList', $collegeTSGaleryImageViewsList)
                    ->with('collegeTSGaleryImageUpdatesList', $collegeTSGaleryImageUpdatesList);
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
            $userCollegeTSGaleryImage = DB::table('users')->join('user_college_t_s_galery_images', 'user_college_t_s_galery_images.user_id', '=', 'users.id')->where('user_college_t_s_galery_images.id', $id)->where(function ($query) {$query->where('user_college_t_s_galery_images.deleted_at', '=', null);})->get();
    
            if(empty($userCollegeTSGaleryImage))
            {
                Flash::error('User College T S Galery Image not found');
                return redirect(route('userCollegeTSGaleryImages.index'));
            }
    
            $user = DB::table('college_t_s_galery_images')->join('college_t_s_galeries', 'college_t_s_galery_images.college_t_s_g_id', '=', 'college_t_s_galeries.id')->join('college_topic_sections', 'college_t_s_galeries.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->where('college_t_s_galery_images.id', '=', $userCollegeTSGaleryImage[0] -> college_t_s_g_image_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $userCollegeTSGImagesList = DB::table('user_college_t_s_galery_images')->join('users', 'user_college_t_s_galery_images.user_id', '=', 'users.id')->select('name', 'email', 'user_college_t_s_galery_images.description', 'permissions', 'user_college_t_s_galery_images.datetime', 'user_college_t_s_galery_images.id', 'college_t_s_g_image_id')->where('college_t_s_g_image_id', $id)->where(function ($query) {$query->where('user_college_t_s_galery_images.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $collegeTSGaleryImageViewsList = DB::table('users')->join('college_t_s_galery_image_views', 'users.id', '=', 'college_t_s_galery_image_views.user_id')->where('college_t_s_g_image_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $collegeTSGaleryImageUpdatesList = DB::table('users')->join('college_t_s_galery_image_updates', 'users.id', '=', 'college_t_s_galery_image_updates.user_id')->where('college_t_s_g_image_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();

                return view('user_college_t_s_galery_images.edit')
                    ->with('userCollegeTSGaleryImage', $userCollegeTSGaleryImage)
                    ->with('id', $userCollegeTSGaleryImage[0] -> college_t_s_g_image_id)
                    ->with('userCollegeTSGImagesList', $userCollegeTSGImagesList)
                    ->with('collegeTSGaleryImageViewsList', $collegeTSGaleryImageViewsList)
                    ->with('collegeTSGaleryImageUpdatesList', $collegeTSGaleryImageUpdatesList);
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

    public function update($id, UpdateUserCollegeTSGaleryImageRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $userCollegeTSGaleryImage = $this->userCollegeTSGaleryImageRepository->findWithoutFail($id);
    
            if(empty($userCollegeTSGaleryImage))
            {
                Flash::error('User College T S Galery Image not found');
                return redirect(route('userCollegeTSGaleryImages.index'));
            }
    
            $user = DB::table('college_t_s_galery_images')->join('college_t_s_galeries', 'college_t_s_galery_images.college_t_s_g_id', '=', 'college_t_s_galeries.id')->join('college_topic_sections', 'college_t_s_galeries.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->where('college_t_s_galery_images.id', '=', $userCollegeTSGaleryImage -> college_t_s_g_image_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $userCollegeTSGaleryImage = $this->userCollegeTSGaleryImageRepository->update($request->all(), $id);
                $user = DB::table('user_college_t_s_galery_images')->join('users', 'users.id', '=', 'user_college_t_s_galery_images.user_id')->where('user_college_t_s_galery_images.id', '=', $userCollegeTSGaleryImage -> id)->select('name')->get();
            
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_c_t_s_g_i_u', 'user_id' => $user_id, 'entity_id' => $userCollegeTSGaleryImage -> college_t_s_g_image_id, 'created_at' => $now]);
                DB::table('user_college_t_s_galery_image_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_g_i_id' => $userCollegeTSGaleryImage -> id]);
            
                Flash::success('User College T S Galery Image updated successfully.');
                return redirect(route('userCollegeTSGaleryImages.show', [$userCollegeTSGaleryImage -> college_t_s_g_image_id]));
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
            $userCollegeTSGaleryImage = $this->userCollegeTSGaleryImageRepository->findWithoutFail($id);
    
            if(empty($userCollegeTSGaleryImage))
            {
                Flash::error('User College T S Galery Image not found');
                return redirect(route('userCollegeTSGaleryImages.index'));
            }
    
            $user = DB::table('college_t_s_galery_images')->join('college_t_s_galeries', 'college_t_s_galery_images.college_t_s_g_id', '=', 'college_t_s_galeries.id')->join('college_topic_sections', 'college_t_s_galeries.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->where('college_t_s_galery_images.id', '=', $userCollegeTSGaleryImage -> college_t_s_g_image_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $this->userCollegeTSGaleryImageRepository->delete($id);
                $user = DB::table('user_college_t_s_galery_images')->join('users', 'users.id', '=', 'user_college_t_s_galery_images.user_id')->where('user_college_t_s_galery_images.id', '=', $userCollegeTSGaleryImage -> id)->select('name')->get();
            
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_c_t_s_g_i_d', 'user_id' => $user_id, 'entity_id' => $userCollegeTSGaleryImage -> college_t_s_g_image_id, 'created_at' => $now]);
                DB::table('user_college_t_s_galery_image_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_g_i_id' => $userCollegeTSGaleryImage -> id]);
            
                Flash::success('User College T S Galery Image deleted successfully.');
                return redirect(route('userCollegeTSGaleryImages.show', [$userCollegeTSGaleryImage -> college_t_s_g_image_id]));
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