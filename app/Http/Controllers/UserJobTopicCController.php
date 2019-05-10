<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserJobTopicCRequest;
use App\Http\Requests\UpdateUserJobTopicCRequest;
use App\Repositories\UserJobTopicCRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserJobTopicCController extends AppBaseController
{
    private $userJobTopicCRepository;

    public function __construct(UserJobTopicCRepository $userJobTopicCRepo)
    {
        $this->userJobTopicCRepository = $userJobTopicCRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userJobTopicCRepository->pushCriteria(new RequestCriteria($request));
            $userJobTopicCs = $this->userJobTopicCRepository->all();
    
            return view('user_job_topic_cs.index')
                ->with('userJobTopicCs', $userJobTopicCs);
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
            return view('user_job_topic_cs.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserJobTopicCRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userJobTopicC = $this->userJobTopicCRepository->create($input);
            
                Flash::success('User Job Topic C saved successfully.');
                return redirect(route('userJobTopicCs.index'));
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
            $userJobTopicC = $this->userJobTopicCRepository->findWithoutFail($id);
    
            if(empty($userJobTopicC))
            {
                Flash::error('User Job Topic C not found');
                return redirect(route('userJobTopicCs.index'));
            }
    
            if($userJobTopicC -> user_id == $user_id)
            {
                return view('user_job_topic_cs.show')
                    ->with('userJobTopicC', $userJobTopicC);
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
            $userJobTopicC = $this->userJobTopicCRepository->findWithoutFail($id);
    
            if(empty($userJobTopicC))
            {
                Flash::error('User Job Topic C not found');
                return redirect(route('userJobTopicCs.index'));
            }
    
            if($userJobTopicC -> user_id == $user_id)
            {
                return view('user_job_topic_cs.edit')
                    ->with('userJobTopicC', $userJobTopicC);
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

    public function update($id, UpdateUserJobTopicCRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userJobTopicC = $this->userJobTopicCRepository->findWithoutFail($id);
    
            if(empty($userJobTopicC))
            {
                Flash::error('User Job Topic C not found');
                return redirect(route('userJobTopicCs.index'));
            }
    
            if($userJobTopicC -> user_id == $user_id)
            {
                $userJobTopicC = $this->userJobTopicCRepository->update($request->all(), $id);
            
                Flash::success('User Job Topic C updated successfully.');
                return redirect(route('userJobTopicCs.index'));
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
            $userJobTopicC = $this->userJobTopicCRepository->findWithoutFail($id);
    
            if(empty($userJobTopicC))
            {
                Flash::error('User Job Topic C not found');
                return redirect(route('userJobTopicCs.index'));
            }
    
            if($userJobTopicC -> user_id == $user_id)
            {
                $this->userJobTopicCRepository->delete($id);
            
                Flash::success('User Job Topic C deleted successfully.');
                return redirect(route('userJobTopicCs.index'));
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