<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateSharedProfileNoteCRequest;
use App\Http\Requests\UpdateSharedProfileNoteCRequest;
use App\Repositories\SharedProfileNoteCRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class SharedProfileNoteCController extends AppBaseController
{
    /** @var  SharedProfileNoteCRepository */
    private $sharedProfileNoteCRepository;

    public function __construct(SharedProfileNoteCRepository $sharedProfileNoteCRepo)
    {
        $this->sharedProfileNoteCRepository = $sharedProfileNoteCRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->sharedProfileNoteCRepository->pushCriteria(new RequestCriteria($request));
            $sharedProfileNoteCs = $this->sharedProfileNoteCRepository->all();
    
            return view('shared_profile_note_cs.index')
                ->with('sharedProfileNoteCs', $sharedProfileNoteCs);
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
            return view('shared_profile_note_cs.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateSharedProfileNoteCRequest $request)
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
                $sharedProfileNoteC = $this->sharedProfileNoteCRepository->create($input);
        
                DB::table('recent_activities')->insert(['name' => $sharedProfileNoteC -> status, 'status' => 'active', 'type' => 's_p_n_c_c', 'user_id' => $user_id, 'entity_id' => $sharedProfileNoteC -> id, 'created_at' => $now]);
        
                Flash::success('Shared Profile Note C saved successfully.');
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
            $sharedProfileNoteC = $this->sharedProfileNoteCRepository->findWithoutFail($id);
    
            if(empty($sharedProfileNoteC))
            {
                Flash::error('Shared Profile Note C not found');
                return redirect(route('sharedProfileNoteCs.index'));
            }
            
            if($user_id == $sharedProfileNoteC -> user_id)
            {
                return view('shared_profile_note_cs.show')->with('sharedProfileNoteC', $sharedProfileNoteC);
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
            $sharedProfileNoteC = $this->sharedProfileNoteCRepository->findWithoutFail($id);
    
            if(empty($sharedProfileNoteC))
            {
                Flash::error('Shared Profile Note C not found');
                return redirect(route('sharedProfileNoteCs.index'));
            }
    
            if($user_id == $sharedProfileNoteC -> user_id)
            {
                return view('shared_profile_note_cs.edit')->with('sharedProfileNoteC', $sharedProfileNoteC);
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

    public function update($id, UpdateSharedProfileNoteCRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $sharedProfileNoteC = $this->sharedProfileNoteCRepository->findWithoutFail($id);
    
            if(empty($sharedProfileNoteC))
            {
                Flash::error('Shared Profile Note C not found');
                return redirect(route('sharedProfileNoteCs.index'));
            }
    
            if($user_id == $sharedProfileNoteC -> user_id)
            {
                $sharedProfileNoteC = $this->sharedProfileNoteCRepository->update($request->all(), $id);
                DB::table('recent_activities')->insert(['name' => $sharedProfileNoteC -> status, 'status' => 'active', 'type' => 's_p_n_c_u', 'user_id' => $user_id, 'entity_id' => $sharedProfileNoteC -> id, 'created_at' => $now]);
    
                Flash::success('Shared Profile Note C updated successfully.');
                return redirect(route('sharedProfileNoteCs.index'));
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
            $sharedProfileNoteC = $this->sharedProfileNoteCRepository->findWithoutFail($id);
    
            if(empty($sharedProfileNoteC))
            {
                Flash::error('Shared Profile Note C not found');
                return redirect(route('sharedProfileNoteCs.index'));
            }
    
            if($user_id == $sharedProfileNoteC -> user_id)
            {
                $this->sharedProfileNoteCRepository->delete($id);
                DB::table('recent_activities')->insert(['name' => $sharedProfileNoteC -> status, 'status' => 'active', 'type' => 's_p_n_c_d', 'user_id' => $user_id, 'entity_id' => $sharedProfileNoteC -> id, 'created_at' => $now]);
        
                Flash::success('Shared Profile Note C deleted successfully.');
                return redirect(route('sharedProfileNoteCs.index'));
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