<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserProjectTopicDRequest;
use App\Http\Requests\UpdateUserProjectTopicDRequest;
use App\Repositories\UserProjectTopicDRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserProjectTopicDController extends AppBaseController
{
    private $userProjectTopicDRepository;

    public function __construct(UserProjectTopicDRepository $userProjectTopicDRepo)
    {
        $this->userProjectTopicDRepository = $userProjectTopicDRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userProjectTopicDRepository->pushCriteria(new RequestCriteria($request));
            $userProjectTopicDs = $this->userProjectTopicDRepository->all();
    
            return view('user_project_topic_ds.index')
                ->with('userProjectTopicDs', $userProjectTopicDs);
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
            return view('user_project_topic_ds.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserProjectTopicDRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userProjectTopicD = $this->userProjectTopicDRepository->create($input);
            
                Flash::success('User Project Topic D saved successfully.');
                return redirect(route('userProjectTopicDs.index'));
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
            $userProjectTopicD = $this->userProjectTopicDRepository->findWithoutFail($id);
    
            if(empty($userProjectTopicD))
            {
                Flash::error('User Project Topic D not found');
                return redirect(route('userProjectTopicDs.index'));
            }
            
            if($userProjectTopicD -> user_id == $user_id)
            {
                return view('user_project_topic_ds.show')
                    ->with('userProjectTopicD', $userProjectTopicD);
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
            $userProjectTopicD = $this->userProjectTopicDRepository->findWithoutFail($id);
    
            if(empty($userProjectTopicD))
            {
                Flash::error('User Project Topic D not found');
                return redirect(route('userProjectTopicDs.index'));
            }
    
            if($userProjectTopicD -> user_id == $user_id)
            {
                return view('user_project_topic_ds.edit')
                    ->with('userProjectTopicD', $userProjectTopicD);
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

    public function update($id, UpdateUserProjectTopicDRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userProjectTopicD = $this->userProjectTopicDRepository->findWithoutFail($id);
    
            if(empty($userProjectTopicD))
            {
                Flash::error('User Project Topic D not found');
                return redirect(route('userProjectTopicDs.index'));
            }
    
            if($userProjectTopicD -> user_id == $user_id)
            {
                $userProjectTopicD = $this->userProjectTopicDRepository->update($request->all(), $id);
            
                Flash::success('User Project Topic D updated successfully.');
                return redirect(route('userProjectTopicDs.index'));
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
            $userProjectTopicD = $this->userProjectTopicDRepository->findWithoutFail($id);
    
            if(empty($userProjectTopicD))
            {
                Flash::error('User Project Topic D not found');
                return redirect(route('userProjectTopicDs.index'));
            }
    
            if($userProjectTopicD -> user_id == $user_id)
            {
                $this->userProjectTopicDRepository->delete($id);
            
                Flash::success('User Project Topic D deleted successfully.');
                return redirect(route('userProjectTopicDs.index'));
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