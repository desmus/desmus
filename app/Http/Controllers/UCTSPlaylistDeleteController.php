<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUCTSPlaylistDeleteRequest;
use App\Http\Requests\UpdateUCTSPlaylistDeleteRequest;
use App\Repositories\UCTSPlaylistDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UCTSPlaylistDeleteController extends AppBaseController
{
    private $uCTSPlaylistDeleteRepository;

    public function __construct(UCTSPlaylistDeleteRepository $uCTSPlaylistDeleteRepo)
    {
        $this->uCTSPlaylistDeleteRepository = $uCTSPlaylistDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->uCTSPlaylistDeleteRepository->pushCriteria(new RequestCriteria($request));
            $uCTSPlaylistDeletes = $this->uCTSPlaylistDeleteRepository->all();
    
            return view('u_c_t_s_playlist_deletes.index')
                ->with('uCTSPlaylistDeletes', $uCTSPlaylistDeletes);
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
            return view('u_c_t_s_playlist_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUCTSPlaylistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
                    
            if($input -> user_id == $user_id)
            {
                $uCTSPlaylistDelete = $this->uCTSPlaylistDeleteRepository->create($input);
            
                Flash::success('U C T S Playlist Delete saved successfully.');
                return redirect(route('uCTSPlaylistDeletes.index'));
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
            $uCTSPlaylistDelete = $this->uCTSPlaylistDeleteRepository->findWithoutFail($id);
    
            if(empty($uCTSPlaylistDelete))
            {
                Flash::error('U C T S Playlist Delete not found');
                return redirect(route('uCTSPlaylistDeletes.index'));
            }
            
            if($uCTSPlaylistDelete -> user_id == $user_id)
            {
                return view('u_c_t_s_playlist_deletes.show')
                    ->with('uCTSPlaylistDelete', $uCTSPlaylistDelete);
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
            $uCTSPlaylistDelete = $this->uCTSPlaylistDeleteRepository->findWithoutFail($id);
    
            if(empty($uCTSPlaylistDelete))
            {
                Flash::error('U C T S Playlist Delete not found');
                return redirect(route('uCTSPlaylistDeletes.index'));
            }
    
            if($uCTSPlaylistDelete -> user_id == $user_id)
            {
                return view('u_c_t_s_playlist_deletes.edit')
                    ->with('uCTSPlaylistDelete', $uCTSPlaylistDelete);
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

    public function update($id, UpdateUCTSPlaylistDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $uCTSPlaylistDelete = $this->uCTSPlaylistDeleteRepository->findWithoutFail($id);
    
            if(empty($uCTSPlaylistDelete))
            {
                Flash::error('U C T S Playlist Delete not found');
                return redirect(route('uCTSPlaylistDeletes.index'));
            }
    
            if($uCTSPlaylistDelete -> user_id == $user_id)
            {
                $uCTSPlaylistDelete = $this->uCTSPlaylistDeleteRepository->update($request->all(), $id);
            
                Flash::success('U C T S Playlist Delete updated successfully.');
                return redirect(route('uCTSPlaylistDeletes.index'));
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
            $uCTSPlaylistDelete = $this->uCTSPlaylistDeleteRepository->findWithoutFail($id);
    
            if(empty($uCTSPlaylistDelete))
            {
                Flash::error('U C T S Playlist Delete not found');
                return redirect(route('uCTSPlaylistDeletes.index'));
            }
    
            if($uCTSPlaylistDelete -> user_id == $user_id)
            {
                $this->uCTSPlaylistDeleteRepository->delete($id);
            
                Flash::success('U C T S Playlist Delete deleted successfully.');
                return redirect(route('uCTSPlaylistDeletes.index'));
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