<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateUserSharedProfileRequest;
use App\Http\Requests\UpdateUserSharedProfileRequest;
use App\Repositories\UserSharedProfileRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use App\Models\SharedProfileTopic;
use Illuminate\Support\Carbon;

class UserSharedProfileController extends AppBaseController
{
    private $userSharedProfileRepository;

    public function __construct(UserSharedProfileRepository $userSharedProfileRepo)
    {
        $this->userSharedProfileRepository = $userSharedProfileRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userSharedProfileRepository->pushCriteria(new RequestCriteria($request));
            $userSharedProfiles = $this->userSharedProfileRepository->all();
    
            return view('user_shared_profile.index')
                ->with('userSharedProfiles', $userSharedProfiles);
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
            
            $userSharedProfilesList = DB::table('user_shared_profile')->join('users', 'user_shared_profile.user_id', '=', 'users.id')->select('name', 'email', 'user_shared_profile.description', 'permissions', 'user_shared_profile.datetime', 'user_shared_profile.id', 'shared_user_id', 'users.id as user_id')->where('shared_user_id', $id)->where(function ($query) {$query->where('user_shared_profile.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
            $userSharedProfileUpdatesList = DB::table('users')->join('user_shared_profile_updates', 'users.id', '=', 'user_shared_profile_updates.user_id')->where('user_shared_profile_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                
            foreach($users as $user)
            {
                $select[$user->id] = $user->name;
            }
            
            return view('user_shared_profiles.create', compact('select'))
                ->with('id', $id)
                ->with('now', $now)
                ->with('userSharedProfilesList', $userSharedProfilesList)
                ->with('userSharedProfileUpdatesList', $userSharedProfileUpdatesList);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserSharedProfileRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            $userSharedProfileCheck = DB::table('user_shared_profile')->where('user_id', '=', $request -> user_id)->where('shared_user_id', '=', $request -> shared_user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
    
            if($userSharedProfileCheck->isEmpty())
            {
                if($request -> user_id == $user_id)
                {
                    $userSharedProfile = $this->userSharedProfileRepository->create($input);
                    
                    DB::table('user_shared_profile_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_shared_profile_id' => $userSharedProfile -> id]);
                    
                    $user = DB::table('user_shared_profile')->join('users', 'users.id', '=', 'user_shared_profile.user_id')->where('user_shared_profile.id', '=', $userSharedProfile -> id)->select('name')->get();
                    
                    DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_s_p_c', 'user_id' => $user_id, 'entity_id' => $userSharedProfile -> shared_user_id, 'created_at' => $now]);
                
                    Flash::success('User Shared Profile saved successfully.');
                    return redirect(route('userSharedProfiles.show', [$userSharedProfile -> user_id]));
                }
                
                else
                {
                    return view('deniedAccess');
                }
            }

            return redirect(route('userSharedProfiles.show', [$request -> suser_id]));
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
            $userSharedProfile = $this->userSharedProfileRepository->findWithoutFail($id);
            $userSharedProfiles = DB::table('user_shared_profile')->join('users', 'user_shared_profile.shared_user_id', '=', 'users.id')->select('name', 'email', 'user_shared_profile.description', 'permissions', 'user_shared_profile.datetime', 'user_shared_profile.id', 'shared_user_id', 'users.id as user_id')->where('user_id', $id)->where(function ($query) {$query->where('user_shared_profile.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
            
            //Delete de $user variable
            
            $user = DB::table('user_shared_profile')->where('user_id', '=', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            
            if($id == $user_id)
            {
                if(empty($userSharedProfiles[0]))
                {
                    Flash::error('User Shared Profile not found');
                    return redirect(route('userSharedProfiles.create', [$id]));
                }
                
                //$userSharedProfile = DB::table('userSharedProfiles')->where('id', '=', $userSharedProfiles[0] -> shared_user_id)->get();
                    
                $userSharedProfilesList = DB::table('user_shared_profile')->join('users', 'user_shared_profile.shared_user_id', '=', 'users.id')->select('name', 'email', 'user_shared_profile.description', 'permissions', 'user_shared_profile.datetime', 'user_shared_profile.id', 'shared_user_id', 'users.id as user_id')->where('shared_user_id', $id)->where(function ($query) {$query->where('user_shared_profile.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $userSharedProfileUpdatesList = DB::table('users')->join('user_shared_profile_updates', 'users.id', '=', 'user_shared_profile_updates.user_id')->where('user_shared_profile_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            
                return view('user_shared_profiles.show')
                    ->with('userSharedProfiles', $userSharedProfiles)
                    ->with('id', $id)
                    ->with('userSharedProfile', $userSharedProfile)
                    ->with('userSharedProfilesList', $userSharedProfilesList)
                    ->with('userSharedProfileUpdatesList', $userSharedProfileUpdatesList);
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
            $userSharedProfile = DB::table('users')->join('user_shared_profile', 'user_shared_profile.user_id', '=', 'users.id')->where('user_shared_profile.id', $id)->where(function ($query) {$query->where('user_shared_profile.deleted_at', '=', null);})->get();
    
            if(empty($userSharedProfile[0]))
            {
                Flash::error('User Shared Profile not found');
                return redirect(route('userSharedProfiles.index'));
            }
            
            $user = DB::table('user_shared_profile')->where('id', '=', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            
            //Reduce code as show function.
            
            if(isset($user[0]))
            {
                if($user[0] -> user_id == $user_id)
                {
                    $userSharedProfilesList = DB::table('user_shared_profile')->join('users', 'user_shared_profile.user_id', '=', 'users.id')->select('name', 'email', 'user_shared_profile.description', 'permissions', 'user_shared_profile.datetime', 'user_shared_profile.id', 'shared_user_id', 'users.id as user_id')->where('shared_user_id', $id)->where(function ($query) {$query->where('user_shared_profile.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                    $userSharedProfileUpdatesList = DB::table('users')->join('user_shared_profile_updates', 'users.id', '=', 'user_shared_profile_updates.user_id')->where('user_shared_profile_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
    
                    return view('user_shared_profiles.edit')
                        ->with('userSharedProfile', $userSharedProfile)
                        ->with('id', $userSharedProfile[0] -> shared_user_id)
                        ->with('userSharedProfilesList', $userSharedProfilesList)
                        ->with('userSharedProfileUpdatesList', $userSharedProfileUpdatesList);
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
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function update($id, UpdateUserSharedProfileRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $userSharedProfile = $this->userSharedProfileRepository->findWithoutFail($id);
            $user_id = Auth::user()->id;
    
            if(empty($userSharedProfile))
            {
                Flash::error('User Shared Profile not found');
                return redirect(route('userSharedProfiles.index'));
            }
            
            $user = DB::table('user_shared_profile')->where('user_id', '=', $userSharedProfile -> user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
    
            //Reduce code as show function.
    
            if(isset($user[0]))
            {
                if($user[0] -> user_id == $user_id)
                {
                    $user_id = $userSharedProfile -> user_id;
                    $userSharedProfile = $this->userSharedProfileRepository->update($request->all(), $id);
                    
                    DB::table('user_shared_profile_updates')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_shared_profile_id' => $userSharedProfile -> id]);
                    
                    $user_id = Auth::user()->id;
                    $user = DB::table('user_shared_profile')->join('users', 'users.id', '=', 'user_shared_profile.user_id')->where('user_shared_profile.id', '=', $userSharedProfile -> id)->select('name')->get();
                    
                    DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_s_p_u', 'user_id' => $user_id, 'entity_id' => $userSharedProfile -> shared_user_id, 'created_at' => $now]);
                
                    Flash::success('User Shared Profile updated successfully.');
                    return redirect(route('userSharedProfiles.show', [$userSharedProfile -> user_id]));
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
            $userSharedProfile = $this->userSharedProfileRepository->findWithoutFail($id);
            $user_id = Auth::user()->id;
    
            if(empty($userSharedProfile))
            {
                Flash::error('User Shared Profile not found');
                return redirect(route('userSharedProfiles.index'));
            }
            
            $user = DB::table('user_shared_profile')->where('user_id', '=', $userSharedProfile -> user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            
            //Reduce code as show function.
            
            if(isset($user[0]))
            {
                if($user[0] -> user_id == $user_id)
                {
                    $user_id = $userSharedProfile -> user_id;
            
                    DB::table('user_shared_profile_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'user_shared_profile_id' => $userSharedProfile -> id]);
            
                    $this->userSharedProfileRepository->delete($id);
                    $user_id = Auth::user()->id;
                    $user = DB::table('user_shared_profile')->join('users', 'users.id', '=', 'user_shared_profile.user_id')->where('user_shared_profile.id', '=', $userSharedProfile -> id)->select('name')->get();
                    
                    DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_s_p_d', 'user_id' => $user_id, 'entity_id' => $userSharedProfile -> shared_user_id, 'created_at' => $now]);
                
                    Flash::success('User Shared Profile deleted successfully.');
                    return redirect(route('userSharedProfiles.show', [$userSharedProfile -> user_id]));
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
        
        else
        {
            return view('deniedAccess');
        }
    }
}