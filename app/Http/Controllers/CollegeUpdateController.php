<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeUpdateRequest;
use App\Http\Requests\UpdateCollegeUpdateRequest;
use App\Repositories\CollegeUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeUpdateController extends AppBaseController
{
    private $collegeUpdateRepository;

    public function __construct(CollegeUpdateRepository $collegeUpdateRepo)
    {
        $this->collegeUpdateRepository = $collegeUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeUpdateRepository->pushCriteria(new RequestCriteria($request));
            $collegeUpdates = $this->collegeUpdateRepository->all();
    
            return view('college_updates.index')
                ->with('collegeUpdates', $collegeUpdates);
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
            return view('college_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
    
            if($input -> user_id == $user_id)
            {
                $collegeUpdate = $this->collegeUpdateRepository->create($input);
            
                Flash::success('College Update saved successfully.');
                return redirect(route('collegeUpdates.index'));
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
            $collegeUpdate = $this->collegeUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeUpdate))
            {
                Flash::error('College Update not found');
                return redirect(route('collegeUpdates.index'));
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
            
            if($user_id == $collegeUpdate -> user_id || $isShared)
            {
                return view('college_updates.show')
                    ->with('collegeUpdate', $collegeUpdate);
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
            $collegeUpdate = $this->collegeUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeUpdate))
            {
                Flash::error('College Update not found');
                return redirect(route('collegeUpdates.index'));
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
            
            if($user_id == $collegeUpdate -> user_id || $isShared)
            {
                return view('college_updates.edit')
                    ->with('collegeUpdate', $collegeUpdate);
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

    public function update($id, UpdateCollegeUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeUpdate = $this->collegeUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeUpdate))
            {
                Flash::error('College Update not found');
                return redirect(route('collegeUpdates.index'));
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
            
            if($user_id == $collegeUpdate -> user_id || $isShared)
            {
                $collegeUpdate = $this->collegeUpdateRepository->update($request->all(), $id);
            
                Flash::success('College Update updated successfully.');
                return redirect(route('collegeUpdates.index'));
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
            $collegeUpdate = $this->collegeUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeUpdate))
            {
                Flash::error('College Update not found');
                return redirect(route('collegeUpdates.index'));
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
            
            if($user_id == $collegeUpdate -> user_id || $isShared)
            {
                $this->collegeUpdateRepository->delete($id);
            
                Flash::success('College Update deleted successfully.');
                return redirect(route('collegeUpdates.index'));
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