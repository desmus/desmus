<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserPersonalDataTSNoteDRequest;
use App\Http\Requests\UpdateUserPersonalDataTSNoteDRequest;
use App\Repositories\UserPersonalDataTSNoteDRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserPersonalDataTSNoteDController extends AppBaseController
{
    private $userPersonalDataTSNoteDRepository;

    public function __construct(UserPersonalDataTSNoteDRepository $userPersonalDataTSNoteDRepo)
    {
        $this->userPersonalDataTSNoteDRepository = $userPersonalDataTSNoteDRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userPersonalDataTSNoteDRepository->pushCriteria(new RequestCriteria($request));
            $userPersonalDataTSNoteDs = $this->userPersonalDataTSNoteDRepository->all();
    
            return view('user_personal_data_t_s_note_ds.index')
                ->with('userPersonalDataTSNoteDs', $userPersonalDataTSNoteDs);
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
            return view('user_personal_data_t_s_note_ds.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserPersonalDataTSNoteDRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userPersonalDataTSNoteD = $this->userPersonalDataTSNoteDRepository->create($input);
            
                Flash::success('User Personal Data T S Note D saved successfully.');
                return redirect(route('userPersonalDataTSNoteDs.index'));
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
            $userPersonalDataTSNoteD = $this->userPersonalDataTSNoteDRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSNoteD))
            {
                Flash::error('User Personal Data T S Note D not found');
                return redirect(route('userPersonalDataTSNoteDs.index'));
            }
    
            if($userPersonalDataTSNoteD -> user_id == $user_id)
            {    
                return view('user_personal_data_t_s_note_ds.show')
                    ->with('userPersonalDataTSNoteD', $userPersonalDataTSNoteD);
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
            $userPersonalDataTSNoteD = $this->userPersonalDataTSNoteDRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSNoteD))
            {
                Flash::error('User Personal Data T S Note D not found');
                return redirect(route('userPersonalDataTSNoteDs.index'));
            }
    
            if($userPersonalDataTSNoteD -> user_id == $user_id)
            {
                return view('user_personal_data_t_s_note_ds.edit')
                    ->with('userPersonalDataTSNoteD', $userPersonalDataTSNoteD);
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

    public function update($id, UpdateUserPersonalDataTSNoteDRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userPersonalDataTSNoteD = $this->userPersonalDataTSNoteDRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSNoteD))
            {
                Flash::error('User Personal Data T S Note D not found');
                return redirect(route('userPersonalDataTSNoteDs.index'));
            }
    
            if($userPersonalDataTSNoteD -> user_id == $user_id)
            {
                $userPersonalDataTSNoteD = $this->userPersonalDataTSNoteDRepository->update($request->all(), $id);
            
                Flash::success('User Personal Data T S Note D updated successfully.');
                return redirect(route('userPersonalDataTSNoteDs.index'));
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
            $userPersonalDataTSNoteD = $this->userPersonalDataTSNoteDRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSNoteD))
            {
                Flash::error('User Personal Data T S Note D not found');
                return redirect(route('userPersonalDataTSNoteDs.index'));
            }
    
            if($userPersonalDataTSNoteD -> user_id == $user_id)
            {
                $this->userPersonalDataTSNoteDRepository->delete($id);
            
                Flash::success('User Personal Data T S Note D deleted successfully.');
                return redirect(route('userPersonalDataTSNoteDs.index'));
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