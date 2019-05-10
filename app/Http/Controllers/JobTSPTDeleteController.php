<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\UpdateJobTSPTDeleteRequest;
use App\Repositories\JobTSPTDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTSPTDeleteController extends AppBaseController
{
    private $jobTSPTDeleteRepository;

    public function __construct(JobTSPTDeleteRepository $jobTSPTDeleteRepo)
    {
        $this->jobTSPTDeleteRepository = $jobTSPTDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTSPTDeleteRepository->pushCriteria(new RequestCriteria($request));
            $jobTSPTDeletes = $this->jobTSPTDeleteRepository->all();
    
            return view('job_t_s_p_t_deletes.index')
                ->with('jobTSPTDeletes', $jobTSPTDeletes);
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
            return view('job_t_s_p_t_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTSPTDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $jobTSPTDelete = $this->jobTSPTDeleteRepository->create($input);
    
            Flash::success('Job T S P T Delete saved successfully.');
            return redirect(route('jobTSPTDeletes.index'));
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
            $jobTSPTDelete = $this->jobTSPTDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTSPTDelete))
            {
                Flash::error('Job T S P T Delete not found');
                return redirect(route('jobTSPTDeletes.index'));
            }
            
            if($jobTSPTDelete -> user_id == $user_id)
            {
                return view('job_t_s_p_t_deletes.show')->with('jobTSPTDelete', $jobTSPTDelete);
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
            $jobTSPTDelete = $this->jobTSPTDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTSPTDelete))
            {
                Flash::error('Job T S P T Delete not found');
                return redirect(route('jobTSPTDeletes.index'));
            }
    
            if($jobTSPTDelete -> user_id == $user_id)
            {
                return view('job_t_s_p_t_deletes.edit')->with('jobTSPTDelete', $jobTSPTDelete);
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

    public function update($id, UpdateJobTSPTDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTSPTDelete = $this->jobTSPTDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTSPTDelete))
            {
                Flash::error('Job T S P T Delete not found');
                return redirect(route('jobTSPTDeletes.index'));
            }
            
            if($jobTSPTDelete -> user_id == $user_id)
            {
                $jobTSPTDelete = $this->jobTSPTDeleteRepository->update($request->all(), $id);
            
                Flash::success('Job T S P T Delete updated successfully.');
                return redirect(route('jobTSPTDeletes.index'));
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
            $jobTSPTDelete = $this->jobTSPTDeleteRepository->findWithoutFail($id);
    
            if(empty($jobTSPTDelete))
            {
                Flash::error('Job T S P T Delete not found');
                return redirect(route('jobTSPTDeletes.index'));
            }
    
            if($jobTSPTDelete -> user_id == $user_id)
            {
                $this->jobTSPTDeleteRepository->delete($id);
            
                Flash::success('Job T S P T Delete deleted successfully.');
                return redirect(route('jobTSPTDeletes.index'));
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