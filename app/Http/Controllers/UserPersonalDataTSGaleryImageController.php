<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateUserPersonalDataTSGaleryImageRequest;
use App\Http\Requests\UpdateUserPersonalDataTSGaleryImageRequest;
use App\Repositories\UserPersonalDataTSGaleryImageRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class UserPersonalDataTSGaleryImageController extends AppBaseController
{
    private $userPersonalDataTSGaleryImageRepository;

    public function __construct(UserPersonalDataTSGaleryImageRepository $userPersonalDataTSGaleryImageRepo)
    {
        $this->userPersonalDataTSGaleryImageRepository = $userPersonalDataTSGaleryImageRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userPersonalDataTSGaleryImageRepository->pushCriteria(new RequestCriteria($request));
            $userPersonalDataTSGaleryImages = $this->userPersonalDataTSGaleryImageRepository->all();
    
            return view('user_personal_data_t_s_galery_images.index')
                ->with('userPersonalDataTSGaleryImages', $userPersonalDataTSGaleryImages);
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
            
            $userPersonalDataTSGImagesList = DB::table('user_personal_data_t_s_galery_images')->join('users', 'user_personal_data_t_s_galery_images.user_id', '=', 'users.id')->select('name', 'email', 'user_personal_data_t_s_galery_images.description', 'permissions', 'user_personal_data_t_s_galery_images.datetime', 'user_personal_data_t_s_galery_images.id', 'p_d_t_s_g_i_id')->where('p_d_t_s_g_i_id', $id)->where(function ($query) {$query->where('user_personal_data_t_s_galery_images.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
            $personalDataTSGaleryImageViewsList = DB::table('users')->join('personal_data_t_s_galery_image_views', 'users.id', '=', 'personal_data_t_s_galery_image_views.user_id')->where('p_d_t_s_g_i_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            $personalDataTSGaleryImageUpdatesList = DB::table('users')->join('personal_data_t_s_galery_image_updates', 'users.id', '=', 'personal_data_t_s_galery_image_updates.user_id')->where('p_d_t_s_g_i_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            
            return view('user_personal_data_t_s_galery_images.create', compact('select'))
                ->with('id', $id)
                ->with('now', $now)
                ->with('userPersonalDataTSGImagesList', $userPersonalDataTSGImagesList)
                ->with('personalDataTSGaleryImageViewsList', $personalDataTSGaleryImageViewsList)
                ->with('personalDataTSGaleryImageUpdatesList', $personalDataTSGaleryImageUpdatesList);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserPersonalDataTSGaleryImageRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $user = DB::table('personal_data_t_s_galery_images')->join('personal_data_t_s_galeries', 'personal_data_t_s_galery_images.personal_data_t_s_g_id', '=', 'personal_data_t_s_galeries.id')->join('personal_data_topic_sections', 'personal_data_t_s_galeries.personal_data_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->where('personal_data_t_s_galery_images.id', '=', $request -> p_d_t_s_g_i_id)->get();
            
            $userPersonalDataTSGaleryImageCheck = DB::table('user_personal_data_t_s_galery_images')->where('user_id', '=', $request -> user_id)->where('p_d_t_s_g_i_id', '=', $request -> p_d_t_s_g_i_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
    
            if($userPersonalDataTSGaleryImageCheck->isEmpty())
            {
                if($user[0] -> user_id == $user_id)
                {
                    $userPersonalDataTSGaleryImage = $this->userPersonalDataTSGaleryImageRepository->create($input);
                    $user = DB::table('user_personal_data_t_s_galery_images')->join('users', 'users.id', '=', 'user_personal_data_t_s_galery_images.user_id')->where('user_personal_data_t_s_galery_images.id', '=', $userPersonalDataTSGaleryImage -> id)->select('name')->get();
                    
                    DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_p_d_t_s_g_i_c', 'user_id' => $user_id, 'entity_id' => $userPersonalDataTSGaleryImage -> p_d_t_s_g_i_id, 'created_at' => $now]);
                    DB::table('user_personal_data_t_s_galery_image_c')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_g_i_id' => $userPersonalDataTSGaleryImage -> id]);
                
                    Flash::success('User PersonalData T S Galery Image saved successfully.');
                    return redirect(route('userPersonalDataTSGaleryImages.show', [$userPersonalDataTSGaleryImage -> p_d_t_s_g_i_id]));
                }
                
                else
                {
                    return view('deniedAccess');
                }
            }
            
            return redirect(route('userPersonalDataTSGaleryImages.show', [$request -> p_d_t_s_g_i_id]));
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
            $userPersonalDataTSGaleryImage = $this->userPersonalDataTSGaleryImageRepository->findWithoutFail($id);
            $userPersonalDataTSGaleryImages = DB::table('user_personal_data_t_s_galery_images')->join('users', 'user_personal_data_t_s_galery_images.user_id', '=', 'users.id')->select('name', 'email', 'user_personal_data_t_s_galery_images.description', 'permissions', 'user_personal_data_t_s_galery_images.datetime', 'user_personal_data_t_s_galery_images.id', 'p_d_t_s_g_i_id')->where('p_d_t_s_g_i_id', $id)->where(function ($query) {$query->where('user_personal_data_t_s_galery_images.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
    
            if (empty($userPersonalDataTSGaleryImages[0]))
            {
                Flash::error('User PersonalData T S Galery Image not found');
                return redirect(route('userPersonalDataTSGaleryImages.create', [$id]));
            }
            
            $user = DB::table('personal_data_t_s_galery_images')->join('personal_data_t_s_galeries', 'personal_data_t_s_galery_images.personal_data_t_s_g_id', '=', 'personal_data_t_s_galeries.id')->join('personal_data_topic_sections', 'personal_data_t_s_galeries.personal_data_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->where('personal_data_t_s_galery_images.id', '=', $userPersonalDataTSGaleryImages[0] -> p_d_t_s_g_i_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $personalDataTSGaleryImage = DB::table('personal_data_t_s_galery_images')->where('id', '=', $userPersonalDataTSGaleryImages[0] -> p_d_t_s_g_i_id)->get();
    
                $userPersonalDataTSGImagesList = DB::table('user_personal_data_t_s_galery_images')->join('users', 'user_personal_data_t_s_galery_images.user_id', '=', 'users.id')->select('name', 'email', 'user_personal_data_t_s_galery_images.description', 'permissions', 'user_personal_data_t_s_galery_images.datetime', 'user_personal_data_t_s_galery_images.id', 'p_d_t_s_g_i_id')->where('p_d_t_s_g_i_id', $id)->where(function ($query) {$query->where('user_personal_data_t_s_galery_images.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $personalDataTSGaleryImageViewsList = DB::table('users')->join('personal_data_t_s_galery_image_views', 'users.id', '=', 'personal_data_t_s_galery_image_views.user_id')->where('p_d_t_s_g_i_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $personalDataTSGaleryImageUpdatesList = DB::table('users')->join('personal_data_t_s_galery_image_updates', 'users.id', '=', 'personal_data_t_s_galery_image_updates.user_id')->where('p_d_t_s_g_i_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
    
                return view('user_personal_data_t_s_galery_images.show')
                    ->with('userPersonalDataTSGaleryImages', $userPersonalDataTSGaleryImages)
                    ->with('id', $id)
                    ->with('personalDataTSGaleryImage', $personalDataTSGaleryImage)
                    ->with('userPersonalDataTSGImagesList', $userPersonalDataTSGImagesList)
                    ->with('personalDataTSGaleryImageViewsList', $personalDataTSGaleryImageViewsList)
                    ->with('personalDataTSGaleryImageUpdatesList', $personalDataTSGaleryImageUpdatesList);
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
            $userPersonalDataTSGaleryImage = DB::table('users')->join('user_personal_data_t_s_galery_images', 'user_personal_data_t_s_galery_images.user_id', '=', 'users.id')->where('user_personal_data_t_s_galery_images.id', $id)->where(function ($query) {$query->where('user_personal_data_t_s_galery_images.deleted_at', '=', null);})->get();
    
            if(empty($userPersonalDataTSGaleryImage))
            {
                Flash::error('User PersonalData T S Galery Image not found');
                return redirect(route('userPersonalDataTSGaleryImages.index'));
            }
    
            $user = DB::table('personal_data_t_s_galery_images')->join('personal_data_t_s_galeries', 'personal_data_t_s_galery_images.personal_data_t_s_g_id', '=', 'personal_data_t_s_galeries.id')->join('personal_data_topic_sections', 'personal_data_t_s_galeries.personal_data_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->where('personal_data_t_s_galery_images.id', '=', $userPersonalDataTSGaleryImage[0] -> p_d_t_s_g_i_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $userPersonalDataTSGImagesList = DB::table('user_personal_data_t_s_galery_images')->join('users', 'user_personal_data_t_s_galery_images.user_id', '=', 'users.id')->select('name', 'email', 'user_personal_data_t_s_galery_images.description', 'permissions', 'user_personal_data_t_s_galery_images.datetime', 'user_personal_data_t_s_galery_images.id', 'p_d_t_s_g_i_id')->where('p_d_t_s_g_i_id', $id)->where(function ($query) {$query->where('user_personal_data_t_s_galery_images.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $personalDataTSGaleryImageViewsList = DB::table('users')->join('personal_data_t_s_galery_image_views', 'users.id', '=', 'personal_data_t_s_galery_image_views.user_id')->where('p_d_t_s_g_i_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $personalDataTSGaleryImageUpdatesList = DB::table('users')->join('personal_data_t_s_galery_image_updates', 'users.id', '=', 'personal_data_t_s_galery_image_updates.user_id')->where('p_d_t_s_g_i_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();

                return view('user_personal_data_t_s_galery_images.edit')
                    ->with('userPersonalDataTSGaleryImage', $userPersonalDataTSGaleryImage)
                    ->with('id', $userPersonalDataTSGaleryImage[0] -> p_d_t_s_g_i_id)
                    ->with('userPersonalDataTSGImagesList', $userPersonalDataTSGImagesList)
                    ->with('personalDataTSGaleryImageViewsList', $personalDataTSGaleryImageViewsList)
                    ->with('personalDataTSGaleryImageUpdatesList', $personalDataTSGaleryImageUpdatesList);
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

    public function update($id, UpdateUserPersonalDataTSGaleryImageRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $userPersonalDataTSGaleryImage = $this->userPersonalDataTSGaleryImageRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSGaleryImage))
            {
                Flash::error('User PersonalData T S Galery Image not found');
                return redirect(route('userPersonalDataTSGaleryImages.index'));
            }
    
            $user = DB::table('personal_data_t_s_galery_images')->join('personal_data_t_s_galeries', 'personal_data_t_s_galery_images.personal_data_t_s_g_id', '=', 'personal_data_t_s_galeries.id')->join('personal_data_topic_sections', 'personal_data_t_s_galeries.personal_data_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->where('personal_data_t_s_galery_images.id', '=', $userPersonalDataTSGaleryImage -> p_d_t_s_g_i_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $userPersonalDataTSGaleryImage = $this->userPersonalDataTSGaleryImageRepository->update($request->all(), $id);
                $user = DB::table('user_personal_data_t_s_galery_images')->join('users', 'users.id', '=', 'user_personal_data_t_s_galery_images.user_id')->where('user_personal_data_t_s_galery_images.id', '=', $userPersonalDataTSGaleryImage -> id)->select('name')->get();
                
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_p_d_t_s_g_i_u', 'user_id' => $user_id, 'entity_id' => $userPersonalDataTSGaleryImage -> p_d_t_s_g_i_id, 'created_at' => $now]);
                DB::table('user_personal_data_t_s_galery_image_u')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_g_i_id' => $userPersonalDataTSGaleryImage -> id]);
            
                Flash::success('User PersonalData T S Galery Image updated successfully.');
                return redirect(route('userPersonalDataTSGaleryImages.show', [$userPersonalDataTSGaleryImage -> p_d_t_s_g_i_id]));
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
            $userPersonalDataTSGaleryImage = $this->userPersonalDataTSGaleryImageRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSGaleryImage))
            {
                Flash::error('User PersonalData T S Galery Image not found');
                return redirect(route('userPersonalDataTSGaleryImages.index'));
            }
    
            $user = DB::table('personal_data_t_s_galery_images')->join('personal_data_t_s_galeries', 'personal_data_t_s_galery_images.personal_data_t_s_g_id', '=', 'personal_data_t_s_galeries.id')->join('personal_data_topic_sections', 'personal_data_t_s_galeries.personal_data_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->where('personal_data_t_s_galery_images.id', '=', $userPersonalDataTSGaleryImage -> p_d_t_s_g_i_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $this->userPersonalDataTSGaleryImageRepository->delete($id);
                $user = DB::table('user_personal_data_t_s_galery_images')->join('users', 'users.id', '=', 'user_personal_data_t_s_galery_images.user_id')->where('user_personal_data_t_s_galery_images.id', '=', $userPersonalDataTSGaleryImage -> id)->select('name')->get();
                
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_p_d_t_s_g_i_d', 'user_id' => $user_id, 'entity_id' => $userPersonalDataTSGaleryImage -> p_d_t_s_g_i_id, 'created_at' => $now]);
                DB::table('user_personal_data_t_s_galery_image_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_g_i_id' => $userPersonalDataTSGaleryImage -> id]);
            
                Flash::success('User PersonalData T S Galery Image deleted successfully.');
                return redirect(route('userPersonalDataTSGaleryImages.show', [$userPersonalDataTSGaleryImage -> p_d_t_s_g_i_id]));
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