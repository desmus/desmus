<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateSharedProfileVideoCRequest;
use App\Http\Requests\UpdateSharedProfileVideoCRequest;
use App\Repositories\SharedProfileVideoCRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class SharedProfileVideoCController extends AppBaseController
{
    /** @var  SharedProfileVideoCRepository */
    private $sharedProfileVideoCRepository;

    public function __construct(SharedProfileVideoCRepository $sharedProfileVideoCRepo)
    {
        $this->sharedProfileVideoCRepository = $sharedProfileVideoCRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->sharedProfileVideoCRepository->pushCriteria(new RequestCriteria($request));
            $sharedProfileVideoCs = $this->sharedProfileVideoCRepository->all();
    
            return view('shared_profile_video_cs.index')
                ->with('sharedProfileVideoCs', $sharedProfileVideoCs);
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
            return view('shared_profile_video_cs.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateSharedProfileVideoCRequest $request)
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
                $sharedProfileVideoC = $this->sharedProfileVideoCRepository->create($input);
        
                DB::table('recent_activities')->insert(['name' => $sharedProfileVideoC -> status, 'status' => 'active', 'type' => 's_p_v_c_c', 'user_id' => $user_id, 'entity_id' => $sharedProfileVideoC -> id, 'created_at' => $now]);
        
                Flash::success('Shared Profile Video C saved successfully.');
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
            $sharedProfileVideoC = $this->sharedProfileVideoCRepository->findWithoutFail($id);
    
            if(empty($sharedProfileVideoC))
            {
                Flash::error('Shared Profile Video C not found');
                return redirect(route('sharedProfileVideoCs.index'));
            }
    
            if($user_id == $sharedProfileVideoC -> user_id)
            {
                return view('shared_profile_video_cs.show')->with('sharedProfileVideoC', $sharedProfileVideoC);
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
            $sharedProfileVideoC = $this->sharedProfileVideoCRepository->findWithoutFail($id);
    
            if(empty($sharedProfileVideoC))
            {
                Flash::error('Shared Profile Video C not found');
                return redirect(route('sharedProfileVideoCs.index'));
            }
    
            if($user_id == $sharedProfileVideoC -> user_id)
            {
                return view('shared_profile_video_cs.edit')->with('sharedProfileVideoC', $sharedProfileVideoC);
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

    public function update($id, UpdateSharedProfileVideoCRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $sharedProfileVideoC = $this->sharedProfileVideoCRepository->findWithoutFail($id);
    
            if (empty($sharedProfileVideoC))
            {
                Flash::error('Shared Profile Video C not found');
                return redirect(route('sharedProfileVideoCs.index'));
            }
    
            if($user_id == $sharedProfileVideoC -> user_id)
            {
                $sharedProfileVideoC = $this->sharedProfileVideoCRepository->update($request->all(), $id);
        
                DB::table('recent_activities')->insert(['name' => $sharedProfileVideoC -> status, 'status' => 'active', 'type' => 's_p_v_c_u', 'user_id' => $user_id, 'entity_id' => $sharedProfileVideoC -> id, 'created_at' => $now]);
        
                Flash::success('Shared Profile Video C updated successfully.');
                return redirect(route('sharedProfileVideoCs.index'));
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
            $sharedProfileVideoC = $this->sharedProfileVideoCRepository->findWithoutFail($id);
    
            if (empty($sharedProfileVideoC))
            {
                Flash::error('Shared Profile Video C not found');
                return redirect(route('sharedProfileVideoCs.index'));
            }
            
            if($user_id == $sharedProfileVideoC -> user_id)
            {
                $this->sharedProfileVideoCRepository->delete($id);
        
                DB::table('recent_activities')->insert(['name' => $sharedProfileVideoC -> status, 'status' => 'active', 'type' => 's_p_v_c_d', 'user_id' => $user_id, 'entity_id' => $sharedProfileVideoC -> id, 'created_at' => $now]);
        
                Flash::success('Shared Profile Video C deleted successfully.');
                return redirect(route('sharedProfileVideoCs.index'));
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