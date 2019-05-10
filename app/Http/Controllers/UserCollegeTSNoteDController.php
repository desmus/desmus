<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserCollegeTSNoteDRequest;
use App\Http\Requests\UpdateUserCollegeTSNoteDRequest;
use App\Repositories\UserCollegeTSNoteDRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserCollegeTSNoteDController extends AppBaseController
{
    private $userCollegeTSNoteDRepository;

    public function __construct(UserCollegeTSNoteDRepository $userCollegeTSNoteDRepo)
    {
        $this->userCollegeTSNoteDRepository = $userCollegeTSNoteDRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userCollegeTSNoteDRepository->pushCriteria(new RequestCriteria($request));
            $userCollegeTSNoteDs = $this->userCollegeTSNoteDRepository->all();
    
            return view('user_college_t_s_note_ds.index')
                ->with('userCollegeTSNoteDs', $userCollegeTSNoteDs);
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
            return view('user_college_t_s_note_ds.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserCollegeTSNoteDRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userCollegeTSNoteD = $this->userCollegeTSNoteDRepository->create($input);
            
                Flash::success('User College T S Note D saved successfully.');
                return redirect(route('userCollegeTSNoteDs.index'));
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
            $userCollegeTSNoteD = $this->userCollegeTSNoteDRepository->findWithoutFail($id);
    
            if(empty($userCollegeTSNoteD))
            {
                Flash::error('User College T S Note D not found');
                return redirect(route('userCollegeTSNoteDs.index'));
            }
    
            if($userCollegeTSNoteD -> user_id == $user_id)
            {
                return view('user_college_t_s_note_ds.show')
                    ->with('userCollegeTSNoteD', $userCollegeTSNoteD);
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
            $userCollegeTSNoteD = $this->userCollegeTSNoteDRepository->findWithoutFail($id);
    
            if(empty($userCollegeTSNoteD))
            {
                Flash::error('User College T S Note D not found');
                return redirect(route('userCollegeTSNoteDs.index'));
            }
    
            if($userCollegeTSNoteD -> user_id == $user_id)
            {
                return view('user_college_t_s_note_ds.edit')
                    ->with('userCollegeTSNoteD', $userCollegeTSNoteD);
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

    public function update($id, UpdateUserCollegeTSNoteDRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userCollegeTSNoteD = $this->userCollegeTSNoteDRepository->findWithoutFail($id);
    
            if(empty($userCollegeTSNoteD))
            {
                Flash::error('User College T S Note D not found');
                return redirect(route('userCollegeTSNoteDs.index'));
            }
    
            if($userCollegeTSNoteD -> user_id == $user_id)
            {
                $userCollegeTSNoteD = $this->userCollegeTSNoteDRepository->update($request->all(), $id);
            
                Flash::success('User College T S Note D updated successfully.');
                return redirect(route('userCollegeTSNoteDs.index'));
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
            $userCollegeTSNoteD = $this->userCollegeTSNoteDRepository->findWithoutFail($id);
    
            if(empty($userCollegeTSNoteD))
            {
                Flash::error('User College T S Note D not found');
                return redirect(route('userCollegeTSNoteDs.index'));
            }
    
            if($userCollegeTSNoteD -> user_id == $user_id)
            {
                $this->userCollegeTSNoteDRepository->delete($id);
            
                Flash::success('User College T S Note D deleted successfully.');
                return redirect(route('userCollegeTSNoteDs.index'));
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