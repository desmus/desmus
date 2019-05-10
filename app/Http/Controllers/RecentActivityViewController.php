<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRecentActivityViewRequest;
use App\Http\Requests\UpdateRecentActivityViewRequest;
use App\Repositories\RecentActivityViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class RecentActivityViewController extends AppBaseController
{
    private $recentActivityViewRepository;

    public function __construct(RecentActivityViewRepository $recentActivityViewRepo)
    {
        $this->recentActivityViewRepository = $recentActivityViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->recentActivityViewRepository->pushCriteria(new RequestCriteria($request));
            $recentActivityViews = $this->recentActivityViewRepository->all();
    
            return view('recent_activity_views.index')
                ->with('recentActivityViews', $recentActivityViews);
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
            return view('recent_activity_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateRecentActivityViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $recentActivityView = $this->recentActivityViewRepository->create($input);
    
            Flash::success('Recent Activity View saved successfully.');
            return redirect(route('recentActivityViews.index'));
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
            $recentActivityView = $this->recentActivityViewRepository->findWithoutFail($id);
            $user = DB::table('recent_activity_views')->join('users', 'users.id', '=', 'recent_activity_views.user_id')->where('recent_activity_views.id', '=', $recentActivityView -> id)->select('users.id')->get();
    
            if(empty($recentActivityView))
            {
                Flash::error('Recent Activity View not found');
                return redirect(route('recentActivityViews.index'));
            }
    
            if($user[0] -> id == $user_id)
            {
                return view('recent_activity_views.show')
                    ->with('recentActivityView', $recentActivityView);
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
            $recentActivityView = $this->recentActivityViewRepository->findWithoutFail($id);
            $user = DB::table('recent_activity_views')->join('users', 'users.id', '=', 'recent_activity_views.user_id')->where('recent_activity_views.id', '=', $recentActivityView -> id)->select('users.id')->get();

            if(empty($recentActivityView))
            {
                Flash::error('Recent Activity View not found');
                return redirect(route('recentActivityViews.index'));
            }
    
            if($user[0] -> id == $user_id)
            {
                return view('recent_activity_views.edit')
                    ->with('recentActivityView', $recentActivityView);
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

    public function update($id, UpdateRecentActivityViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $recentActivityView = $this->recentActivityViewRepository->findWithoutFail($id);
            $user = DB::table('recent_activity_views')->join('users', 'users.id', '=', 'recent_activity_views.user_id')->where('recent_activity_views.id', '=', $recentActivityView -> id)->select('users.id')->get();
    
            if(empty($recentActivityView))
            {
                Flash::error('Recent Activity View not found');
                return redirect(route('recentActivityViews.index'));
            }
    
            if($user[0] -> id == $user_id)
            {
                $recentActivityView = $this->recentActivityViewRepository->update($request->all(), $id);
            
                Flash::success('Recent Activity View updated successfully.');
                return redirect(route('recentActivityViews.index'));
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
            $recentActivityView = $this->recentActivityViewRepository->findWithoutFail($id);
            $user = DB::table('recent_activity_views')->join('users', 'users.id', '=', 'recent_activity_views.user_id')->where('recent_activity_views.id', '=', $recentActivityView -> id)->select('users.id')->get();
    
            if(empty($recentActivityView))
            {
                Flash::error('Recent Activity View not found');
                return redirect(route('recentActivityViews.index'));
            }
    
            if($user[0] -> id == $user_id)
            {
                $this->recentActivityViewRepository->delete($id);
    
                Flash::success('Recent Activity View deleted successfully.');
                return redirect(route('recentActivityViews.index'));
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