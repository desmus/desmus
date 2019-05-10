<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUCTSPAudioCreateRequest;
use App\Http\Requests\UpdateUCTSPAudioCreateRequest;
use App\Repositories\UCTSPAudioCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UCTSPAudioCreateController extends AppBaseController
{
    private $uCTSPAudioCreateRepository;

    public function __construct(UCTSPAudioCreateRepository $uCTSPAudioCreateRepo)
    {
        $this->uCTSPAudioCreateRepository = $uCTSPAudioCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->uCTSPAudioCreateRepository->pushCriteria(new RequestCriteria($request));
            $uCTSPAudioCreates = $this->uCTSPAudioCreateRepository->all();
    
            return view('u_c_t_s_p_audio_creates.index')
                ->with('uCTSPAudioCreates', $uCTSPAudioCreates);
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
            return view('u_c_t_s_p_audio_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUCTSPAudioCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
    
            if($input -> user_id == $user_id)
            {
                $uCTSPAudioCreate = $this->uCTSPAudioCreateRepository->create($input);
            
                Flash::success('U C T S P Audio Create saved successfully.');
                return redirect(route('uCTSPAudioCreates.index'));
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
            $uCTSPAudioCreate = $this->uCTSPAudioCreateRepository->findWithoutFail($id);
    
            if(empty($uCTSPAudioCreate))
            {
                Flash::error('U C T S P Audio Create not found');
                return redirect(route('uCTSPAudioCreates.index'));
            }
            
            if($uCTSPAudioCreate -> user_id == $user_id)
            {
                return view('u_c_t_s_p_audio_creates.show')->with('uCTSPAudioCreate', $uCTSPAudioCreate);
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
            $uCTSPAudioCreate = $this->uCTSPAudioCreateRepository->findWithoutFail($id);
    
            if(empty($uCTSPAudioCreate))
            {
                Flash::error('U C T S P Audio Create not found');
                return redirect(route('uCTSPAudioCreates.index'));
            }
            
            if($uCTSPAudioCreate -> user_id == $user_id)
            {
                return view('u_c_t_s_p_audio_creates.edit')
                    ->with('uCTSPAudioCreate', $uCTSPAudioCreate);
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

    public function update($id, UpdateUCTSPAudioCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $uCTSPAudioCreate = $this->uCTSPAudioCreateRepository->findWithoutFail($id);
    
            if(empty($uCTSPAudioCreate))
            {
                Flash::error('U C T S P Audio Create not found');
                return redirect(route('uCTSPAudioCreates.index'));
            }
    
            if($uCTSPAudioCreate -> user_id == $user_id)
            {
                $uCTSPAudioCreate = $this->uCTSPAudioCreateRepository->update($request->all(), $id);
            
                Flash::success('U C T S P Audio Create updated successfully.');
                return redirect(route('uCTSPAudioCreates.index'));
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
            $uCTSPAudioCreate = $this->uCTSPAudioCreateRepository->findWithoutFail($id);
    
            if(empty($uCTSPAudioCreate))
            {
                Flash::error('U C T S P Audio Create not found');
                return redirect(route('uCTSPAudioCreates.index'));
            }
    
            if($uCTSPAudioCreate -> user_id == $user_id)
            {
                $this->uCTSPAudioCreateRepository->delete($id);
            
                Flash::success('U C T S P Audio Create deleted successfully.');
                return redirect(route('uCTSPAudioCreates.index'));
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