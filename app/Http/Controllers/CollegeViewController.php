<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeViewRequest;
use App\Http\Requests\UpdateCollegeViewRequest;
use App\Repositories\CollegeViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeViewController extends AppBaseController
{
    private $collegeViewRepository;

    public function __construct(CollegeViewRepository $collegeViewRepo)
    {
        $this->collegeViewRepository = $collegeViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeViewRepository->pushCriteria(new RequestCriteria($request));
            $collegeViews = $this->collegeViewRepository->all();
    
            return view('college_views.index')
                ->with('collegeViews', $collegeViews);
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
            return view('college_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
    
            if($input -> user_id == $user_id)
            {
                $collegeView = $this->collegeViewRepository->create($input);
            
                Flash::success('College View saved successfully.');
                return redirect(route('collegeViews.index'));
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
            $collegeView = $this->collegeViewRepository->findWithoutFail($id);
    
            if(empty($collegeView))
            {
                Flash::error('College View not found');
                return redirect(route('collegeViews.index'));
            }
            
            $userColleges = DB::table('user_colleges')->where('college_id', '=', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userColleges as $userCollege)
            {
                if($userCollege -> user_id == $user_id && $userCollege -> permissions == 'advanced')
                {
                    $isShared = true;
                    break;
                }
            }
            
            if($user_id == $collegeView -> user_id || $isShared)
            {
                return view('college_views.show')
                    ->with('collegeView', $collegeView);
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
            $collegeView = $this->collegeViewRepository->findWithoutFail($id);
    
            if(empty($collegeView))
            {
                Flash::error('College View not found');
                return redirect(route('collegeViews.index'));
            }
    
            $userColleges = DB::table('user_colleges')->where('college_id', '=', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userColleges as $userCollege)
            {
                if($userCollege -> user_id == $user_id && $userCollege -> permissions == 'advanced')
                {
                    $isShared = true;
                    break;
                }
            }
            
            if($user_id == $collegeView -> user_id || $isShared)
            {
                return view('college_views.edit')
                    ->with('collegeView', $collegeView);
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

    public function update($id, UpdateCollegeViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeView = $this->collegeViewRepository->findWithoutFail($id);
    
            if(empty($collegeView))
            {
                Flash::error('College View not found');
                return redirect(route('collegeViews.index'));
            }
            
            $userColleges = DB::table('user_colleges')->where('college_id', '=', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userColleges as $userCollege)
            {
                if($userCollege -> user_id == $user_id && $userCollege -> permissions == 'advanced')
                {
                    $isShared = true;
                    break;
                }
            }
            
            if($user_id == $collegeView -> user_id || $isShared)
            {
                $collegeView = $this->collegeViewRepository->update($request->all(), $id);
            
                Flash::success('College View updated successfully.');
                return redirect(route('collegeViews.index'));
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
            $collegeView = $this->collegeViewRepository->findWithoutFail($id);
    
            if(empty($collegeView))
            {
                Flash::error('College View not found');
                return redirect(route('collegeViews.index'));
            }
            
            $userColleges = DB::table('user_colleges')->where('college_id', '=', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userColleges as $userCollege)
            {
                if($userCollege -> user_id == $user_id && $userCollege -> permissions == 'advanced')
                {
                    $isShared = true;
                    break;
                }
            }
            
            if($user_id == $collegeView -> user_id || $isShared)
            {
                $this->collegeViewRepository->delete($id);
            
                Flash::success('College View deleted successfully.');
                return redirect(route('collegeViews.index'));
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