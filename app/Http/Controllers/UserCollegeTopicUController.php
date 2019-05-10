<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserCollegeTopicURequest;
use App\Http\Requests\UpdateUserCollegeTopicURequest;
use App\Repositories\UserCollegeTopicURepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserCollegeTopicUController extends AppBaseController
{
    private $userCollegeTopicURepository;

    public function __construct(UserCollegeTopicURepository $userCollegeTopicURepo)
    {
        $this->userCollegeTopicURepository = $userCollegeTopicURepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userCollegeTopicURepository->pushCriteria(new RequestCriteria($request));
            $userCollegeTopicUs = $this->userCollegeTopicURepository->all();
    
            return view('user_college_topic_us.index')
                ->with('userCollegeTopicUs', $userCollegeTopicUs);
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
            return view('user_college_topic_us.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserCollegeTopicURequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $user_id = Auth::user()->id;
            
            if($input -> user_id == $user_id)
            {
                $userCollegeTopicU = $this->userCollegeTopicURepository->create($input);
            
                Flash::success('User College Topic U saved successfully.');
                return redirect(route('userCollegeTopicUs.index'));
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
            $userCollegeTopicU = $this->userCollegeTopicURepository->findWithoutFail($id);
    
            if(empty($userCollegeTopicU))
            {
                Flash::error('User College Topic U not found');
                return redirect(route('userCollegeTopicUs.index'));
            }
            
            if($userCollegeTopicU -> user_id == $user_id)
            {
                return view('user_college_topic_us.show')
                    ->with('userCollegeTopicU', $userCollegeTopicU);
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
            $userCollegeTopicU = $this->userCollegeTopicURepository->findWithoutFail($id);
    
            if(empty($userCollegeTopicU))
            {
                Flash::error('User College Topic U not found');
                return redirect(route('userCollegeTopicUs.index'));
            }
    
            if($userCollegeTopicU -> user_id == $user_id)
            {
                return view('user_college_topic_us.edit')
                    ->with('userCollegeTopicU', $userCollegeTopicU);
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

    public function update($id, UpdateUserCollegeTopicURequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userCollegeTopicU = $this->userCollegeTopicURepository->findWithoutFail($id);
    
            if(empty($userCollegeTopicU)) 
            {
                Flash::error('User College Topic U not found');
                return redirect(route('userCollegeTopicUs.index'));
            }
    
            if($userCollegeTopicU -> user_id == $user_id)
            {
                $userCollegeTopicU = $this->userCollegeTopicURepository->update($request->all(), $id);
            
                Flash::success('User College Topic U updated successfully.');
                return redirect(route('userCollegeTopicUs.index'));
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
            $userCollegeTopicU = $this->userCollegeTopicURepository->findWithoutFail($id);
    
            if(empty($userCollegeTopicU))
            {
                Flash::error('User College Topic U not found');
                return redirect(route('userCollegeTopicUs.index'));
            }
    
            if($userCollegeTopicU -> user_id == $user_id)
            {
                $this->userCollegeTopicURepository->delete($id);
            
                Flash::success('User College Topic U deleted successfully.');
                return redirect(route('userCollegeTopicUs.index'));
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