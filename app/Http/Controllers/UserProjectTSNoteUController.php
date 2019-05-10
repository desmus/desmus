<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserProjectTSNoteURequest;
use App\Http\Requests\UpdateUserProjectTSNoteURequest;
use App\Repositories\UserProjectTSNoteURepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserProjectTSNoteUController extends AppBaseController
{
    private $userProjectTSNoteURepository;

    public function __construct(UserProjectTSNoteURepository $userProjectTSNoteURepo)
    {
        $this->userProjectTSNoteURepository = $userProjectTSNoteURepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userProjectTSNoteURepository->pushCriteria(new RequestCriteria($request));
            $userProjectTSNoteUs = $this->userProjectTSNoteURepository->all();
    
            return view('user_project_t_s_note_us.index')
                ->with('userProjectTSNoteUs', $userProjectTSNoteUs);
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
            return view('user_project_t_s_note_us.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserProjectTSNoteURequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userProjectTSNoteU = $this->userProjectTSNoteURepository->create($input);
            
                Flash::success('User Project T S Note U saved successfully.');
                return redirect(route('userProjectTSNoteUs.index'));
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
            $userProjectTSNoteU = $this->userProjectTSNoteURepository->findWithoutFail($id);
    
            if(empty($userProjectTSNoteU))
            {
                Flash::error('User Project T S Note U not found');
                return redirect(route('userProjectTSNoteUs.index'));
            }
    
            if($userProjectTSNoteU -> user_id == $user_id)
            {
                return view('user_project_t_s_note_us.show')
                    ->with('userProjectTSNoteU', $userProjectTSNoteU);
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
            $userProjectTSNoteU = $this->userProjectTSNoteURepository->findWithoutFail($id);
    
            if(empty($userProjectTSNoteU))
            {
                Flash::error('User Project T S Note U not found');
                return redirect(route('userProjectTSNoteUs.index'));
            }
    
            if($userProjectTSNoteU -> user_id == $user_id)
            {
                return view('user_project_t_s_note_us.edit')
                    ->with('userProjectTSNoteU', $userProjectTSNoteU);
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

    public function update($id, UpdateUserProjectTSNoteURequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userProjectTSNoteU = $this->userProjectTSNoteURepository->findWithoutFail($id);
    
            if(empty($userProjectTSNoteU))
            {
                Flash::error('User Project T S Note U not found');
                return redirect(route('userProjectTSNoteUs.index'));
            }
    
            if($userProjectTSNoteU -> user_id == $user_id)
            {
                $userProjectTSNoteU = $this->userProjectTSNoteURepository->update($request->all(), $id);
            
                Flash::success('User Project T S Note U updated successfully.');
                return redirect(route('userProjectTSNoteUs.index'));
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
            $userProjectTSNoteU = $this->userProjectTSNoteURepository->findWithoutFail($id);
    
            if(empty($userProjectTSNoteU))
            {
                Flash::error('User Project T S Note U not found');
                return redirect(route('userProjectTSNoteUs.index'));
            }
    
            if($userProjectTSNoteU -> user_id == $user_id)
            {
                $this->userProjectTSNoteURepository->delete($id);
            
                Flash::success('User Project T S Note U deleted successfully.');
                return redirect(route('userProjectTSNoteUs.index'));
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