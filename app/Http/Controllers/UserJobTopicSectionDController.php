<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserJobTopicSectionDRequest;
use App\Http\Requests\UpdateUserJobTopicSectionDRequest;
use App\Repositories\UserJobTopicSectionDRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserJobTopicSectionDController extends AppBaseController
{
    private $userJobTopicSectionDRepository;

    public function __construct(UserJobTopicSectionDRepository $userJobTopicSectionDRepo)
    {
        $this->userJobTopicSectionDRepository = $userJobTopicSectionDRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userJobTopicSectionDRepository->pushCriteria(new RequestCriteria($request));
            $userJobTopicSectionDs = $this->userJobTopicSectionDRepository->all();
    
            return view('user_job_topic_section_ds.index')
                ->with('userJobTopicSectionDs', $userJobTopicSectionDs);
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
            if(Auth::user() != null)
            {
                return view('user_job_topic_section_ds.create');
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

    public function store(CreateUserJobTopicSectionDRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userJobTopicSectionD = $this->userJobTopicSectionDRepository->create($input);
            
                Flash::success('User Job Topic Section D saved successfully.');
                return redirect(route('userJobTopicSectionDs.index'));
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
            $userJobTopicSectionD = $this->userJobTopicSectionDRepository->findWithoutFail($id);
    
            if(empty($userJobTopicSectionD))
            {
                Flash::error('User Job Topic Section D not found');
                return redirect(route('userJobTopicSectionDs.index'));
            }
    
            if($userJobTopicSectionD -> user_id == $user_id)
            {
                return view('user_job_topic_section_ds.show')
                    ->with('userJobTopicSectionD', $userJobTopicSectionD);
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
            $userJobTopicSectionD = $this->userJobTopicSectionDRepository->findWithoutFail($id);
    
            if(empty($userJobTopicSectionD))
            {
                Flash::error('User Job Topic Section D not found');
                return redirect(route('userJobTopicSectionDs.index'));
            }
    
            if($userJobTopicSectionD -> user_id == $user_id)
            {
                return view('user_job_topic_section_ds.edit')
                    ->with('userJobTopicSectionD', $userJobTopicSectionD);
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

    public function update($id, UpdateUserJobTopicSectionDRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userJobTopicSectionD = $this->userJobTopicSectionDRepository->findWithoutFail($id);
    
            if(empty($userJobTopicSectionD))
            {
                Flash::error('User Job Topic Section D not found');
                return redirect(route('userJobTopicSectionDs.index'));
            }
    
            if($userJobTopicSectionD -> user_id == $user_id)
            {
                $userJobTopicSectionD = $this->userJobTopicSectionDRepository->update($request->all(), $id);
            
                Flash::success('User Job Topic Section D updated successfully.');
                return redirect(route('userJobTopicSectionDs.index'));
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
            $userJobTopicSectionD = $this->userJobTopicSectionDRepository->findWithoutFail($id);
    
            if(empty($userJobTopicSectionD))
            {
                Flash::error('User Job Topic Section D not found');
                return redirect(route('userJobTopicSectionDs.index'));
            }
    
            if($userJobTopicSectionD -> user_id == $user_id)
            {
                $this->userJobTopicSectionDRepository->delete($id);
            
                Flash::success('User Job Topic Section D deleted successfully.');
                return redirect(route('userJobTopicSectionDs.index'));
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