<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserJobTSNoteDRequest;
use App\Http\Requests\UpdateUserJobTSNoteDRequest;
use App\Repositories\UserJobTSNoteDRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserJobTSNoteDController extends AppBaseController
{
    private $userJobTSNoteDRepository;

    public function __construct(UserJobTSNoteDRepository $userJobTSNoteDRepo)
    {
        $this->userJobTSNoteDRepository = $userJobTSNoteDRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userJobTSNoteDRepository->pushCriteria(new RequestCriteria($request));
            $userJobTSNoteDs = $this->userJobTSNoteDRepository->all();
    
            return view('user_job_t_s_note_ds.index')
                ->with('userJobTSNoteDs', $userJobTSNoteDs);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function create()
    {
        if(Auth::user() != null)
        {
            return view('user_job_t_s_note_ds.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserJobTSNoteDRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userJobTSNoteD = $this->userJobTSNoteDRepository->create($input);
            
                Flash::success('User Job T S Note D saved successfully.');
                return redirect(route('userJobTSNoteDs.index'));
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
            $user_id = Auth::user()->id;
            $userJobTSNoteD = $this->userJobTSNoteDRepository->findWithoutFail($id);
    
            if(empty($userJobTSNoteD))
            {
                Flash::error('User Job T S Note D not found');
                return redirect(route('userJobTSNoteDs.index'));
            }
    
            if($userJobTSNoteD -> user_id == $user_id)
            {
                return view('user_job_t_s_note_ds.show')
                    ->with('userJobTSNoteD', $userJobTSNoteD);
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
            $user_id = Auth::user()->id;
            $userJobTSNoteD = $this->userJobTSNoteDRepository->findWithoutFail($id);
    
            if(empty($userJobTSNoteD))
            {
                Flash::error('User Job T S Note D not found');
                return redirect(route('userJobTSNoteDs.index'));
            }
    
            if($userJobTSNoteD -> user_id == $user_id)
            {
                return view('user_job_t_s_note_ds.edit')
                    ->with('userJobTSNoteD', $userJobTSNoteD);
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

    public function update($id, UpdateUserJobTSNoteDRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userJobTSNoteD = $this->userJobTSNoteDRepository->findWithoutFail($id);
    
            if(empty($userJobTSNoteD))
            {
                Flash::error('User Job T S Note D not found');
                return redirect(route('userJobTSNoteDs.index'));
            }
    
            if($userJobTSNoteD -> user_id == $user_id)
            {
                $userJobTSNoteD = $this->userJobTSNoteDRepository->update($request->all(), $id);
            
                Flash::success('User Job T S Note D updated successfully.');
                return redirect(route('userJobTSNoteDs.index'));
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
            $user_id = Auth::user()->id;
            $userJobTSNoteD = $this->userJobTSNoteDRepository->findWithoutFail($id);
    
            if(empty($userJobTSNoteD))
            {
                Flash::error('User Job T S Note D not found');
                return redirect(route('userJobTSNoteDs.index'));
            }
    
            if($userJobTSNoteD -> user_id == $user_id)
            {
                $this->userJobTSNoteDRepository->delete($id);
            
                Flash::success('User Job T S Note D deleted successfully.');
                return redirect(route('userJobTSNoteDs.index'));
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