<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserJobTopicDRequest;
use App\Http\Requests\UpdateUserJobTopicDRequest;
use App\Repositories\UserJobTopicDRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserJobTopicDController extends AppBaseController
{
    private $userJobTopicDRepository;

    public function __construct(UserJobTopicDRepository $userJobTopicDRepo)
    {
        $this->userJobTopicDRepository = $userJobTopicDRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userJobTopicDRepository->pushCriteria(new RequestCriteria($request));
            $userJobTopicDs = $this->userJobTopicDRepository->all();
    
            return view('user_job_topic_ds.index')
                ->with('userJobTopicDs', $userJobTopicDs);
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
            return view('user_job_topic_ds.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserJobTopicDRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userJobTopicD = $this->userJobTopicDRepository->create($input);
            
                Flash::success('User Job Topic D saved successfully.');
                return redirect(route('userJobTopicDs.index'));
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
            $userJobTopicD = $this->userJobTopicDRepository->findWithoutFail($id);
    
            if(empty($userJobTopicD))
            {
                Flash::error('User Job Topic D not found');
                return redirect(route('userJobTopicDs.index'));
            }
            
            if($userJobTopicD -> user_id == $user_id)
            {
                return view('user_job_topic_ds.show')
                    ->with('userJobTopicD', $userJobTopicD);
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
            $userJobTopicD = $this->userJobTopicDRepository->findWithoutFail($id);
    
            if(empty($userJobTopicD))
            {
                Flash::error('User Job Topic D not found');
                return redirect(route('userJobTopicDs.index'));
            }
    
            if($userJobTopicD -> user_id == $user_id)
            {
                return view('user_job_topic_ds.edit')
                    ->with('userJobTopicD', $userJobTopicD);
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

    public function update($id, UpdateUserJobTopicDRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userJobTopicD = $this->userJobTopicDRepository->findWithoutFail($id);
    
            if(empty($userJobTopicD))
            {
                Flash::error('User Job Topic D not found');
                return redirect(route('userJobTopicDs.index'));
            }
    
            if($userJobTopicD -> user_id == $user_id)
            {
                $userJobTopicD = $this->userJobTopicDRepository->update($request->all(), $id);
            
                Flash::success('User Job Topic D updated successfully.');
                return redirect(route('userJobTopicDs.index'));
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
            $userJobTopicD = $this->userJobTopicDRepository->findWithoutFail($id);
    
            if(empty($userJobTopicD))
            {
                Flash::error('User Job Topic D not found');
                return redirect(route('userJobTopicDs.index'));
            }
    
            if($userJobTopicD -> user_id == $user_id)
            {
                $this->userJobTopicDRepository->delete($id);
            
                Flash::success('User Job Topic D deleted successfully.');
                return redirect(route('userJobTopicDs.index'));
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