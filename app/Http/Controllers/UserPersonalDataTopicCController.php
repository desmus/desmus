<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserPersonalDataTopicCRequest;
use App\Http\Requests\UpdateUserPersonalDataTopicCRequest;
use App\Repositories\UserPersonalDataTopicCRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserPersonalDataTopicCController extends AppBaseController
{
    private $userPersonalDataTopicCRepository;

    public function __construct(UserPersonalDataTopicCRepository $userPersonalDataTopicCRepo)
    {
        $this->userPersonalDataTopicCRepository = $userPersonalDataTopicCRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userPersonalDataTopicCRepository->pushCriteria(new RequestCriteria($request));
            $userPersonalDataTopicCs = $this->userPersonalDataTopicCRepository->all();
    
            return view('user_personal_data_topic_cs.index')
                ->with('userPersonalDataTopicCs', $userPersonalDataTopicCs);
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
            return view('user_personal_data_topic_cs.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserPersonalDataTopicCRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $user_id = Auth::user()->id;
            
            if($input -> user_id == $user_id)
            {
                $userPersonalDataTopicC = $this->userPersonalDataTopicCRepository->create($input);
            
                Flash::success('User Personal Data Topic C saved successfully.');
                return redirect(route('userPersonalDataTopicCs.index'));
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
            $userPersonalDataTopicC = $this->userPersonalDataTopicCRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTopicC))
            {
                Flash::error('User Personal Data Topic C not found');
                return redirect(route('userPersonalDataTopicCs.index'));
            }
    
            if($userPersonalDataTopicC -> user_id == $user_id)
            {
                return view('user_personal_data_topic_cs.show')
                    ->with('userPersonalDataTopicC', $userPersonalDataTopicC);
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
            $userPersonalDataTopicC = $this->userPersonalDataTopicCRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTopicC))
            {
                Flash::error('User Personal Data Topic C not found');
                return redirect(route('userPersonalDataTopicCs.index'));
            }
    
            if($userPersonalDataTopicC -> user_id == $user_id)
            {
                return view('user_personal_data_topic_cs.edit')
                    ->with('userPersonalDataTopicC', $userPersonalDataTopicC);
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

    public function update($id, UpdateUserPersonalDataTopicCRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userPersonalDataTopicC = $this->userPersonalDataTopicCRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTopicC))
            {
                Flash::error('User Personal Data Topic C not found');
                return redirect(route('userPersonalDataTopicCs.index'));
            }
    
            if($userPersonalDataTopicC -> user_id == $user_id)
            {
                $userPersonalDataTopicC = $this->userPersonalDataTopicCRepository->update($request->all(), $id);
            
                Flash::success('User Personal Data Topic C updated successfully.');
                return redirect(route('userPersonalDataTopicCs.index'));
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
            $userPersonalDataTopicC = $this->userPersonalDataTopicCRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTopicC))
            {
                Flash::error('User Personal Data Topic C not found');
                return redirect(route('userPersonalDataTopicCs.index'));
            }
    
            if($userPersonalDataTopicC -> user_id == $user_id)
            {
                $this->userPersonalDataTopicCRepository->delete($id);
            
                Flash::success('User Personal Data Topic C deleted successfully.');
                return redirect(route('userPersonalDataTopicCs.index'));
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