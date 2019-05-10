<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserPersonalDataTSNoteCRequest;
use App\Http\Requests\UpdateUserPersonalDataTSNoteCRequest;
use App\Repositories\UserPersonalDataTSNoteCRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserPersonalDataTSNoteCController extends AppBaseController
{
    private $userPersonalDataTSNoteCRepository;

    public function __construct(UserPersonalDataTSNoteCRepository $userPersonalDataTSNoteCRepo)
    {
        $this->userPersonalDataTSNoteCRepository = $userPersonalDataTSNoteCRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userPersonalDataTSNoteCRepository->pushCriteria(new RequestCriteria($request));
            $userPersonalDataTSNoteCs = $this->userPersonalDataTSNoteCRepository->all();
    
            return view('user_personal_data_t_s_note_cs.index')
                ->with('userPersonalDataTSNoteCs', $userPersonalDataTSNoteCs);
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
            return view('user_personal_data_t_s_note_cs.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserPersonalDataTSNoteCRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $user_id = Auth::user()->id;
            
            if($input -> user_id == $user_id)
            {
                $userPersonalDataTSNoteC = $this->userPersonalDataTSNoteCRepository->create($input);
            
                Flash::success('User Personal Data T S Note C saved successfully.');
                return redirect(route('userPersonalDataTSNoteCs.index'));
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
            $userPersonalDataTSNoteC = $this->userPersonalDataTSNoteCRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSNoteC))
            {
                Flash::error('User Personal Data T S Note C not found');
                return redirect(route('userPersonalDataTSNoteCs.index'));
            }
            
            if($userPersonalDataTSNoteC -> user_id == $user_id)
            {
                return view('user_personal_data_t_s_note_cs.show')
                    ->with('userPersonalDataTSNoteC', $userPersonalDataTSNoteC);
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
            $userPersonalDataTSNoteC = $this->userPersonalDataTSNoteCRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSNoteC))
            {
                Flash::error('User Personal Data T S Note C not found');
                return redirect(route('userPersonalDataTSNoteCs.index'));
            }
    
            if($userPersonalDataTSNoteC -> user_id == $user_id)
            {
                return view('user_personal_data_t_s_note_cs.edit')
                    ->with('userPersonalDataTSNoteC', $userPersonalDataTSNoteC);
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

    public function update($id, UpdateUserPersonalDataTSNoteCRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userPersonalDataTSNoteC = $this->userPersonalDataTSNoteCRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSNoteC))
            {
                Flash::error('User Personal Data T S Note C not found');
                return redirect(route('userPersonalDataTSNoteCs.index'));
            }
    
            if($userPersonalDataTSNoteC -> user_id == $user_id)
            {
                $userPersonalDataTSNoteC = $this->userPersonalDataTSNoteCRepository->update($request->all(), $id);
            
                Flash::success('User Personal Data T S Note C updated successfully.');
                return redirect(route('userPersonalDataTSNoteCs.index'));
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
            $userPersonalDataTSNoteC = $this->userPersonalDataTSNoteCRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSNoteC))
            {
                Flash::error('User Personal Data T S Note C not found');
                return redirect(route('userPersonalDataTSNoteCs.index'));
            }
    
            if($userPersonalDataTSNoteC -> user_id == $user_id)
            {
                $this->userPersonalDataTSNoteCRepository->delete($id);
            
                Flash::success('User Personal Data T S Note C deleted successfully.');
                return redirect(route('userPersonalDataTSNoteCs.index'));
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