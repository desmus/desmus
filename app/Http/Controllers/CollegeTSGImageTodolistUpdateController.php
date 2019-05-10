<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTSGImageTodolistUpdateRequest;
use App\Http\Requests\UpdateCollegeTSGImageTodolistUpdateRequest;
use App\Repositories\CollegeTSGImageTodolistUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTSGImageTodolistUpdateController extends AppBaseController
{
    private $collegeTSGImageTodolistUpdateRepository;

    public function __construct(CollegeTSGImageTodolistUpdateRepository $collegeTSGImageTodolistUpdateRepo)
    {
        $this->collegeTSGImageTodolistUpdateRepository = $collegeTSGImageTodolistUpdateRepo;
    }
    
    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTSGImageTodolistUpdateRepository->pushCriteria(new RequestCriteria($request));
            $collegeTSGImageTodolistUpdates = $this->collegeTSGImageTodolistUpdateRepository->all();
    
            return view('college_t_s_g_image_todolist_updates.index')
                ->with('collegeTSGImageTodolistUpdates', $collegeTSGImageTodolistUpdates);
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
            return view('college_t_s_g_image_todolist_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTSGImageTodolistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $collegeTSGImageTodolistUpdate = $this->collegeTSGImageTodolistUpdateRepository->create($input);
    
            Flash::success('College T S G Image Todolist Update saved successfully.');
            return redirect(route('collegeTSGImageTodolistUpdates.index'));
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
            $collegeTSGImageTodolistUpdate = $this->collegeTSGImageTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTSGImageTodolistUpdate))
            {
                Flash::error('College T S G Image Todolist Update not found');
                return redirect(route('collegeTSGImageTodolistUpdates.index'));
            }
            
            if($collegeTSGImageTodolistUpdate -> user_id == $user_id)
            {
                return view('college_t_s_g_image_todolist_updates.show')
                    ->with('collegeTSGImageTodolistUpdate', $collegeTSGImageTodolistUpdate);
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
            $collegeTSGImageTodolistUpdate = $this->collegeTSGImageTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTSGImageTodolistUpdate))
            {
                Flash::error('College T S G Image Todolist Update not found');
                return redirect(route('collegeTSGImageTodolistUpdates.index'));
            }
    
            if($collegeTSGImageTodolistUpdate -> user_id == $user_id)
            {
                return view('college_t_s_g_image_todolist_updates.edit')->with('collegeTSGImageTodolistUpdate', $collegeTSGImageTodolistUpdate);
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

    public function update($id, UpdateCollegeTSGImageTodolistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTSGImageTodolistUpdate = $this->collegeTSGImageTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTSGImageTodolistUpdate))
            {
                Flash::error('College T S G Image Todolist Update not found');
                return redirect(route('collegeTSGImageTodolistUpdates.index'));
            }
    
            if($collegeTSGImageTodolistUpdate -> user_id == $user_id)
            {
                $collegeTSGImageTodolistUpdate = $this->collegeTSGImageTodolistUpdateRepository->update($request->all(), $id);
            
                Flash::success('College T S G Image Todolist Update updated successfully.');
                return redirect(route('collegeTSGImageTodolistUpdates.index'));
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
            $collegeTSGImageTodolistUpdate = $this->collegeTSGImageTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTSGImageTodolistUpdate))
            {
                Flash::error('College T S G Image Todolist Update not found');
                return redirect(route('collegeTSGImageTodolistUpdates.index'));
            }
            
            if($collegeTSGImageTodolistUpdate -> user_id == $user_id)
            {
                $this->collegeTSGImageTodolistUpdateRepository->delete($id);
            
                Flash::success('College T S G Image Todolist Update deleted successfully.');
                return redirect(route('collegeTSGImageTodolistUpdates.index'));
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