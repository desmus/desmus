<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRecentActivityDeleteRequest;
use App\Http\Requests\UpdateRecentActivityDeleteRequest;
use App\Repositories\RecentActivityDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class RecentActivityDeleteController extends AppBaseController
{
    private $recentActivityDeleteRepository;

    public function __construct(RecentActivityDeleteRepository $recentActivityDeleteRepo)
    {
        $this->recentActivityDeleteRepository = $recentActivityDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->recentActivityDeleteRepository->pushCriteria(new RequestCriteria($request));
            $recentActivityDeletes = $this->recentActivityDeleteRepository->all();
    
            return view('recent_activity_deletes.index')
                ->with('recentActivityDeletes', $recentActivityDeletes);
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
            return view('recent_activity_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateRecentActivityDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $recentActivityDelete = $this->recentActivityDeleteRepository->create($input);
    
            Flash::success('Recent Activity Delete saved successfully.');
            return redirect(route('recentActivityDeletes.index'));
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
            $recentActivityDelete = $this->recentActivityDeleteRepository->findWithoutFail($id);
            $user = DB::table('recent_activity_deletes')->join('users', 'users.id', '=', 'recent_activity_deletes.user_id')->where('recent_activity_deletes.id', '=', $recentActivityDelete -> id)->select('users.id')->get();
    
            if(empty($recentActivityDelete))
            {
                Flash::error('Recent Activity Delete not found');
                return redirect(route('recentActivityDeletes.index'));
            }
            
            if($user[0] -> id == $user_id)
            {
                return view('recent_activity_deletes.show')
                    ->with('recentActivityDelete', $recentActivityDelete);
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
            $recentActivityDelete = $this->recentActivityDeleteRepository->findWithoutFail($id);
            $user = DB::table('recent_activity_deletes')->join('users', 'users.id', '=', 'recent_activity_deletes.user_id')->where('recent_activity_deletes.id', '=', $recentActivityDelete -> id)->select('users.id')->get();
    
            if (empty($recentActivityDelete))
            {
                Flash::error('Recent Activity Delete not found');
                return redirect(route('recentActivityDeletes.index'));
            }
    
            if($user[0] -> id == $user_id)
            {
                return view('recent_activity_deletes.edit')
                    ->with('recentActivityDelete', $recentActivityDelete);
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

    public function update($id, UpdateRecentActivityDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $recentActivityDelete = $this->recentActivityDeleteRepository->findWithoutFail($id);
            $user = DB::table('recent_activity_deletes')->join('users', 'users.id', '=', 'recent_activity_deletes.user_id')->where('recent_activity_deletes.id', '=', $recentActivityDelete -> id)->select('users.id')->get();
    
            if (empty($recentActivityDelete))
            {
                Flash::error('Recent Activity Delete not found');
                return redirect(route('recentActivityDeletes.index'));
            }
    
            if($user[0] -> id == $user_id)
            {
                $recentActivityDelete = $this->recentActivityDeleteRepository->update($request->all(), $id);
            
                Flash::success('Recent Activity Delete updated successfully.');
                return redirect(route('recentActivityDeletes.index'));
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
            $recentActivityDelete = $this->recentActivityDeleteRepository->findWithoutFail($id);
            $user = DB::table('recent_activity_deletes')->join('users', 'users.id', '=', 'recent_activity_deletes.user_id')->where('recent_activity_deletes.id', '=', $recentActivityDelete -> id)->select('users.id')->get();
    
            if (empty($recentActivityDelete))
            {
                Flash::error('Recent Activity Delete not found');
                return redirect(route('recentActivityDeletes.index'));
            }
    
            if($user[0] -> id == $user_id)
            {
                $this->recentActivityDeleteRepository->delete($id);
                
                Flash::success('Recent Activity Delete deleted successfully.');
                return redirect(route('recentActivityDeletes.index'));
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