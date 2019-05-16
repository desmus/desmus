<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateSharedProfileAudioCRequest;
use App\Http\Requests\UpdateSharedProfileAudioCRequest;
use App\Repositories\SharedProfileAudioCRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class SharedProfileAudioCController extends AppBaseController
{
    private $sharedProfileAudioCRepository;

    public function __construct(SharedProfileAudioCRepository $sharedProfileAudioCRepo)
    {
        $this->sharedProfileAudioCRepository = $sharedProfileAudioCRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->sharedProfileAudioCRepository->pushCriteria(new RequestCriteria($request));
            $sharedProfileAudioCs = $this->sharedProfileAudioCRepository->all();
    
            return view('shared_profile_audio_cs.index')
                ->with('sharedProfileAudioCs', $sharedProfileAudioCs);
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
            return view('shared_profile_audio_cs.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateSharedProfileAudioCRequest $request)
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
                $sharedProfileAudioC = $this->sharedProfileAudioCRepository->create($input);
                
                DB::table('recent_activities')->insert(['name' => $sharedProfileAudioC -> status, 'status' => 'active', 'type' => 's_p_a_c_c', 'user_id' => $user_id, 'entity_id' => $sharedProfileAudioC -> id, 'created_at' => $now]);
        
                Flash::success('Shared Profile Audio C saved successfully.');
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
            $sharedProfileAudioC = $this->sharedProfileAudioCRepository->findWithoutFail($id);
    
            if(empty($sharedProfileAudioC))
            {
                Flash::error('Shared Profile Audio C not found');
                return redirect(route('sharedProfileAudioCs.index'));
            }
    
            if($user_id == $sharedProfileAudioC -> user_id)
            {
                return view('shared_profile_audio_cs.show')->with('sharedProfileAudioC', $sharedProfileAudioC);
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
            $sharedProfileAudioC = $this->sharedProfileAudioCRepository->findWithoutFail($id);
    
            if(empty($sharedProfileAudioC))
            {
                Flash::error('Shared Profile Audio C not found');
                return redirect(route('sharedProfileAudioCs.index'));
            }
    
            if($user_id == $sharedProfileAudioC -> user_id)
            {
                return view('shared_profile_audio_cs.edit')->with('sharedProfileAudioC', $sharedProfileAudioC);
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

    public function update($id, UpdateSharedProfileAudioCRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $sharedProfileAudioC = $this->sharedProfileAudioCRepository->findWithoutFail($id);
    
            if(empty($sharedProfileAudioC)) 
            {
                Flash::error('Shared Profile Audio C not found');
                return redirect(route('sharedProfileAudioCs.index'));
            }
    
            if($user_id == $sharedProfileAudioC -> user_id)
            {
                $sharedProfileAudioC = $this->sharedProfileAudioCRepository->update($request->all(), $id);
        
                DB::table('recent_activities')->insert(['name' => $sharedProfileAudioC -> status, 'status' => 'active', 'type' => 's_p_a_c_u', 'user_id' => $user_id, 'entity_id' => $sharedProfileAudioC -> id, 'created_at' => $now]);
        
                Flash::success('Shared Profile Audio C updated successfully.');
                return redirect(route('sharedProfileAudioCs.index'));
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
            $sharedProfileAudioC = $this->sharedProfileAudioCRepository->findWithoutFail($id);
    
            if(empty($sharedProfileAudioC))
            {
                Flash::error('Shared Profile Audio C not found');
                return redirect(route('sharedProfileAudioCs.index'));
            }
    
            if($user_id == $sharedProfileAudioC -> user_id)
            {
                $this->sharedProfileAudioCRepository->delete($id);
                
                DB::table('recent_activities')->insert(['name' => $sharedProfileAudioC -> status, 'status' => 'active', 'type' => 's_p_a_c_d', 'user_id' => $user_id, 'entity_id' => $sharedProfileAudioC -> id, 'created_at' => $now]);
        
                Flash::success('Shared Profile Audio C deleted successfully.');
                return redirect(route('sharedProfileAudioCs.index'));
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