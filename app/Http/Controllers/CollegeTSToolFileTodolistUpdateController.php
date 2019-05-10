<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTSToolFileTodolistUpdateRequest;
use App\Http\Requests\UpdateCollegeTSToolFileTodolistUpdateRequest;
use App\Repositories\CollegeTSToolFileTodolistUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTSToolFileTodolistUpdateController extends AppBaseController
{
    private $collegeTSToolFileTodolistUpdateRepository;

    public function __construct(CollegeTSToolFileTodolistUpdateRepository $collegeTSToolFileTodolistUpdateRepo)
    {
        $this->collegeTSToolFileTodolistUpdateRepository = $collegeTSToolFileTodolistUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTSToolFileTodolistUpdateRepository->pushCriteria(new RequestCriteria($request));
            $collegeTSToolFileTodolistUpdates = $this->collegeTSToolFileTodolistUpdateRepository->all();
    
            return view('college_t_s_tool_file_todolist_updates.index')
                ->with('collegeTSToolFileTodolistUpdates', $collegeTSToolFileTodolistUpdates);
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
            return view('college_t_s_tool_file_todolist_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTSToolFileTodolistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $collegeTSToolFileTodolistUpdate = $this->collegeTSToolFileTodolistUpdateRepository->create($input);
    
            Flash::success('College T S Tool File Todolist Update saved successfully.');
            return redirect(route('collegeTSToolFileTodolistUpdates.index'));
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
            $collegeTSToolFileTodolistUpdate = $this->collegeTSToolFileTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTSToolFileTodolistUpdate))
            {
                Flash::error('College T S Tool File Todolist Update not found');
                return redirect(route('collegeTSToolFileTodolistUpdates.index'));
            }
            
            if($collegeTSToolFileTodolistUpdate -> user_id == $user_id)
            {
                return view('college_t_s_tool_file_todolist_updates.show')->with('collegeTSToolFileTodolistUpdate', $collegeTSToolFileTodolistUpdate);
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
            $collegeTSToolFileTodolistUpdate = $this->collegeTSToolFileTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTSToolFileTodolistUpdate))
            {
                Flash::error('College T S Tool File Todolist Update not found');
                return redirect(route('collegeTSToolFileTodolistUpdates.index'));
            }
    
            if($collegeTSToolFileTodolistUpdate -> user_id == $user_id)
            {
                return view('college_t_s_tool_file_todolist_updates.edit')->with('collegeTSToolFileTodolistUpdate', $collegeTSToolFileTodolistUpdate);
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

    public function update($id, UpdateCollegeTSToolFileTodolistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTSToolFileTodolistUpdate = $this->collegeTSToolFileTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTSToolFileTodolistUpdate))
            {
                Flash::error('College T S Tool File Todolist Update not found');
                return redirect(route('collegeTSToolFileTodolistUpdates.index'));
            }
    
            if($collegeTSToolFileTodolistUpdate -> user_id == $user_id)
            {
                $collegeTSToolFileTodolistUpdate = $this->collegeTSToolFileTodolistUpdateRepository->update($request->all(), $id);
            
                Flash::success('College T S Tool File Todolist Update updated successfully.');
                return redirect(route('collegeTSToolFileTodolistUpdates.index'));
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
            $collegeTSToolFileTodolistUpdate = $this->collegeTSToolFileTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTSToolFileTodolistUpdate))
            {
                Flash::error('College T S Tool File Todolist Update not found');
                return redirect(route('collegeTSToolFileTodolistUpdates.index'));
            }
    
            if($collegeTSToolFileTodolistUpdate -> user_id == $user_id)
            {
                $this->collegeTSToolFileTodolistUpdateRepository->delete($id);
            
                Flash::success('College T S Tool File Todolist Update deleted successfully.');
                return redirect(route('collegeTSToolFileTodolistUpdates.index'));
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