<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUPDTSPAudioCreateRequest;
use App\Http\Requests\UpdateUPDTSPAudioCreateRequest;
use App\Repositories\UPDTSPAudioCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UPDTSPAudioCreateController extends AppBaseController
{
    private $uPDTSPAudioCreateRepository;

    public function __construct(UPDTSPAudioCreateRepository $uPDTSPAudioCreateRepo)
    {
        $this->uPDTSPAudioCreateRepository = $uPDTSPAudioCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->uPDTSPAudioCreateRepository->pushCriteria(new RequestCriteria($request));
            $uPDTSPAudioCreates = $this->uPDTSPAudioCreateRepository->all();
    
            return view('u_p_d_t_s_p_audio_creates.index')
                ->with('uPDTSPAudioCreates', $uPDTSPAudioCreates);
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
            return view('u_p_d_t_s_p_audio_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUPDTSPAudioCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $uPDTSPAudioCreate = $this->uPDTSPAudioCreateRepository->create($input);
            
                Flash::success('U P D T S P Audio Create saved successfully.');
                return redirect(route('uPDTSPAudioCreates.index'));
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
            $uPDTSPAudioCreate = $this->uPDTSPAudioCreateRepository->findWithoutFail($id);
    
            if(empty($uPDTSPAudioCreate))
            {
                Flash::error('U P D T S P Audio Create not found');
                return redirect(route('uPDTSPAudioCreates.index'));
            }
    
            if($uPDTSPAudioCreate -> user_id == $user_id)
            {
                return view('u_p_d_t_s_p_audio_creates.show')
                    ->with('uPDTSPAudioCreate', $uPDTSPAudioCreate);
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
            $uPDTSPAudioCreate = $this->uPDTSPAudioCreateRepository->findWithoutFail($id);
    
            if(empty($uPDTSPAudioCreate))
            {
                Flash::error('U P D T S P Audio Create not found');
                return redirect(route('uPDTSPAudioCreates.index'));
            }
    
            if($uPDTSPAudioCreate -> user_id == $user_id)
            {
                return view('u_p_d_t_s_p_audio_creates.edit')
                    ->with('uPDTSPAudioCreate', $uPDTSPAudioCreate);
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

    public function update($id, UpdateUPDTSPAudioCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $uPDTSPAudioCreate = $this->uPDTSPAudioCreateRepository->findWithoutFail($id);
    
            if(empty($uPDTSPAudioCreate))
            {
                Flash::error('U P D T S P Audio Create not found');
                return redirect(route('uPDTSPAudioCreates.index'));
            }
    
            if($uPDTSPAudioCreate -> user_id == $user_id)
            {
                $uPDTSPAudioCreate = $this->uPDTSPAudioCreateRepository->update($request->all(), $id);
            
                Flash::success('U P D T S P Audio Create updated successfully.');
                return redirect(route('uPDTSPAudioCreates.index'));
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
            $uPDTSPAudioCreate = $this->uPDTSPAudioCreateRepository->findWithoutFail($id);
    
            if (empty($uPDTSPAudioCreate))
            {
                Flash::error('U P D T S P Audio Create not found');
                return redirect(route('uPDTSPAudioCreates.index'));
            }
    
            if($uPDTSPAudioCreate -> user_id == $user_id)
            {
                $this->uPDTSPAudioCreateRepository->delete($id);
            
                Flash::success('U P D T S P Audio Create deleted successfully.');
                return redirect(route('uPDTSPAudioCreates.index'));
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