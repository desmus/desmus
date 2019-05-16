<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateSharedProfileNoteCResponseRequest;
use App\Http\Requests\UpdateSharedProfileNoteCResponseRequest;
use App\Repositories\SharedProfileNoteCResponseRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class SharedProfileNoteCResponseController extends AppBaseController
{
    /** @var  SharedProfileNoteCResponseRepository */
    private $sharedProfileNoteCResponseRepository;

    public function __construct(SharedProfileNoteCResponseRepository $sharedProfileNoteCResponseRepo)
    {
        $this->sharedProfileNoteCResponseRepository = $sharedProfileNoteCResponseRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->sharedProfileNoteCResponseRepository->pushCriteria(new RequestCriteria($request));
            $sharedProfileNoteCResponses = $this->sharedProfileNoteCResponseRepository->all();
    
            return view('shared_profile_note_c_responses.index')
                ->with('sharedProfileNoteCResponses', $sharedProfileNoteCResponses);
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
            return view('shared_profile_note_c_responses.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateSharedProfileNoteCResponseRequest $request)
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
                $sharedProfileNoteCResponse = $this->sharedProfileNoteCResponseRepository->create($input);
        
                DB::table('recent_activities')->insert(['name' => $sharedProfileNoteCResponse -> status, 'status' => 'active', 'type' => 's_p_n_c_r_c', 'user_id' => $user_id, 'entity_id' => $sharedProfileNoteCResponse -> id, 'created_at' => $now]);
        
                Flash::success('Shared Profile Note C Response saved successfully.');
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
            $sharedProfileNoteCResponse = $this->sharedProfileNoteCResponseRepository->findWithoutFail($id);
    
            if(empty($sharedProfileNoteCResponse))
            {
                Flash::error('Shared Profile Note C Response not found');
                return redirect(route('sharedProfileNoteCResponses.index'));
            }
    
            if($user_id == $sharedProfileNoteCResponse -> user_id)
            {
                return view('shared_profile_note_c_responses.show')->with('sharedProfileNoteCResponse', $sharedProfileNoteCResponse);
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
            $sharedProfileNoteCResponse = $this->sharedProfileNoteCResponseRepository->findWithoutFail($id);
    
            if (empty($sharedProfileNoteCResponse))
            {
                Flash::error('Shared Profile Note C Response not found');
                return redirect(route('sharedProfileNoteCResponses.index'));
            }
    
            if($user_id == $sharedProfileNoteCResponse -> user_id)
            {
                return view('shared_profile_note_c_responses.edit')->with('sharedProfileNoteCResponse', $sharedProfileNoteCResponse);
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

    public function update($id, UpdateSharedProfileNoteCResponseRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $sharedProfileNoteCResponse = $this->sharedProfileNoteCResponseRepository->findWithoutFail($id);
    
            if (empty($sharedProfileNoteCResponse))
            {
                Flash::error('Shared Profile Note C Response not found');
                return redirect(route('sharedProfileNoteCResponses.index'));
            }
    
            if($user_id == $sharedProfileNoteCResponse -> user_id)
            {
                $sharedProfileNoteCResponse = $this->sharedProfileNoteCResponseRepository->update($request->all(), $id);
    
                DB::table('recent_activities')->insert(['name' => $sharedProfileNoteCResponse -> status, 'status' => 'active', 'type' => 's_p_n_c_r_u', 'user_id' => $user_id, 'entity_id' => $sharedProfileNoteCResponse -> id, 'created_at' => $now]);
        
                Flash::success('Shared Profile Note C Response updated successfully.');
                return redirect(route('sharedProfileNoteCResponses.index'));
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
            $sharedProfileNoteCResponse = $this->sharedProfileNoteCResponseRepository->findWithoutFail($id);
    
            if(empty($sharedProfileNoteCResponse))
            {
                Flash::error('Shared Profile Note C Response not found');
                return redirect(route('sharedProfileNoteCResponses.index'));
            }
    
            if($user_id == $sharedProfileNoteCResponse -> user_id)
            {
                $this->sharedProfileNoteCResponseRepository->delete($id);
        
                DB::table('recent_activities')->insert(['name' => $sharedProfileNoteCResponse -> status, 'status' => 'active', 'type' => 's_p_n_c_r_d', 'user_id' => $user_id, 'entity_id' => $sharedProfileNoteCResponse -> id, 'created_at' => $now]);
        
                Flash::success('Shared Profile Note C Response deleted successfully.');
                return redirect(route('sharedProfileNoteCResponses.index'));
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
