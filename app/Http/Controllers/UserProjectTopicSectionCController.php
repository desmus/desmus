<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserProjectTopicSectionCRequest;
use App\Http\Requests\UpdateUserProjectTopicSectionCRequest;
use App\Repositories\UserProjectTopicSectionCRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserProjectTopicSectionCController extends AppBaseController
{
    private $userProjectTopicSectionCRepository;

    public function __construct(UserProjectTopicSectionCRepository $userProjectTopicSectionCRepo)
    {
        $this->userProjectTopicSectionCRepository = $userProjectTopicSectionCRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userProjectTopicSectionCRepository->pushCriteria(new RequestCriteria($request));
            $userProjectTopicSectionCs = $this->userProjectTopicSectionCRepository->all();
    
            return view('user_project_topic_section_cs.index')
                ->with('userProjectTopicSectionCs', $userProjectTopicSectionCs);
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
            return view('user_project_topic_section_cs.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserProjectTopicSectionCRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $userProjectTopicSectionC = $this->userProjectTopicSectionCRepository->create($input);
            
                Flash::success('User Project Topic Section C saved successfully.');
                return redirect(route('userProjectTopicSectionCs.index'));
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
            $userProjectTopicSectionC = $this->userProjectTopicSectionCRepository->findWithoutFail($id);
    
            if(empty($userProjectTopicSectionC))
            {
                Flash::error('User Project Topic Section C not found');
                return redirect(route('userProjectTopicSectionCs.index'));
            }
    
            if($userProjectTopicSectionC -> user_id == $user_id)
            {
                return view('user_project_topic_section_cs.show')
                    ->with('userProjectTopicSectionC', $userProjectTopicSectionC);
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
            $userProjectTopicSectionC = $this->userProjectTopicSectionCRepository->findWithoutFail($id);
    
            if(empty($userProjectTopicSectionC))
            {
                Flash::error('User Project Topic Section C not found');
                return redirect(route('userProjectTopicSectionCs.index'));
            }
    
            if($userProjectTopicSectionC -> user_id == $user_id)
            {
                return view('user_project_topic_section_cs.edit')
                    ->with('userProjectTopicSectionC', $userProjectTopicSectionC);
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

    public function update($id, UpdateUserProjectTopicSectionCRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userProjectTopicSectionC = $this->userProjectTopicSectionCRepository->findWithoutFail($id);
    
            if(empty($userProjectTopicSectionC))
            {
                Flash::error('User Project Topic Section C not found');
                return redirect(route('userProjectTopicSectionCs.index'));
            }
    
            if($userProjectTopicSectionC -> user_id == $user_id)
            {
                $userProjectTopicSectionC = $this->userProjectTopicSectionCRepository->update($request->all(), $id);
            
                Flash::success('User Project Topic Section C updated successfully.');
                return redirect(route('userProjectTopicSectionCs.index'));
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
            $userProjectTopicSectionC = $this->userProjectTopicSectionCRepository->findWithoutFail($id);
    
            if(empty($userProjectTopicSectionC))
            {
                Flash::error('User Project Topic Section C not found');
                return redirect(route('userProjectTopicSectionCs.index'));
            }
    
            if($userProjectTopicSectionC -> user_id == $user_id)
            {
                $this->userProjectTopicSectionCRepository->delete($id);
            
                Flash::success('User Project Topic Section C deleted successfully.');
                return redirect(route('userProjectTopicSectionCs.index'));
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