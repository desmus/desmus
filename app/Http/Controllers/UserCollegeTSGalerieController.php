<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateUserCollegeTSGalerieRequest;
use App\Http\Requests\UpdateUserCollegeTSGalerieRequest;
use App\Repositories\UserCollegeTSGalerieRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class UserCollegeTSGalerieController extends AppBaseController
{
    private $userCollegeTSGalerieRepository;

    public function __construct(UserCollegeTSGalerieRepository $userCollegeTSGalerieRepo)
    {
        $this->userCollegeTSGalerieRepository = $userCollegeTSGalerieRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userCollegeTSGalerieRepository->pushCriteria(new RequestCriteria($request));
            $userCollegeTSGaleries = $this->userCollegeTSGalerieRepository->all();
    
            return view('user_college_t_s_galeries.index')
                ->with('userCollegeTSGaleries', $userCollegeTSGaleries);
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
            
            $collegeTSGImagesList = DB::table('college_t_s_galery_images')->where('college_t_s_g_id' , '=', $id)->orderBy('id', 'desc')->limit(10)->get();
            $userCollegeTSGaleriesList = DB::table('user_college_t_s_galeries')->join('users', 'user_college_t_s_galeries.user_id', '=', 'users.id')->select('name', 'email', 'user_college_t_s_galeries.description', 'permissions', 'user_college_t_s_galeries.datetime', 'user_college_t_s_galeries.id', 'college_t_s_galery_id')->where('college_t_s_galery_id', $id)->where(function ($query) {$query->where('user_college_t_s_galeries.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
            $collegeTSGaleryViewsList = DB::table('users')->join('college_t_s_galery_views', 'users.id', '=', 'college_t_s_galery_views.user_id')->where('college_t_s_galery_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            $collegeTSGaleryUpdatesList = DB::table('users')->join('college_t_s_galery_updates', 'users.id', '=', 'college_t_s_galery_updates.user_id')->where('college_t_s_galery_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();

            return view('user_college_t_s_galeries.create', compact('select'))
                ->with('id', $id)
                ->with('now', $now)
                ->with('collegeTSGImagesList', $collegeTSGImagesList)
                ->with('userCollegeTSGaleriesList', $userCollegeTSGaleriesList)
                ->with('collegeTSGaleryViewsList', $collegeTSGaleryViewsList)
                ->with('collegeTSGaleryUpdatesList', $collegeTSGaleryUpdatesList);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserCollegeTSGalerieRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $user = DB::table('college_t_s_galeries')->join('college_topic_sections', 'college_t_s_galeries.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->where('college_t_s_galeries.id', '=', $request -> college_t_s_galery_id)->get();
            
            $userCollegeTSGaleryCheck = DB::table('user_college_t_s_galeries')->where('user_id', '=', $request -> user_id)->where('college_t_s_galery_id', '=', $request -> college_t_s_galery_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
    
            if($userCollegeTSGaleryCheck->isEmpty())
            {
                if($user[0] -> user_id == $user_id)
                {
                    $userCollegeTSGalerie = $this->userCollegeTSGalerieRepository->create($input);
                    $collegeTSGaleryImages = DB::table('college_t_s_galery_images')->where('college_t_s_g_id', '=', $userCollegeTSGalerie -> college_t_s_galery_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                    
                    DB::table('user_college_t_s_galerie_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_g_id' => $userCollegeTSGalerie -> id]);
                       
                    foreach($collegeTSGaleryImages as $collegeTSGaleryImage)
                    {
                        DB::table('user_college_t_s_galery_images')->insert(['datetime' => $now, 'user_id' => $userCollegeTSGalerie -> user_id, 'description' => $userCollegeTSGalerie -> description, 'college_t_s_g_image_id' => $collegeTSGaleryImage -> id]);
                                                
                        $userCollegeTSGaleryImage = DB::table('user_college_t_s_galery_images')->where('college_t_s_g_image_id', '=', $collegeTSGaleryImage -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                                
                        if(isset($userCollegeTSGalery[0]))
                        {
                            DB::table('user_college_t_s_galery_image_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_g_i_id' => $userCollegeTSGaleryImage[0] -> id]);
                        }        
                    }
                    
                    $user = DB::table('user_college_t_s_galeries')->join('users', 'users.id', '=', 'user_college_t_s_galeries.user_id')->where('user_college_t_s_galeries.id', '=', $userCollegeTSGalerie -> id)->select('name')->get();
                    
                    DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_c_t_s_g_c', 'user_id' => $user_id, 'entity_id' => $userCollegeTSGalerie -> college_t_s_galery_id, 'created_at' => $now]);
                
                    Flash::success('User College T S Galerie saved successfully.');
                    return redirect(route('userCollegeTSGaleries.show', [$userCollegeTSGalerie -> college_t_s_galery_id]));
                }
                
                else
                {
                    return view('deniedAccess');
                }
            }
            
            return redirect(route('userCollegeTSGaleries.show', [$request -> college_t_s_galery_id]));
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
            $userCollegeTSGalerie = $this->userCollegeTSGalerieRepository->findWithoutFail($id);
            $userCollegeTSGaleries = DB::table('user_college_t_s_galeries')->join('users', 'user_college_t_s_galeries.user_id', '=', 'users.id')->select('name', 'email', 'user_college_t_s_galeries.description', 'permissions', 'user_college_t_s_galeries.datetime', 'user_college_t_s_galeries.id', 'college_t_s_galery_id')->where('college_t_s_galery_id', $id)->where(function ($query) {$query->where('user_college_t_s_galeries.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
    
            if(empty($userCollegeTSGaleries[0]))
            {
                Flash::error('User College T S Galerie not found');
                return redirect(route('userCollegeTSGaleries.create', [$id]));
            }
            
            $user = DB::table('college_t_s_galeries')->join('college_topic_sections', 'college_t_s_galeries.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->where('college_t_s_galeries.id', '=', $userCollegeTSGaleries[0] -> college_t_s_galery_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $collegeTSGalerie = DB::table('college_t_s_galeries')->where('id', '=', $userCollegeTSGaleries[0] -> college_t_s_galery_id)->get();
    
                $collegeTSGImagesList = DB::table('college_t_s_galery_images')->where('college_t_s_g_id' , '=', $id)->orderBy('id', 'desc')->limit(10)->get();
                $userCollegeTSGaleriesList = DB::table('user_college_t_s_galeries')->join('users', 'user_college_t_s_galeries.user_id', '=', 'users.id')->select('name', 'email', 'user_college_t_s_galeries.description', 'permissions', 'user_college_t_s_galeries.datetime', 'user_college_t_s_galeries.id', 'college_t_s_galery_id')->where('college_t_s_galery_id', $id)->where(function ($query) {$query->where('user_college_t_s_galeries.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $collegeTSGaleryViewsList = DB::table('users')->join('college_t_s_galery_views', 'users.id', '=', 'college_t_s_galery_views.user_id')->where('college_t_s_galery_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $collegeTSGaleryUpdatesList = DB::table('users')->join('college_t_s_galery_updates', 'users.id', '=', 'college_t_s_galery_updates.user_id')->where('college_t_s_galery_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();

                return view('user_college_t_s_galeries.show')->with('userCollegeTSGaleries', $userCollegeTSGaleries)
                    ->with('id', $id)
                    ->with('collegeTSGalerie', $collegeTSGalerie)
                    ->with('collegeTSGImagesList', $collegeTSGImagesList)
                    ->with('userCollegeTSGaleriesList', $userCollegeTSGaleriesList)
                    ->with('collegeTSGaleryViewsList', $collegeTSGaleryViewsList)
                    ->with('collegeTSGaleryUpdatesList', $collegeTSGaleryUpdatesList);
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
            $userCollegeTSGalerie = DB::table('users')->join('user_college_t_s_galeries', 'user_college_t_s_galeries.user_id', '=', 'users.id')->where('user_college_t_s_galeries.id', $id)->where(function ($query) {$query->where('user_college_t_s_galeries.deleted_at', '=', null);})->get();
    
            if(empty($userCollegeTSGalerie[0]))
            {
                Flash::error('User College T S Galerie not found');
                return redirect(route('userCollegeTSGaleries.index'));
            }
    
            $user = DB::table('college_t_s_galeries')->join('college_topic_sections', 'college_t_s_galeries.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->where('college_t_s_galeries.id', '=', $userCollegeTSGalerie[0] -> college_t_s_galery_id)->get();
    
            $collegeTSGImagesList = DB::table('college_t_s_galery_images')->where('college_t_s_g_id' , '=', $id)->orderBy('id', 'desc')->limit(10)->get();
            $userCollegeTSGaleriesList = DB::table('user_college_t_s_galeries')->join('users', 'user_college_t_s_galeries.user_id', '=', 'users.id')->select('name', 'email', 'user_college_t_s_galeries.description', 'permissions', 'user_college_t_s_galeries.datetime', 'user_college_t_s_galeries.id', 'college_t_s_galery_id')->where('college_t_s_galery_id', $id)->where(function ($query) {$query->where('user_college_t_s_galeries.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
            $collegeTSGaleryViewsList = DB::table('users')->join('college_t_s_galery_views', 'users.id', '=', 'college_t_s_galery_views.user_id')->where('college_t_s_galery_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            $collegeTSGaleryUpdatesList = DB::table('users')->join('college_t_s_galery_updates', 'users.id', '=', 'college_t_s_galery_updates.user_id')->where('college_t_s_galery_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
    
            if($user[0] -> user_id == $user_id)
            {
                return view('user_college_t_s_galeries.edit')
                    ->with('userCollegeTSGalerie', $userCollegeTSGalerie)
                    ->with('id', $userCollegeTSGalerie[0] -> college_t_s_galery_id)
                    ->with('collegeTSGImagesList', $collegeTSGImagesList)
                    ->with('userCollegeTSGaleriesList', $userCollegeTSGaleriesList)
                    ->with('collegeTSGaleryViewsList', $collegeTSGaleryViewsList)
                    ->with('collegeTSGaleryUpdatesList', $collegeTSGaleryUpdatesList);
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

    public function update($id, UpdateUserCollegeTSGalerieRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $userCollegeTSGalerie = $this->userCollegeTSGalerieRepository->findWithoutFail($id);
            $user_id = Auth::user()->id;
    
            if(empty($userCollegeTSGalerie))
            {
                Flash::error('User College T S Galerie not found');
                return redirect(route('userCollegeTSGaleries.index'));
            }
            
            $user = DB::table('college_t_s_galeries')->join('college_topic_sections', 'college_t_s_galeries.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->where('college_t_s_galeries.id', '=', $userCollegeTSGalerie -> college_t_s_galery_id)->get();
    
            if($user[0] -> user_id == $user_id)
            {
                $user_id = $userCollegeTSGalerie -> user_id;
                $userCollegeTSGalerie = $this->userCollegeTSGalerieRepository->update($request->all(), $id);
                $collegeTSGaleryImages = DB::table('college_t_s_galery_images')->where('college_t_s_g_id', '=', $userCollegeTSGalerie -> college_t_s_galery_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                
                DB::table('user_college_t_s_galerie_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_g_id' => $userCollegeTSGalerie -> id]);
    
                foreach($collegeTSGaleryImages as $collegeTSGaleryImage)
                {
                    DB::table('user_college_t_s_galery_images')->where('college_t_s_g_image_id', $collegeTSGaleryImage -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userCollegeTSGalerie -> permissions]);
                                            
                    $userCollegeTSGaleryImage = DB::table('user_college_t_s_galery_images')->where('college_t_s_g_image_id', '=', $collegeTSGaleryImage -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                            
                    if(isset($userCollegeTSGaleryImage[0]))
                    {
                        DB::table('user_college_t_s_galery_image_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_g_i_id' => $userCollegeTSGaleryImage[0] -> id]);
                    }
                }
                
                $user_id = Auth::user()->id;
                $user = DB::table('user_college_t_s_galeries')->join('users', 'users.id', '=', 'user_college_t_s_galeries.user_id')->where('user_college_t_s_galeries.id', '=', $userCollegeTSGalerie -> id)->select('name')->get();
                
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_c_t_s_g_u', 'user_id' => $user_id, 'entity_id' => $userCollegeTSGalerie -> college_t_s_galery_id, 'created_at' => $now]);
            
                Flash::success('User College T S Galerie updated successfully.');
                return redirect(route('userCollegeTSGaleries.show', [$userCollegeTSGalerie -> college_t_s_galery_id]));
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
            $userCollegeTSGalerie = $this->userCollegeTSGalerieRepository->findWithoutFail($id);
    
            if(empty($userCollegeTSGalerie))
            {
                Flash::error('User College T S Galerie not found');
                return redirect(route('userCollegeTSGaleries.index'));
            }
            
            $user = DB::table('college_t_s_galeries')->join('college_topic_sections', 'college_t_s_galeries.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->where('college_t_s_galeries.id', '=', $userCollegeTSGalerie -> college_t_s_galery_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $user_id = $userCollegeTSGalerie -> user_id;
                $collegeTSGaleryImages = DB::table('college_t_s_galery_images')->where('college_t_s_g_id', '=', $userCollegeTSGalerie -> college_t_s_galery_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                
                DB::table('user_college_t_s_galerie_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_g_id' => $userCollegeTSGalerie -> id]);
                       
                foreach($collegeTSGaleryImages as $collegeTSGaleryImage)
                {
                    DB::table('user_college_t_s_galery_images')->where('college_t_s_g_image_id', $collegeTSGaleryImage -> id)->where('user_id', '=', $user_id)->update(['deleted_at' => $now]);
                                            
                    $userCollegeTSGaleryImage = DB::table('user_college_t_s_galery_images')->where('college_t_s_g_image_id', '=', $collegeTSGaleryImage -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                            
                    if(isset($userCollegeTSGaleryImage[0]))
                    {
                        DB::table('user_college_t_s_galery_image_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_c_t_s_g_i_id' => $userCollegeTSGaleryImage[0] -> id]);
                    }
                }
        
                $this->userCollegeTSGalerieRepository->delete($id);
                $user_id = Auth::user()->id;
                $user = DB::table('user_college_t_s_galeries')->join('users', 'users.id', '=', 'user_college_t_s_galeries.user_id')->where('user_college_t_s_galeries.id', '=', $userCollegeTSGalerie -> id)->select('name')->get();
                
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_c_t_s_g_d', 'user_id' => $user_id, 'entity_id' => $userCollegeTSGalerie -> college_t_s_galery_id, 'created_at' => $now]);
            
                Flash::success('User College T S Galerie deleted successfully.');
                return redirect(route('userCollegeTSGaleries.show', [$userCollegeTSGalerie -> college_t_s_galery_id]));
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