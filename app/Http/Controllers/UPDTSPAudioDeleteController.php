<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUPDTSPAudioDeleteRequest;
use App\Http\Requests\UpdateUPDTSPAudioDeleteRequest;
use App\Repositories\UPDTSPAudioDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UPDTSPAudioDeleteController extends AppBaseController
{
    private $uPDTSPAudioDeleteRepository;

    public function __construct(UPDTSPAudioDeleteRepository $uPDTSPAudioDeleteRepo)
    {
        $this->uPDTSPAudioDeleteRepository = $uPDTSPAudioDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->uPDTSPAudioDeleteRepository->pushCriteria(new RequestCriteria($request));
            $uPDTSPAudioDeletes = $this->uPDTSPAudioDeleteRepository->all();
    
            return view('u_p_d_t_s_p_audio_deletes.index')
                ->with('uPDTSPAudioDeletes', $uPDTSPAudioDeletes);
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
            return view('u_p_d_t_s_p_audio_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUPDTSPAudioDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $uPDTSPAudioDelete = $this->uPDTSPAudioDeleteRepository->create($input);
            
                Flash::success('U P D T S P Audio Delete saved successfully.');
                return redirect(route('uPDTSPAudioDeletes.index'));
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
            $uPDTSPAudioDelete = $this->uPDTSPAudioDeleteRepository->findWithoutFail($id);
    
            if(empty($uPDTSPAudioDelete))
            {
                Flash::error('U P D T S P Audio Delete not found');
                return redirect(route('uPDTSPAudioDeletes.index'));
            }
            
            if($uPDTSPAudioDelete -> user_id == $user_id)
            {
                return view('u_p_d_t_s_p_audio_deletes.show')
                    ->with('uPDTSPAudioDelete', $uPDTSPAudioDelete);
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
            $uPDTSPAudioDelete = $this->uPDTSPAudioDeleteRepository->findWithoutFail($id);
    
            if(empty($uPDTSPAudioDelete))
            {
                Flash::error('U P D T S P Audio Delete not found');
                return redirect(route('uPDTSPAudioDeletes.index'));
            }
            
            if($uPDTSPAudioDelete -> user_id == $user_id)
            {
                return view('u_p_d_t_s_p_audio_deletes.edit')
                    ->with('uPDTSPAudioDelete', $uPDTSPAudioDelete);
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

    public function update($id, UpdateUPDTSPAudioDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $uPDTSPAudioDelete = $this->uPDTSPAudioDeleteRepository->findWithoutFail($id);
    
            if(empty($uPDTSPAudioDelete))
            {
                Flash::error('U P D T S P Audio Delete not found');
                return redirect(route('uPDTSPAudioDeletes.index'));
            }
    
            if($uPDTSPAudioDelete -> user_id == $user_id)
            {
                $uPDTSPAudioDelete = $this->uPDTSPAudioDeleteRepository->update($request->all(), $id);
            
                Flash::success('U P D T S P Audio Delete updated successfully.');
                return redirect(route('uPDTSPAudioDeletes.index'));
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
            $uPDTSPAudioDelete = $this->uPDTSPAudioDeleteRepository->findWithoutFail($id);
    
            if(empty($uPDTSPAudioDelete))
            {
                Flash::error('U P D T S P Audio Delete not found');
                return redirect(route('uPDTSPAudioDeletes.index'));
            }
    
            if($uPDTSPAudioDelete -> user_id == $user_id)
            {
                $this->uPDTSPAudioDeleteRepository->delete($id);
            
                Flash::success('U P D T S P Audio Delete deleted successfully.');
                return redirect(route('uPDTSPAudioDeletes.index'));
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