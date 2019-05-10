<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserCollegeTopicCRequest;
use App\Http\Requests\UpdateUserCollegeTopicCRequest;
use App\Repositories\UserCollegeTopicCRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserCollegeTopicCController extends AppBaseController
{
    private $userCollegeTopicCRepository;

    public function __construct(UserCollegeTopicCRepository $userCollegeTopicCRepo)
    {
        $this->userCollegeTopicCRepository = $userCollegeTopicCRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userCollegeTopicCRepository->pushCriteria(new RequestCriteria($request));
            $userCollegeTopicCs = $this->userCollegeTopicCRepository->all();
    
            return view('user_college_topic_cs.index')
                ->with('userCollegeTopicCs', $userCollegeTopicCs);
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
            return view('user_college_topic_cs.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }
    
    public function store(CreateUserCollegeTopicCRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userCollegeTopicC = $this->userCollegeTopicCRepository->create($input);
            
                Flash::success('User College Topic C saved successfully.');
                return redirect(route('userCollegeTopicCs.index'));
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
            $userCollegeTopicC = $this->userCollegeTopicCRepository->findWithoutFail($id);
    
            if(empty($userCollegeTopicC))
            {
                Flash::error('User College Topic C not found');
                return redirect(route('userCollegeTopicCs.index'));
            }
            
            if($userCollegeTopicC -> user_id == $user_id)
            {
                return view('user_college_topic_cs.show')->with('userCollegeTopicC', $userCollegeTopicC);
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
            $userCollegeTopicC = $this->userCollegeTopicCRepository->findWithoutFail($id);
    
            if(empty($userCollegeTopicC))
            {
                Flash::error('User College Topic C not found');
                return redirect(route('userCollegeTopicCs.index'));
            }
    
            if($userCollegeTopicC -> user_id == $user_id)
            {
                return view('user_college_topic_cs.edit')
                    ->with('userCollegeTopicC', $userCollegeTopicC);
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

    public function update($id, UpdateUserCollegeTopicCRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userCollegeTopicC = $this->userCollegeTopicCRepository->findWithoutFail($id);
    
            if(empty($userCollegeTopicC))
            {
                Flash::error('User College Topic C not found');
                return redirect(route('userCollegeTopicCs.index'));
            }
    
            if($userCollegeTopicC -> user_id == $user_id)
            {
                $userCollegeTopicC = $this->userCollegeTopicCRepository->update($request->all(), $id);
            
                Flash::success('User College Topic C updated successfully.');
                return redirect(route('userCollegeTopicCs.index'));
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
            $userCollegeTopicC = $this->userCollegeTopicCRepository->findWithoutFail($id);
    
            if(empty($userCollegeTopicC))
            {
                Flash::error('User College Topic C not found');
                return redirect(route('userCollegeTopicCs.index'));
            }
    
            if($userCollegeTopicC -> user_id == $user_id)
            {
                $this->userCollegeTopicCRepository->delete($id);
            
                Flash::success('User College Topic C deleted successfully.');
                return redirect(route('userCollegeTopicCs.index'));
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