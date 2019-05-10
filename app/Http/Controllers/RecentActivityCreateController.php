<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRecentActivityCreateRequest;
use App\Http\Requests\UpdateRecentActivityCreateRequest;
use App\Repositories\RecentActivityCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class RecentActivityCreateController extends AppBaseController
{
    private $recentActivityCreateRepository;

    public function __construct(RecentActivityCreateRepository $recentActivityCreateRepo)
    {
        $this->recentActivityCreateRepository = $recentActivityCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->recentActivityCreateRepository->pushCriteria(new RequestCriteria($request));
            $recentActivityCreates = $this->recentActivityCreateRepository->all();
    
            return view('recent_activity_creates.index')
                ->with('recentActivityCreates', $recentActivityCreates);
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
            return view('recent_activity_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateRecentActivityCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $recentActivityCreate = $this->recentActivityCreateRepository->create($input);
    
            Flash::success('Recent Activity Create saved successfully.');
            return redirect(route('recentActivityCreates.index'));
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
            $recentActivityCreate = $this->recentActivityCreateRepository->findWithoutFail($id);
            $user = DB::table('recent_activity_creates')->join('users', 'users.id', '=', 'recent_activity_creates.user_id')->where('recent_activity_creates.id', '=', $recentActivityCreate -> id)->select('users.id')->get();
    
            if(empty($recentActivityCreate))
            {
                Flash::error('Recent Activity Create not found');
                return redirect(route('recentActivityCreates.index'));
            }
    
            if($user[0] -> id == $user_id)
            {
                return view('recent_activity_creates.show')
                    ->with('recentActivityCreate', $recentActivityCreate);
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
            $recentActivityCreate = $this->recentActivityCreateRepository->findWithoutFail($id);
            $user = DB::table('recent_activity_creates')->join('users', 'users.id', '=', 'recent_activity_creates.user_id')->where('recent_activity_creates.id', '=', $recentActivityCreate -> id)->select('users.id')->get();

            if(empty($recentActivityCreate))
            {
                Flash::error('Recent Activity Create not found');
                return redirect(route('recentActivityCreates.index'));
            }
    
            if($user[0] -> id == $user_id)
            {
                return view('recent_activity_creates.edit')
                    ->with('recentActivityCreate', $recentActivityCreate);
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

    public function update($id, UpdateRecentActivityCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $recentActivityCreate = $this->recentActivityCreateRepository->findWithoutFail($id);
            $user = DB::table('recent_activity_creates')->join('users', 'users.id', '=', 'recent_activity_creates.user_id')->where('recent_activity_creates.id', '=', $recentActivityCreate -> id)->select('users.id')->get();
    
            if(empty($recentActivityCreate))
            {
                Flash::error('Recent Activity Create not found');
                return redirect(route('recentActivityCreates.index'));
            }
    
            if($user[0] -> id == $user_id)
            {
                $recentActivityCreate = $this->recentActivityCreateRepository->update($request->all(), $id);
            
                Flash::success('Recent Activity Create updated successfully.');
                return redirect(route('recentActivityCreates.index'));
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
            $recentActivityCreate = $this->recentActivityCreateRepository->findWithoutFail($id);
            $user = DB::table('recent_activity_creates')->join('users', 'users.id', '=', 'recent_activity_creates.user_id')->where('recent_activity_creates.id', '=', $recentActivityCreate -> id)->select('users.id')->get();

            if(empty($recentActivityCreate))
            {
                Flash::error('Recent Activity Create not found');
                return redirect(route('recentActivityCreates.index'));
            }
    
            if($user[0] -> id == $user_id)
            {
                $this->recentActivityCreateRepository->delete($id);
                
                Flash::success('Recent Activity Create deleted successfully.');
                return redirect(route('recentActivityCreates.index'));
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