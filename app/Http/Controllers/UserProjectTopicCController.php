<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserProjectTopicCRequest;
use App\Http\Requests\UpdateUserProjectTopicCRequest;
use App\Repositories\UserProjectTopicCRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserProjectTopicCController extends AppBaseController
{
    private $userProjectTopicCRepository;

    public function __construct(UserProjectTopicCRepository $userProjectTopicCRepo)
    {
        $this->userProjectTopicCRepository = $userProjectTopicCRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userProjectTopicCRepository->pushCriteria(new RequestCriteria($request));
            $userProjectTopicCs = $this->userProjectTopicCRepository->all();
    
            return view('user_project_topic_cs.index')
                ->with('userProjectTopicCs', $userProjectTopicCs);
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
            return view('user_project_topic_cs.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserProjectTopicCRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userProjectTopicC = $this->userProjectTopicCRepository->create($input);
            
                Flash::success('User Project Topic C saved successfully.');
                return redirect(route('userProjectTopicCs.index'));
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
            $userProjectTopicC = $this->userProjectTopicCRepository->findWithoutFail($id);
    
            if (empty($userProjectTopicC))
            {
                Flash::error('User Project Topic C not found');
                return redirect(route('userProjectTopicCs.index'));
            }
    
            if($userProjectTopicC -> user_id == $user_id)
            {
                return view('user_project_topic_cs.show')
                    ->with('userProjectTopicC', $userProjectTopicC);
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
            $userProjectTopicC = $this->userProjectTopicCRepository->findWithoutFail($id);
    
            if(empty($userProjectTopicC))
            {
                Flash::error('User Project Topic C not found');
                return redirect(route('userProjectTopicCs.index'));
            }
    
            if($userProjectTopicC -> user_id == $user_id)
            {
                return view('user_project_topic_cs.edit')
                    ->with('userProjectTopicC', $userProjectTopicC);
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

    public function update($id, UpdateUserProjectTopicCRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userProjectTopicC = $this->userProjectTopicCRepository->findWithoutFail($id);
    
            if(empty($userProjectTopicC))
            {
                Flash::error('User Project Topic C not found');
                return redirect(route('userProjectTopicCs.index'));
            }
    
            if($userProjectTopicC -> user_id == $user_id)
            {
                $userProjectTopicC = $this->userProjectTopicCRepository->update($request->all(), $id);
            
                Flash::success('User Project Topic C updated successfully.');
                return redirect(route('userProjectTopicCs.index'));
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
            $userProjectTopicC = $this->userProjectTopicCRepository->findWithoutFail($id);
    
            if(empty($userProjectTopicC))
            {
                Flash::error('User Project Topic C not found');
                return redirect(route('userProjectTopicCs.index'));
            }
    
            if($userProjectTopicC -> user_id == $user_id)
            {
                $this->userProjectTopicCRepository->delete($id);
            
                Flash::success('User Project Topic C deleted successfully.');
                return redirect(route('userProjectTopicCs.index'));
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