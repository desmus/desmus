<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateUserPersonalDataTSGalerieRequest;
use App\Http\Requests\UpdateUserPersonalDataTSGalerieRequest;
use App\Repositories\UserPersonalDataTSGalerieRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class UserPersonalDataTSGalerieController extends AppBaseController
{
    private $userPersonalDataTSGalerieRepository;

    public function __construct(UserPersonalDataTSGalerieRepository $userPersonalDataTSGalerieRepo)
    {
        $this->userPersonalDataTSGalerieRepository = $userPersonalDataTSGalerieRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userPersonalDataTSGalerieRepository->pushCriteria(new RequestCriteria($request));
            $userPersonalDataTSGaleries = $this->userPersonalDataTSGalerieRepository->all();
    
            return view('user_personal_data_t_s_galeries.index')
                ->with('userPersonalDataTSGaleries', $userPersonalDataTSGaleries);
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
            
            $personalDataTSGImagesList = DB::table('personal_data_t_s_galery_images')->where('personal_data_t_s_g_id' , '=', $id)->orderBy('id', 'desc')->limit(10)->get();
            $userPersonalDataTSGaleriesList = DB::table('user_personal_data_t_s_galeries')->join('users', 'user_personal_data_t_s_galeries.user_id', '=', 'users.id')->select('name', 'email', 'user_personal_data_t_s_galeries.description', 'permissions', 'user_personal_data_t_s_galeries.datetime', 'user_personal_data_t_s_galeries.id', 'personal_data_t_s_g_id')->where('personal_data_t_s_g_id', $id)->where(function ($query) {$query->where('user_personal_data_t_s_galeries.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
            $personalDataTSGaleryViewsList = DB::table('users')->join('personal_data_t_s_galery_views', 'users.id', '=', 'personal_data_t_s_galery_views.user_id')->where('personal_d_t_s_g_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            $personalDataTSGaleryUpdatesList = DB::table('users')->join('personal_data_t_s_galery_updates', 'users.id', '=', 'personal_data_t_s_galery_updates.user_id')->where('p_d_t_s_g_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            
            return view('user_personal_data_t_s_galeries.create', compact('select'))
                ->with('id', $id)
                ->with('now', $now)
                ->with('personalDataTSGImagesList', $personalDataTSGImagesList)
                ->with('userPersonalDataTSGaleriesList', $userPersonalDataTSGaleriesList)
                ->with('personalDataTSGaleryViewsList', $personalDataTSGaleryViewsList)
                ->with('personalDataTSGaleryUpdatesList', $personalDataTSGaleryUpdatesList);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserPersonalDataTSGalerieRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $user = DB::table('personal_data_t_s_galeries')->join('personal_data_topic_sections', 'personal_data_t_s_galeries.personal_data_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->where('personal_data_t_s_galeries.id', '=', $request -> personal_data_t_s_g_id)->get();
            
            $userPersonalDataTSGaleryCheck = DB::table('user_personal_data_t_s_galeries')->where('user_id', '=', $request -> user_id)->where('personal_data_t_s_g_id', '=', $request -> personal_data_t_s_g_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
    
            if($userPersonalDataTSGaleryCheck->isEmpty())
            {
                if($user[0] -> user_id == $user_id)
                {
                    $userPersonalDataTSGalerie = $this->userPersonalDataTSGalerieRepository->create($input);
                    $personalDataTSGaleryImages = DB::table('personal_data_t_s_galery_images')->where('personal_data_t_s_g_id', '=', $userPersonalDataTSGalerie -> personal_data_t_s_g_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                
                    DB::table('user_personal_data_t_s_galerie_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_g_id' => $userPersonalDataTSGalerie -> id]);
               
                    foreach($personalDataTSGaleryImages as $personalDataTSGaleryImage)
                    {
                        DB::table('user_personal_data_t_s_galery_images')->insert(['datetime' => $now, 'user_id' => $userPersonalDataTSGalerie -> user_id, 'description' => $userPersonalDataTSGalerie -> description, 'p_d_t_s_g_i_id' => $personalDataTSGaleryImage -> id]);
                                                
                        $userPersonalDataTSGaleryImage = DB::table('user_personal_data_t_s_galery_images')->where('p_d_t_s_g_i_id', '=', $personalDataTSGaleryImage -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                                
                        if(isset($userPersonalDataTSGaleryImage[0]))
                        {
                            DB::table('user_personal_data_t_s_galery_image_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_g_i_id' => $userPersonalDataTSGaleryImage[0] -> id]);
                        }
                    }
                    
                    $user = DB::table('user_personal_data_t_s_galeries')->join('users', 'users.id', '=', 'user_personal_data_t_s_galeries.user_id')->where('user_personal_data_t_s_galeries.id', '=', $userPersonalDataTSGalerie -> id)->select('name')->get();
                    
                    DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_p_d_t_s_g_c', 'user_id' => $user_id, 'entity_id' => $userPersonalDataTSGalerie -> personal_data_t_s_g_id, 'created_at' => $now]);
                
                    Flash::success('User PersonalData T S Galerie saved successfully.');
                    return redirect(route('userPersonalDataTSGaleries.show', [$userPersonalDataTSGalerie -> personal_data_t_s_g_id]));
                }
                
                else
                {
                    return view('deniedAccess');
                }
            }
            
            return redirect(route('userPersonalDataTSGaleries.show', [$request -> personal_data_t_s_g_id]));
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
            $userPersonalDataTSGalerie = $this->userPersonalDataTSGalerieRepository->findWithoutFail($id);
            $userPersonalDataTSGaleries = DB::table('user_personal_data_t_s_galeries')->join('users', 'user_personal_data_t_s_galeries.user_id', '=', 'users.id')->select('name', 'email', 'user_personal_data_t_s_galeries.description', 'permissions', 'user_personal_data_t_s_galeries.datetime', 'user_personal_data_t_s_galeries.id', 'personal_data_t_s_g_id')->where('personal_data_t_s_g_id', $id)->where(function ($query) {$query->where('user_personal_data_t_s_galeries.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
    
            if(empty($userPersonalDataTSGaleries[0]))
            {
                Flash::error('User PersonalData T S Galerie not found');
                return redirect(route('userPersonalDataTSGaleries.create', [$id]));
            }
    
            $user = DB::table('personal_data_t_s_galeries')->join('personal_data_topic_sections', 'personal_data_t_s_galeries.personal_data_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->where('personal_data_t_s_galeries.id', '=', $userPersonalDataTSGaleries[0] -> personal_data_t_s_g_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $personalDataTSGalerie = DB::table('personal_data_t_s_galeries')->where('id', '=', $userPersonalDataTSGaleries[0] -> personal_data_t_s_g_id)->get();
    
                $personalDataTSGImagesList = DB::table('personal_data_t_s_galery_images')->where('personal_data_t_s_g_id' , '=', $id)->orderBy('id', 'desc')->limit(10)->get();
                $userPersonalDataTSGaleriesList = DB::table('user_personal_data_t_s_galeries')->join('users', 'user_personal_data_t_s_galeries.user_id', '=', 'users.id')->select('name', 'email', 'user_personal_data_t_s_galeries.description', 'permissions', 'user_personal_data_t_s_galeries.datetime', 'user_personal_data_t_s_galeries.id', 'personal_data_t_s_g_id')->where('personal_data_t_s_g_id', $id)->where(function ($query) {$query->where('user_personal_data_t_s_galeries.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $personalDataTSGaleryViewsList = DB::table('users')->join('personal_data_t_s_galery_views', 'users.id', '=', 'personal_data_t_s_galery_views.user_id')->where('personal_d_t_s_g_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $personalDataTSGaleryUpdatesList = DB::table('users')->join('personal_data_t_s_galery_updates', 'users.id', '=', 'personal_data_t_s_galery_updates.user_id')->where('p_d_t_s_g_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
    
                return view('user_personal_data_t_s_galeries.show')
                    ->with('userPersonalDataTSGaleries', $userPersonalDataTSGaleries)
                    ->with('id', $id)
                    ->with('personalDataTSGalerie', $personalDataTSGalerie)
                    ->with('personalDataTSGImagesList', $personalDataTSGImagesList)
                    ->with('userPersonalDataTSGaleriesList', $userPersonalDataTSGaleriesList)
                    ->with('personalDataTSGaleryViewsList', $personalDataTSGaleryViewsList)
                    ->with('personalDataTSGaleryUpdatesList', $personalDataTSGaleryUpdatesList);
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
            $userPersonalDataTSGalerie = DB::table('users')->join('user_personal_data_t_s_galeries', 'user_personal_data_t_s_galeries.user_id', '=', 'users.id')->where('user_personal_data_t_s_galeries.id', $id)->where(function ($query) {$query->where('user_personal_data_t_s_galeries.deleted_at', '=', null);})->get();
    
            if(empty($userPersonalDataTSGalerie))
            {
                Flash::error('User PersonalData T S Galerie not found');
                return redirect(route('userPersonalDataTSGaleries.index'));
            }
    
            $user = DB::table('personal_data_t_s_galeries')->join('personal_data_topic_sections', 'personal_data_t_s_galeries.personal_data_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->where('personal_data_t_s_galeries.id', '=', $userPersonalDataTSGalerie[0] -> personal_data_t_s_g_id)->get();
    
            $personalDataTSGImagesList = DB::table('personal_data_t_s_galery_images')->where('personal_data_t_s_g_id' , '=', $id)->orderBy('id', 'desc')->limit(10)->get();
            $userPersonalDataTSGaleriesList = DB::table('user_personal_data_t_s_galeries')->join('users', 'user_personal_data_t_s_galeries.user_id', '=', 'users.id')->select('name', 'email', 'user_personal_data_t_s_galeries.description', 'permissions', 'user_personal_data_t_s_galeries.datetime', 'user_personal_data_t_s_galeries.id', 'personal_data_t_s_g_id')->where('personal_data_t_s_g_id', $id)->where(function ($query) {$query->where('user_personal_data_t_s_galeries.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
            $personalDataTSGaleryViewsList = DB::table('users')->join('personal_data_t_s_galery_views', 'users.id', '=', 'personal_data_t_s_galery_views.user_id')->where('personal_d_t_s_g_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            $personalDataTSGaleryUpdatesList = DB::table('users')->join('personal_data_t_s_galery_updates', 'users.id', '=', 'personal_data_t_s_galery_updates.user_id')->where('p_d_t_s_g_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
    
            if($user[0] -> user_id == $user_id)
            {
                return view('user_personal_data_t_s_galeries.edit')
                    ->with('userPersonalDataTSGalerie', $userPersonalDataTSGalerie)
                    ->with('id', $userPersonalDataTSGalerie[0] -> personal_data_t_s_g_id)
                    ->with('personalDataTSGImagesList', $personalDataTSGImagesList)
                    ->with('userPersonalDataTSGaleriesList', $userPersonalDataTSGaleriesList)
                    ->with('personalDataTSGaleryViewsList', $personalDataTSGaleryViewsList)
                    ->with('personalDataTSGaleryUpdatesList', $personalDataTSGaleryUpdatesList);
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

    public function update($id, UpdateUserPersonalDataTSGalerieRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $userPersonalDataTSGalerie = $this->userPersonalDataTSGalerieRepository->findWithoutFail($id);
            $user_id = Auth::user()->id;
    
            if(empty($userPersonalDataTSGalerie))
            {
                Flash::error('User PersonalData T S Galerie not found');
                return redirect(route('userPersonalDataTSGaleries.index'));
            }
    
            $user = DB::table('personal_data_t_s_galeries')->join('personal_data_topic_sections', 'personal_data_t_s_galeries.personal_data_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->where('personal_data_t_s_galeries.id', '=', $userPersonalDataTSGalerie -> personal_data_t_s_g_id)->get();
    
            if($user[0] -> user_id == $user_id)
            {
                $user_id = $userPersonalDataTSGalerie -> user_id;
                $userPersonalDataTSGalerie = $this->userPersonalDataTSGalerieRepository->update($request->all(), $id);
                $personalDataTSGaleryImages = DB::table('personal_data_t_s_galery_images')->where('personal_data_t_s_g_id', '=', $userPersonalDataTSGalerie -> personal_data_t_s_g_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                
                DB::table('user_personal_data_t_s_galerie_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_g_id' => $userPersonalDataTSGalerie -> id]);
          
                foreach($personalDataTSGaleryImages as $personalDataTSGaleryImage)
                {
                    DB::table('user_personal_data_t_s_galery_images')->where('p_d_t_s_g_i_id', $personalDataTSGaleryImage -> id)->where('user_id', '=', $user_id)->update(['permissions' => $userPersonalDataTSGalerie -> permissions]);
                                            
                    $userPersonalDataTSGaleryImage = DB::table('user_personal_data_t_s_galery_images')->where('p_d_t_s_g_i_id', '=', $personalDataTSGaleryImage -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                            
                    if(isset($userPersonalDataTSGaleryImage[0]))
                    {
                        DB::table('user_personal_data_t_s_galery_image_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_g_i_id' => $userPersonalDataTSGaleryImage[0] -> id]);
                    }
                }
                
                $user_id = Auth::user()->id;
                $user = DB::table('user_personal_data_t_s_galeries')->join('users', 'users.id', '=', 'user_personal_data_t_s_galeries.user_id')->where('user_personal_data_t_s_galeries.id', '=', $userPersonalDataTSGalerie -> id)->select('name')->get();
                
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_p_d_t_s_g_u', 'user_id' => $user_id, 'entity_id' => $userPersonalDataTSGalerie -> personal_data_t_s_g_id, 'created_at' => $now]);
            
                Flash::success('User PersonalData T S Galerie updated successfully.');
                return redirect(route('userPersonalDataTSGaleries.show', [$userPersonalDataTSGalerie -> personal_data_t_s_g_id]));
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
            $userPersonalDataTSGalerie = $this->userPersonalDataTSGalerieRepository->findWithoutFail($id);
            $user_id = Auth::user()->id;
    
            if(empty($userPersonalDataTSGalerie))
            {
                Flash::error('User PersonalData T S Galerie not found');
                return redirect(route('userPersonalDataTSGaleries.index'));
            }
            
            $user = DB::table('personal_data_t_s_galeries')->join('personal_data_topic_sections', 'personal_data_t_s_galeries.personal_data_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->where('personal_data_t_s_galeries.id', '=', $userPersonalDataTSGalerie -> personal_data_t_s_g_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $user_id = $userPersonalDataTSGalerie -> user_id;
                $personalDataTSGaleryImages = DB::table('personal_data_t_s_galery_images')->where('personal_data_t_s_g_id', '=', $userPersonalDataTSGalerie -> personal_data_t_s_g_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                
                DB::table('user_personal_data_t_s_galerie_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_g_id' => $userPersonalDataTSGalerie -> id]);
                         
                foreach($personalDataTSGaleryImages as $personalDataTSGaleryImage)
                {
                    DB::table('user_personal_data_t_s_galery_images')->where('p_d_t_s_g_i_id', $personalDataTSGaleryImage -> id)->where('user_id', '=', $user_id)->update(['deleted_at' => $now]);
                                            
                    $userPersonalDataTSGaleryImage = DB::table('user_personal_data_t_s_galery_images')->where('p_d_t_s_g_i_id', '=', $personalDataTSGaleryImage -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                                            
                    if(isset($userPersonalDataTSGaleryImage[0]))
                    {
                        DB::table('user_personal_data_t_s_galery_image_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_g_i_id' => $userPersonalDataTSGaleryImage[0] -> id]);
                    }
                }
        
                $this->userPersonalDataTSGalerieRepository->delete($id);
                $user_id = Auth::user()->id;
                $user = DB::table('user_personal_data_t_s_galeries')->join('users', 'users.id', '=', 'user_personal_data_t_s_galeries.user_id')->where('user_personal_data_t_s_galeries.id', '=', $userPersonalDataTSGalerie -> id)->select('name')->get();
                
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_p_d_t_s_g_d', 'user_id' => $user_id, 'entity_id' => $userPersonalDataTSGalerie -> personal_data_t_s_g_id, 'created_at' => $now]);
            
                Flash::success('User PersonalData T S Galerie deleted successfully.');
                return redirect(route('userPersonalDataTSGaleries.show', [$userPersonalDataTSGalerie -> personal_data_t_s_g_id]));
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