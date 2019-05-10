<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUCTSPlaylistCreateRequest;
use App\Http\Requests\UpdateUCTSPlaylistCreateRequest;
use App\Repositories\UCTSPlaylistCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UCTSPlaylistCreateController extends AppBaseController
{
    private $uCTSPlaylistCreateRepository;

    public function __construct(UCTSPlaylistCreateRepository $uCTSPlaylistCreateRepo)
    {
        $this->uCTSPlaylistCreateRepository = $uCTSPlaylistCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->uCTSPlaylistCreateRepository->pushCriteria(new RequestCriteria($request));
            $uCTSPlaylistCreates = $this->uCTSPlaylistCreateRepository->all();
    
            return view('u_c_t_s_playlist_creates.index')
                ->with('uCTSPlaylistCreates', $uCTSPlaylistCreates);
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
            return view('u_c_t_s_playlist_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUCTSPlaylistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $uCTSPlaylistCreate = $this->uCTSPlaylistCreateRepository->create($input);
            
                Flash::success('U C T S Playlist Create saved successfully.');
                return redirect(route('uCTSPlaylistCreates.index'));
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
            $uCTSPlaylistCreate = $this->uCTSPlaylistCreateRepository->findWithoutFail($id);
    
            if(empty($uCTSPlaylistCreate))
            {
                Flash::error('U C T S Playlist Create not found');
                return redirect(route('uCTSPlaylistCreates.index'));
            }
    
            if($uCTSPlaylistCreate -> user_id == $user_id)
            {
                return view('u_c_t_s_playlist_creates.show')
                    ->with('uCTSPlaylistCreate', $uCTSPlaylistCreate);
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
            $uCTSPlaylistCreate = $this->uCTSPlaylistCreateRepository->findWithoutFail($id);
    
            if(empty($uCTSPlaylistCreate))
            {
                Flash::error('U C T S Playlist Create not found');
                return redirect(route('uCTSPlaylistCreates.index'));
            }
    
            if($uCTSPlaylistCreate -> user_id == $user_id)
            {
                return view('u_c_t_s_playlist_creates.edit')
                    ->with('uCTSPlaylistCreate', $uCTSPlaylistCreate);
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

    public function update($id, UpdateUCTSPlaylistCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $uCTSPlaylistCreate = $this->uCTSPlaylistCreateRepository->findWithoutFail($id);
    
            if(empty($uCTSPlaylistCreate))
            {
                Flash::error('U C T S Playlist Create not found');
                return redirect(route('uCTSPlaylistCreates.index'));
            }
    
            if($uCTSPlaylistCreate -> user_id == $user_id)
            {
                $uCTSPlaylistCreate = $this->uCTSPlaylistCreateRepository->update($request->all(), $id);
            
                Flash::success('U C T S Playlist Create updated successfully.');
                return redirect(route('uCTSPlaylistCreates.index'));
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
            $uCTSPlaylistCreate = $this->uCTSPlaylistCreateRepository->findWithoutFail($id);
    
            if(empty($uCTSPlaylistCreate))
            {
                Flash::error('U C T S Playlist Create not found');
                return redirect(route('uCTSPlaylistCreates.index'));
            }
    
            if($uCTSPlaylistCreate -> user_id == $user_id)
            {
                $this->uCTSPlaylistCreateRepository->delete($id);
            
                Flash::success('U C T S Playlist Create deleted successfully.');
                return redirect(route('uCTSPlaylistCreates.index'));
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