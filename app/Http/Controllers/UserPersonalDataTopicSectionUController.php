<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserPersonalDataTopicSectionURequest;
use App\Http\Requests\UpdateUserPersonalDataTopicSectionURequest;
use App\Repositories\UserPersonalDataTopicSectionURepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserPersonalDataTopicSectionUController extends AppBaseController
{
    private $userPersonalDataTopicSectionURepository;

    public function __construct(UserPersonalDataTopicSectionURepository $userPersonalDataTopicSectionURepo)
    {
        $this->userPersonalDataTopicSectionURepository = $userPersonalDataTopicSectionURepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userPersonalDataTopicSectionURepository->pushCriteria(new RequestCriteria($request));
            $userPersonalDataTopicSectionUs = $this->userPersonalDataTopicSectionURepository->all();
    
            return view('user_personal_data_topic_section_us.index')
                ->with('userPersonalDataTopicSectionUs', $userPersonalDataTopicSectionUs);
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
            return view('user_personal_data_topic_section_us.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserPersonalDataTopicSectionURequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userPersonalDataTopicSectionU = $this->userPersonalDataTopicSectionURepository->create($input);
            
                Flash::success('User Personal Data Topic Section U saved successfully.');
                return redirect(route('userPersonalDataTopicSectionUs.index'));
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
            $userPersonalDataTopicSectionU = $this->userPersonalDataTopicSectionURepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTopicSectionU))
            {
                Flash::error('User Personal Data Topic Section U not found');
                return redirect(route('userPersonalDataTopicSectionUs.index'));
            }
    
            if($userPersonalDataTopicSectionU -> user_id == $user_id)
            {
                return view('user_personal_data_topic_section_us.show')
                    ->with('userPersonalDataTopicSectionU', $userPersonalDataTopicSectionU);
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
            $userPersonalDataTopicSectionU = $this->userPersonalDataTopicSectionURepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTopicSectionU))
            {
                Flash::error('User Personal Data Topic Section U not found');
                return redirect(route('userPersonalDataTopicSectionUs.index'));
            }
    
            if($userPersonalDataTopicSectionU -> user_id == $user_id)
            {
                return view('user_personal_data_topic_section_us.edit')
                    ->with('userPersonalDataTopicSectionU', $userPersonalDataTopicSectionU);
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

    public function update($id, UpdateUserPersonalDataTopicSectionURequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userPersonalDataTopicSectionU = $this->userPersonalDataTopicSectionURepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTopicSectionU))
            {
                Flash::error('User Personal Data Topic Section U not found');
                return redirect(route('userPersonalDataTopicSectionUs.index'));
            }
    
            if($userPersonalDataTopicSectionU -> user_id == $user_id)
            {
                $userPersonalDataTopicSectionU = $this->userPersonalDataTopicSectionURepository->update($request->all(), $id);
            
                Flash::success('User Personal Data Topic Section U updated successfully.');
                return redirect(route('userPersonalDataTopicSectionUs.index'));
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
            $userPersonalDataTopicSectionU = $this->userPersonalDataTopicSectionURepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTopicSectionU))
            {
                Flash::error('User Personal Data Topic Section U not found');
                return redirect(route('userPersonalDataTopicSectionUs.index'));
            }
    
            if($userPersonalDataTopicSectionU -> user_id == $user_id)
            {
                $this->userPersonalDataTopicSectionURepository->delete($id);
            
                Flash::success('User Personal Data Topic Section U deleted successfully.');
                return redirect(route('userPersonalDataTopicSectionUs.index'));
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