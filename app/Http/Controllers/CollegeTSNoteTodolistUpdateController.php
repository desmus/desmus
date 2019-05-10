<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTSNoteTodolistUpdateRequest;
use App\Http\Requests\UpdateCollegeTSNoteTodolistUpdateRequest;
use App\Repositories\CollegeTSNoteTodolistUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTSNoteTodolistUpdateController extends AppBaseController
{
    private $collegeTSNoteTodolistUpdateRepository;

    public function __construct(CollegeTSNoteTodolistUpdateRepository $collegeTSNoteTodolistUpdateRepo)
    {
        $this->collegeTSNoteTodolistUpdateRepository = $collegeTSNoteTodolistUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTSNoteTodolistUpdateRepository->pushCriteria(new RequestCriteria($request));
            $collegeTSNoteTodolistUpdates = $this->collegeTSNoteTodolistUpdateRepository->all();
    
            return view('college_t_s_note_todolist_updates.index')
                ->with('collegeTSNoteTodolistUpdates', $collegeTSNoteTodolistUpdates);
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
            return view('college_t_s_note_todolist_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTSNoteTodolistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $collegeTSNoteTodolistUpdate = $this->collegeTSNoteTodolistUpdateRepository->create($input);
    
            Flash::success('College T S Note Todolist Update saved successfully.');
            return redirect(route('collegeTSNoteTodolistUpdates.index'));
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
            $collegeTSNoteTodolistUpdate = $this->collegeTSNoteTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTSNoteTodolistUpdate))
            {
                Flash::error('College T S Note Todolist Update not found');
                return redirect(route('collegeTSNoteTodolistUpdates.index'));
            }
    
            if($collegeTSNoteTodolistUpdate -> user_id == $user_id)
            {
              return view('college_t_s_note_todolist_updates.show')->with('collegeTSNoteTodolistUpdate', $collegeTSNoteTodolistUpdate);
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
            $collegeTSNoteTodolistUpdate = $this->collegeTSNoteTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTSNoteTodolistUpdate))
            {
                Flash::error('College T S Note Todolist Update not found');
                return redirect(route('collegeTSNoteTodolistUpdates.index'));
            }
    
            if($collegeTSNoteTodolistUpdate -> user_id == $user_id)
            {
              return view('college_t_s_note_todolist_updates.edit')->with('collegeTSNoteTodolistUpdate', $collegeTSNoteTodolistUpdate);
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

    public function update($id, UpdateCollegeTSNoteTodolistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTSNoteTodolistUpdate = $this->collegeTSNoteTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTSNoteTodolistUpdate))
            {
                Flash::error('College T S Note Todolist Update not found');
                return redirect(route('collegeTSNoteTodolistUpdates.index'));
            }
    
            if($collegeTSNoteTodolistUpdate -> user_id == $user_id)
            {
                $collegeTSNoteTodolistUpdate = $this->collegeTSNoteTodolistUpdateRepository->update($request->all(), $id);
            
                Flash::success('College T S Note Todolist Update updated successfully.');
                return redirect(route('collegeTSNoteTodolistUpdates.index'));
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
            $collegeTSNoteTodolistUpdate = $this->collegeTSNoteTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTSNoteTodolistUpdate))
            {
                Flash::error('College T S Note Todolist Update not found');
                return redirect(route('collegeTSNoteTodolistUpdates.index'));
            }
    
            if($collegeTSNoteTodolistUpdate -> user_id == $user_id)
            {
                $this->collegeTSNoteTodolistUpdateRepository->delete($id);
            
                Flash::success('College T S Note Todolist Update deleted successfully.');
                return redirect(route('collegeTSNoteTodolistUpdates.index'));
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