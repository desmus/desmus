<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserCollegeTopicSectionDRequest;
use App\Http\Requests\UpdateUserCollegeTopicSectionDRequest;
use App\Repositories\UserCollegeTopicSectionDRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserCollegeTopicSectionDController extends AppBaseController
{
    private $userCollegeTopicSectionDRepository;

    public function __construct(UserCollegeTopicSectionDRepository $userCollegeTopicSectionDRepo)
    {
        $this->userCollegeTopicSectionDRepository = $userCollegeTopicSectionDRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userCollegeTopicSectionDRepository->pushCriteria(new RequestCriteria($request));
            $userCollegeTopicSectionDs = $this->userCollegeTopicSectionDRepository->all();
    
            return view('user_college_topic_section_ds.index')
                ->with('userCollegeTopicSectionDs', $userCollegeTopicSectionDs);
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
            return view('user_college_topic_section_ds.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserCollegeTopicSectionDRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $user_id = Auth::user()->id;
                    
            if($input -> user_id == $user_id)
            {
                $userCollegeTopicSectionD = $this->userCollegeTopicSectionDRepository->create($input);
            
                Flash::success('User College Topic Section D saved successfully.');
                return redirect(route('userCollegeTopicSectionDs.index'));
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
            $input = $request->all();
            $user_id = Auth::user()->id;
            $userCollegeTopicSectionD = $this->userCollegeTopicSectionDRepository->findWithoutFail($id);
    
            if(empty($userCollegeTopicSectionD))
            {
                Flash::error('User College Topic Section D not found');
                return redirect(route('userCollegeTopicSectionDs.index'));
            }
            
            if($userCollegeTopicSectionD -> user_id == $user_id)
            {
                return view('user_college_topic_section_ds.show')
                    ->with('userCollegeTopicSectionD', $userCollegeTopicSectionD);
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
            $input = $request->all();
            $user_id = Auth::user()->id;
            $userCollegeTopicSectionD = $this->userCollegeTopicSectionDRepository->findWithoutFail($id);
    
            if(empty($userCollegeTopicSectionD))
            {
                Flash::error('User College Topic Section D not found');
                return redirect(route('userCollegeTopicSectionDs.index'));
            }
    
            if($userCollegeTopicSectionD -> user_id == $user_id)
            {
                return view('user_college_topic_section_ds.edit')
                    ->with('userCollegeTopicSectionD', $userCollegeTopicSectionD);
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

    public function update($id, UpdateUserCollegeTopicSectionDRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userCollegeTopicSectionD = $this->userCollegeTopicSectionDRepository->findWithoutFail($id);
    
            if(empty($userCollegeTopicSectionD))
            {
                Flash::error('User College Topic Section D not found');
                return redirect(route('userCollegeTopicSectionDs.index'));
            }
    
            if($userCollegeTopicSectionD -> user_id == $user_id)
            {
                $userCollegeTopicSectionD = $this->userCollegeTopicSectionDRepository->update($request->all(), $id);
            
                Flash::success('User College Topic Section D updated successfully.');
                return redirect(route('userCollegeTopicSectionDs.index'));
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
            $userCollegeTopicSectionD = $this->userCollegeTopicSectionDRepository->findWithoutFail($id);
    
            if(empty($userCollegeTopicSectionD))
            {
                Flash::error('User College Topic Section D not found');
                return redirect(route('userCollegeTopicSectionDs.index'));
            }
    
            if($userCollegeTopicSectionD -> user_id == $user_id)
            {
                $this->userCollegeTopicSectionDRepository->delete($id);
            
                Flash::success('User College Topic Section D deleted successfully.');
                return redirect(route('userCollegeTopicSectionDs.index'));
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