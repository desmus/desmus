<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUCTSPlaylistUpdateRequest;
use App\Http\Requests\UpdateUCTSPlaylistUpdateRequest;
use App\Repositories\UCTSPlaylistUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UCTSPlaylistUpdateController extends AppBaseController
{
    private $uCTSPlaylistUpdateRepository;

    public function __construct(UCTSPlaylistUpdateRepository $uCTSPlaylistUpdateRepo)
    {
        $this->uCTSPlaylistUpdateRepository = $uCTSPlaylistUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->uCTSPlaylistUpdateRepository->pushCriteria(new RequestCriteria($request));
            $uCTSPlaylistUpdates = $this->uCTSPlaylistUpdateRepository->all();
    
            return view('u_c_t_s_playlist_updates.index')
                ->with('uCTSPlaylistUpdates', $uCTSPlaylistUpdates);
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
            return view('u_c_t_s_playlist_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUCTSPlaylistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $uCTSPlaylistUpdate = $this->uCTSPlaylistUpdateRepository->create($input);
            
                Flash::success('U C T S Playlist Update saved successfully.');
                return redirect(route('uCTSPlaylistUpdates.index'));
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
            $uCTSPlaylistUpdate = $this->uCTSPlaylistUpdateRepository->findWithoutFail($id);
    
            if(empty($uCTSPlaylistUpdate))
            {
                Flash::error('U C T S Playlist Update not found');
                return redirect(route('uCTSPlaylistUpdates.index'));
            }
    
            if($uCTSPlaylistUpdate -> user_id == $user_id)
            {
                return view('u_c_t_s_playlist_updates.show')
                    ->with('uCTSPlaylistUpdate', $uCTSPlaylistUpdate);
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
            $uCTSPlaylistUpdate = $this->uCTSPlaylistUpdateRepository->findWithoutFail($id);
    
            if(empty($uCTSPlaylistUpdate))
            {
                Flash::error('U C T S Playlist Update not found');
                return redirect(route('uCTSPlaylistUpdates.index'));
            }
    
            if($uCTSPlaylistUpdate -> user_id == $user_id)
            {
                return view('u_c_t_s_playlist_updates.edit')
                    ->with('uCTSPlaylistUpdate', $uCTSPlaylistUpdate);
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

    public function update($id, UpdateUCTSPlaylistUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $uCTSPlaylistUpdate = $this->uCTSPlaylistUpdateRepository->findWithoutFail($id);
    
            if(empty($uCTSPlaylistUpdate))
            {
                Flash::error('U C T S Playlist Update not found');
                return redirect(route('uCTSPlaylistUpdates.index'));
            }
    
            if($uCTSPlaylistUpdate -> user_id == $user_id)
            {
                $uCTSPlaylistUpdate = $this->uCTSPlaylistUpdateRepository->update($request->all(), $id);
            
                Flash::success('U C T S Playlist Update updated successfully.');
                return redirect(route('uCTSPlaylistUpdates.index'));
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
            $uCTSPlaylistUpdate = $this->uCTSPlaylistUpdateRepository->findWithoutFail($id);
    
            if(empty($uCTSPlaylistUpdate))
            {
                Flash::error('U C T S Playlist Update not found');
                return redirect(route('uCTSPlaylistUpdates.index'));
            }
    
            if($uCTSPlaylistUpdate -> user_id == $user_id)
            {
                $this->uCTSPlaylistUpdateRepository->delete($id);
            
                Flash::success('U C T S Playlist Update deleted successfully.');
                return redirect(route('uCTSPlaylistUpdates.index'));
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