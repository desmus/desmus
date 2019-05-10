<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUPDTSPAudioUpdateRequest;
use App\Http\Requests\UpdateUPDTSPAudioUpdateRequest;
use App\Repositories\UPDTSPAudioUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UPDTSPAudioUpdateController extends AppBaseController
{
    private $uPDTSPAudioUpdateRepository;

    public function __construct(UPDTSPAudioUpdateRepository $uPDTSPAudioUpdateRepo)
    {
        $this->uPDTSPAudioUpdateRepository = $uPDTSPAudioUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->uPDTSPAudioUpdateRepository->pushCriteria(new RequestCriteria($request));
            $uPDTSPAudioUpdates = $this->uPDTSPAudioUpdateRepository->all();
    
            return view('u_p_d_t_s_p_audio_updates.index')
                ->with('uPDTSPAudioUpdates', $uPDTSPAudioUpdates);
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
            return view('u_p_d_t_s_p_audio_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUPDTSPAudioUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $uPDTSPAudioUpdate = $this->uPDTSPAudioUpdateRepository->create($input);
            
                Flash::success('U P D T S P Audio Update saved successfully.');
                return redirect(route('uPDTSPAudioUpdates.index'));
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
            $uPDTSPAudioUpdate = $this->uPDTSPAudioUpdateRepository->findWithoutFail($id);
    
            if(empty($uPDTSPAudioUpdate))
            {
                Flash::error('U P D T S P Audio Update not found');
                return redirect(route('uPDTSPAudioUpdates.index'));
            }
    
            if($uPDTSPAudioUpdate -> user_id == $user_id)
            {
                return view('u_p_d_t_s_p_audio_updates.show')
                    ->with('uPDTSPAudioUpdate', $uPDTSPAudioUpdate);
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
            $uPDTSPAudioUpdate = $this->uPDTSPAudioUpdateRepository->findWithoutFail($id);
    
            if(empty($uPDTSPAudioUpdate))
            {
                Flash::error('U P D T S P Audio Update not found');
                return redirect(route('uPDTSPAudioUpdates.index'));
            }
    
            if($uPDTSPAudioUpdate -> user_id == $user_id)
            {
                return view('u_p_d_t_s_p_audio_updates.edit')
                    ->with('uPDTSPAudioUpdate', $uPDTSPAudioUpdate);
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

    public function update($id, UpdateUPDTSPAudioUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $uPDTSPAudioUpdate = $this->uPDTSPAudioUpdateRepository->findWithoutFail($id);
    
            if(empty($uPDTSPAudioUpdate))
            {
                Flash::error('U P D T S P Audio Update not found');
                return redirect(route('uPDTSPAudioUpdates.index'));
            }
    
            if($uPDTSPAudioUpdate -> user_id == $user_id)
            {
                $uPDTSPAudioUpdate = $this->uPDTSPAudioUpdateRepository->update($request->all(), $id);
            
                Flash::success('U P D T S P Audio Update updated successfully.');
                return redirect(route('uPDTSPAudioUpdates.index'));
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
            $uPDTSPAudioUpdate = $this->uPDTSPAudioUpdateRepository->findWithoutFail($id);
    
            if(empty($uPDTSPAudioUpdate))
            {
                Flash::error('U P D T S P Audio Update not found');
                return redirect(route('uPDTSPAudioUpdates.index'));
            }
    
            if($uPDTSPAudioUpdate -> user_id == $user_id)
            {
                $this->uPDTSPAudioUpdateRepository->delete($id);
            
                Flash::success('U P D T S P Audio Update deleted successfully.');
                return redirect(route('uPDTSPAudioUpdates.index'));
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