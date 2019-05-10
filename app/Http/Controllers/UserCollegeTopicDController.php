<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserCollegeTopicDRequest;
use App\Http\Requests\UpdateUserCollegeTopicDRequest;
use App\Repositories\UserCollegeTopicDRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserCollegeTopicDController extends AppBaseController
{
    private $userCollegeTopicDRepository;

    public function __construct(UserCollegeTopicDRepository $userCollegeTopicDRepo)
    {
        $this->userCollegeTopicDRepository = $userCollegeTopicDRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userCollegeTopicDRepository->pushCriteria(new RequestCriteria($request));
            $userCollegeTopicDs = $this->userCollegeTopicDRepository->all();
    
            return view('user_college_topic_ds.index')
                ->with('userCollegeTopicDs', $userCollegeTopicDs);
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
            return view('user_college_topic_ds.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserCollegeTopicDRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userCollegeTopicD = $this->userCollegeTopicDRepository->create($input);
            }
            
            else
            {
                return view('deniedAccess');
            }
    
            Flash::success('User College Topic D saved successfully.');
            return redirect(route('userCollegeTopicDs.index'));
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
            $userCollegeTopicD = $this->userCollegeTopicDRepository->findWithoutFail($id);
    
            if(empty($userCollegeTopicD))
            {
                Flash::error('User College Topic D not found');
                return redirect(route('userCollegeTopicDs.index'));
            }
    
            if($userCollegeTopicD -> user_id == $user_id)
            {
                return view('user_college_topic_ds.show')
                    ->with('userCollegeTopicD', $userCollegeTopicD);
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
            $userCollegeTopicD = $this->userCollegeTopicDRepository->findWithoutFail($id);
    
            if(empty($userCollegeTopicD))
            {
                Flash::error('User College Topic D not found');
                return redirect(route('userCollegeTopicDs.index'));
            }
    
            if($userCollegeTopicD -> user_id == $user_id)
            {
                return view('user_college_topic_ds.edit')
                    ->with('userCollegeTopicD', $userCollegeTopicD);
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

    public function update($id, UpdateUserCollegeTopicDRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userCollegeTopicD = $this->userCollegeTopicDRepository->findWithoutFail($id);
    
            if(empty($userCollegeTopicD))
            {
                Flash::error('User College Topic D not found');
                return redirect(route('userCollegeTopicDs.index'));
            }
    
            if($userCollegeTopicD -> user_id == $user_id)
            {
                $userCollegeTopicD = $this->userCollegeTopicDRepository->update($request->all(), $id);
            
                Flash::success('User College Topic D updated successfully.');
                return redirect(route('userCollegeTopicDs.index'));
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
            $userCollegeTopicD = $this->userCollegeTopicDRepository->findWithoutFail($id);
    
            if(empty($userCollegeTopicD))
            {
                Flash::error('User College Topic D not found');
                return redirect(route('userCollegeTopicDs.index'));
            }
    
            if($userCollegeTopicD -> user_id == $user_id)
            {
                $this->userCollegeTopicDRepository->delete($id);
            
                Flash::success('User College Topic D deleted successfully.');
                return redirect(route('userCollegeTopicDs.index'));
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