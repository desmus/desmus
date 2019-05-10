<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserJobTSNoteURequest;
use App\Http\Requests\UpdateUserJobTSNoteURequest;
use App\Repositories\UserJobTSNoteURepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserJobTSNoteUController extends AppBaseController
{
    private $userJobTSNoteURepository;

    public function __construct(UserJobTSNoteURepository $userJobTSNoteURepo)
    {
        $this->userJobTSNoteURepository = $userJobTSNoteURepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userJobTSNoteURepository->pushCriteria(new RequestCriteria($request));
            $userJobTSNoteUs = $this->userJobTSNoteURepository->all();
    
            return view('user_job_t_s_note_us.index')
                ->with('userJobTSNoteUs', $userJobTSNoteUs);
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
            return view('user_job_t_s_note_us.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserJobTSNoteURequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userJobTSNoteU = $this->userJobTSNoteURepository->create($input);
            
                Flash::success('User Job T S Note U saved successfully.');
                return redirect(route('userJobTSNoteUs.index'));
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
            $userJobTSNoteU = $this->userJobTSNoteURepository->findWithoutFail($id);
    
            if(empty($userJobTSNoteU))
            {
                Flash::error('User Job T S Note U not found');
                return redirect(route('userJobTSNoteUs.index'));
            }
    
            if($userJobTSNoteU -> user_id == $user_id)
            {
                return view('user_job_t_s_note_us.show')
                    ->with('userJobTSNoteU', $userJobTSNoteU);
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
            $userJobTSNoteU = $this->userJobTSNoteURepository->findWithoutFail($id);
    
            if(empty($userJobTSNoteU))
            {
                Flash::error('User Job T S Note U not found');
                return redirect(route('userJobTSNoteUs.index'));
            }
    
            if($userJobTSNoteU -> user_id == $user_id)
            {
                return view('user_job_t_s_note_us.edit')
                    ->with('userJobTSNoteU', $userJobTSNoteU);
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

    public function update($id, UpdateUserJobTSNoteURequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userJobTSNoteU = $this->userJobTSNoteURepository->findWithoutFail($id);
    
            if(empty($userJobTSNoteU))
            {
                Flash::error('User Job T S Note U not found');
                return redirect(route('userJobTSNoteUs.index'));
            }
    
            if($userJobTSNoteU -> user_id == $user_id)
            {
                $userJobTSNoteU = $this->userJobTSNoteURepository->update($request->all(), $id);
            
                Flash::success('User Job T S Note U updated successfully.');
                return redirect(route('userJobTSNoteUs.index'));
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
            $userJobTSNoteU = $this->userJobTSNoteURepository->findWithoutFail($id);
    
            if(empty($userJobTSNoteU))
            {
                Flash::error('User Job T S Note U not found');
                return redirect(route('userJobTSNoteUs.index'));
            }
    
            if($userJobTSNoteU -> user_id == $user_id)
            {
                $this->userJobTSNoteURepository->delete($id);
            
                Flash::success('User Job T S Note U deleted successfully.');
                return redirect(route('userJobTSNoteUs.index'));
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