<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTSPTUpdateRequest;
use App\Http\Requests\UpdatePersonalDataTSPTUpdateRequest;
use App\Repositories\PersonalDataTSPTUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTSPTUpdateController extends AppBaseController
{
    private $personalDataTSPTUpdateRepository;

    public function __construct(PersonalDataTSPTUpdateRepository $personalDataTSPTUpdateRepo)
    {
        $this->personalDataTSPTUpdateRepository = $personalDataTSPTUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTSPTUpdateRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTSPTUpdates = $this->personalDataTSPTUpdateRepository->all();
    
            return view('personal_data_t_s_p_t_updates.index')
                ->with('personalDataTSPTUpdates', $personalDataTSPTUpdates);
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
            return view('personal_data_t_s_p_t_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(UpdatePersonalDataTSPTUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $personalDataTSPTUpdate = $this->personalDataTSPTUpdateRepository->create($input);
    
            Flash::success('PersonalData T S P T Update saved successfully.');
            return redirect(route('personalDataTSPTUpdates.index'));
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
            $personalDataTSPTUpdate = $this->personalDataTSPTUpdateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSPTUpdate))
            {
                Flash::error('PersonalData T S P T Update not found');
                return redirect(route('personalDataTSPTUpdates.index'));
            }
            
            if($personalDataTSPTUpdate -> user_id == $user_id)
            {
                return view('personal_data_t_s_p_t_updates.show')->with('personalDataTSPTUpdate', $personalDataTSPTUpdate);
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
            $personalDataTSPTUpdate = $this->personalDataTSPTUpdateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSPTUpdate))
            {
                Flash::error('PersonalData T S P T Update not found');
                return redirect(route('personalDataTSPTUpdates.index'));
            }
    
            if($personalDataTSPTUpdate -> user_id == $user_id)
            {
                return view('personal_data_t_s_p_t_updates.edit')->with('personalDataTSPTUpdate', $personalDataTSPTUpdate);
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

    public function update($id, UpdatePersonalDataTSPTUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $personalDataTSPTUpdate = $this->personalDataTSPTUpdateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSPTUpdate))
            {
                Flash::error('PersonalData T S P T Update not found');
                return redirect(route('personalDataTSPTUpdates.index'));
            }
            
            if($personalDataTSPTUpdate -> user_id == $user_id)
            {
                $personalDataTSPTUpdate = $this->personalDataTSPTUpdateRepository->update($request->all(), $id);
            
                Flash::success('PersonalData T S P T Update updated successfully.');
                return redirect(route('personalDataTSPTUpdates.index'));
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
            $personalDataTSPTUpdate = $this->personalDataTSPTUpdateRepository->findWithoutFail($id);
    
            if(empty($personalDataTSPTUpdate))
            {
                Flash::error('PersonalData T S P T Update not found');
                return redirect(route('personalDataTSPTUpdates.index'));
            }
    
            if($personalDataTSPTUpdate -> user_id == $user_id)
            {
                $this->personalDataTSPTUpdateRepository->delete($id);
            
                Flash::success('PersonalData T S P T Update deleted successfully.');
                return redirect(route('personalDataTSPTUpdates.index'));
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