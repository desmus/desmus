<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserPersonalDataTopicSectionDRequest;
use App\Http\Requests\UpdateUserPersonalDataTopicSectionDRequest;
use App\Repositories\UserPersonalDataTopicSectionDRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserPersonalDataTopicSectionDController extends AppBaseController
{
    private $userPersonalDataTopicSectionDRepository;

    public function __construct(UserPersonalDataTopicSectionDRepository $userPersonalDataTopicSectionDRepo)
    {
        $this->userPersonalDataTopicSectionDRepository = $userPersonalDataTopicSectionDRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userPersonalDataTopicSectionDRepository->pushCriteria(new RequestCriteria($request));
            $userPersonalDataTopicSectionDs = $this->userPersonalDataTopicSectionDRepository->all();
    
            return view('user_personal_data_topic_section_ds.index')
                ->with('userPersonalDataTopicSectionDs', $userPersonalDataTopicSectionDs);
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
            return view('user_personal_data_topic_section_ds.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserPersonalDataTopicSectionDRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $user_id = Auth::user()->id;
            
            if($input -> user_id == $user_id)
            {
                $userPersonalDataTopicSectionD = $this->userPersonalDataTopicSectionDRepository->create($input);
            
                Flash::success('User Personal Data Topic Section D saved successfully.');
                return redirect(route('userPersonalDataTopicSectionDs.index'));
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
        $user_id = Auth::user()->id;
        $userPersonalDataTopicSectionD = $this->userPersonalDataTopicSectionDRepository->findWithoutFail($id);

        if(empty($userPersonalDataTopicSectionD))
        {
            Flash::error('User Personal Data Topic Section D not found');
            return redirect(route('userPersonalDataTopicSectionDs.index'));
        }

        if($userPersonalDataTopicSectionD -> user_id == $user_id)
        {
            return view('user_personal_data_topic_section_ds.show')
                ->with('userPersonalDataTopicSectionD', $userPersonalDataTopicSectionD);
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
            $userPersonalDataTopicSectionD = $this->userPersonalDataTopicSectionDRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTopicSectionD))
            {
                Flash::error('User Personal Data Topic Section D not found');
                return redirect(route('userPersonalDataTopicSectionDs.index'));
            }
    
            if($userPersonalDataTopicSectionD -> user_id == $user_id)
            {
                return view('user_personal_data_topic_section_ds.edit')
                    ->with('userPersonalDataTopicSectionD', $userPersonalDataTopicSectionD);
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

    public function update($id, UpdateUserPersonalDataTopicSectionDRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userPersonalDataTopicSectionD = $this->userPersonalDataTopicSectionDRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTopicSectionD))
            {
                Flash::error('User Personal Data Topic Section D not found');
                return redirect(route('userPersonalDataTopicSectionDs.index'));
            }
    
            if($userPersonalDataTopicSectionD -> user_id == $user_id)
            {
                $userPersonalDataTopicSectionD = $this->userPersonalDataTopicSectionDRepository->update($request->all(), $id);
            
                Flash::success('User Personal Data Topic Section D updated successfully.');
                return redirect(route('userPersonalDataTopicSectionDs.index'));
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
            $userPersonalDataTopicSectionD = $this->userPersonalDataTopicSectionDRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTopicSectionD))
            {
                Flash::error('User Personal Data Topic Section D not found');
                return redirect(route('userPersonalDataTopicSectionDs.index'));
            }
    
            if($userPersonalDataTopicSectionD -> user_id == $user_id)
            {
                $this->userPersonalDataTopicSectionDRepository->delete($id);
            
                Flash::success('User Personal Data Topic Section D deleted successfully.');
                return redirect(route('userPersonalDataTopicSectionDs.index'));
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