<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserProjectTSNoteCRequest;
use App\Http\Requests\UpdateUserProjectTSNoteCRequest;
use App\Repositories\UserProjectTSNoteCRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserProjectTSNoteCController extends AppBaseController
{
    private $userProjectTSNoteCRepository;

    public function __construct(UserProjectTSNoteCRepository $userProjectTSNoteCRepo)
    {
        $this->userProjectTSNoteCRepository = $userProjectTSNoteCRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userProjectTSNoteCRepository->pushCriteria(new RequestCriteria($request));
            $userProjectTSNoteCs = $this->userProjectTSNoteCRepository->all();
    
            return view('user_project_t_s_note_cs.index')
                ->with('userProjectTSNoteCs', $userProjectTSNoteCs);
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
            return view('user_project_t_s_note_cs.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserProjectTSNoteCRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userProjectTSNoteC = $this->userProjectTSNoteCRepository->create($input);
            
                Flash::success('User Project T S Note C saved successfully.');
                return redirect(route('userProjectTSNoteCs.index'));
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
            $userProjectTSNoteC = $this->userProjectTSNoteCRepository->findWithoutFail($id);
    
            if(empty($userProjectTSNoteC))
            {
                Flash::error('User Project T S Note C not found');
                return redirect(route('userProjectTSNoteCs.index'));
            }
    
            if($userProjectTSNoteC -> user_id == $user_id)
            {
                return view('user_project_t_s_note_cs.show')
                    ->with('userProjectTSNoteC', $userProjectTSNoteC);
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
            $userProjectTSNoteC = $this->userProjectTSNoteCRepository->findWithoutFail($id);
    
            if(empty($userProjectTSNoteC))
            {
                Flash::error('User Project T S Note C not found');
                return redirect(route('userProjectTSNoteCs.index'));
            }
    
            if($userProjectTSNoteC -> user_id == $user_id)
            {
                return view('user_project_t_s_note_cs.edit')
                    ->with('userProjectTSNoteC', $userProjectTSNoteC);
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

    public function update($id, UpdateUserProjectTSNoteCRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userProjectTSNoteC = $this->userProjectTSNoteCRepository->findWithoutFail($id);
    
            if(empty($userProjectTSNoteC))
            {
                Flash::error('User Project T S Note C not found');
                return redirect(route('userProjectTSNoteCs.index'));
            }
    
            if($userProjectTSNoteC -> user_id == $user_id)
            {
                $userProjectTSNoteC = $this->userProjectTSNoteCRepository->update($request->all(), $id);
            
                Flash::success('User Project T S Note C updated successfully.');
                return redirect(route('userProjectTSNoteCs.index'));
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
            $userProjectTSNoteC = $this->userProjectTSNoteCRepository->findWithoutFail($id);
    
            if(empty($userProjectTSNoteC))
            {
                Flash::error('User Project T S Note C not found');
                return redirect(route('userProjectTSNoteCs.index'));
            }
    
            if($userProjectTSNoteC -> user_id == $user_id)
            {
                $this->userProjectTSNoteCRepository->delete($id);
            
                Flash::success('User Project T S Note C deleted successfully.');
                return redirect(route('userProjectTSNoteCs.index'));
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