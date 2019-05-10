<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUCTSPAudioDeleteRequest;
use App\Http\Requests\UpdateUCTSPAudioDeleteRequest;
use App\Repositories\UCTSPAudioDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UCTSPAudioDeleteController extends AppBaseController
{
    private $uCTSPAudioDeleteRepository;

    public function __construct(UCTSPAudioDeleteRepository $uCTSPAudioDeleteRepo)
    {
        $this->uCTSPAudioDeleteRepository = $uCTSPAudioDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->uCTSPAudioDeleteRepository->pushCriteria(new RequestCriteria($request));
            $uCTSPAudioDeletes = $this->uCTSPAudioDeleteRepository->all();
    
            return view('u_c_t_s_p_audio_deletes.index')
                ->with('uCTSPAudioDeletes', $uCTSPAudioDeletes);
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
            return view('u_c_t_s_p_audio_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUCTSPAudioDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $uCTSPAudioDelete = $this->uCTSPAudioDeleteRepository->create($input);
            
                Flash::success('U C T S P Audio Delete saved successfully.');
                return redirect(route('uCTSPAudioDeletes.index'));
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
            $uCTSPAudioDelete = $this->uCTSPAudioDeleteRepository->findWithoutFail($id);
    
            if(empty($uCTSPAudioDelete))
            {
                Flash::error('U C T S P Audio Delete not found');
                return redirect(route('uCTSPAudioDeletes.index'));
            }
            
            if($uCTSPAudioDelete -> user_id == $user_id)
            {
                return view('u_c_t_s_p_audio_deletes.show')
                    ->with('uCTSPAudioDelete', $uCTSPAudioDelete);
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
            $uCTSPAudioDelete = $this->uCTSPAudioDeleteRepository->findWithoutFail($id);
    
            if(empty($uCTSPAudioDelete))
            {
                Flash::error('U C T S P Audio Delete not found');
                return redirect(route('uCTSPAudioDeletes.index'));
            }
    
            if($uCTSPAudioDelete -> user_id == $user_id)
            {
                return view('u_c_t_s_p_audio_deletes.edit')
                    ->with('uCTSPAudioDelete', $uCTSPAudioDelete);
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

    public function update($id, UpdateUCTSPAudioDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $uCTSPAudioDelete = $this->uCTSPAudioDeleteRepository->findWithoutFail($id);
    
            if(empty($uCTSPAudioDelete))
            {
                Flash::error('U C T S P Audio Delete not found');
                return redirect(route('uCTSPAudioDeletes.index'));
            }
    
            if($uCTSPAudioDelete -> user_id == $user_id)
            {
                $uCTSPAudioDelete = $this->uCTSPAudioDeleteRepository->update($request->all(), $id);
            
                Flash::success('U C T S P Audio Delete updated successfully.');
                return redirect(route('uCTSPAudioDeletes.index'));
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
            $uCTSPAudioDelete = $this->uCTSPAudioDeleteRepository->findWithoutFail($id);
    
            if(empty($uCTSPAudioDelete))
            {
                Flash::error('U C T S P Audio Delete not found');
                return redirect(route('uCTSPAudioDeletes.index'));
            }
    
            if($uCTSPAudioDelete -> user_id == $user_id)
            {
                $this->uCTSPAudioDeleteRepository->delete($id);
            
                Flash::success('U C T S P Audio Delete deleted successfully.');
                return redirect(route('uCTSPAudioDeletes.index'));
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