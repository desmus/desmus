<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserJobTopicSectionCRequest;
use App\Http\Requests\UpdateUserJobTopicSectionCRequest;
use App\Repositories\UserJobTopicSectionCRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserJobTopicSectionCController extends AppBaseController
{
    private $userJobTopicSectionCRepository;

    public function __construct(UserJobTopicSectionCRepository $userJobTopicSectionCRepo)
    {
        $this->userJobTopicSectionCRepository = $userJobTopicSectionCRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userJobTopicSectionCRepository->pushCriteria(new RequestCriteria($request));
            $userJobTopicSectionCs = $this->userJobTopicSectionCRepository->all();
    
            return view('user_job_topic_section_cs.index')
                ->with('userJobTopicSectionCs', $userJobTopicSectionCs);
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
            return view('user_job_topic_section_cs.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserJobTopicSectionCRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userJobTopicSectionC = $this->userJobTopicSectionCRepository->create($input);
            
                Flash::success('User Job Topic Section C saved successfully.');
                return redirect(route('userJobTopicSectionCs.index'));
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
            $userJobTopicSectionC = $this->userJobTopicSectionCRepository->findWithoutFail($id);
    
            if(empty($userJobTopicSectionC))
            {
                Flash::error('User Job Topic Section C not found');
                return redirect(route('userJobTopicSectionCs.index'));
            }
    
            if($userJobTopicSectionC -> user_id == $user_id)
            {
                return view('user_job_topic_section_cs.show')
                    ->with('userJobTopicSectionC', $userJobTopicSectionC);
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
            $userJobTopicSectionC = $this->userJobTopicSectionCRepository->findWithoutFail($id);
    
            if(empty($userJobTopicSectionC))
            {
                Flash::error('User Job Topic Section C not found');
                return redirect(route('userJobTopicSectionCs.index'));
            }
    
            if($userJobTopicSectionC -> user_id == $user_id)
            {
                return view('user_job_topic_section_cs.edit')
                    ->with('userJobTopicSectionC', $userJobTopicSectionC);
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

    public function update($id, UpdateUserJobTopicSectionCRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userJobTopicSectionC = $this->userJobTopicSectionCRepository->findWithoutFail($id);
    
            if(empty($userJobTopicSectionC))
            {
                Flash::error('User Job Topic Section C not found');
                return redirect(route('userJobTopicSectionCs.index'));
            }
    
            if($userJobTopicSectionC -> user_id == $user_id)
            {
                $userJobTopicSectionC = $this->userJobTopicSectionCRepository->update($request->all(), $id);
            
                Flash::success('User Job Topic Section C updated successfully.');
                return redirect(route('userJobTopicSectionCs.index'));
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
            $userJobTopicSectionC = $this->userJobTopicSectionCRepository->findWithoutFail($id);
    
            if(empty($userJobTopicSectionC))
            {
                Flash::error('User Job Topic Section C not found');
                return redirect(route('userJobTopicSectionCs.index'));
            }
    
            if($userJobTopicSectionC -> user_id == $user_id)
            {
                $this->userJobTopicSectionCRepository->delete($id);
            
                Flash::success('User Job Topic Section C deleted successfully.');
                return redirect(route('userJobTopicSectionCs.index'));
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