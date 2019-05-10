<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateRecentActivityRequest;
use App\Http\Requests\UpdateRecentActivityRequest;
use App\Repositories\RecentActivityRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class RecentActivityController extends AppBaseController
{
    private $recentActivityRepository;

    public function __construct(RecentActivityRepository $recentActivityRepo)
    {
        $this->recentActivityRepository = $recentActivityRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->recentActivityRepository->pushCriteria(new RequestCriteria($request));
            $recentActivities = $this->recentActivityRepository->all();
    
            return view('recent_activities.index')
                ->with('recentActivities', $recentActivities);
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
            return view('recent_activities.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateRecentActivityRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $recentActivity = $this->recentActivityRepository->create($input);
    
            Flash::success('Recent Activity saved successfully.');
            return redirect(route('recentActivities.index'));
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
            $recentActivity = $this->recentActivityRepository->findWithoutFail($id);
            $user = DB::table('recent_activities')->join('users', 'users.id', '=', 'recent_activities.user_id')->where('recent_activities.id', '=', $recentActivity -> id)->select('users.id')->get();
    
            if(empty($recentActivity))
            {
                Flash::error('Recent Activity not found');
                return redirect(route('recentActivities.index'));
            }
            
            if($user[0] -> id == $user_id)
            {
                return view('recent_activities.show')
                    ->with('recentActivity', $recentActivity);
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
            $recentActivity = $this->recentActivityRepository->findWithoutFail($id);
            $user = DB::table('recent_activities')->join('users', 'users.id', '=', 'recent_activities.user_id')->where('recent_activities.id', '=', $recentActivity -> id)->select('users.id')->get();
    
            if(empty($recentActivity))
            {
                Flash::error('Recent Activity not found');
                return redirect(route('recentActivities.index'));
            }
    
            if($user[0] -> id == $user_id)
            {
                return view('recent_activities.edit')
                    ->with('recentActivity', $recentActivity);
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

    public function update($id, UpdateRecentActivityRequest $request)
    {
        if(Auth::user() != null)
        {
            $recentActivity = $this->recentActivityRepository->findWithoutFail($id);
            $user = DB::table('recent_activities')->join('users', 'users.id', '=', 'recent_activities.user_id')->where('recent_activities.id', '=', $recentActivity -> id)->select('users.id')->get();
    
            if(empty($recentActivity))
            {
                Flash::error('Recent Activity not found');
                return redirect(route('recentActivities.index'));
            }
    
            if($user[0] -> id == $user_id)
            {
                $recentActivity = $this->recentActivityRepository->update($request->all(), $id);
            
                Flash::success('Recent Activity updated successfully.');
                return redirect(route('recentActivities.index'));
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
            $recentActivity = $this->recentActivityRepository->findWithoutFail($id);
            $user = DB::table('recent_activities')->join('users', 'users.id', '=', 'recent_activities.user_id')->where('recent_activities.id', '=', $recentActivity -> id)->select('users.id')->get();
    
            if(empty($recentActivity))
            {
                Flash::error('Recent Activity not found');
                return redirect(route('recentActivities.index'));
            }
    
            if($user[0] -> id == $user_id)
            {
                $this->recentActivityRepository->delete($id);
            
                Flash::success('Recent Activity deleted successfully.');
                return redirect(route('recentActivities.index'));
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