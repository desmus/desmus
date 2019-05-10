<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRecentActivityUpdateRequest;
use App\Http\Requests\UpdateRecentActivityUpdateRequest;
use App\Repositories\RecentActivityUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class RecentActivityUpdateController extends AppBaseController
{
    private $recentActivityUpdateRepository;

    public function __construct(RecentActivityUpdateRepository $recentActivityUpdateRepo)
    {
        $this->recentActivityUpdateRepository = $recentActivityUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->recentActivityUpdateRepository->pushCriteria(new RequestCriteria($request));
            $recentActivityUpdates = $this->recentActivityUpdateRepository->all();
    
            return view('recent_activity_updates.index')
                ->with('recentActivityUpdates', $recentActivityUpdates);
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
            return view('recent_activity_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateRecentActivityUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $recentActivityUpdate = $this->recentActivityUpdateRepository->create($input);
    
            Flash::success('Recent Activity Update saved successfully.');
            return redirect(route('recentActivityUpdates.index'));
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
            $recentActivityUpdate = $this->recentActivityUpdateRepository->findWithoutFail($id);
            $user = DB::table('recent_activity_updates')->join('users', 'users.id', '=', 'recent_activity_updates.user_id')->where('recent_activity_updates.id', '=', $recentActivityUpdate -> id)->select('users.id')->get();
    
            if(empty($recentActivityUpdate))
            {
                Flash::error('Recent Activity Update not found');
                return redirect(route('recentActivityUpdates.index'));
            }
    
            if($user[0] -> id == $user_id)
            {
                return view('recent_activity_updates.show')
                    ->with('recentActivityUpdate', $recentActivityUpdate);
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
            $recentActivityUpdate = $this->recentActivityUpdateRepository->findWithoutFail($id);
            $user = DB::table('recent_activity_updates')->join('users', 'users.id', '=', 'recent_activity_updates.user_id')->where('recent_activity_updates.id', '=', $recentActivityUpdate -> id)->select('users.id')->get();
    
            if(empty($recentActivityUpdate))
            {
                Flash::error('Recent Activity Update not found');
                return redirect(route('recentActivityUpdates.index'));
            }
    
            if($user[0] -> id == $user_id)
            {
                return view('recent_activity_updates.edit')
                    ->with('recentActivityUpdate', $recentActivityUpdate);
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

    public function update($id, UpdateRecentActivityUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $recentActivityUpdate = $this->recentActivityUpdateRepository->findWithoutFail($id);
            $user = DB::table('recent_activity_updates')->join('users', 'users.id', '=', 'recent_activity_updates.user_id')->where('recent_activity_updates.id', '=', $recentActivityUpdate -> id)->select('users.id')->get();
    
            if(empty($recentActivityUpdate))
            {
                Flash::error('Recent Activity Update not found');
                return redirect(route('recentActivityUpdates.index'));
            }
    
            if($user[0] -> id == $user_id)
            {
                $recentActivityUpdate = $this->recentActivityUpdateRepository->update($request->all(), $id);
                
                Flash::success('Recent Activity Update updated successfully.');
                return redirect(route('recentActivityUpdates.index'));
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
            $recentActivityUpdate = $this->recentActivityUpdateRepository->findWithoutFail($id);
            $user = DB::table('recent_activity_updates')->join('users', 'users.id', '=', 'recent_activity_updates.user_id')->where('recent_activity_updates.id', '=', $recentActivityUpdate -> id)->select('users.id')->get();
    
            if(empty($recentActivityUpdate))
            {
                Flash::error('Recent Activity Update not found');
                return redirect(route('recentActivityUpdates.index'));
            }
    
            if($user[0] -> id == $user_id)
            {
                $this->recentActivityUpdateRepository->delete($id);
                
                Flash::success('Recent Activity Update deleted successfully.');
                return redirect(route('recentActivityUpdates.index'));
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