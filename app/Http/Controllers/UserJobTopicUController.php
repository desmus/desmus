<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserJobTopicURequest;
use App\Http\Requests\UpdateUserJobTopicURequest;
use App\Repositories\UserJobTopicURepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserJobTopicUController extends AppBaseController
{
    private $userJobTopicURepository;

    public function __construct(UserJobTopicURepository $userJobTopicURepo)
    {
        $this->userJobTopicURepository = $userJobTopicURepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userJobTopicURepository->pushCriteria(new RequestCriteria($request));
            $userJobTopicUs = $this->userJobTopicURepository->all();
    
            return view('user_job_topic_us.index')
                ->with('userJobTopicUs', $userJobTopicUs);
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
            return view('user_job_topic_us.create');    
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserJobTopicURequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userJobTopicU = $this->userJobTopicURepository->create($input);
            
                Flash::success('User Job Topic U saved successfully.');
                return redirect(route('userJobTopicUs.index'));
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
            $userJobTopicU = $this->userJobTopicURepository->findWithoutFail($id);
    
            if(empty($userJobTopicU))
            {
                Flash::error('User Job Topic U not found');
                return redirect(route('userJobTopicUs.index'));
            }
    
            if($userJobTopicSectionU -> user_id == $user_id)
            {
                return view('user_job_topic_us.show')
                    ->with('userJobTopicU', $userJobTopicU);
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
            $userJobTopicU = $this->userJobTopicURepository->findWithoutFail($id);
    
            if(empty($userJobTopicU))
            {
                Flash::error('User Job Topic U not found');
                return redirect(route('userJobTopicUs.index'));
            }
    
            if($userJobTopicSectionU -> user_id == $user_id)
            {
                return view('user_job_topic_us.edit')
                    ->with('userJobTopicU', $userJobTopicU);
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

    public function update($id, UpdateUserJobTopicURequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userJobTopicU = $this->userJobTopicURepository->findWithoutFail($id);
    
            if(empty($userJobTopicU))
            {
                Flash::error('User Job Topic U not found');
                return redirect(route('userJobTopicUs.index'));
            }
    
            if($userJobTopicSectionU -> user_id == $user_id)
            {
                $userJobTopicU = $this->userJobTopicURepository->update($request->all(), $id);
            
                Flash::success('User Job Topic U updated successfully.');
                return redirect(route('userJobTopicUs.index'));
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
            $userJobTopicU = $this->userJobTopicURepository->findWithoutFail($id);
    
            if(empty($userJobTopicU))
            {
                Flash::error('User Job Topic U not found');
                return redirect(route('userJobTopicUs.index'));
            }
    
            if($userJobTopicSectionU -> user_id == $user_id)
            {
                $this->userJobTopicURepository->delete($id);
            
                Flash::success('User Job Topic U deleted successfully.');
                return redirect(route('userJobTopicUs.index'));
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