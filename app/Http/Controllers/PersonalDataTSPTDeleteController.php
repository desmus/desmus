<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTSPTDeleteRequest;
use App\Http\Requests\UpdatePersonalDataTSPTDeleteRequest;
use App\Repositories\PersonalDataTSPTDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTSPTDeleteController extends AppBaseController
{
    private $personalDataTSPTDeleteRepository;

    public function __construct(PersonalDataTSPTDeleteRepository $personalDataTSPTDeleteRepo)
    {
        $this->personalDataTSPTDeleteRepository = $personalDataTSPTDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTSPTDeleteRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTSPTDeletes = $this->personalDataTSPTDeleteRepository->all();
    
            return view('personal_data_t_s_p_t_deletes.index')
                ->with('personalDataTSPTDeletes', $personalDataTSPTDeletes);
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
            return view('personal_data_t_s_p_t_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(DeletePersonalDataTSPTDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $personalDataTSPTDelete = $this->personalDataTSPTDeleteRepository->create($input);
    
            Flash::success('PersonalData T S P T Delete saved successfully.');
            return redirect(route('personalDataTSPTDeletes.index'));
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
            $personalDataTSPTDelete = $this->personalDataTSPTDeleteRepository->findWithoutFail($id);
    
            if(empty($personalDataTSPTDelete))
            {
                Flash::error('PersonalData T S P T Delete not found');
                return redirect(route('personalDataTSPTDeletes.index'));
            }
            
            if($personalDataTSPTDelete -> user_id == $user_id)
            {
                return view('personal_data_t_s_p_t_deletes.show')->with('personalDataTSPTDelete', $personalDataTSPTDelete);
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
            $personalDataTSPTDelete = $this->personalDataTSPTDeleteRepository->findWithoutFail($id);
    
            if(empty($personalDataTSPTDelete))
            {
                Flash::error('PersonalData T S P T Delete not found');
                return redirect(route('personalDataTSPTDeletes.index'));
            }
    
            if($personalDataTSPTDelete -> user_id == $user_id)
            {
                return view('personal_data_t_s_p_t_deletes.edit')->with('personalDataTSPTDelete', $personalDataTSPTDelete);
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

    public function update($id, UpdatePersonalDataTSPTDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $personalDataTSPTDelete = $this->personalDataTSPTDeleteRepository->findWithoutFail($id);
    
            if(empty($personalDataTSPTDelete))
            {
                Flash::error('PersonalData T S P T Delete not found');
                return redirect(route('personalDataTSPTDeletes.index'));
            }
            
            if($personalDataTSPTDelete -> user_id == $user_id)
            {
                $personalDataTSPTDelete = $this->personalDataTSPTDeleteRepository->update($request->all(), $id);
            
                Flash::success('PersonalData T S P T Delete updated successfully.');
                return redirect(route('personalDataTSPTDeletes.index'));
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
            $personalDataTSPTDelete = $this->personalDataTSPTDeleteRepository->findWithoutFail($id);
    
            if(empty($personalDataTSPTDelete))
            {
                Flash::error('PersonalData T S P T Delete not found');
                return redirect(route('personalDataTSPTDeletes.index'));
            }
    
            if($personalDataTSPTDelete -> user_id == $user_id)
            {
                $this->personalDataTSPTDeleteRepository->delete($id);
            
                Flash::success('PersonalData T S P T Delete deleted successfully.');
                return redirect(route('personalDataTSPTDeletes.index'));
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