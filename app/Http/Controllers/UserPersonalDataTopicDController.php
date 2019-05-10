<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserPersonalDataTopicDRequest;
use App\Http\Requests\UpdateUserPersonalDataTopicDRequest;
use App\Repositories\UserPersonalDataTopicDRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserPersonalDataTopicDController extends AppBaseController
{
    private $userPersonalDataTopicDRepository;

    public function __construct(UserPersonalDataTopicDRepository $userPersonalDataTopicDRepo)
    {
        $this->userPersonalDataTopicDRepository = $userPersonalDataTopicDRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userPersonalDataTopicDRepository->pushCriteria(new RequestCriteria($request));
            $userPersonalDataTopicDs = $this->userPersonalDataTopicDRepository->all();
    
            return view('user_personal_data_topic_ds.index')
                ->with('userPersonalDataTopicDs', $userPersonalDataTopicDs);
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
            return view('user_personal_data_topic_ds.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserPersonalDataTopicDRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $user_id = Auth::user()->id;
            
            if($input -> user_id == $user_id)
            {
                $userPersonalDataTopicD = $this->userPersonalDataTopicDRepository->create($input);
            
                Flash::success('User Personal Data Topic D saved successfully.');
                return redirect(route('userPersonalDataTopicDs.index'));
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
            $userPersonalDataTopicD = $this->userPersonalDataTopicDRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTopicD))
            {
                Flash::error('User Personal Data Topic D not found');
                return redirect(route('userPersonalDataTopicDs.index'));
            }
    
            if($userPersonalDataTopicD -> user_id == $user_id)
            {
                return view('user_personal_data_topic_ds.show')
                    ->with('userPersonalDataTopicD', $userPersonalDataTopicD);
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
            $userPersonalDataTopicD = $this->userPersonalDataTopicDRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTopicD))
            {
                Flash::error('User Personal Data Topic D not found');
                return redirect(route('userPersonalDataTopicDs.index'));
            }
    
            if($userPersonalDataTopicD -> user_id == $user_id)
            {
                return view('user_personal_data_topic_ds.edit')
                    ->with('userPersonalDataTopicD', $userPersonalDataTopicD);
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

    public function update($id, UpdateUserPersonalDataTopicDRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userPersonalDataTopicD = $this->userPersonalDataTopicDRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTopicD))
            {
                Flash::error('User Personal Data Topic D not found');
                return redirect(route('userPersonalDataTopicDs.index'));
            }
    
            if($userPersonalDataTopicD -> user_id == $user_id)
            {
                $userPersonalDataTopicD = $this->userPersonalDataTopicDRepository->update($request->all(), $id);
            
                Flash::success('User Personal Data Topic D updated successfully.');
                return redirect(route('userPersonalDataTopicDs.index'));
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
            $userPersonalDataTopicD = $this->userPersonalDataTopicDRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTopicD))
            {
                Flash::error('User Personal Data Topic D not found');
                return redirect(route('userPersonalDataTopicDs.index'));
            }
    
            if($userPersonalDataTopicD -> user_id == $user_id)
            {
                $this->userPersonalDataTopicDRepository->delete($id);
            
                Flash::success('User Personal Data Topic D deleted successfully.');
                return redirect(route('userPersonalDataTopicDs.index'));
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