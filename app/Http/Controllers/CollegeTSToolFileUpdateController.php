<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTSToolFileUpdateRequest;
use App\Http\Requests\UpdateCollegeTSToolFileUpdateRequest;
use App\Repositories\CollegeTSToolFileUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTSToolFileUpdateController extends AppBaseController
{
    private $collegeTSToolFileUpdateRepository;

    public function __construct(CollegeTSToolFileUpdateRepository $collegeTSToolFileUpdateRepo)
    {
        $this->collegeTSToolFileUpdateRepository = $collegeTSToolFileUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTSToolFileUpdateRepository->pushCriteria(new RequestCriteria($request));
            $collegeTSToolFileUpdates = $this->collegeTSToolFileUpdateRepository->all();
    
            return view('college_t_s_tool_file_updates.index')
                ->with('collegeTSToolFileUpdates', $collegeTSToolFileUpdates);
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
            return view('college_t_s_tool_file_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTSToolFileUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $collegeTSToolFileUpdate = $this->collegeTSToolFileUpdateRepository->create($input);
            
                Flash::success('College T S Tool File Update saved successfully.');
                return redirect(route('collegeTSToolFileUpdates.index'));
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
            $collegeTSToolFileUpdate = $this->collegeTSToolFileUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTSToolFileUpdate))
            {
                Flash::error('College T S Tool File Update not found');
                return redirect(route('collegeTSToolFileUpdates.index'));
            }
            
            $userCollegeTSToolFiles = DB::table('user_college_t_s_tool_files')->where('college_t_s_t_file_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userCollegeTSToolFiles as $userCollegeTSToolFile)
            {
                if($userCollegeTSToolFile -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('college_t_s_tool_files')->join('college_t_s_tools', 'college_t_s_tool_files.college_t_s_t_id', '=', 'college_t_s_tools.id')->join('college_topic_sections', 'college_t_s_tools.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->join('users', 'users.id', '=', 'colleges.user_id')->where('college_t_s_tool_files.id', '=', $id)->get();
            
            if($user_id == $collegeTSToolFileUpdate -> user_id || $isShared)
            {
                return view('college_t_s_tool_file_updates.show')->with('collegeTSToolFileUpdate', $collegeTSToolFileUpdate);
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
            $collegeTSToolFileUpdate = $this->collegeTSToolFileUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTSToolFileUpdate))
            {
                Flash::error('College T S Tool File Update not found');
                return redirect(route('collegeTSToolFileUpdates.index'));
            }
    
            if($user_id == $collegeTSToolFileUpdate -> user_id || $isShared)
            {
                return view('college_t_s_tool_file_updates.edit')->with('collegeTSToolFileUpdate', $collegeTSToolFileUpdate);
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

    public function update($id, UpdateCollegeTSToolFileUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTSToolFileUpdate = $this->collegeTSToolFileUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTSToolFileUpdate))
            {
                Flash::error('College T S Tool File Update not found');
                return redirect(route('collegeTSToolFileUpdates.index'));
            }
    
            if($user_id == $collegeTSToolFileUpdate -> user_id || $isShared)
            {
                $collegeTSToolFileUpdate = $this->collegeTSToolFileUpdateRepository->update($request->all(), $id);
            
                Flash::success('College T S Tool File Update updated successfully.');
                return redirect(route('collegeTSToolFileUpdates.index'));
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
            $collegeTSToolFileUpdate = $this->collegeTSToolFileUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTSToolFileUpdate))
            {
                Flash::error('College T S Tool File Update not found');
                return redirect(route('collegeTSToolFileUpdates.index'));
            }
    
            if($user_id == $collegeTSToolFileUpdate -> user_id || $isShared)
            {
                $this->collegeTSToolFileUpdateRepository->delete($id);
            
                Flash::success('College T S Tool File Update deleted successfully.');
                return redirect(route('collegeTSToolFileUpdates.index'));
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