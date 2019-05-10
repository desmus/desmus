<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUJTSPAudioCreateRequest;
use App\Http\Requests\UpdateUJTSPAudioCreateRequest;
use App\Repositories\UJTSPAudioCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UJTSPAudioCreateController extends AppBaseController
{
    private $uJTSPAudioCreateRepository;

    public function __construct(UJTSPAudioCreateRepository $uJTSPAudioCreateRepo)
    {
        $this->uJTSPAudioCreateRepository = $uJTSPAudioCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->uJTSPAudioCreateRepository->pushCriteria(new RequestCriteria($request));
            $uJTSPAudioCreates = $this->uJTSPAudioCreateRepository->all();
    
            return view('u_j_t_s_p_audio_creates.index')
                ->with('uJTSPAudioCreates', $uJTSPAudioCreates);
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
            return view('u_j_t_s_p_audio_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUJTSPAudioCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $uJTSPAudioCreate = $this->uJTSPAudioCreateRepository->create($input);
            
                Flash::success('U J T S P Audio Create saved successfully.');
                return redirect(route('uJTSPAudioCreates.index'));
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

    public function show($id)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $uJTSPAudioCreate = $this->uJTSPAudioCreateRepository->findWithoutFail($id);
    
            if(empty($uJTSPAudioCreate))
            {
                Flash::error('U J T S P Audio Create not found');
                return redirect(route('uJTSPAudioCreates.index'));
            }
            
            if($uJTSPAudioCreate -> user_id == $user_id)
            {
                return view('u_j_t_s_p_audio_creates.show')
                    ->with('uJTSPAudioCreate', $uJTSPAudioCreate);
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
            $uJTSPAudioCreate = $this->uJTSPAudioCreateRepository->findWithoutFail($id);
    
            if(empty($uJTSPAudioCreate))
            {
                Flash::error('U J T S P Audio Create not found');
                return redirect(route('uJTSPAudioCreates.index'));
            }
    
            if($uJTSPAudioCreate -> user_id == $user_id)
            {
                return view('u_j_t_s_p_audio_creates.edit')
                    ->with('uJTSPAudioCreate', $uJTSPAudioCreate);
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

    public function update($id, UpdateUJTSPAudioCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $uJTSPAudioCreate = $this->uJTSPAudioCreateRepository->findWithoutFail($id);
    
            if(empty($uJTSPAudioCreate))
            {
                Flash::error('U J T S P Audio Create not found');
                return redirect(route('uJTSPAudioCreates.index'));
            }
    
            if($uJTSPAudioCreate -> user_id == $user_id)
            {
                $uJTSPAudioCreate = $this->uJTSPAudioCreateRepository->update($request->all(), $id);
            
                Flash::success('U J T S P Audio Create updated successfully.');
                return redirect(route('uJTSPAudioCreates.index'));
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
            $uJTSPAudioCreate = $this->uJTSPAudioCreateRepository->findWithoutFail($id);
    
            if(empty($uJTSPAudioCreate))
            {
                Flash::error('U J T S P Audio Create not found');
                return redirect(route('uJTSPAudioCreates.index'));
            }
    
            if($uJTSPAudioCreate -> user_id == $user_id)
            {
                $this->uJTSPAudioCreateRepository->delete($id);
            
                Flash::success('U J T S P Audio Create deleted successfully.');
                return redirect(route('uJTSPAudioCreates.index'));
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