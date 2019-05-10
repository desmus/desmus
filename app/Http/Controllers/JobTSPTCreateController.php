<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTSPTCreateRequest;
use App\Http\Requests\UpdateJobTSPTCreateRequest;
use App\Repositories\JobTSPTCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTSPTCreateController extends AppBaseController
{
    private $jobTSPTCreateRepository;

    public function __construct(JobTSPTCreateRepository $jobTSPTCreateRepo)
    {
        $this->jobTSPTCreateRepository = $jobTSPTCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTSPTCreateRepository->pushCriteria(new RequestCriteria($request));
            $jobTSPTCreates = $this->jobTSPTCreateRepository->all();
    
            return view('job_t_s_p_t_creates.index')
                ->with('jobTSPTCreates', $jobTSPTCreates);
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
            return view('job_t_s_p_t_creates.jreate');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTSPTCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $jobTSPTCreate = $this->jobTSPTCreateRepository->create($input);
    
            Flash::success('Job T S P T Create saved successfully.');
            return redirect(route('jobTSPTCreates.index'));
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
            $jobTSPTCreate = $this->jobTSPTCreateRepository->findWithoutFail($id);
    
            if(empty($jobTSPTCreate))
            {
                Flash::error('Job T S P T Create not found');
                return redirect(route('jobTSPTCreates.index'));
            }
            
            if($jobTSPTCreate -> user_id == $user_id)
            {
                return view('job_t_s_p_t_creates.show')->with('jobTSPTCreate', $jobTSPTCreate);
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
            $jobTSPTCreate = $this->jobTSPTCreateRepository->findWithoutFail($id);
    
            if(empty($jobTSPTCreate))
            {
                Flash::error('Job T S P T Create not found');
                return redirect(route('jobTSPTCreates.index'));
            }
    
            if($jobTSPTCreate -> user_id == $user_id)
            {
                return view('job_t_s_p_t_creates.edit')->with('jobTSPTCreate', $jobTSPTCreate);
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

    public function update($id, UpdateJobTSPTCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTSPTCreate = $this->jobTSPTCreateRepository->findWithoutFail($id);
    
            if(empty($jobTSPTCreate))
            {
                Flash::error('Job T S P T Create not found');
                return redirect(route('jobTSPTCreates.index'));
            }
            
            if($jobTSPTCreate -> user_id == $user_id)
            {
                $jobTSPTCreate = $this->jobTSPTCreateRepository->update($request->all(), $id);
            
                Flash::success('Job T S P T Create updated successfully.');
                return redirect(route('jobTSPTCreates.index'));
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
            $jobTSPTCreate = $this->jobTSPTCreateRepository->findWithoutFail($id);
    
            if(empty($jobTSPTCreate))
            {
                Flash::error('Job T S P T Create not found');
                return redirect(route('jobTSPTCreates.index'));
            }
    
            if($jobTSPTCreate -> user_id == $user_id)
            {
                $this->jobTSPTCreateRepository->delete($id);
            
                Flash::success('Job T S P T Create deleted successfully.');
                return redirect(route('jobTSPTCreates.index'));
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