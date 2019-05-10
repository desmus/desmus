<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTSPTViewRequest;
use App\Http\Requests\UpdateCollegeTSPTViewRequest;
use App\Repositories\CollegeTSPTViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTSPTViewController extends AppBaseController
{
    private $collegeTSPTViewRepository;

    public function __construct(CollegeTSPTViewRepository $collegeTSPTViewRepo)
    {
        $this->collegeTSPTViewRepository = $collegeTSPTViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTSPTViewRepository->pushCriteria(new RequestCriteria($request));
            $collegeTSPTViews = $this->collegeTSPTViewRepository->all();
    
            return view('college_t_s_p_t_views.index')
                ->with('collegeTSPTViews', $collegeTSPTViews);
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
            return view('college_t_s_p_t_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTSPTViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $collegeTSPTView = $this->collegeTSPTViewRepository->create($input);
    
            Flash::success('College T S P T View saved successfully.');
            return redirect(route('collegeTSPTViews.index'));
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
            $collegeTSPTView = $this->collegeTSPTViewRepository->findWithoutFail($id);
    
            if(empty($collegeTSPTView))
            {
                Flash::error('College T S P T View not found');
                return redirect(route('collegeTSPTViews.index'));
            }
    
            if($collegeTSPTView -> user_id == $user_id)
            {
                return view('college_t_s_p_t_views.show')->with('collegeTSPTView', $collegeTSPTView);
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
            $collegeTSPTView = $this->collegeTSPTViewRepository->findWithoutFail($id);
    
            if(empty($collegeTSPTView))
            {
                Flash::error('College T S P T View not found');
                return redirect(route('collegeTSPTViews.index'));
            }
    
            if($collegeTSPTView -> user_id == $user_id)
            {
                return view('college_t_s_p_t_views.edit')->with('collegeTSPTView', $collegeTSPTView);
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

    public function update($id, UpdateCollegeTSPTViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTSPTView = $this->collegeTSPTViewRepository->findWithoutFail($id);
    
            if(empty($collegeTSPTView))
            {
                Flash::error('College T S P T View not found');
                return redirect(route('collegeTSPTViews.index'));
            }
    
            if($collegeTSPTView -> user_id == $user_id)
            {
                $collegeTSPTView = $this->collegeTSPTViewRepository->update($request->all(), $id);
            
                Flash::success('College T S P T View updated successfully.');
                return redirect(route('collegeTSPTViews.index'));
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
            $collegeTSPTView = $this->collegeTSPTViewRepository->findWithoutFail($id);
    
            if(empty($collegeTSPTView))
            {
                Flash::error('College T S P T View not found');
                return redirect(route('collegeTSPTViews.index'));
            }
    
            if($collegeTSPTView -> user_id == $user_id)
            {
                $this->collegeTSPTViewRepository->delete($id);
            
                Flash::success('College T S P T View deleted successfully.');
                return redirect(route('collegeTSPTViews.index'));
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