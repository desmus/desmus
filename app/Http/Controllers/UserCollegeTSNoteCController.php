<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserCollegeTSNoteCRequest;
use App\Http\Requests\UpdateUserCollegeTSNoteCRequest;
use App\Repositories\UserCollegeTSNoteCRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class UserCollegeTSNoteCController extends AppBaseController
{
    private $userCollegeTSNoteCRepository;

    public function __construct(UserCollegeTSNoteCRepository $userCollegeTSNoteCRepo)
    {
        $this->userCollegeTSNoteCRepository = $userCollegeTSNoteCRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userCollegeTSNoteCRepository->pushCriteria(new RequestCriteria($request));
            $userCollegeTSNoteCs = $this->userCollegeTSNoteCRepository->all();
    
            return view('user_college_t_s_note_cs.index')
                ->with('userCollegeTSNoteCs', $userCollegeTSNoteCs);
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
            return view('user_college_t_s_note_cs.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserCollegeTSNoteCRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userCollegeTSNoteC = $this->userCollegeTSNoteCRepository->create($input);
            
                Flash::success('User College T S Note C saved successfully.');
                return redirect(route('userCollegeTSNoteCs.index'));
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
            $userCollegeTSNoteC = $this->userCollegeTSNoteCRepository->findWithoutFail($id);
    
            if(empty($userCollegeTSNoteC))
            {
                Flash::error('User College T S Note C not found');
                return redirect(route('userCollegeTSNoteCs.index'));
            }
            
            if($userCollegeTSNoteC -> user_id == $user_id)
            {
                return view('user_college_t_s_note_cs.show')
                    ->with('userCollegeTSNoteC', $userCollegeTSNoteC);
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
            $userCollegeTSNoteC = $this->userCollegeTSNoteCRepository->findWithoutFail($id);
    
            if(empty($userCollegeTSNoteC))
            {
                Flash::error('User College T S Note C not found');
                return redirect(route('userCollegeTSNoteCs.index'));
            }
    
            if($userCollegeTSNoteC -> user_id == $user_id)
            {
                return view('user_college_t_s_note_cs.edit')
                    ->with('userCollegeTSNoteC', $userCollegeTSNoteC);
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

    public function update($id, UpdateUserCollegeTSNoteCRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userCollegeTSNoteC = $this->userCollegeTSNoteCRepository->findWithoutFail($id);
    
            if(empty($userCollegeTSNoteC))
            {
                Flash::error('User College T S Note C not found');
                return redirect(route('userCollegeTSNoteCs.index'));
            }
    
            if($userCollegeTSNoteC -> user_id == $user_id)
            {
                $userCollegeTSNoteC = $this->userCollegeTSNoteCRepository->update($request->all(), $id);
            
                Flash::success('User College T S Note C updated successfully.');
                return redirect(route('userCollegeTSNoteCs.index'));
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
            $userCollegeTSNoteC = $this->userCollegeTSNoteCRepository->findWithoutFail($id);
    
            if(empty($userCollegeTSNoteC))
            {
                Flash::error('User College T S Note C not found');
                return redirect(route('userCollegeTSNoteCs.index'));
            }
    
            if($userCollegeTSNoteC -> user_id == $user_id)
            {
                $this->userCollegeTSNoteCRepository->delete($id);
            
                Flash::success('User College T S Note C deleted successfully.');
                return redirect(route('userCollegeTSNoteCs.index'));
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