<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserPersonalDataTSNoteURequest;
use App\Http\Requests\UpdateUserPersonalDataTSNoteURequest;
use App\Repositories\UserPersonalDataTSNoteURepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class UserPersonalDataTSNoteUController extends AppBaseController
{
    private $userPersonalDataTSNoteURepository;

    public function __construct(UserPersonalDataTSNoteURepository $userPersonalDataTSNoteURepo)
    {
        $this->userPersonalDataTSNoteURepository = $userPersonalDataTSNoteURepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userPersonalDataTSNoteURepository->pushCriteria(new RequestCriteria($request));
            $userPersonalDataTSNoteUs = $this->userPersonalDataTSNoteURepository->all();
    
            return view('user_personal_data_t_s_note_us.index')
                ->with('userPersonalDataTSNoteUs', $userPersonalDataTSNoteUs);
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
            return view('user_personal_data_t_s_note_us.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserPersonalDataTSNoteURequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userPersonalDataTSNoteU = $this->userPersonalDataTSNoteURepository->create($input);
            
                Flash::success('User Personal Data T S Note U saved successfully.');
                return redirect(route('userPersonalDataTSNoteUs.index'));
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
            $userPersonalDataTSNoteU = $this->userPersonalDataTSNoteURepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSNoteU))
            {
                Flash::error('User Personal Data T S Note U not found');
                return redirect(route('userPersonalDataTSNoteUs.index'));
            }
    
            if($userPersonalDataTSNoteU -> user_id == $user_id)
            {
                return view('user_personal_data_t_s_note_us.show')
                    ->with('userPersonalDataTSNoteU', $userPersonalDataTSNoteU);
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
            $userPersonalDataTSNoteU = $this->userPersonalDataTSNoteURepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSNoteU))
            {
                Flash::error('User Personal Data T S Note U not found');
                return redirect(route('userPersonalDataTSNoteUs.index'));
            }
    
            if($userPersonalDataTSNoteU -> user_id == $user_id)
            {
                return view('user_personal_data_t_s_note_us.edit')
                    ->with('userPersonalDataTSNoteU', $userPersonalDataTSNoteU);
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

    public function update($id, UpdateUserPersonalDataTSNoteURequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userPersonalDataTSNoteU = $this->userPersonalDataTSNoteURepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSNoteU))
            {
                Flash::error('User Personal Data T S Note U not found');
                return redirect(route('userPersonalDataTSNoteUs.index'));
            }
    
            if($userPersonalDataTSNoteU -> user_id == $user_id)
            {
                $userPersonalDataTSNoteU = $this->userPersonalDataTSNoteURepository->update($request->all(), $id);
            
                Flash::success('User Personal Data T S Note U updated successfully.');
                return redirect(route('userPersonalDataTSNoteUs.index'));
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
            $userPersonalDataTSNoteU = $this->userPersonalDataTSNoteURepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTSNoteU))
            {
                Flash::error('User Personal Data T S Note U not found');
                return redirect(route('userPersonalDataTSNoteUs.index'));
            }
    
            if($userPersonalDataTSNoteU -> user_id == $user_id)
            {
                $this->userPersonalDataTSNoteURepository->delete($id);
            
                Flash::success('User Personal Data T S Note U deleted successfully.');
                return redirect(route('userPersonalDataTSNoteUs.index'));
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