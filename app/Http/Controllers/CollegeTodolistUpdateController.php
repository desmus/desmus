<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTodolistUpdateRequest;
use App\Http\Requests\UpdateCollegeTodolistUpdateRequest;
use App\Repositories\CollegeTodolistUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTodolistUpdateController extends AppBaseController
{
    private $collegeTodolistUpdateRepository;

    public function __construct(CollegeTodolistUpdateRepository $collegeTodolistUpdateRepo)
    {
        $this->collegeTodolistUpdateRepository = $collegeTodolistUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTodolistUpdateRepository->pushCriteria(new RequestCriteria($request));
            $collegeTodolistUpdates = $this->collegeTodolistUpdateRepository->all();

            return view('college_todolist_updates.index')
                ->with('collegeTodolistUpdates', $collegeTodolistUpdates);
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
            return view('college_todolist_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTodolistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $collegeTodolistUpdate = $this->collegeTodolistUpdateRepository->create($input);

            Flash::success('College Todolist Update saved successfully.');
            return redirect(route('collegeTodolistUpdates.index'));
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
            $collegeTodolistUpdate = $this->collegeTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTodolistUpdate))
            {
                Flash::error('College Todolist Update not found');
                return redirect(route('collegeTodolistUpdates.index'));
            }
            
            if($collegeTodolistUpdate -> user_id == $user_id)
            {
                return view('college_todolist_updates.show')->with('collegeTodolistUpdate', $collegeTodolistUpdate);
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
            $collegeTodolistUpdate = $this->collegeTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTodolistUpdate))
            {
                Flash::error('College Todolist Update not found');
                return redirect(route('collegeTodolistUpdates.index'));
            }
            
            if($collegeTodolistUpdate -> user_id == $user_id)
            {
                return view('college_todolist_updates.edit')->with('collegeTodolistUpdate', $collegeTodolistUpdate);
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

    public function update($id, UpdateCollegeTodolistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTodolistUpdate = $this->collegeTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTodolistUpdate))
            {
                Flash::error('College Todolist Update not found');
                return redirect(route('collegeTodolistUpdates.index'));
            }
            
            if($collegeTodolistUpdate -> user_id == $user_id)
            {
                $collegeTodolistUpdate = $this->collegeTodolistUpdateRepository->update($request->all(), $id);
            
                Flash::success('College Todolist Update updated successfully.');
                return redirect(route('collegeTodolistUpdates.index'));
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
            $collegeTodolistUpdate = $this->collegeTodolistUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTodolistUpdate))
            {
                Flash::error('College Todolist Update not found');
                return redirect(route('collegeTodolistUpdates.index'));
            }
    
            if($collegeTodolistUpdate -> user_id == $user_id)
            {
                $this->collegeTodolistUpdateRepository->delete($id);
            
                Flash::success('College Todolist Update deleted successfully.');
                return redirect(route('collegeTodolistUpdates.index'));
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