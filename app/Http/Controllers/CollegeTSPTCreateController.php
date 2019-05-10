<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTSPTCreateRequest;
use App\Http\Requests\UpdateCollegeTSPTCreateRequest;
use App\Repositories\CollegeTSPTCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTSPTCreateController extends AppBaseController
{
    private $collegeTSPTCreateRepository;

    public function __construct(CollegeTSPTCreateRepository $collegeTSPTCreateRepo)
    {
        $this->collegeTSPTCreateRepository = $collegeTSPTCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTSPTCreateRepository->pushCriteria(new RequestCriteria($request));
            $collegeTSPTCreates = $this->collegeTSPTCreateRepository->all();
    
            return view('college_t_s_p_t_creates.index')
                ->with('collegeTSPTCreates', $collegeTSPTCreates);
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
            return view('college_t_s_p_t_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTSPTCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $collegeTSPTCreate = $this->collegeTSPTCreateRepository->create($input);
    
            Flash::success('College T S P T Create saved successfully.');
            return redirect(route('collegeTSPTCreates.index'));
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
            $collegeTSPTCreate = $this->collegeTSPTCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTSPTCreate))
            {
                Flash::error('College T S P T Create not found');
                return redirect(route('collegeTSPTCreates.index'));
            }
            
            if($collegeTSPTCreate -> user_id == $user_id)
            {
                return view('college_t_s_p_t_creates.show')->with('collegeTSPTCreate', $collegeTSPTCreate);
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
            $collegeTSPTCreate = $this->collegeTSPTCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTSPTCreate))
            {
                Flash::error('College T S P T Create not found');
                return redirect(route('collegeTSPTCreates.index'));
            }
    
            if($collegeTSPTCreate -> user_id == $user_id)
            {
                return view('college_t_s_p_t_creates.edit')->with('collegeTSPTCreate', $collegeTSPTCreate);
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

    public function update($id, UpdateCollegeTSPTCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTSPTCreate = $this->collegeTSPTCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTSPTCreate))
            {
                Flash::error('College T S P T Create not found');
                return redirect(route('collegeTSPTCreates.index'));
            }
            
            if($collegeTSPTCreate -> user_id == $user_id)
            {
                $collegeTSPTCreate = $this->collegeTSPTCreateRepository->update($request->all(), $id);
            
                Flash::success('College T S P T Create updated successfully.');
                return redirect(route('collegeTSPTCreates.index'));
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
            $collegeTSPTCreate = $this->collegeTSPTCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTSPTCreate))
            {
                Flash::error('College T S P T Create not found');
                return redirect(route('collegeTSPTCreates.index'));
            }
    
            if($collegeTSPTCreate -> user_id == $user_id)
            {
                $this->collegeTSPTCreateRepository->delete($id);
            
                Flash::success('College T S P T Create deleted successfully.');
                return redirect(route('collegeTSPTCreates.index'));
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