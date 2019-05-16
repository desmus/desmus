<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateSharedProfileAudioCResponseRequest;
use App\Http\Requests\UpdateSharedProfileAudioCResponseRequest;
use App\Repositories\SharedProfileAudioCResponseRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class SharedProfileAudioCResponseController extends AppBaseController
{
    private $sharedProfileAudioCResponseRepository;

    public function __construct(SharedProfileAudioCResponseRepository $sharedProfileAudioCResponseRepo)
    {
        $this->sharedProfileAudioCResponseRepository = $sharedProfileAudioCResponseRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->sharedProfileAudioCResponseRepository->pushCriteria(new RequestCriteria($request));
            $sharedProfileAudioCResponses = $this->sharedProfileAudioCResponseRepository->all();
    
            return view('shared_profile_audio_c_responses.index')
                ->with('sharedProfileAudioCResponses', $sharedProfileAudioCResponses);
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
            return view('shared_profile_audio_c_responses.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateSharedProfileAudioCResponseRequest $request)
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
                $sharedProfileAudioCResponse = $this->sharedProfileAudioCResponseRepository->create($input);
        
                DB::table('recent_activities')->insert(['name' => $sharedProfileAudioCResponse -> status, 'status' => 'active', 'type' => 's_p_a_c_r_c', 'user_id' => $user_id, 'entity_id' => $sharedProfileAudioCResponse -> id, 'created_at' => $now]);
        
                Flash::success('Shared Profile Audio C Response saved successfully.');
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
            $sharedProfileAudioCResponse = $this->sharedProfileAudioCResponseRepository->findWithoutFail($id);
    
            if(empty($sharedProfileAudioCResponse))
            {
                Flash::error('Shared Profile Audio C Response not found');
                return redirect(route('sharedProfileAudioCResponses.index'));
            }
    
            if($user_id == $sharedProfileAudioCResponse -> user_id)
            {
                return view('shared_profile_audio_c_responses.show')->with('sharedProfileAudioCResponse', $sharedProfileAudioCResponse);
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
            $sharedProfileAudioCResponse = $this->sharedProfileAudioCResponseRepository->findWithoutFail($id);
    
            if(empty($sharedProfileAudioCResponse))
            {
                Flash::error('Shared Profile Audio C Response not found');
                return redirect(route('sharedProfileAudioCResponses.index'));
            }
            
            if($user_id == $sharedProfileAudioCResponse -> user_id)
            {
                return view('shared_profile_audio_c_responses.edit')->with('sharedProfileAudioCResponse', $sharedProfileAudioCResponse);
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

    public function update($id, UpdateSharedProfileAudioCResponseRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $sharedProfileAudioCResponse = $this->sharedProfileAudioCResponseRepository->findWithoutFail($id);
    
            if(empty($sharedProfileAudioCResponse))
            {
                Flash::error('Shared Profile Audio C Response not found');
                return redirect(route('sharedProfileAudioCResponses.index'));
            }
    
            if($user_id == $sharedProfileAudioCResponse -> user_id)
            {
                $sharedProfileAudioCResponse = $this->sharedProfileAudioCResponseRepository->update($request->all(), $id);
        
                DB::table('recent_activities')->insert(['name' => $sharedProfileAudioCResponse -> status, 'status' => 'active', 'type' => 's_p_a_c_r_u', 'user_id' => $user_id, 'entity_id' => $sharedProfileAudioCResponse -> id, 'created_at' => $now]);
        
                Flash::success('Shared Profile Audio C Response updated successfully.');
                return redirect(route('sharedProfileAudioCResponses.index'));
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
            $sharedProfileAudioCResponse = $this->sharedProfileAudioCResponseRepository->findWithoutFail($id);
    
            if(empty($sharedProfileAudioCResponse))
            {
                Flash::error('Shared Profile Audio C Response not found');
                return redirect(route('sharedProfileAudioCResponses.index'));
            }
            
            if($user_id == $sharedProfileAudioCResponse -> user_id)
            {
                $this->sharedProfileAudioCResponseRepository->delete($id);
        
                DB::table('recent_activities')->insert(['name' => $sharedProfileAudioCResponse -> status, 'status' => 'active', 'type' => 's_p_a_c_r_d', 'user_id' => $user_id, 'entity_id' => $sharedProfileAudioCResponse -> id, 'created_at' => $now]);
        
                Flash::success('Shared Profile Audio C Response deleted successfully.');
                return redirect(route('sharedProfileAudioCResponses.index'));
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
