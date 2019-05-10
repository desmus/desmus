<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserCollegeTSNoteURequest;
use App\Http\Requests\UpdateUserCollegeTSNoteURequest;
use App\Repositories\UserCollegeTSNoteURepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserCollegeTSNoteUController extends AppBaseController
{
    private $userCollegeTSNoteURepository;

    public function __construct(UserCollegeTSNoteURepository $userCollegeTSNoteURepo)
    {
        $this->userCollegeTSNoteURepository = $userCollegeTSNoteURepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userCollegeTSNoteURepository->pushCriteria(new RequestCriteria($request));
            $userCollegeTSNoteUs = $this->userCollegeTSNoteURepository->all();
    
            return view('user_college_t_s_note_us.index')
                ->with('userCollegeTSNoteUs', $userCollegeTSNoteUs);
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
            return view('user_college_t_s_note_us.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserCollegeTSNoteURequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userCollegeTSNoteU = $this->userCollegeTSNoteURepository->create($input);
            
                Flash::success('User College T S Note U saved successfully.');
                return redirect(route('userCollegeTSNoteUs.index'));
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
            $userCollegeTSNoteU = $this->userCollegeTSNoteURepository->findWithoutFail($id);
    
            if(empty($userCollegeTSNoteU))
            {
                Flash::error('User College T S Note U not found');
                return redirect(route('userCollegeTSNoteUs.index'));
            }
            
            if($userCollegeTSNoteU -> user_id == $user_id)
            {
                return view('user_college_t_s_note_us.show')
                    ->with('userCollegeTSNoteU', $userCollegeTSNoteU);
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
            $userCollegeTSNoteU = $this->userCollegeTSNoteURepository->findWithoutFail($id);
    
            if(empty($userCollegeTSNoteU))
            {
                Flash::error('User College T S Note U not found');
                return redirect(route('userCollegeTSNoteUs.index'));
            }
    
            if($userCollegeTSNoteU -> user_id == $user_id)
            {
                return view('user_college_t_s_note_us.edit')
                    ->with('userCollegeTSNoteU', $userCollegeTSNoteU);
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

    public function update($id, UpdateUserCollegeTSNoteURequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userCollegeTSNoteU = $this->userCollegeTSNoteURepository->findWithoutFail($id);
    
            if(empty($userCollegeTSNoteU))
            {
                Flash::error('User College T S Note U not found');
                return redirect(route('userCollegeTSNoteUs.index'));
            }
    
            if($userCollegeTSNoteU -> user_id == $user_id)
            {
                $userCollegeTSNoteU = $this->userCollegeTSNoteURepository->update($request->all(), $id);
            
                Flash::success('User College T S Note U updated successfully.');
                return redirect(route('userCollegeTSNoteUs.index'));
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
            $userCollegeTSNoteU = $this->userCollegeTSNoteURepository->findWithoutFail($id);
    
            if(empty($userCollegeTSNoteU))
            {
                Flash::error('User College T S Note U not found');
                return redirect(route('userCollegeTSNoteUs.index'));
            }
    
            if($userCollegeTSNoteU -> user_id == $user_id)
            {
                $this->userCollegeTSNoteURepository->delete($id);
            
                Flash::success('User College T S Note U deleted successfully.');
                return redirect(route('userCollegeTSNoteUs.index'));
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