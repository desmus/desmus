<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateSharedProfileImageCRequest;
use App\Http\Requests\UpdateSharedProfileImageCRequest;
use App\Repositories\SharedProfileImageCRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class SharedProfileImageCController extends AppBaseController
{
    /** @var  SharedProfileImageCRepository */
    private $sharedProfileImageCRepository;

    public function __construct(SharedProfileImageCRepository $sharedProfileImageCRepo)
    {
        $this->sharedProfileImageCRepository = $sharedProfileImageCRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->sharedProfileImageCRepository->pushCriteria(new RequestCriteria($request));
            $sharedProfileImageCs = $this->sharedProfileImageCRepository->all();
    
            return view('shared_profile_image_cs.index')
                ->with('sharedProfileImageCs', $sharedProfileImageCs);
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
            return view('shared_profile_image_cs.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateSharedProfileImageCRequest $request)
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
                $sharedProfileImageC = $this->sharedProfileImageCRepository->create($input);
        
                DB::table('recent_activities')->insert(['name' => $sharedProfileImageC -> status, 'status' => 'active', 'type' => 's_p_i_c_c', 'user_id' => $user_id, 'entity_id' => $sharedProfileImageC -> id, 'created_at' => $now]);
        
                Flash::success('Shared Profile Image C saved successfully.');
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
            $sharedProfileImageC = $this->sharedProfileImageCRepository->findWithoutFail($id);
    
            if(empty($sharedProfileImageC))
            {
                Flash::error('Shared Profile Image C not found');
                return redirect(route('sharedProfileImageCs.index'));
            }
    
            if($user_id == $sharedProfileImageC -> user_id)
            {
                return view('shared_profile_image_cs.show')->with('sharedProfileImageC', $sharedProfileImageC);
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
            $sharedProfileImageC = $this->sharedProfileImageCRepository->findWithoutFail($id);
    
            if(empty($sharedProfileImageC))
            {
                Flash::error('Shared Profile Image C not found');
                return redirect(route('sharedProfileImageCs.index'));
            }
    
            if($user_id == $sharedProfileImageC -> user_id)
            {
                return view('shared_profile_image_cs.edit')->with('sharedProfileImageC', $sharedProfileImageC);
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

    public function update($id, UpdateSharedProfileImageCRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $sharedProfileImageC = $this->sharedProfileImageCRepository->findWithoutFail($id);
    
            if(empty($sharedProfileImageC))
            {
                Flash::error('Shared Profile Image C not found');
                return redirect(route('sharedProfileImageCs.index'));
            }
    
            if($user_id == $sharedProfileImageC -> user_id)
            {
                $sharedProfileImageC = $this->sharedProfileImageCRepository->update($request->all(), $id);
                
                DB::table('recent_activities')->insert(['name' => $sharedProfileImageC -> status, 'status' => 'active', 'type' => 's_p_i_c_u', 'user_id' => $user_id, 'entity_id' => $sharedProfileImageC -> id, 'created_at' => $now]);
        
                Flash::success('Shared Profile Image C updated successfully.');
                return redirect(route('sharedProfileImageCs.index'));
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
            $sharedProfileImageC = $this->sharedProfileImageCRepository->findWithoutFail($id);
    
            if(empty($sharedProfileImageC))
            {
                Flash::error('Shared Profile Image C not found');
                return redirect(route('sharedProfileImageCs.index'));
            }
    
            if($user_id == $sharedProfileImageC -> user_id)
            {
                $this->sharedProfileImageCRepository->delete($id);
    
                DB::table('recent_activities')->insert(['name' => $sharedProfileImageC -> status, 'status' => 'active', 'type' => 's_p_i_c_d', 'user_id' => $user_id, 'entity_id' => $sharedProfileImageC -> id, 'created_at' => $now]);
    
                Flash::success('Shared Profile Image C deleted successfully.');
                return redirect(route('sharedProfileImageCs.index'));
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