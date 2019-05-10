<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeCreateRequest;
use App\Http\Requests\UpdateCollegeCreateRequest;
use App\Repositories\CollegeCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeCreateController extends AppBaseController
{
    private $collegeCreateRepository;

    public function __construct(CollegeCreateRepository $collegeCreateRepo)
    {
        $this->collegeCreateRepository = $collegeCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeCreateRepository->pushCriteria(new RequestCriteria($request));
            $collegeCreates = $this->collegeCreateRepository->all();
    
            return view('college_creates.index')
                ->with('collegeCreates', $collegeCreates);
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
            return view('college_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $collegeCreate = $this->collegeCreateRepository->create($input);
            
                Flash::success('College Create saved successfully.');
                return redirect(route('collegeCreates.index'));
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
            $collegeCreate = $this->collegeCreateRepository->findWithoutFail($id);
    
            if(empty($collegeCreate))
            {
                Flash::error('College Create not found');
                return redirect(route('collegeCreates.index'));
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
            
            if($user_id == $collegeCreate -> user_id || $isShared)
            {
                return view('college_creates.show')->with('collegeCreate', $collegeCreate);
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
            $collegeCreate = $this->collegeCreateRepository->findWithoutFail($id);
    
            if(empty($collegeCreate))
            {
                Flash::error('College Create not found');
                return redirect(route('collegeCreates.index'));
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
            
            if($user_id == $collegeCreate -> user_id || $isShared)
            {
                return view('college_creates.edit')->with('collegeCreate', $collegeCreate);
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

    public function update($id, UpdateCollegeCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeCreate = $this->collegeCreateRepository->findWithoutFail($id);
    
            if(empty($collegeCreate))
            {
                Flash::error('College Create not found');
                return redirect(route('collegeCreates.index'));
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
            
            if($user_id == $collegeCreate -> user_id || $isShared)
            {
                $collegeCreate = $this->collegeCreateRepository->update($request->all(), $id);
            
                Flash::success('College Create updated successfully.');
                return redirect(route('collegeCreates.index'));
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
            $collegeCreate = $this->collegeCreateRepository->findWithoutFail($id);
    
            if(empty($collegeCreate)) 
            {
                Flash::error('College Create not found');
                return redirect(route('collegeCreates.index'));
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
            
            if($user_id == $collegeCreate -> user_id || $isShared)
            {
                $this->collegeCreateRepository->delete($id);
            
                Flash::success('College Create deleted successfully.');
                return redirect(route('collegeCreates.index'));
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