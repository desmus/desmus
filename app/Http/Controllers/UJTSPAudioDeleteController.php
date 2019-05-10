<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUJTSPAudioDeleteRequest;
use App\Http\Requests\UpdateUJTSPAudioDeleteRequest;
use App\Repositories\UJTSPAudioDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UJTSPAudioDeleteController extends AppBaseController
{
    private $uJTSPAudioDeleteRepository;

    public function __construct(UJTSPAudioDeleteRepository $uJTSPAudioDeleteRepo)
    {
        $this->uJTSPAudioDeleteRepository = $uJTSPAudioDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->uJTSPAudioDeleteRepository->pushCriteria(new RequestCriteria($request));
            $uJTSPAudioDeletes = $this->uJTSPAudioDeleteRepository->all();
    
            return view('u_j_t_s_p_audio_deletes.index')
                ->with('uJTSPAudioDeletes', $uJTSPAudioDeletes);
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
            return view('u_j_t_s_p_audio_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUJTSPAudioDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $uJTSPAudioDelete = $this->uJTSPAudioDeleteRepository->create($input);
            
                Flash::success('U J T S P Audio Delete saved successfully.');
                return redirect(route('uJTSPAudioDeletes.index'));
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
            $uJTSPAudioDelete = $this->uJTSPAudioDeleteRepository->findWithoutFail($id);
    
            if (empty($uJTSPAudioDelete))
            {
                Flash::error('U J T S P Audio Delete not found');
                return redirect(route('uJTSPAudioDeletes.index'));
            }
    
            if($uJTSPAudioDelete -> user_id == $user_id)
            {
                return view('u_j_t_s_p_audio_deletes.show')
                    ->with('uJTSPAudioDelete', $uJTSPAudioDelete);
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
            $uJTSPAudioDelete = $this->uJTSPAudioDeleteRepository->findWithoutFail($id);
    
            if (empty($uJTSPAudioDelete))
            {
                Flash::error('U J T S P Audio Delete not found');
                return redirect(route('uJTSPAudioDeletes.index'));
            }
    
            if($uJTSPAudioDelete -> user_id == $user_id)
            {
                return view('u_j_t_s_p_audio_deletes.edit')
                    ->with('uJTSPAudioDelete', $uJTSPAudioDelete);
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

    public function update($id, UpdateUJTSPAudioDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $uJTSPAudioDelete = $this->uJTSPAudioDeleteRepository->findWithoutFail($id);
    
            if (empty($uJTSPAudioDelete))
            {
                Flash::error('U J T S P Audio Delete not found');
                return redirect(route('uJTSPAudioDeletes.index'));
            }
    
            if($uJTSPAudioDelete -> user_id == $user_id)
            {
                $uJTSPAudioDelete = $this->uJTSPAudioDeleteRepository->update($request->all(), $id);
            
                Flash::success('U J T S P Audio Delete updated successfully.');
                return redirect(route('uJTSPAudioDeletes.index'));
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
            $uJTSPAudioDelete = $this->uJTSPAudioDeleteRepository->findWithoutFail($id);
    
            if (empty($uJTSPAudioDelete))
            {
                Flash::error('U J T S P Audio Delete not found');
                return redirect(route('uJTSPAudioDeletes.index'));
            }
    
            if($uJTSPAudioDelete -> user_id == $user_id)
            {
                $this->uJTSPAudioDeleteRepository->delete($id);
            
                Flash::success('U J T S P Audio Delete deleted successfully.');
                return redirect(route('uJTSPAudioDeletes.index'));
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