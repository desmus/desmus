<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\UpdateCollegeTSPTDeleteRequest;
use App\Repositories\CollegeTSPTDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTSPTDeleteController extends AppBaseController
{
    private $collegeTSPTDeleteRepository;

    public function __construct(CollegeTSPTDeleteRepository $collegeTSPTDeleteRepo)
    {
        $this->collegeTSPTDeleteRepository = $collegeTSPTDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTSPTDeleteRepository->pushCriteria(new RequestCriteria($request));
            $collegeTSPTDeletes = $this->collegeTSPTDeleteRepository->all();
    
            return view('college_t_s_p_t_deletes.index')
                ->with('collegeTSPTDeletes', $collegeTSPTDeletes);
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
            return view('college_t_s_p_t_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTSPTDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $collegeTSPTDelete = $this->collegeTSPTDeleteRepository->create($input);
    
            Flash::success('College T S P T Delete saved successfully.');
            return redirect(route('collegeTSPTDeletes.index'));
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
            $collegeTSPTDelete = $this->collegeTSPTDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeTSPTDelete))
            {
                Flash::error('College T S P T Delete not found');
                return redirect(route('collegeTSPTDeletes.index'));
            }
            
            if($collegeTSPTDelete -> user_id == $user_id)
            {
                return view('college_t_s_p_t_deletes.show')->with('collegeTSPTDelete', $collegeTSPTDelete);
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
            $collegeTSPTDelete = $this->collegeTSPTDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeTSPTDelete))
            {
                Flash::error('College T S P T Delete not found');
                return redirect(route('collegeTSPTDeletes.index'));
            }
    
            if($collegeTSPTDelete -> user_id == $user_id)
            {
                return view('college_t_s_p_t_deletes.edit')->with('collegeTSPTDelete', $collegeTSPTDelete);
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

    public function update($id, UpdateCollegeTSPTDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTSPTDelete = $this->collegeTSPTDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeTSPTDelete))
            {
                Flash::error('College T S P T Delete not found');
                return redirect(route('collegeTSPTDeletes.index'));
            }
            
            if($collegeTSPTDelete -> user_id == $user_id)
            {
                $collegeTSPTDelete = $this->collegeTSPTDeleteRepository->update($request->all(), $id);
            
                Flash::success('College T S P T Delete updated successfully.');
                return redirect(route('collegeTSPTDeletes.index'));
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
            $collegeTSPTDelete = $this->collegeTSPTDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeTSPTDelete))
            {
                Flash::error('College T S P T Delete not found');
                return redirect(route('collegeTSPTDeletes.index'));
            }
    
            if($collegeTSPTDelete -> user_id == $user_id)
            {
                $this->collegeTSPTDeleteRepository->delete($id);
            
                Flash::success('College T S P T Delete deleted successfully.');
                return redirect(route('collegeTSPTDeletes.index'));
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