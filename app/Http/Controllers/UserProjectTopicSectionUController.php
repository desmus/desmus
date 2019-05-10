<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserProjectTopicSectionURequest;
use App\Http\Requests\UpdateUserProjectTopicSectionURequest;
use App\Repositories\UserProjectTopicSectionURepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserProjectTopicSectionUController extends AppBaseController
{
    private $userProjectTopicSectionURepository;

    public function __construct(UserProjectTopicSectionURepository $userProjectTopicSectionURepo)
    {
        $this->userProjectTopicSectionURepository = $userProjectTopicSectionURepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userProjectTopicSectionURepository->pushCriteria(new RequestCriteria($request));
            $userProjectTopicSectionUs = $this->userProjectTopicSectionURepository->all();
    
            return view('user_project_topic_section_us.index')
                ->with('userProjectTopicSectionUs', $userProjectTopicSectionUs);
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
            return view('user_project_topic_section_us.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserProjectTopicSectionURequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userProjectTopicSectionU = $this->userProjectTopicSectionURepository->create($input);
            
                Flash::success('User Project Topic Section U saved successfully.');
                return redirect(route('userProjectTopicSectionUs.index'));
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
            $userProjectTopicSectionU = $this->userProjectTopicSectionURepository->findWithoutFail($id);
    
            if(empty($userProjectTopicSectionU))
            {
                Flash::error('User Project Topic Section U not found');
                return redirect(route('userProjectTopicSectionUs.index'));
            }
    
            if($userProjectTopicSectionU -> user_id == $user_id)
            {
                return view('user_project_topic_section_us.show')
                    ->with('userProjectTopicSectionU', $userProjectTopicSectionU);
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
            $userProjectTopicSectionU = $this->userProjectTopicSectionURepository->findWithoutFail($id);
    
            if(empty($userProjectTopicSectionU))
            {
                Flash::error('User Project Topic Section U not found');
                return redirect(route('userProjectTopicSectionUs.index'));
            }
    
            if($userProjectTopicSectionU -> user_id == $user_id)
            {
                return view('user_project_topic_section_us.edit')
                    ->with('userProjectTopicSectionU', $userProjectTopicSectionU);
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

    public function update($id, UpdateUserProjectTopicSectionURequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userProjectTopicSectionU = $this->userProjectTopicSectionURepository->findWithoutFail($id);
    
            if(empty($userProjectTopicSectionU))
            {
                Flash::error('User Project Topic Section U not found');
                return redirect(route('userProjectTopicSectionUs.index'));
            }
    
            if($userProjectTopicSectionU -> user_id == $user_id)
            {
                $userProjectTopicSectionU = $this->userProjectTopicSectionURepository->update($request->all(), $id);
            
                Flash::success('User Project Topic Section U updated successfully.');
                return redirect(route('userProjectTopicSectionUs.index'));
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
            $userProjectTopicSectionU = $this->userProjectTopicSectionURepository->findWithoutFail($id);
    
            if(empty($userProjectTopicSectionU))
            {
                Flash::error('User Project Topic Section U not found');
                return redirect(route('userProjectTopicSectionUs.index'));
            }
    
            if($userProjectTopicSectionU -> user_id == $user_id)
            {
                $this->userProjectTopicSectionURepository->delete($id);
            
                Flash::success('User Project Topic Section U deleted successfully.');
                return redirect(route('userProjectTopicSectionUs.index'));
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