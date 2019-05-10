<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTSPTViewRequest;
use App\Http\Requests\UpdateJobTSPTViewRequest;
use App\Repositories\JobTSPTViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTSPTViewController extends AppBaseController
{
    private $jobTSPTViewRepository;

    public function __construct(JobTSPTViewRepository $jobTSPTViewRepo)
    {
        $this->jobTSPTViewRepository = $jobTSPTViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTSPTViewRepository->pushCriteria(new RequestCriteria($request));
            $jobTSPTViews = $this->jobTSPTViewRepository->all();
    
            return view('job_t_s_p_t_views.index')
                ->with('jobTSPTViews', $jobTSPTViews);
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
            return view('job_t_s_p_t_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTSPTViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $jobTSPTView = $this->jobTSPTViewRepository->create($input);
    
            Flash::success('Job T S P T View saved successfully.');
            return redirect(route('jobTSPTViews.index'));
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
            $jobTSPTView = $this->jobTSPTViewRepository->findWithoutFail($id);
    
            if(empty($jobTSPTView))
            {
                Flash::error('Job T S P T View not found');
                return redirect(route('jobTSPTViews.index'));
            }
    
            if($jobTSPTView -> user_id == $user_id)
            {
                return view('job_t_s_p_t_views.show')->with('jobTSPTView', $jobTSPTView);
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
            $jobTSPTView = $this->jobTSPTViewRepository->findWithoutFail($id);
    
            if(empty($jobTSPTView))
            {
                Flash::error('Job T S P T View not found');
                return redirect(route('jobTSPTViews.index'));
            }
    
            if($jobTSPTView -> user_id == $user_id)
            {
                return view('job_t_s_p_t_views.edit')->with('jobTSPTView', $jobTSPTView);
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

    public function update($id, UpdateJobTSPTViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTSPTView = $this->jobTSPTViewRepository->findWithoutFail($id);
    
            if(empty($jobTSPTView))
            {
                Flash::error('Job T S P T View not found');
                return redirect(route('jobTSPTViews.index'));
            }
    
            if($jobTSPTView -> user_id == $user_id)
            {
                $jobTSPTView = $this->jobTSPTViewRepository->update($request->all(), $id);
            
                Flash::success('Job T S P T View updated successfully.');
                return redirect(route('jobTSPTViews.index'));
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
            $jobTSPTView = $this->jobTSPTViewRepository->findWithoutFail($id);
    
            if(empty($jobTSPTView))
            {
                Flash::error('Job T S P T View not found');
                return redirect(route('jobTSPTViews.index'));
            }
    
            if($jobTSPTView -> user_id == $user_id)
            {
                $this->jobTSPTViewRepository->delete($id);
            
                Flash::success('Job T S P T View deleted successfully.');
                return redirect(route('jobTSPTViews.index'));
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