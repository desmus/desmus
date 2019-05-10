<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTodolistCreateRequest;
use App\Http\Requests\UpdateCollegeTodolistCreateRequest;
use App\Repositories\CollegeTodolistCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTodolistCreateController extends AppBaseController
{
    private $collegeTodolistCreateRepository;

    public function __construct(CollegeTodolistCreateRepository $collegeTodolistCreateRepo)
    {
        $this->collegeTodolistCreateRepository = $collegeTodolistCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTodolistCreateRepository->pushCriteria(new RequestCriteria($request));
            $collegeTodolistCreates = $this->collegeTodolistCreateRepository->all();
    
            return view('college_todolist_creates.index')
                ->with('collegeTodolistCreates', $collegeTodolistCreates);
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
            return view('college_todolist_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTodolistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $collegeTodolistCreate = $this->collegeTodolistCreateRepository->create($input);
    
            Flash::success('College Todolist Create saved successfully.');
            return redirect(route('collegeTodolistCreates.index'));
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
            $collegeTodolistCreate = $this->collegeTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTodolistCreate))
            {
                Flash::error('College Todolist Create not found');
                return redirect(route('collegeTodolistCreates.index'));
            }
            
            if($collegeTodolistCreate -> user_id == $user_id)
            {
                return view('college_todolist_creates.show')
                    ->with('collegeTodolistCreate', $collegeTodolistCreate);
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
            $collegeTodolistCreate = $this->collegeTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTodolistCreate))
            {
                Flash::error('College Todolist Create not found');
                return redirect(route('collegeTodolistCreates.index'));
            }
    
            if($collegeTodolistCreate -> user_id == $user_id)
            {
                return view('college_todolist_creates.edit')->with('collegeTodolistCreate', $collegeTodolistCreate);
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

    public function update($id, UpdateCollegeTodolistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTodolistCreate = $this->collegeTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTodolistCreate))
            {
                Flash::error('College Todolist Create not found');
                return redirect(route('collegeTodolistCreates.index'));
            }
    
            if($collegeTodolistCreate -> user_id == $user_id)
            {
                $collegeTodolistCreate = $this->collegeTodolistCreateRepository->update($request->all(), $id);
            
                Flash::success('College Todolist Create updated successfully.');
                return redirect(route('collegeTodolistCreates.index'));
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
            $collegeTodolistCreate = $this->collegeTodolistCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTodolistCreate))
            {
                Flash::error('College Todolist Create not found');
                return redirect(route('collegeTodolistCreates.index'));
            }
            
            if($collegeTodolistCreate -> user_id == $user_id)
            {
                $this->collegeTodolistCreateRepository->delete($id);
            
                Flash::success('College Todolist Create deleted successfully.');
                return redirect(route('collegeTodolistCreates.index'));
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