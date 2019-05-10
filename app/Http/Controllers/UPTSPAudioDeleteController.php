<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUPTSPAudioDeleteRequest;
use App\Http\Requests\UpdateUPTSPAudioDeleteRequest;
use App\Repositories\UPTSPAudioDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UPTSPAudioDeleteController extends AppBaseController
{
    private $uPTSPAudioDeleteRepository;

    public function __construct(UPTSPAudioDeleteRepository $uPTSPAudioDeleteRepo)
    {
        $this->uPTSPAudioDeleteRepository = $uPTSPAudioDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->uPTSPAudioDeleteRepository->pushCriteria(new RequestCriteria($request));
            $uPTSPAudioDeletes = $this->uPTSPAudioDeleteRepository->all();
    
            return view('u_p_t_s_p_audio_deletes.index')
                ->with('uPTSPAudioDeletes', $uPTSPAudioDeletes);
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
            return view('u_p_t_s_p_audio_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUPTSPAudioDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $uPTSPAudioDelete = $this->uPTSPAudioDeleteRepository->create($input);
            
                Flash::success('U P T S P Audio Delete saved successfully.');
                return redirect(route('uPTSPAudioDeletes.index'));
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
            $uPTSPAudioDelete = $this->uPTSPAudioDeleteRepository->findWithoutFail($id);
    
            if(empty($uPTSPAudioDelete))
            {
                Flash::error('U P T S P Audio Delete not found');
                return redirect(route('uPTSPAudioDeletes.index'));
            }
    
            if($uPTSPAudioDelete -> user_id == $user_id)
            {
                return view('u_p_t_s_p_audio_deletes.show')
                    ->with('uPTSPAudioDelete', $uPTSPAudioDelete);
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
            $uPTSPAudioDelete = $this->uPTSPAudioDeleteRepository->findWithoutFail($id);
    
            if(empty($uPTSPAudioDelete))
            {
                Flash::error('U P T S P Audio Delete not found');
                return redirect(route('uPTSPAudioDeletes.index'));
            }
    
            if($uPTSPAudioDelete -> user_id == $user_id)
            {
                return view('u_p_t_s_p_audio_deletes.edit')
                    ->with('uPTSPAudioDelete', $uPTSPAudioDelete);
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

    public function update($id, UpdateUPTSPAudioDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $uPTSPAudioDelete = $this->uPTSPAudioDeleteRepository->findWithoutFail($id);
    
            if(empty($uPTSPAudioDelete))
            {
                Flash::error('U P T S P Audio Delete not found');
                return redirect(route('uPTSPAudioDeletes.index'));
            }
    
            if($uPTSPAudioDelete -> user_id == $user_id)
            {
                $uPTSPAudioDelete = $this->uPTSPAudioDeleteRepository->update($request->all(), $id);
            
                Flash::success('U P T S P Audio Delete updated successfully.');
                return redirect(route('uPTSPAudioDeletes.index'));
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
            $uPTSPAudioDelete = $this->uPTSPAudioDeleteRepository->findWithoutFail($id);
    
            if(empty($uPTSPAudioDelete))
            {
                Flash::error('U P T S P Audio Delete not found');
                return redirect(route('uPTSPAudioDeletes.index'));
            }
    
            if($uPTSPAudioDelete -> user_id == $user_id)
            {
                $this->uPTSPAudioDeleteRepository->delete($id);
            
                Flash::success('U P T S P Audio Delete deleted successfully.');
                return redirect(route('uPTSPAudioDeletes.index'));
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