<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUJTSPAudioUpdateRequest;
use App\Http\Requests\UpdateUJTSPAudioUpdateRequest;
use App\Repositories\UJTSPAudioUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UJTSPAudioUpdateController extends AppBaseController
{
    private $uJTSPAudioUpdateRepository;

    public function __construct(UJTSPAudioUpdateRepository $uJTSPAudioUpdateRepo)
    {
        $this->uJTSPAudioUpdateRepository = $uJTSPAudioUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->uJTSPAudioUpdateRepository->pushCriteria(new RequestCriteria($request));
            $uJTSPAudioUpdates = $this->uJTSPAudioUpdateRepository->all();
    
            return view('u_j_t_s_p_audio_updates.index')
                ->with('uJTSPAudioUpdates', $uJTSPAudioUpdates);
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
            return view('u_j_t_s_p_audio_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUJTSPAudioUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $uJTSPAudioUpdate = $this->uJTSPAudioUpdateRepository->create($input);
            
                Flash::success('U J T S P Audio Update saved successfully.');
                return redirect(route('uJTSPAudioUpdates.index'));
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
            $uJTSPAudioUpdate = $this->uJTSPAudioUpdateRepository->findWithoutFail($id);
    
            if (empty($uJTSPAudioUpdate))
            {
                Flash::error('U J T S P Audio Update not found');
                return redirect(route('uJTSPAudioUpdates.index'));
            }
            
            if($uJTSPAudioUpdate -> user_id == $user_id)
            {
                return view('u_j_t_s_p_audio_updates.show')
                    ->with('uJTSPAudioUpdate', $uJTSPAudioUpdate);
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
            $uJTSPAudioUpdate = $this->uJTSPAudioUpdateRepository->findWithoutFail($id);
    
            if (empty($uJTSPAudioUpdate))
            {
                Flash::error('U J T S P Audio Update not found');
                return redirect(route('uJTSPAudioUpdates.index'));
            }
    
            if($uJTSPAudioUpdate -> user_id == $user_id)
            {
                return view('u_j_t_s_p_audio_updates.edit')
                    ->with('uJTSPAudioUpdate', $uJTSPAudioUpdate);
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

    public function update($id, UpdateUJTSPAudioUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $uJTSPAudioUpdate = $this->uJTSPAudioUpdateRepository->findWithoutFail($id);
    
            if (empty($uJTSPAudioUpdate))
            {
                Flash::error('U J T S P Audio Update not found');
                return redirect(route('uJTSPAudioUpdates.index'));
            }
    
            if($uJTSPAudioUpdate -> user_id == $user_id)
            {
                $uJTSPAudioUpdate = $this->uJTSPAudioUpdateRepository->update($request->all(), $id);
            
                Flash::success('U J T S P Audio Update updated successfully.');
                return redirect(route('uJTSPAudioUpdates.index'));
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
            $uJTSPAudioUpdate = $this->uJTSPAudioUpdateRepository->findWithoutFail($id);
    
            if (empty($uJTSPAudioUpdate))
            {
                Flash::error('U J T S P Audio Update not found');
                return redirect(route('uJTSPAudioUpdates.index'));
            }
    
            if($uJTSPAudioUpdate -> user_id == $user_id)
            {
                $this->uJTSPAudioUpdateRepository->delete($id);
            
                Flash::success('U J T S P Audio Update deleted successfully.');
                return redirect(route('uJTSPAudioUpdates.index'));
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