<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTSPTCreateRequest;
use App\Http\Requests\UpdatePersonalDataTSPTCreateRequest;
use App\Repositories\PersonalDataTSPTCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTSPTCreateController extends AppBaseController
{
    private $personalDataTSPTCreateRepository;

    public function __construct(PersonalDataTSPTCreateRepository $personalDataTSPTCreateRepo)
    {
        $this->personalDataTSPTCreateRepository = $personalDataTSPTCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTSPTCreateRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTSPTCreates = $this->personalDataTSPTCreateRepository->all();
    
            return view('personal_data_t_s_p_t_creates.index')
                ->with('personalDataTSPTCreates', $personalDataTSPTCreates);
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
            return view('personal_data_t_s_p_t_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreatePersonalDataTSPTCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $personalDataTSPTCreate = $this->personalDataTSPTCreateRepository->create($input);
    
            Flash::success('PersonalData T S P T Create saved successfully.');
            return redirect(route('personalDataTSPTCreates.index'));
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
            $personalDataTSPTCreate = $this->personalDataTSPTCreateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSPTCreate))
            {
                Flash::error('PersonalData T S P T Create not found');
                return redirect(route('personalDataTSPTCreates.index'));
            }
            
            if($personalDataTSPTCreate -> user_id == $user_id)
            {
                return view('personal_data_t_s_p_t_creates.show')->with('personalDataTSPTCreate', $personalDataTSPTCreate);
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
            $personalDataTSPTCreate = $this->personalDataTSPTCreateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSPTCreate))
            {
                Flash::error('PersonalData T S P T Create not found');
                return redirect(route('personalDataTSPTCreates.index'));
            }
    
            if($personalDataTSPTCreate -> user_id == $user_id)
            {
                return view('personal_data_t_s_p_t_creates.edit')->with('personalDataTSPTCreate', $personalDataTSPTCreate);
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

    public function update($id, UpdatePersonalDataTSPTCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $personalDataTSPTCreate = $this->personalDataTSPTCreateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSPTCreate))
            {
                Flash::error('PersonalData T S P T Create not found');
                return redirect(route('personalDataTSPTCreates.index'));
            }
            
            if($personalDataTSPTCreate -> user_id == $user_id)
            {
                $personalDataTSPTCreate = $this->personalDataTSPTCreateRepository->update($request->all(), $id);
            
                Flash::success('PersonalData T S P T Create updated successfully.');
                return redirect(route('personalDataTSPTCreates.index'));
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
            $personalDataTSPTCreate = $this->personalDataTSPTCreateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSPTCreate))
            {
                Flash::error('PersonalData T S P T Create not found');
                return redirect(route('personalDataTSPTCreates.index'));
            }
    
            if($personalDataTSPTCreate -> user_id == $user_id)
            {
                $this->personalDataTSPTCreateRepository->delete($id);
            
                Flash::success('PersonalData T S P T Create deleted successfully.');
                return redirect(route('personalDataTSPTCreates.index'));
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