<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserProjectTopicSectionDRequest;
use App\Http\Requests\UpdateUserProjectTopicSectionDRequest;
use App\Repositories\UserProjectTopicSectionDRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserProjectTopicSectionDController extends AppBaseController
{
    private $userProjectTopicSectionDRepository;

    public function __construct(UserProjectTopicSectionDRepository $userProjectTopicSectionDRepo)
    {
        $this->userProjectTopicSectionDRepository = $userProjectTopicSectionDRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userProjectTopicSectionDRepository->pushCriteria(new RequestCriteria($request));
            $userProjectTopicSectionDs = $this->userProjectTopicSectionDRepository->all();
    
            return view('user_project_topic_section_ds.index')
                ->with('userProjectTopicSectionDs', $userProjectTopicSectionDs);
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
            return view('user_project_topic_section_ds.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserProjectTopicSectionDRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userProjectTopicSectionD = $this->userProjectTopicSectionDRepository->create($input);
            
                Flash::success('User Project Topic Section D saved successfully.');
                return redirect(route('userProjectTopicSectionDs.index'));
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
            $userProjectTopicSectionD = $this->userProjectTopicSectionDRepository->findWithoutFail($id);
    
            if(empty($userProjectTopicSectionD))
            {
                Flash::error('User Project Topic Section D not found');
                return redirect(route('userProjectTopicSectionDs.index'));
            }
    
            if($userProjectTopicSectionD -> user_id == $user_id)
            {
                return view('user_project_topic_section_ds.show')
                    ->with('userProjectTopicSectionD', $userProjectTopicSectionD);
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
            $userProjectTopicSectionD = $this->userProjectTopicSectionDRepository->findWithoutFail($id);
    
            if(empty($userProjectTopicSectionD))
            {
                Flash::error('User Project Topic Section D not found');
                return redirect(route('userProjectTopicSectionDs.index'));
            }
    
            if($userProjectTopicSectionD -> user_id == $user_id)
            {
                return view('user_project_topic_section_ds.edit')
                    ->with('userProjectTopicSectionD', $userProjectTopicSectionD);
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

    public function update($id, UpdateUserProjectTopicSectionDRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userProjectTopicSectionD = $this->userProjectTopicSectionDRepository->findWithoutFail($id);
    
            if(empty($userProjectTopicSectionD))
            {
                Flash::error('User Project Topic Section D not found');
                return redirect(route('userProjectTopicSectionDs.index'));
            }
    
            if($userProjectTopicSectionD -> user_id == $user_id)
            {
                $userProjectTopicSectionD = $this->userProjectTopicSectionDRepository->update($request->all(), $id);
            
                Flash::success('User Project Topic Section D updated successfully.');
                return redirect(route('userProjectTopicSectionDs.index'));
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
            $userProjectTopicSectionD = $this->userProjectTopicSectionDRepository->findWithoutFail($id);
    
            if(empty($userProjectTopicSectionD))
            {
                Flash::error('User Project Topic Section D not found');
                return redirect(route('userProjectTopicSectionDs.index'));
            }
    
            if($userProjectTopicSectionD -> user_id == $user_id)
            {
                $this->userProjectTopicSectionDRepository->delete($id);
            
                Flash::success('User Project Topic Section D deleted successfully.');
                return redirect(route('userProjectTopicSectionDs.index'));
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