<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserProjectTSNoteDRequest;
use App\Http\Requests\UpdateUserProjectTSNoteDRequest;
use App\Repositories\UserProjectTSNoteDRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserProjectTSNoteDController extends AppBaseController
{
    private $userProjectTSNoteDRepository;

    public function __construct(UserProjectTSNoteDRepository $userProjectTSNoteDRepo)
    {
        $this->userProjectTSNoteDRepository = $userProjectTSNoteDRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userProjectTSNoteDRepository->pushCriteria(new RequestCriteria($request));
            $userProjectTSNoteDs = $this->userProjectTSNoteDRepository->all();
    
            return view('user_project_t_s_note_ds.index')
                ->with('userProjectTSNoteDs', $userProjectTSNoteDs);
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
            return view('user_project_t_s_note_ds.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserProjectTSNoteDRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userProjectTSNoteD = $this->userProjectTSNoteDRepository->create($input);
            
                Flash::success('User Project T S Note D saved successfully.');
                return redirect(route('userProjectTSNoteDs.index'));
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
            $userProjectTSNoteD = $this->userProjectTSNoteDRepository->findWithoutFail($id);
    
            if(empty($userProjectTSNoteD))
            {
                Flash::error('User Project T S Note D not found');
                return redirect(route('userProjectTSNoteDs.index'));
            }
    
            if($userProjectTSNoteD -> user_id == $user_id)
            {
                return view('user_project_t_s_note_ds.show')
                    ->with('userProjectTSNoteD', $userProjectTSNoteD);
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
            $userProjectTSNoteD = $this->userProjectTSNoteDRepository->findWithoutFail($id);
    
            if(empty($userProjectTSNoteD))
            {
                Flash::error('User Project T S Note D not found');
                return redirect(route('userProjectTSNoteDs.index'));
            }
    
            if($userProjectTSNoteD -> user_id == $user_id)
            {
                return view('user_project_t_s_note_ds.edit')
                    ->with('userProjectTSNoteD', $userProjectTSNoteD);
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

    public function update($id, UpdateUserProjectTSNoteDRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userProjectTSNoteD = $this->userProjectTSNoteDRepository->findWithoutFail($id);
    
            if(empty($userProjectTSNoteD))
            {
                Flash::error('User Project T S Note D not found');
                return redirect(route('userProjectTSNoteDs.index'));
            }
    
            if($userProjectTSNoteD -> user_id == $user_id)
            {
                $userProjectTSNoteD = $this->userProjectTSNoteDRepository->update($request->all(), $id);
            
                Flash::success('User Project T S Note D updated successfully.');
                return redirect(route('userProjectTSNoteDs.index'));
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
            $userProjectTSNoteD = $this->userProjectTSNoteDRepository->findWithoutFail($id);
    
            if(empty($userProjectTSNoteD))
            {
                Flash::error('User Project T S Note D not found');
                return redirect(route('userProjectTSNoteDs.index'));
            }
    
            if($userProjectTSNoteD -> user_id == $user_id)
            {
                $this->userProjectTSNoteDRepository->delete($id);
            
                Flash::success('User Project T S Note D deleted successfully.');
                return redirect(route('userProjectTSNoteDs.index'));
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