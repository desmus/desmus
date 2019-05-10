<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUPTSPAudioUpdateRequest;
use App\Http\Requests\UpdateUPTSPAudioUpdateRequest;
use App\Repositories\UPTSPAudioUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UPTSPAudioUpdateController extends AppBaseController
{
    private $uPTSPAudioUpdateRepository;

    public function __construct(UPTSPAudioUpdateRepository $uPTSPAudioUpdateRepo)
    {
        $this->uPTSPAudioUpdateRepository = $uPTSPAudioUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->uPTSPAudioUpdateRepository->pushCriteria(new RequestCriteria($request));
            $uPTSPAudioUpdates = $this->uPTSPAudioUpdateRepository->all();
    
            return view('u_p_t_s_p_audio_updates.index')
                ->with('uPTSPAudioUpdates', $uPTSPAudioUpdates);
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
            return view('u_p_t_s_p_audio_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUPTSPAudioUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $uPTSPAudioUpdate = $this->uPTSPAudioUpdateRepository->create($input);
            
                Flash::success('U P T S P Audio Update saved successfully.');
                return redirect(route('uPTSPAudioUpdates.index'));
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
            $uPTSPAudioUpdate = $this->uPTSPAudioUpdateRepository->findWithoutFail($id);
    
            if(empty($uPTSPAudioUpdate))
            {
                Flash::error('U P T S P Audio Update not found');
                return redirect(route('uPTSPAudioUpdates.index'));
            }
    
            if($uPTSPAudioUpdate -> user_id == $user_id)
            {
                return view('u_p_t_s_p_audio_updates.show')
                    ->with('uPTSPAudioUpdate', $uPTSPAudioUpdate);
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
            $uPTSPAudioUpdate = $this->uPTSPAudioUpdateRepository->findWithoutFail($id);
    
            if(empty($uPTSPAudioUpdate))
            {
                Flash::error('U P T S P Audio Update not found');
                return redirect(route('uPTSPAudioUpdates.index'));
            }
    
            if($uPTSPAudioUpdate -> user_id == $user_id)
            {
                return view('u_p_t_s_p_audio_updates.edit')
                    ->with('uPTSPAudioUpdate', $uPTSPAudioUpdate);
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

    public function update($id, UpdateUPTSPAudioUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $uPTSPAudioUpdate = $this->uPTSPAudioUpdateRepository->findWithoutFail($id);
    
            if(empty($uPTSPAudioUpdate))
            {
                Flash::error('U P T S P Audio Update not found');
                return redirect(route('uPTSPAudioUpdates.index'));
            }
    
            if($uPTSPAudioUpdate -> user_id == $user_id)
            {
                $uPTSPAudioUpdate = $this->uPTSPAudioUpdateRepository->update($request->all(), $id);
            
                Flash::success('U P T S P Audio Update updated successfully.');
                return redirect(route('uPTSPAudioUpdates.index'));
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
            $uPTSPAudioUpdate = $this->uPTSPAudioUpdateRepository->findWithoutFail($id);
    
            if(empty($uPTSPAudioUpdate))
            {
                Flash::error('U P T S P Audio Update not found');
                return redirect(route('uPTSPAudioUpdates.index'));
            }
    
            if($uPTSPAudioUpdate -> user_id == $user_id)
            {
                $this->uPTSPAudioUpdateRepository->delete($id);
            
                Flash::success('U P T S P Audio Update deleted successfully.');
                return redirect(route('uPTSPAudioUpdates.index'));
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