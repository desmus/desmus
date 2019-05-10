<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserPersonalDataTopicSectionCRequest;
use App\Http\Requests\UpdateUserPersonalDataTopicSectionCRequest;
use App\Repositories\UserPersonalDataTopicSectionCRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserPersonalDataTopicSectionCController extends AppBaseController
{
    private $userPersonalDataTopicSectionCRepository;

    public function __construct(UserPersonalDataTopicSectionCRepository $userPersonalDataTopicSectionCRepo)
    {
        $this->userPersonalDataTopicSectionCRepository = $userPersonalDataTopicSectionCRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userPersonalDataTopicSectionCRepository->pushCriteria(new RequestCriteria($request));
            $userPersonalDataTopicSectionCs = $this->userPersonalDataTopicSectionCRepository->all();
    
            return view('user_personal_data_topic_section_cs.index')
                ->with('userPersonalDataTopicSectionCs', $userPersonalDataTopicSectionCs);
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
            return view('user_personal_data_topic_section_cs.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserPersonalDataTopicSectionCRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $user_id = Auth::user()->id;
            
            if($input -> user_id == $user_id)
            {
                $userPersonalDataTopicSectionC = $this->userPersonalDataTopicSectionCRepository->create($input);
            
                Flash::success('User Personal Data Topic Section C saved successfully.');
                return redirect(route('userPersonalDataTopicSectionCs.index'));
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
            $userPersonalDataTopicSectionC = $this->userPersonalDataTopicSectionCRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTopicSectionC))
            {
                Flash::error('User Personal Data Topic Section C not found');
                return redirect(route('userPersonalDataTopicSectionCs.index'));
            }
    
            if($userPersonalDataTopicSectionC -> user_id == $user_id)
            {
                return view('user_personal_data_topic_section_cs.show')
                    ->with('userPersonalDataTopicSectionC', $userPersonalDataTopicSectionC);
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
            $userPersonalDataTopicSectionC = $this->userPersonalDataTopicSectionCRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTopicSectionC))
            {
                Flash::error('User Personal Data Topic Section C not found');
                return redirect(route('userPersonalDataTopicSectionCs.index'));
            }
    
            if($userPersonalDataTopicSectionC -> user_id == $user_id)
            {
                return view('user_personal_data_topic_section_cs.edit')
                    ->with('userPersonalDataTopicSectionC', $userPersonalDataTopicSectionC);
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

    public function update($id, UpdateUserPersonalDataTopicSectionCRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $userPersonalDataTopicSectionC = $this->userPersonalDataTopicSectionCRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTopicSectionC))
            {
                Flash::error('User Personal Data Topic Section C not found');
                return redirect(route('userPersonalDataTopicSectionCs.index'));
            }
    
            if($userPersonalDataTopicSectionC -> user_id == $user_id)
            {
                $userPersonalDataTopicSectionC = $this->userPersonalDataTopicSectionCRepository->update($request->all(), $id);
            
                Flash::success('User Personal Data Topic Section C updated successfully.');
                return redirect(route('userPersonalDataTopicSectionCs.index'));
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
            $userPersonalDataTopicSectionC = $this->userPersonalDataTopicSectionCRepository->findWithoutFail($id);
    
            if(empty($userPersonalDataTopicSectionC))
            {
                Flash::error('User Personal Data Topic Section C not found');
                return redirect(route('userPersonalDataTopicSectionCs.index'));
            }
    
            if($userPersonalDataTopicSectionC -> user_id == $user_id)
            {
                $this->userPersonalDataTopicSectionCRepository->delete($id);
            
                Flash::success('User Personal Data Topic Section C deleted successfully.');
                return redirect(route('userPersonalDataTopicSectionCs.index'));
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