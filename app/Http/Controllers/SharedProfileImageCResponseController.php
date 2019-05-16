<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateSharedProfileImageCResponseRequest;
use App\Http\Requests\UpdateSharedProfileImageCResponseRequest;
use App\Repositories\SharedProfileImageCResponseRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class SharedProfileImageCResponseController extends AppBaseController
{
    /** @var  SharedProfileImageCResponseRepository */
    private $sharedProfileImageCResponseRepository;

    public function __construct(SharedProfileImageCResponseRepository $sharedProfileImageCResponseRepo)
    {
        $this->sharedProfileImageCResponseRepository = $sharedProfileImageCResponseRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->sharedProfileImageCResponseRepository->pushCriteria(new RequestCriteria($request));
            $sharedProfileImageCResponses = $this->sharedProfileImageCResponseRepository->all();
    
            return view('shared_profile_image_c_responses.index')
                ->with('sharedProfileImageCResponses', $sharedProfileImageCResponses);
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
            return view('shared_profile_image_c_responses.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateSharedProfileImageCResponseRequest $request)
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
                $sharedProfileImageCResponse = $this->sharedProfileImageCResponseRepository->create($input);
        
                DB::table('recent_activities')->insert(['name' => $sharedProfileImageCResponse -> status, 'status' => 'active', 'type' => 's_p_i_c_r_c', 'user_id' => $user_id, 'entity_id' => $sharedProfileImageCResponse -> id, 'created_at' => $now]);
        
                Flash::success('Shared Profile Image C Response saved successfully.');
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
            $sharedProfileImageCResponse = $this->sharedProfileImageCResponseRepository->findWithoutFail($id);
    
            if(empty($sharedProfileImageCResponse))
            {
                Flash::error('Shared Profile Image C Response not found');
                return redirect(route('sharedProfileImageCResponses.index'));
            }
    
            if($user_id == $sharedProfileImageCResponse -> user_id)
            {
                return view('shared_profile_image_c_responses.show')->with('sharedProfileImageCResponse', $sharedProfileImageCResponse);
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
            $sharedProfileImageCResponse = $this->sharedProfileImageCResponseRepository->findWithoutFail($id);
    
            if(empty($sharedProfileImageCResponse))
            {
                Flash::error('Shared Profile Image C Response not found');
                return redirect(route('sharedProfileImageCResponses.index'));
            }
    
            if($user_id == $sharedProfileImageCResponse -> user_id)
            {
                return view('shared_profile_image_c_responses.edit')->with('sharedProfileImageCResponse', $sharedProfileImageCResponse);
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

    public function update($id, UpdateSharedProfileImageCResponseRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $sharedProfileImageCResponse = $this->sharedProfileImageCResponseRepository->findWithoutFail($id);
    
            if(empty($sharedProfileImageCResponse))
            {
                Flash::error('Shared Profile Image C Response not found');
                return redirect(route('sharedProfileImageCResponses.index'));
            }
    
            if($user_id == $sharedProfileImageCResponse -> user_id)
            {
                $sharedProfileImageCResponse = $this->sharedProfileImageCResponseRepository->update($request->all(), $id);
        
                DB::table('recent_activities')->insert(['name' => $sharedProfileImageCResponse -> status, 'status' => 'active', 'type' => 's_p_i_c_r_u', 'user_id' => $user_id, 'entity_id' => $sharedProfileImageCResponse -> id, 'created_at' => $now]);
        
                Flash::success('Shared Profile Image C Response updated successfully.');
                return redirect(route('sharedProfileImageCResponses.index'));
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
            $sharedProfileImageCResponse = $this->sharedProfileImageCResponseRepository->findWithoutFail($id);
    
            if(empty($sharedProfileImageCResponse))
            {
                Flash::error('Shared Profile Image C Response not found');
                return redirect(route('sharedProfileImageCResponses.index'));
            }
    
            if($user_id == $sharedProfileImageCResponse -> user_id)
            {
                $this->sharedProfileImageCResponseRepository->delete($id);
        
                DB::table('recent_activities')->insert(['name' => $sharedProfileImageCResponse -> status, 'status' => 'active', 'type' => 's_p_i_c_r_d', 'user_id' => $user_id, 'entity_id' => $sharedProfileImageCResponse -> id, 'created_at' => $now]);
        
                Flash::success('Shared Profile Image C Response deleted successfully.');
                return redirect(route('sharedProfileImageCResponses.index'));
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