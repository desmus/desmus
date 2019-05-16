<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateSharedProfileVideoCResponseRequest;
use App\Http\Requests\UpdateSharedProfileVideoCResponseRequest;
use App\Repositories\SharedProfileVideoCResponseRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class SharedProfileVideoCResponseController extends AppBaseController
{
    /** @var  SharedProfileVideoCResponseRepository */
    private $sharedProfileVideoCResponseRepository;

    public function __construct(SharedProfileVideoCResponseRepository $sharedProfileVideoCResponseRepo)
    {
        $this->sharedProfileVideoCResponseRepository = $sharedProfileVideoCResponseRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->sharedProfileVideoCResponseRepository->pushCriteria(new RequestCriteria($request));
            $sharedProfileVideoCResponses = $this->sharedProfileVideoCResponseRepository->all();
    
            return view('shared_profile_video_c_responses.index')
                ->with('sharedProfileVideoCResponses', $sharedProfileVideoCResponses);
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
            return view('shared_profile_video_c_responses.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateSharedProfileVideoCResponseRequest $request)
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
                $sharedProfileVideoCResponse = $this->sharedProfileVideoCResponseRepository->create($input);
                
                DB::table('recent_activities')->insert(['name' => $sharedProfileVideoCResponse -> status, 'status' => 'active', 'type' => 's_p_v_c_r_c', 'user_id' => $user_id, 'entity_id' => $sharedProfileVideoCResponse -> id, 'created_at' => $now]);
        
                Flash::success('Shared Profile Video C Response saved successfully.');
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
            $sharedProfileVideoCResponse = $this->sharedProfileVideoCResponseRepository->findWithoutFail($id);
    
            if(empty($sharedProfileVideoCResponse))
            {
                Flash::error('Shared Profile Video C Response not found');
                return redirect(route('sharedProfileVideoCResponses.index'));
            }
    
            if($user_id == $sharedProfileVideoCResponse -> user_id)
            {
                return view('shared_profile_video_c_responses.show')->with('sharedProfileVideoCResponse', $sharedProfileVideoCResponse);
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
            $sharedProfileVideoCResponse = $this->sharedProfileVideoCResponseRepository->findWithoutFail($id);
    
            if(empty($sharedProfileVideoCResponse))
            {
                Flash::error('Shared Profile Video C Response not found');
                return redirect(route('sharedProfileVideoCResponses.index'));
            }
    
            if($user_id == $sharedProfileVideoCResponse -> user_id)
            {
                return view('shared_profile_video_c_responses.edit')->with('sharedProfileVideoCResponse', $sharedProfileVideoCResponse);
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

    public function update($id, UpdateSharedProfileVideoCResponseRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $sharedProfileVideoCResponse = $this->sharedProfileVideoCResponseRepository->findWithoutFail($id);
    
            if(empty($sharedProfileVideoCResponse))
            {
                Flash::error('Shared Profile Video C Response not found');
                return redirect(route('sharedProfileVideoCResponses.index'));
            }
    
            if($user_id == $sharedProfileVideoCResponse -> user_id)
            {
                $sharedProfileVideoCResponse = $this->sharedProfileVideoCResponseRepository->update($request->all(), $id);
        
                DB::table('recent_activities')->insert(['name' => $sharedProfileVideoCResponse -> status, 'status' => 'active', 'type' => 's_p_v_c_r_u', 'user_id' => $user_id, 'entity_id' => $sharedProfileVideoCResponse -> id, 'created_at' => $now]);
        
                Flash::success('Shared Profile Video C Response updated successfully.');
                return redirect(route('sharedProfileVideoCResponses.index'));
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
            $sharedProfileVideoCResponse = $this->sharedProfileVideoCResponseRepository->findWithoutFail($id);
    
            if(empty($sharedProfileVideoCResponse))
            {
                Flash::error('Shared Profile Video C Response not found');
                return redirect(route('sharedProfileVideoCResponses.index'));
            }
    
            if($user_id == $sharedProfileVideoCResponse -> user_id)
            {
                $this->sharedProfileVideoCResponseRepository->delete($id);
        
                DB::table('recent_activities')->insert(['name' => $sharedProfileVideoCResponse -> status, 'status' => 'active', 'type' => 's_p_v_c_r_d', 'user_id' => $user_id, 'entity_id' => $sharedProfileVideoCResponse -> id, 'created_at' => $now]);
        
                Flash::success('Shared Profile Video C Response deleted successfully.');
                return redirect(route('sharedProfileVideoCResponses.index'));
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