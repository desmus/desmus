<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateSharedProfileFileCResponseRequest;
use App\Http\Requests\UpdateSharedProfileFileCResponseRequest;
use App\Repositories\SharedProfileFileCResponseRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class SharedProfileFileCResponseController extends AppBaseController
{
    /** @var  SharedProfileFileCResponseRepository */
    private $sharedProfileFileCResponseRepository;

    public function __construct(SharedProfileFileCResponseRepository $sharedProfileFileCResponseRepo)
    {
        $this->sharedProfileFileCResponseRepository = $sharedProfileFileCResponseRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->sharedProfileFileCResponseRepository->pushCriteria(new RequestCriteria($request));
            $sharedProfileFileCResponses = $this->sharedProfileFileCResponseRepository->all();
    
            return view('shared_profile_file_c_responses.index')
                ->with('sharedProfileFileCResponses', $sharedProfileFileCResponses);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function create()
    {
        $user_id = Auth::user()->id;
        
        if(Auth::user() != null)
        {
            return view('shared_profile_file_c_responses.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateSharedProfileFileCResponseRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            
            $userSharedProfiles = DB::table('user_shared_profile')->where('shared_user_id', '=', $request -> user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userSharedProfiles as $userSharedProfile)
            {
                if($userSharedProfile -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            if($user_id == $request -> user_id || $isShared)
            {
                $input = $request->all();
                $sharedProfileFileCResponse = $this->sharedProfileFileCResponseRepository->create($input);
                
                DB::table('recent_activities')->insert(['name' => $sharedProfileFileCResponse -> status, 'status' => 'active', 'type' => 's_p_f_c_r_c', 'user_id' => $user_id, 'entity_id' => $sharedProfileFileCResponse -> id, 'created_at' => $now]);
        
                Flash::success('Shared Profile File C Response saved successfully.');
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

    public function show($id)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $sharedProfileFileCResponse = $this->sharedProfileFileCResponseRepository->findWithoutFail($id);
    
            if(empty($sharedProfileFileCResponse))
            {
                Flash::error('Shared Profile File C Response not found');
                return redirect(route('sharedProfileFileCResponses.index'));
            }
    
            if($user_id == $sharedProfileFileCResponse -> user_id)
            {
                return view('shared_profile_file_c_responses.show')->with('sharedProfileFileCResponse', $sharedProfileFileCResponse);
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
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $sharedProfileFileCResponse = $this->sharedProfileFileCResponseRepository->findWithoutFail($id);
    
            if(empty($sharedProfileFileCResponse))
            {
                Flash::error('Shared Profile File C Response not found');
                return redirect(route('sharedProfileFileCResponses.index'));
            }
    
            if($user_id == $sharedProfileFileCResponse -> user_id)
            {
                return view('shared_profile_file_c_responses.edit')->with('sharedProfileFileCResponse', $sharedProfileFileCResponse);
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

    public function update($id, UpdateSharedProfileFileCResponseRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $sharedProfileFileCResponse = $this->sharedProfileFileCResponseRepository->findWithoutFail($id);
    
            if(empty($sharedProfileFileCResponse))
            {
                Flash::error('Shared Profile File C Response not found');
                return redirect(route('sharedProfileFileCResponses.index'));
            }
            
            if($user_id == $sharedProfileFileCResponse -> user_id)
            {
                $sharedProfileFileCResponse = $this->sharedProfileFileCResponseRepository->update($request->all(), $id);
        
                DB::table('recent_activities')->insert(['name' => $sharedProfileFileCResponse -> status, 'status' => 'active', 'type' => 's_p_f_c_r_u', 'user_id' => $user_id, 'entity_id' => $sharedProfileFileCResponse -> id, 'created_at' => $now]);
        
                Flash::success('Shared Profile File C Response updated successfully.');
                return redirect(route('sharedProfileFileCResponses.index'));
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
            $sharedProfileFileCResponse = $this->sharedProfileFileCResponseRepository->findWithoutFail($id);
    
            if(empty($sharedProfileFileCResponse))
            {
                Flash::error('Shared Profile File C Response not found');
                return redirect(route('sharedProfileFileCResponses.index'));
            }
    
            if($user_id == $sharedProfileFileCResponse -> user_id)
            {
                $this->sharedProfileFileCResponseRepository->delete($id);
        
                DB::table('recent_activities')->insert(['name' => $sharedProfileFileCResponse -> status, 'status' => 'active', 'type' => 's_p_f_c_r_d', 'user_id' => $user_id, 'entity_id' => $sharedProfileFileCResponse -> id, 'created_at' => $now]);
        
                Flash::success('Shared Profile File C Response deleted successfully.');
                return redirect(route('sharedProfileFileCResponses.index'));
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