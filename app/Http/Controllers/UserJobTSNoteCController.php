<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserJobTSNoteCRequest;
use App\Http\Requests\UpdateUserJobTSNoteCRequest;
use App\Repositories\UserJobTSNoteCRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserJobTSNoteCController extends AppBaseController
{
    private $userJobTSNoteCRepository;

    public function __construct(UserJobTSNoteCRepository $userJobTSNoteCRepo)
    {
        $this->userJobTSNoteCRepository = $userJobTSNoteCRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userJobTSNoteCRepository->pushCriteria(new RequestCriteria($request));
            $userJobTSNoteCs = $this->userJobTSNoteCRepository->all();
    
            return view('user_job_t_s_note_cs.index')
                ->with('userJobTSNoteCs', $userJobTSNoteCs);
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
            return view('user_job_t_s_note_cs.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserJobTSNoteCRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userJobTSNoteC = $this->userJobTSNoteCRepository->create($input);
            
                Flash::success('User Job T S Note C saved successfully.');
                return redirect(route('userJobTSNoteCs.index'));
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
            $userJobTSNoteC = $this->userJobTSNoteCRepository->findWithoutFail($id);
    
            if(empty($userJobTSNoteC))
            {
                Flash::error('User Job T S Note C not found');
                return redirect(route('userJobTSNoteCs.index'));
            }
    
            if($userJobTSNoteC -> user_id == $user_id)
            {
                return view('user_job_t_s_note_cs.show')
                    ->with('userJobTSNoteC', $userJobTSNoteC);
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
            $userJobTSNoteC = $this->userJobTSNoteCRepository->findWithoutFail($id);
    
            if(empty($userJobTSNoteC))
            {
                Flash::error('User Job T S Note C not found');
                return redirect(route('userJobTSNoteCs.index'));
            }
    
            if($userJobTSNoteC -> user_id == $user_id)
            {
                return view('user_job_t_s_note_cs.edit')
                    ->with('userJobTSNoteC', $userJobTSNoteC);
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

    public function update($id, UpdateUserJobTSNoteCRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userJobTSNoteC = $this->userJobTSNoteCRepository->findWithoutFail($id);
    
            if(empty($userJobTSNoteC))
            {
                Flash::error('User Job T S Note C not found');
                return redirect(route('userJobTSNoteCs.index'));
            }
    
            if($userJobTSNoteC -> user_id == $user_id)
            {
                $userJobTSNoteC = $this->userJobTSNoteCRepository->update($request->all(), $id);
            
                Flash::success('User Job T S Note C updated successfully.');
                return redirect(route('userJobTSNoteCs.index'));
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
            $userJobTSNoteC = $this->userJobTSNoteCRepository->findWithoutFail($id);
    
            if(empty($userJobTSNoteC))
            {
                Flash::error('User Job T S Note C not found');
                return redirect(route('userJobTSNoteCs.index'));
            }
    
            if($userJobTSNoteC -> user_id == $user_id)
            {
                $this->userJobTSNoteCRepository->delete($id);
            
                Flash::success('User Job T S Note C deleted successfully.');
                return redirect(route('userJobTSNoteCs.index'));
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