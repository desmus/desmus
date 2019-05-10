<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTSToolTodolistUpdateRequest;
use App\Http\Requests\UpdateCollegeTSToolTodolistUpdateRequest;
use App\Repositories\CollegeTSToolTodolistUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTSToolTodolistUpdateController extends AppBaseController
{
    private $collegeTSToolTodolistUpdateRepository;

    public function __construct(CollegeTSToolTodolistUpdateRepository $collegeTSToolTodolistUpdateRepo)
    {
        $this->collegeTSToolTodolistUpdateRepository = $collegeTSToolTodolistUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTSToolTodolistUpdateRepository->pushCriteria(new RequestCriteria($request));
            $collegeTSToolTodolistUpdates = $this->collegeTSToolTodolistUpdateRepository->all();
    
            return view('college_t_s_tool_todolist_updates.index')
                ->with('collegeTSToolTodolistUpdates', $collegeTSToolTodolistUpdates);
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
            return view('college_t_s_tool_todolist_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTSToolTodolistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $collegeTSToolTodolistUpdate = $this->collegeTSToolTodolistUpdateRepository->create($input);
    
            Flash::success('College T S Tool Todolist Update saved successfully.');
            return redirect(route('collegeTSToolTodolistUpdates.index'));
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
            $collegeTSToolTodolistUpdate = $this->collegeTSToolTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTSToolTodolistUpdate))
            {
                Flash::error('College T S Tool Todolist Update not found');
                return redirect(route('collegeTSToolTodolistUpdates.index'));
            }
            
            if($collegeTSToolTodolistUpdate -> user_id == $user_id)
            {
                return view('college_t_s_tool_todolist_updates.show')->with('collegeTSToolTodolistUpdate', $collegeTSToolTodolistUpdate);
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
            $collegeTSToolTodolistUpdate = $this->collegeTSToolTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTSToolTodolistUpdate))
            {
                Flash::error('College T S Tool Todolist Update not found');
                return redirect(route('collegeTSToolTodolistUpdates.index'));
            }
    
            if($collegeTSToolTodolistUpdate -> user_id == $user_id)
            {
                return view('college_t_s_tool_todolist_updates.edit')->with('collegeTSToolTodolistUpdate', $collegeTSToolTodolistUpdate);
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

    public function update($id, UpdateCollegeTSToolTodolistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTSToolTodolistUpdate = $this->collegeTSToolTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTSToolTodolistUpdate))
            {
                Flash::error('College T S Tool Todolist Update not found');
                return redirect(route('collegeTSToolTodolistUpdates.index'));
            }
    
            if($collegeTSToolTodolistUpdate -> user_id == $user_id)
            {
                $collegeTSToolTodolistUpdate = $this->collegeTSToolTodolistUpdateRepository->update($request->all(), $id);
            
                Flash::success('College T S Tool Todolist Update updated successfully.');
                return redirect(route('collegeTSToolTodolistUpdates.index'));
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
            $collegeTSToolTodolistUpdate = $this->collegeTSToolTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTSToolTodolistUpdate))
            {
                Flash::error('College T S Tool Todolist Update not found');
                return redirect(route('collegeTSToolTodolistUpdates.index'));
            }
            
            if($collegeTSToolTodolistUpdate -> user_id == $user_id)
            {
                $this->collegeTSToolTodolistUpdateRepository->delete($id);
            
                Flash::success('College T S Tool Todolist Update deleted successfully.');
                return redirect(route('collegeTSToolTodolistUpdates.index'));
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