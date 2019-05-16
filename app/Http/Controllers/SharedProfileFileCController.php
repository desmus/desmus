<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateSharedProfileFileCRequest;
use App\Http\Requests\UpdateSharedProfileFileCRequest;
use App\Repositories\SharedProfileFileCRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class SharedProfileFileCController extends AppBaseController
{
    /** @var  SharedProfileFileCRepository */
    private $sharedProfileFileCRepository;

    public function __construct(SharedProfileFileCRepository $sharedProfileFileCRepo)
    {
        $this->sharedProfileFileCRepository = $sharedProfileFileCRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->sharedProfileFileCRepository->pushCriteria(new RequestCriteria($request));
            $sharedProfileFileCs = $this->sharedProfileFileCRepository->all();
    
            return view('shared_profile_file_cs.index')
                ->with('sharedProfileFileCs', $sharedProfileFileCs);
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
            return view('shared_profile_file_cs.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateSharedProfileFileCRequest $request)
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
                $sharedProfileFileC = $this->sharedProfileFileCRepository->create($input);
            
                DB::table('recent_activities')->insert(['name' => $sharedProfileFileC -> status, 'status' => 'active', 'type' => 's_p_f_c_c', 'user_id' => $user_id, 'entity_id' => $sharedProfileFileC -> id, 'created_at' => $now]);
    
                Flash::success('Shared Profile File C saved successfully.');
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
            $sharedProfileFileC = $this->sharedProfileFileCRepository->findWithoutFail($id);

            if(empty($sharedProfileFileC))
            {
                Flash::error('Shared Profile File C not found');
                return redirect(route('sharedProfileFileCs.index'));
            }
        
            if($user_id == $sharedProfileFileC -> user_id)
            {
                return view('shared_profile_file_cs.show')->with('sharedProfileFileC', $sharedProfileFileC);
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
            $sharedProfileFileC = $this->sharedProfileFileCRepository->findWithoutFail($id);
    
            if(empty($sharedProfileFileC))
            {
                Flash::error('Shared Profile File C not found');
                return redirect(route('sharedProfileFileCs.index'));
            }
            
            if($user_id == $sharedProfileFileC -> user_id)
            {
                return view('shared_profile_file_cs.edit')->with('sharedProfileFileC', $sharedProfileFileC);
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

    public function update($id, UpdateSharedProfileFileCRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $sharedProfileFileC = $this->sharedProfileFileCRepository->findWithoutFail($id);
    
            if(empty($sharedProfileFileC))
            {
                Flash::error('Shared Profile File C not found');
                return redirect(route('sharedProfileFileCs.index'));
            }
    
            if($user_id == $sharedProfileFileC -> user_id)
            {
                $sharedProfileFileC = $this->sharedProfileFileCRepository->update($request->all(), $id);
            
                DB::table('recent_activities')->insert(['name' => $sharedProfileFileC -> status, 'status' => 'active', 'type' => 's_p_f_c_u', 'user_id' => $user_id, 'entity_id' => $sharedProfileFileC -> id, 'created_at' => $now]);
    
                Flash::success('Shared Profile File C updated successfully.');
                return redirect(route('sharedProfileFileCs.index'));
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
            $sharedProfileFileC = $this->sharedProfileFileCRepository->findWithoutFail($id);
    
            if(empty($sharedProfileFileC)) 
            {
                Flash::error('Shared Profile File C not found');
                return redirect(route('sharedProfileFileCs.index'));
            }
    
            if($user_id == $sharedProfileFileC -> user_id)
            {
                $this->sharedProfileFileCRepository->delete($id);
                
                DB::table('recent_activities')->insert(['name' => $sharedProfileFileC -> status, 'status' => 'active', 'type' => 's_p_f_c_d', 'user_id' => $user_id, 'entity_id' => $sharedProfileFileC -> id, 'created_at' => $now]);
        
                Flash::success('Shared Profile File C deleted successfully.');
                return redirect(route('sharedProfileFileCs.index'));
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