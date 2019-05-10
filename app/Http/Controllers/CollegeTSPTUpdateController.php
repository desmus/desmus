<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTSPTUpdateRequest;
use App\Http\Requests\UpdateCollegeTSPTUpdateRequest;
use App\Repositories\CollegeTSPTUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTSPTUpdateController extends AppBaseController
{
    private $collegeTSPTUpdateRepository;

    public function __construct(CollegeTSPTUpdateRepository $collegeTSPTUpdateRepo)
    {
        $this->collegeTSPTUpdateRepository = $collegeTSPTUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTSPTUpdateRepository->pushCriteria(new RequestCriteria($request));
            $collegeTSPTUpdates = $this->collegeTSPTUpdateRepository->all();
    
            return view('college_t_s_p_t_updates.index')
                ->with('collegeTSPTUpdates', $collegeTSPTUpdates);
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
            return view('college_t_s_p_t_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTSPTUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $collegeTSPTUpdate = $this->collegeTSPTUpdateRepository->create($input);
    
            Flash::success('College T S P T Update saved successfully.');
            return redirect(route('collegeTSPTUpdates.index'));
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
            $collegeTSPTUpdate = $this->collegeTSPTUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTSPTUpdate))
            {
                Flash::error('College T S P T Update not found');
                return redirect(route('collegeTSPTUpdates.index'));
            }
    
            if($collegeTSPTUpdate -> user_id == $user_id)
            {
                return view('college_t_s_p_t_updates.show')->with('collegeTSPTUpdate', $collegeTSPTUpdate);
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
            $collegeTSPTUpdate = $this->collegeTSPTUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTSPTUpdate))
            {
                Flash::error('College T S P T Update not found');
                return redirect(route('collegeTSPTUpdates.index'));
            }
    
            if($collegeTSPTUpdate -> user_id == $user_id)
            {
                return view('college_t_s_p_t_updates.edit')->with('collegeTSPTUpdate', $collegeTSPTUpdate);
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

    public function update($id, UpdateCollegeTSPTUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTSPTUpdate = $this->collegeTSPTUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTSPTUpdate))
            {
                Flash::error('College T S P T Update not found');
                return redirect(route('collegeTSPTUpdates.index'));
            }
    
            if($collegeTSPTUpdate -> user_id == $user_id)
            {
                $collegeTSPTUpdate = $this->collegeTSPTUpdateRepository->update($request->all(), $id);
            
                Flash::success('College T S P T Update updated successfully.');
                return redirect(route('collegeTSPTUpdates.index'));
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
            $collegeTSPTUpdate = $this->collegeTSPTUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTSPTUpdate))
            {
                Flash::error('College T S P T Update not found');
                return redirect(route('collegeTSPTUpdates.index'));
            }
    
            if($collegeTSPTUpdate -> user_id == $user_id)
            {
                $this->collegeTSPTUpdateRepository->delete($id);
            
                Flash::success('College T S P T Update deleted successfully.');
                return redirect(route('collegeTSPTUpdates.index'));
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