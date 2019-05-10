<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserProjectTopicURequest;
use App\Http\Requests\UpdateUserProjectTopicURequest;
use App\Repositories\UserProjectTopicURepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserProjectTopicUController extends AppBaseController
{
    private $userProjectTopicURepository;

    public function __construct(UserProjectTopicURepository $userProjectTopicURepo)
    {
        $this->userProjectTopicURepository = $userProjectTopicURepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userProjectTopicURepository->pushCriteria(new RequestCriteria($request));
            $userProjectTopicUs = $this->userProjectTopicURepository->all();
    
            return view('user_project_topic_us.index')
                ->with('userProjectTopicUs', $userProjectTopicUs);
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
            return view('user_project_topic_us.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserProjectTopicURequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userProjectTopicU = $this->userProjectTopicURepository->create($input);
            
                Flash::success('User Project Topic U saved successfully.');
                return redirect(route('userProjectTopicUs.index'));
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
            $userProjectTopicU = $this->userProjectTopicURepository->findWithoutFail($id);
    
            if(empty($userProjectTopicU))
            {
                Flash::error('User Project Topic U not found');
                return redirect(route('userProjectTopicUs.index'));
            }
    
            if($userProjectTopicU -> user_id == $user_id)
            {
                return view('user_project_topic_us.show')
                    ->with('userProjectTopicU', $userProjectTopicU);
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
            $userProjectTopicU = $this->userProjectTopicURepository->findWithoutFail($id);
    
            if(empty($userProjectTopicU))
            {
                Flash::error('User Project Topic U not found');
                return redirect(route('userProjectTopicUs.index'));
            }
    
            if($userProjectTopicU -> user_id == $user_id)
            {
                return view('user_project_topic_us.edit')
                    ->with('userProjectTopicU', $userProjectTopicU);
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

    public function update($id, UpdateUserProjectTopicURequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userProjectTopicU = $this->userProjectTopicURepository->findWithoutFail($id);
    
            if(empty($userProjectTopicU))
            {
                Flash::error('User Project Topic U not found');
                return redirect(route('userProjectTopicUs.index'));
            }
    
            if($userProjectTopicU -> user_id == $user_id)
            {
                $userProjectTopicU = $this->userProjectTopicURepository->update($request->all(), $id);
            
                Flash::success('User Project Topic U updated successfully.');
                return redirect(route('userProjectTopicUs.index'));
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
            $userProjectTopicU = $this->userProjectTopicURepository->findWithoutFail($id);
    
            if(empty($userProjectTopicU))
            {
                Flash::error('User Project Topic U not found');
                return redirect(route('userProjectTopicUs.index'));
            }
    
            if($userProjectTopicU -> user_id == $user_id)
            {
                $this->userProjectTopicURepository->delete($id);
            
                Flash::success('User Project Topic U deleted successfully.');
                return redirect(route('userProjectTopicUs.index'));
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