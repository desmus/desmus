<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserJobTopicSectionURequest;
use App\Http\Requests\UpdateUserJobTopicSectionURequest;
use App\Repositories\UserJobTopicSectionURepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserJobTopicSectionUController extends AppBaseController
{
    private $userJobTopicSectionURepository;

    public function __construct(UserJobTopicSectionURepository $userJobTopicSectionURepo)
    {
        $this->userJobTopicSectionURepository = $userJobTopicSectionURepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userJobTopicSectionURepository->pushCriteria(new RequestCriteria($request));
            $userJobTopicSectionUs = $this->userJobTopicSectionURepository->all();
    
            return view('user_job_topic_section_us.index')
                ->with('userJobTopicSectionUs', $userJobTopicSectionUs);
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
            return view('user_job_topic_section_us.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserJobTopicSectionURequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userJobTopicSectionU = $this->userJobTopicSectionURepository->create($input);
            
                Flash::success('User Job Topic Section U saved successfully.');
                return redirect(route('userJobTopicSectionUs.index'));
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
            $userJobTopicSectionU = $this->userJobTopicSectionURepository->findWithoutFail($id);
    
            if(empty($userJobTopicSectionU))
            {
                Flash::error('User Job Topic Section U not found');
                return redirect(route('userJobTopicSectionUs.index'));
            }
    
            if($userJobTopicSectionU -> user_id == $user_id)
            {
                return view('user_job_topic_section_us.show')
                    ->with('userJobTopicSectionU', $userJobTopicSectionU);
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
            $userJobTopicSectionU = $this->userJobTopicSectionURepository->findWithoutFail($id);
    
            if(empty($userJobTopicSectionU))
            {
                Flash::error('User Job Topic Section U not found');
                return redirect(route('userJobTopicSectionUs.index'));
            }
    
            if($userJobTopicSectionU -> user_id == $user_id)
            {
                return view('user_job_topic_section_us.edit')
                    ->with('userJobTopicSectionU', $userJobTopicSectionU);
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

    public function update($id, UpdateUserJobTopicSectionURequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userJobTopicSectionU = $this->userJobTopicSectionURepository->findWithoutFail($id);
    
            if(empty($userJobTopicSectionU))
            {
                Flash::error('User Job Topic Section U not found');
                return redirect(route('userJobTopicSectionUs.index'));
            }
    
            if($userJobTopicSectionU -> user_id == $user_id)
            {
                $userJobTopicSectionU = $this->userJobTopicSectionURepository->update($request->all(), $id);
            
                Flash::success('User Job Topic Section U updated successfully.');
                return redirect(route('userJobTopicSectionUs.index'));
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
            $userJobTopicSectionU = $this->userJobTopicSectionURepository->findWithoutFail($id);
    
            if(empty($userJobTopicSectionU))
            {
                Flash::error('User Job Topic Section U not found');
                return redirect(route('userJobTopicSectionUs.index'));
            }
    
            if($userJobTopicSectionU -> user_id == $user_id)
            {
                $this->userJobTopicSectionURepository->delete($id);
            
                Flash::success('User Job Topic Section U deleted successfully.');
                return redirect(route('userJobTopicSectionUs.index'));
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