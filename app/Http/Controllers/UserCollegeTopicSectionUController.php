<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserCollegeTopicSectionURequest;
use App\Http\Requests\UpdateUserCollegeTopicSectionURequest;
use App\Repositories\UserCollegeTopicSectionURepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserCollegeTopicSectionUController extends AppBaseController
{
    private $userCollegeTopicSectionURepository;

    public function __construct(UserCollegeTopicSectionURepository $userCollegeTopicSectionURepo)
    {
        $this->userCollegeTopicSectionURepository = $userCollegeTopicSectionURepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userCollegeTopicSectionURepository->pushCriteria(new RequestCriteria($request));
            $userCollegeTopicSectionUs = $this->userCollegeTopicSectionURepository->all();
    
            return view('user_college_topic_section_us.index')
                ->with('userCollegeTopicSectionUs', $userCollegeTopicSectionUs);
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
            return view('user_college_topic_section_us.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserCollegeTopicSectionURequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $user_id = Auth::user()->id;
            
            if($input -> user_id == $user_id)
            {
                $userCollegeTopicSectionU = $this->userCollegeTopicSectionURepository->create($input);
            }
            
            else
            {
                return view('deniedAccess');
            }
    
            Flash::success('User College Topic Section U saved successfully.');
            return redirect(route('userCollegeTopicSectionUs.index'));
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
            $userCollegeTopicSectionU = $this->userCollegeTopicSectionURepository->findWithoutFail($id);
            $user_id = Auth::user()->id;
    
            if(empty($userCollegeTopicSectionU))
            {
                Flash::error('User College Topic Section U not found');
                return redirect(route('userCollegeTopicSectionUs.index'));
            }
            
            if($userCollegeTopicSectionU -> user_id == $user_id)
            {
                return view('user_college_topic_section_us.show')
                    ->with('userCollegeTopicSectionU', $userCollegeTopicSectionU);
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
            $userCollegeTopicSectionU = $this->userCollegeTopicSectionURepository->findWithoutFail($id);
            $user_id = Auth::user()->id;
    
            if(empty($userCollegeTopicSectionU))
            {
                Flash::error('User College Topic Section U not found');
                return redirect(route('userCollegeTopicSectionUs.index'));
            }
    
            if($userCollegeTopicSectionU -> user_id == $user_id)
            {
                return view('user_college_topic_section_us.edit')
                    ->with('userCollegeTopicSectionU', $userCollegeTopicSectionU);
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

    public function update($id, UpdateUserCollegeTopicSectionURequest $request)
    {
        if(Auth::user() != null)
        {
            $userCollegeTopicSectionU = $this->userCollegeTopicSectionURepository->findWithoutFail($id);
            $user_id = Auth::user()->id;
    
            if(empty($userCollegeTopicSectionU))
            {
                Flash::error('User College Topic Section U not found');
                return redirect(route('userCollegeTopicSectionUs.index'));
            }
            
            if($userCollegeTopicSectionU -> user_id == $user_id)
            {
                $userCollegeTopicSectionU = $this->userCollegeTopicSectionURepository->update($request->all(), $id);
            
                Flash::success('User College Topic Section U updated successfully.');
                return redirect(route('userCollegeTopicSectionUs.index'));
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
            $userCollegeTopicSectionU = $this->userCollegeTopicSectionURepository->findWithoutFail($id);
            $user_id = Auth::user()->id;
    
            if(empty($userCollegeTopicSectionU))
            {
                Flash::error('User College Topic Section U not found');
                return redirect(route('userCollegeTopicSectionUs.index'));
            }
            
            if($userCollegeTopicSectionU -> user_id == $user_id)
            {
                $this->userCollegeTopicSectionURepository->delete($id);
            
                Flash::success('User College Topic Section U deleted successfully.');
                return redirect(route('userCollegeTopicSectionUs.index'));
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