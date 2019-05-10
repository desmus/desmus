<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserCollegeTopicSectionCRequest;
use App\Http\Requests\UpdateUserCollegeTopicSectionCRequest;
use App\Repositories\UserCollegeTopicSectionCRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserCollegeTopicSectionCController extends AppBaseController
{
    private $userCollegeTopicSectionCRepository;

    public function __construct(UserCollegeTopicSectionCRepository $userCollegeTopicSectionCRepo)
    {
        $this->userCollegeTopicSectionCRepository = $userCollegeTopicSectionCRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userCollegeTopicSectionCRepository->pushCriteria(new RequestCriteria($request));
            $userCollegeTopicSectionCs = $this->userCollegeTopicSectionCRepository->all();
    
            return view('user_college_topic_section_cs.index')
                ->with('userCollegeTopicSectionCs', $userCollegeTopicSectionCs);
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
            return view('user_college_topic_section_cs.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserCollegeTopicSectionCRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userCollegeTopicSectionC = $this->userCollegeTopicSectionCRepository->create($input);
            
                Flash::success('User College Topic Section C saved successfully.');
                return redirect(route('userCollegeTopicSectionCs.index'));
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
            $userCollegeTopicSectionC = $this->userCollegeTopicSectionCRepository->findWithoutFail($id);
    
            if(empty($userCollegeTopicSectionC))
            {
                Flash::error('User College Topic Section C not found');
                return redirect(route('userCollegeTopicSectionCs.index'));
            }
            
            if($userCollegeTopicSectionC -> user_id == $user_id)
            {
                return view('user_college_topic_section_cs.show')
                    ->with('userCollegeTopicSectionC', $userCollegeTopicSectionC);
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
            $userCollegeTopicSectionC = $this->userCollegeTopicSectionCRepository->findWithoutFail($id);
    
            if(empty($userCollegeTopicSectionC))
            {
                Flash::error('User College Topic Section C not found');
                return redirect(route('userCollegeTopicSectionCs.index'));
            }
    
            if($userCollegeTopicSectionC -> user_id == $user_id)
            {
                return view('user_college_topic_section_cs.edit')
                    ->with('userCollegeTopicSectionC', $userCollegeTopicSectionC);
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

    public function update($id, UpdateUserCollegeTopicSectionCRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userCollegeTopicSectionC = $this->userCollegeTopicSectionCRepository->findWithoutFail($id);
    
            if(empty($userCollegeTopicSectionC))
            {
                Flash::error('User College Topic Section C not found');
                return redirect(route('userCollegeTopicSectionCs.index'));
            }
    
            if($userCollegeTopicSectionC -> user_id == $user_id)
            {
                $userCollegeTopicSectionC = $this->userCollegeTopicSectionCRepository->update($request->all(), $id);
            
                Flash::success('User College Topic Section C updated successfully.');
                return redirect(route('userCollegeTopicSectionCs.index'));
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
            $userCollegeTopicSectionC = $this->userCollegeTopicSectionCRepository->findWithoutFail($id);
    
            if(empty($userCollegeTopicSectionC))
            {
                Flash::error('User College Topic Section C not found');
                return redirect(route('userCollegeTopicSectionCs.index'));
            }
    
            if($userCollegeTopicSectionC -> user_id == $user_id)
            {
                $this->userCollegeTopicSectionCRepository->delete($id);
            
                Flash::success('User College Topic Section C deleted successfully.');
                return redirect(route('userCollegeTopicSectionCs.index'));
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