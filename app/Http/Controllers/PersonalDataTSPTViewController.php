<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTSPTViewRequest;
use App\Http\Requests\UpdatePersonalDataTSPTViewRequest;
use App\Repositories\PersonalDataTSPTViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PersonalDataTSPTViewController extends AppBaseController
{
    private $personalDataTSPTViewRepository;

    public function __construct(PersonalDataTSPTViewRepository $personalDataTSPTViewRepo)
    {
        $this->personalDataTSPTViewRepository = $personalDataTSPTViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTSPTViewRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTSPTViews = $this->personalDataTSPTViewRepository->all();
    
            return view('personal_data_t_s_p_t_views.index')
                ->with('personalDataTSPTViews', $personalDataTSPTViews);
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
            return view('personal_data_t_s_p_t_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(ViewPersonalDataTSPTViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $personalDataTSPTView = $this->personalDataTSPTViewRepository->create($input);
    
            Flash::success('PersonalData T S P T View saved successfully.');
            return redirect(route('personalDataTSPTViews.index'));
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
            $personalDataTSPTView = $this->personalDataTSPTViewRepository->findWithoutFail($id);
    
            if(empty($personalDataTSPTView))
            {
                Flash::error('PersonalData T S P T View not found');
                return redirect(route('personalDataTSPTViews.index'));
            }
            
            if($personalDataTSPTView -> user_id == $user_id)
            {
                return view('personal_data_t_s_p_t_views.show')->with('personalDataTSPTView', $personalDataTSPTView);
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
            $personalDataTSPTView = $this->personalDataTSPTViewRepository->findWithoutFail($id);
    
            if(empty($personalDataTSPTView))
            {
                Flash::error('PersonalData T S P T View not found');
                return redirect(route('personalDataTSPTViews.index'));
            }
    
            if($personalDataTSPTView -> user_id == $user_id)
            {
                return view('personal_data_t_s_p_t_views.edit')->with('personalDataTSPTView', $personalDataTSPTView);
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

    public function update($id, UpdatePersonalDataTSPTViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $personalDataTSPTView = $this->personalDataTSPTViewRepository->findWithoutFail($id);
    
            if(empty($personalDataTSPTView))
            {
                Flash::error('PersonalData T S P T View not found');
                return redirect(route('personalDataTSPTViews.index'));
            }
            
            if($personalDataTSPTView -> user_id == $user_id)
            {
                $personalDataTSPTView = $this->personalDataTSPTViewRepository->update($request->all(), $id);
            
                Flash::success('PersonalData T S P T View updated successfully.');
                return redirect(route('personalDataTSPTViews.index'));
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
            $personalDataTSPTView = $this->personalDataTSPTViewRepository->findWithoutFail($id);
    
            if(empty($personalDataTSPTView))
            {
                Flash::error('PersonalData T S P T View not found');
                return redirect(route('personalDataTSPTViews.index'));
            }
    
            if($personalDataTSPTView -> user_id == $user_id)
            {
                $this->personalDataTSPTViewRepository->delete($id);
            
                Flash::success('PersonalData T S P T View deleted successfully.');
                return redirect(route('personalDataTSPTViews.index'));
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