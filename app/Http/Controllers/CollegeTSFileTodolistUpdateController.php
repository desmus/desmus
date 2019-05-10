<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTSFileTodolistUpdateRequest;
use App\Http\Requests\UpdateCollegeTSFileTodolistUpdateRequest;
use App\Repositories\CollegeTSFileTodolistUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTSFileTodolistUpdateController extends AppBaseController
{
    private $collegeTSFileTodolistUpdateRepository;

    public function __construct(CollegeTSFileTodolistUpdateRepository $collegeTSFileTodolistUpdateRepo)
    {
        $this->collegeTSFileTodolistUpdateRepository = $collegeTSFileTodolistUpdateRepo;
    }
    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTSFileTodolistUpdateRepository->pushCriteria(new RequestCriteria($request));
            $collegeTSFileTodolistUpdates = $this->collegeTSFileTodolistUpdateRepository->all();
    
            return view('college_t_s_file_todolist_updates.index')
                ->with('collegeTSFileTodolistUpdates', $collegeTSFileTodolistUpdates);
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
            return view('college_t_s_file_todolist_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }
    
    public function store(CreateCollegeTSFileTodolistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $collegeTSFileTodolistUpdate = $this->collegeTSFileTodolistUpdateRepository->create($input);
    
            Flash::success('College T S File Todolist Update saved successfully.');
            return redirect(route('collegeTSFileTodolistUpdates.index'));
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
            $collegeTSFileTodolistUpdate = $this->collegeTSFileTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTSFileTodolistUpdate))
            {
                Flash::error('College T S File Todolist Update not found');
                return redirect(route('collegeTSFileTodolistUpdates.index'));
            }
    
            if($collegeTSFileTodolistUpdate -> user_id == $user_id)
            {
                return view('college_t_s_file_todolist_updates.show')->with('collegeTSFileTodolistUpdate', $collegeTSFileTodolistUpdate);
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
            $collegeTSFileTodolistUpdate = $this->collegeTSFileTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTSFileTodolistUpdate))
            {
                Flash::error('College T S File Todolist Update not found');
                return redirect(route('collegeTSFileTodolistUpdates.index'));
            }
    
            if($collegeTSFileTodolistUpdate -> user_id == $user_id)
            {
                return view('college_t_s_file_todolist_updates.edit')->with('collegeTSFileTodolistUpdate', $collegeTSFileTodolistUpdate);
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
    
    public function update($id, UpdateCollegeTSFileTodolistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTSFileTodolistUpdate = $this->collegeTSFileTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTSFileTodolistUpdate))
            {
                Flash::error('College T S File Todolist Update not found');
                return redirect(route('collegeTSFileTodolistUpdates.index'));
            }
    
            if($collegeTSFileTodolistUpdate -> user_id == $user_id)
            {
                $collegeTSFileTodolistUpdate = $this->collegeTSFileTodolistUpdateRepository->update($request->all(), $id);
            
                Flash::success('College T S File Todolist Update updated successfully.');
                return redirect(route('collegeTSFileTodolistUpdates.index'));
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
            $collegeTSFileTodolistUpdate = $this->collegeTSFileTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTSFileTodolistUpdate))
            {
                Flash::error('College T S File Todolist Update not found');
                return redirect(route('collegeTSFileTodolistUpdates.index'));
            }
            
            if($collegeTSFileTodolistUpdate -> user_id == $user_id)
            {
                $this->collegeTSFileTodolistUpdateRepository->delete($id);
            
                Flash::success('College T S File Todolist Update deleted successfully.');
                return redirect(route('collegeTSFileTodolistUpdates.index'));
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