<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateJobTSToolFileUpdateRequest;
use App\Http\Requests\UpdateJobTSToolFileUpdateRequest;
use App\Repositories\JobTSToolFileUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class JobTSToolFileUpdateController extends AppBaseController
{
    private $jobTSToolFileUpdateRepository;

    public function __construct(JobTSToolFileUpdateRepository $jobTSToolFileUpdateRepo)
    {
        $this->jobTSToolFileUpdateRepository = $jobTSToolFileUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->jobTSToolFileUpdateRepository->pushCriteria(new RequestCriteria($request));
            $jobTSToolFileUpdates = $this->jobTSToolFileUpdateRepository->all();
    
            return view('job_t_s_tool_file_updates.index')
                ->with('jobTSToolFileUpdates', $jobTSToolFileUpdates);
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
            return view('job_t_s_tool_file_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateJobTSToolFileUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $jobTSToolFileUpdate = $this->jobTSToolFileUpdateRepository->create($input);
            
                Flash::success('Job T S Tool File Update saved successfully.');
                return redirect(route('jobTSToolFileUpdates.index'));
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
            $jobTSToolFileUpdate = $this->jobTSToolFileUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTSToolFileUpdate))
            {
                Flash::error('Job T S Tool File Update not found');
                return redirect(route('jobTSToolFileUpdates.index'));
            }
            
            $userJobTSToolFiles = DB::table('user_job_t_s_tool_files')->where('job_t_s_t_file_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userJobTSToolFiles as $userJobTSToolFile)
            {
                if($userJobTSToolFile -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('job_t_s_tool_files')->join('job_t_s_tools', 'job_t_s_tool_files.job_t_s_t_id', '=', 'job_t_s_tools.id')->join('job_topic_sections', 'job_t_s_tools.job_topic_section_id', '=', 'job_topic_sections.id')->join('job_topics', 'job_topic_sections.job_topic_id', '=', 'job_topics.id')->join('jobs', 'job_topics.job_id', '=', 'jobs.id')->join('users', 'users.id', '=', 'jobs.user_id')->where('job_t_s_tool_files.id', '=', $id)->get();
            
            if($user_id == $jobTSToolFileUpdate -> user_id || $isShared)
            {
                return view('job_t_s_tool_file_updates.show')->with('jobTSToolFileUpdate', $jobTSToolFileUpdate);
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
            $jobTSToolFileUpdate = $this->jobTSToolFileUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTSToolFileUpdate))
            {
                Flash::error('Job T S Tool File Update not found');
                return redirect(route('jobTSToolFileUpdates.index'));
            }
    
            if($user_id == $jobTSToolFileUpdate -> user_id || $isShared)
            {
                return view('job_t_s_tool_file_updates.edit')->with('jobTSToolFileUpdate', $jobTSToolFileUpdate);
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

    public function update($id, UpdateJobTSToolFileUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $jobTSToolFileUpdate = $this->jobTSToolFileUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTSToolFileUpdate))
            {
                Flash::error('Job T S Tool File Update not found');
                return redirect(route('jobTSToolFileUpdates.index'));
            }
    
            if($user_id == $jobTSToolFileUpdate -> user_id || $isShared)
            {
                $jobTSToolFileUpdate = $this->jobTSToolFileUpdateRepository->update($request->all(), $id);
            
                Flash::success('Job T S Tool File Update updated successfully.');
                return redirect(route('jobTSToolFileUpdates.index'));
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
            $jobTSToolFileUpdate = $this->jobTSToolFileUpdateRepository->findWithoutFail($id);
    
            if(empty($jobTSToolFileUpdate))
            {
                Flash::error('Job T S Tool File Update not found');
                return redirect(route('jobTSToolFileUpdates.index'));
            }
    
            if($user_id == $jobTSToolFileUpdate -> user_id || $isShared)
            {
                $this->jobTSToolFileUpdateRepository->delete($id);
            
                Flash::success('Job T S Tool File Update deleted successfully.');
                return redirect(route('jobTSToolFileUpdates.index'));
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