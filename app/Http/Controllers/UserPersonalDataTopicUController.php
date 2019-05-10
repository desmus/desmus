<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserPersonalDataTopicURequest;
use App\Http\Requests\UpdateUserPersonalDataTopicURequest;
use App\Repositories\UserPersonalDataTopicURepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserPersonalDataTopicUController extends AppBaseController
{
    private $userPersonalDataTopicURepository;

    public function __construct(UserPersonalDataTopicURepository $userPersonalDataTopicURepo)
    {
        $this->userPersonalDataTopicURepository = $userPersonalDataTopicURepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userPersonalDataTopicURepository->pushCriteria(new RequestCriteria($request));
            $userPersonalDataTopicUs = $this->userPersonalDataTopicURepository->all();
    
            return view('user_personal_data_topic_us.index')
                ->with('userPersonalDataTopicUs', $userPersonalDataTopicUs);
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
            return view('user_personal_data_topic_us.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserPersonalDataTopicURequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userPersonalDataTopicU = $this->userPersonalDataTopicURepository->create($input);
            
                Flash::success('User Personal Data Topic U saved successfully.');
                return redirect(route('userPersonalDataTopicUs.index'));
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
            $userPersonalDataTopicU = $this->userPersonalDataTopicURepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTopicU))
            {
                Flash::error('User Personal Data Topic U not found');
                return redirect(route('userPersonalDataTopicUs.index'));
            }
    
            if($userPersonalDataTopicU -> user_id == $user_id)
            {
                return view('user_personal_data_topic_us.show')
                    ->with('userPersonalDataTopicU', $userPersonalDataTopicU);
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
            $userPersonalDataTopicU = $this->userPersonalDataTopicURepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTopicU))
            {
                Flash::error('User Personal Data Topic U not found');
                return redirect(route('userPersonalDataTopicUs.index'));
            }
    
            if($userPersonalDataTopicU -> user_id == $user_id)
            {
                return view('user_personal_data_topic_us.edit')
                    ->with('userPersonalDataTopicU', $userPersonalDataTopicU);
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

    public function update($id, UpdateUserPersonalDataTopicURequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userPersonalDataTopicU = $this->userPersonalDataTopicURepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTopicU))
            {
                Flash::error('User Personal Data Topic U not found');
                return redirect(route('userPersonalDataTopicUs.index'));
            }
    
            if($userPersonalDataTopicU -> user_id == $user_id)
            {
                $userPersonalDataTopicU = $this->userPersonalDataTopicURepository->update($request->all(), $id);
            
                Flash::success('User Personal Data Topic U updated successfully.');
                return redirect(route('userPersonalDataTopicUs.index'));
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
            $userPersonalDataTopicU = $this->userPersonalDataTopicURepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTopicU))
            {
                Flash::error('User Personal Data Topic U not found');
                return redirect(route('userPersonalDataTopicUs.index'));
            }
    
            if($userPersonalDataTopicU -> user_id == $user_id)
            {
                $this->userPersonalDataTopicURepository->delete($id);
            
                Flash::success('User Personal Data Topic U deleted successfully.');
                return redirect(route('userPersonalDataTopicUs.index'));
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