<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUCTSPAudioUpdateRequest;
use App\Http\Requests\UpdateUCTSPAudioUpdateRequest;
use App\Repositories\UCTSPAudioUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UCTSPAudioUpdateController extends AppBaseController
{
    private $uCTSPAudioUpdateRepository;

    public function __construct(UCTSPAudioUpdateRepository $uCTSPAudioUpdateRepo)
    {
        $this->uCTSPAudioUpdateRepository = $uCTSPAudioUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->uCTSPAudioUpdateRepository->pushCriteria(new RequestCriteria($request));
            $uCTSPAudioUpdates = $this->uCTSPAudioUpdateRepository->all();
    
            return view('u_c_t_s_p_audio_updates.index')
                ->with('uCTSPAudioUpdates', $uCTSPAudioUpdates);
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
            return view('u_c_t_s_p_audio_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUCTSPAudioUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $uCTSPAudioUpdate = $this->uCTSPAudioUpdateRepository->create($input);
            
                Flash::success('U C T S P Audio Update saved successfully.');
                return redirect(route('uCTSPAudioUpdates.index'));
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
            $uCTSPAudioUpdate = $this->uCTSPAudioUpdateRepository->findWithoutFail($id);
    
            if(empty($uCTSPAudioUpdate))
            {
                Flash::error('U C T S P Audio Update not found');
                return redirect(route('uCTSPAudioUpdates.index'));
            }
    
            if($uCTSPAudioUpdate -> user_id == $user_id)
            {
                return view('u_c_t_s_p_audio_updates.show')
                    ->with('uCTSPAudioUpdate', $uCTSPAudioUpdate);
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
            $uCTSPAudioUpdate = $this->uCTSPAudioUpdateRepository->findWithoutFail($id);
    
            if(empty($uCTSPAudioUpdate))
            {
                Flash::error('U C T S P Audio Update not found');
                return redirect(route('uCTSPAudioUpdates.index'));
            }
    
            if($uCTSPAudioUpdate -> user_id == $user_id)
            {
                return view('u_c_t_s_p_audio_updates.edit')
                    ->with('uCTSPAudioUpdate', $uCTSPAudioUpdate);
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

    public function update($id, UpdateUCTSPAudioUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $uCTSPAudioUpdate = $this->uCTSPAudioUpdateRepository->findWithoutFail($id);
    
            if(empty($uCTSPAudioUpdate))
            {
                Flash::error('U C T S P Audio Update not found');
                return redirect(route('uCTSPAudioUpdates.index'));
            }
    
            if($uCTSPAudioUpdate -> user_id == $user_id)
            {
                $uCTSPAudioUpdate = $this->uCTSPAudioUpdateRepository->update($request->all(), $id);
            
                Flash::success('U C T S P Audio Update updated successfully.');
                return redirect(route('uCTSPAudioUpdates.index'));
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
            $uCTSPAudioUpdate = $this->uCTSPAudioUpdateRepository->findWithoutFail($id);
    
            if(empty($uCTSPAudioUpdate))
            {
                Flash::error('U C T S P Audio Update not found');
                return redirect(route('uCTSPAudioUpdates.index'));
            }
            
            if($uCTSPAudioUpdate -> user_id == $user_id)
            {
                $this->uCTSPAudioUpdateRepository->delete($id);
            
                Flash::success('U C T S P Audio Update deleted successfully.');
                return redirect(route('uCTSPAudioUpdates.index'));
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