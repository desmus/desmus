<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTSGaleryTodolistUpdateRequest;
use App\Http\Requests\UpdateCollegeTSGaleryTodolistUpdateRequest;
use App\Repositories\CollegeTSGaleryTodolistUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTSGaleryTodolistUpdateController extends AppBaseController
{
    private $collegeTSGaleryTodolistUpdateRepository;

    public function __construct(CollegeTSGaleryTodolistUpdateRepository $collegeTSGaleryTodolistUpdateRepo)
    {
        $this->collegeTSGaleryTodolistUpdateRepository = $collegeTSGaleryTodolistUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTSGaleryTodolistUpdateRepository->pushCriteria(new RequestCriteria($request));
            $collegeTSGaleryTodolistUpdates = $this->collegeTSGaleryTodolistUpdateRepository->all();
    
            return view('college_t_s_galery_todolist_updates.index')
                ->with('collegeTSGaleryTodolistUpdates', $collegeTSGaleryTodolistUpdates);
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
            return view('college_t_s_galery_todolist_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTSGaleryTodolistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $collegeTSGaleryTodolistUpdate = $this->collegeTSGaleryTodolistUpdateRepository->create($input);
    
            Flash::success('College T S Galery Todolist Update saved successfully.');
            return redirect(route('collegeTSGaleryTodolistUpdates.index'));
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
            $collegeTSGaleryTodolistUpdate = $this->collegeTSGaleryTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTSGaleryTodolistUpdate))
            {
                Flash::error('College T S Galery Todolist Update not found');
                return redirect(route('collegeTSGaleryTodolistUpdates.index'));
            }
    
            if($collegeTSGaleryTodolistUpdate -> user_id == $user_id)
            {
                return view('college_t_s_galery_todolist_updates.show')->with('collegeTSGaleryTodolistUpdate', $collegeTSGaleryTodolistUpdate);
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
            $collegeTSGaleryTodolistUpdate = $this->collegeTSGaleryTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTSGaleryTodolistUpdate))
            {
                Flash::error('College T S Galery Todolist Update not found');
                return redirect(route('collegeTSGaleryTodolistUpdates.index'));
            }
            
            if($collegeTSGaleryTodolistUpdate -> user_id == $user_id)
            {
                return view('college_t_s_galery_todolist_updates.edit')->with('collegeTSGaleryTodolistUpdate', $collegeTSGaleryTodolistUpdate);
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

    public function update($id, UpdateCollegeTSGaleryTodolistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTSGaleryTodolistUpdate = $this->collegeTSGaleryTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTSGaleryTodolistUpdate))
            {
                Flash::error('College T S Galery Todolist Update not found');
                return redirect(route('collegeTSGaleryTodolistUpdates.index'));
            }
    
            if($collegeTSGaleryTodolistUpdate -> user_id == $user_id)
            {
                $collegeTSGaleryTodolistUpdate = $this->collegeTSGaleryTodolistUpdateRepository->update($request->all(), $id);
            
                Flash::success('College T S Galery Todolist Update updated successfully.');
                return redirect(route('collegeTSGaleryTodolistUpdates.index'));
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
            $collegeTSGaleryTodolistUpdate = $this->collegeTSGaleryTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTSGaleryTodolistUpdate))
            {
                Flash::error('College T S Galery Todolist Update not found');
                return redirect(route('collegeTSGaleryTodolistUpdates.index'));
            }
    
            if($collegeTSGaleryTodolistUpdate -> user_id == $user_id)
            {
                $this->collegeTSGaleryTodolistUpdateRepository->delete($id);
            
                Flash::success('College T S Galery Todolist Update deleted successfully.');
                return redirect(route('collegeTSGaleryTodolistUpdates.index'));
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