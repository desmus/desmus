<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUPTSPAudioCreateRequest;
use App\Http\Requests\UpdateUPTSPAudioCreateRequest;
use App\Repositories\UPTSPAudioCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UPTSPAudioCreateController extends AppBaseController
{
    private $uPTSPAudioCreateRepository;

    public function __construct(UPTSPAudioCreateRepository $uPTSPAudioCreateRepo)
    {
        $this->uPTSPAudioCreateRepository = $uPTSPAudioCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->uPTSPAudioCreateRepository->pushCriteria(new RequestCriteria($request));
            $uPTSPAudioCreates = $this->uPTSPAudioCreateRepository->all();
    
            return view('u_p_t_s_p_audio_creates.index')
                ->with('uPTSPAudioCreates', $uPTSPAudioCreates);
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
            return view('u_p_t_s_p_audio_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUPTSPAudioCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $uPTSPAudioCreate = $this->uPTSPAudioCreateRepository->create($input);
            
                Flash::success('U P T S P Audio Create saved successfully.');
                return redirect(route('uPTSPAudioCreates.index'));
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
            $uPTSPAudioCreate = $this->uPTSPAudioCreateRepository->findWithoutFail($id);
    
            if(empty($uPTSPAudioCreate))
            {
                Flash::error('U P T S P Audio Create not found');
                return redirect(route('uPTSPAudioCreates.index'));
            }
    
            if($uPTSPAudioCreate -> user_id == $user_id)
            {
                return view('u_p_t_s_p_audio_creates.show')
                    ->with('uPTSPAudioCreate', $uPTSPAudioCreate);
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
            $uPTSPAudioCreate = $this->uPTSPAudioCreateRepository->findWithoutFail($id);
    
            if(empty($uPTSPAudioCreate))
            {
                Flash::error('U P T S P Audio Create not found');
                return redirect(route('uPTSPAudioCreates.index'));
            }
    
            if($uPTSPAudioCreate -> user_id == $user_id)
            {
                return view('u_p_t_s_p_audio_creates.edit')
                    ->with('uPTSPAudioCreate', $uPTSPAudioCreate);
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

    public function update($id, UpdateUPTSPAudioCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $uPTSPAudioCreate = $this->uPTSPAudioCreateRepository->findWithoutFail($id);
    
            if(empty($uPTSPAudioCreate))
            {
                Flash::error('U P T S P Audio Create not found');
                return redirect(route('uPTSPAudioCreates.index'));
            }
    
            if($uPTSPAudioCreate -> user_id == $user_id)
            {
                $uPTSPAudioCreate = $this->uPTSPAudioCreateRepository->update($request->all(), $id);
            
                Flash::success('U P T S P Audio Create updated successfully.');
                return redirect(route('uPTSPAudioCreates.index'));
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
            $uPTSPAudioCreate = $this->uPTSPAudioCreateRepository->findWithoutFail($id);
    
            if(empty($uPTSPAudioCreate))
            {
                Flash::error('U P T S P Audio Create not found');
                return redirect(route('uPTSPAudioCreates.index'));
            }
    
            if($uPTSPAudioCreate -> user_id == $user_id)
            {
                $this->uPTSPAudioCreateRepository->delete($id);
            
                Flash::success('U P T S P Audio Create deleted successfully.');
                return redirect(route('uPTSPAudioCreates.index'));
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