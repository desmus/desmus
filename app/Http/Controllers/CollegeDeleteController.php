<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeDeleteRequest;
use App\Http\Requests\UpdateCollegeDeleteRequest;
use App\Repositories\CollegeDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeDeleteController extends AppBaseController
{
    private $collegeDeleteRepository;

    public function __construct(CollegeDeleteRepository $collegeDeleteRepo)
    {
        $this->collegeDeleteRepository = $collegeDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeDeleteRepository->pushCriteria(new RequestCriteria($request));
            $collegeDeletes = $this->collegeDeleteRepository->all();

            return view('college_deletes.index')
                ->with('collegeDeletes', $collegeDeletes);
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
            return view('college_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $collegeDelete = $this->collegeDeleteRepository->create($input);
            
                Flash::success('College Delete saved successfully.');
                return redirect(route('collegeDeletes.index'));
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
            $collegeDelete = $this->collegeDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeDelete))
            {
                Flash::error('College Delete not found');
                return redirect(route('collegeDeletes.index'));
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
            
            if($user_id == $collegeDelete -> user_id || $isShared)
            {
                return view('college_deletes.show')
                    ->with('collegeDelete', $collegeDelete);
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
            $collegeDelete = $this->collegeDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeDelete))
            {
                Flash::error('College Delete not found');
                return redirect(route('collegeDeletes.index'));
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
            
            if($user_id == $collegeDelete -> user_id || $isShared)
            {
                return view('college_deletes.edit')->with('collegeDelete', $collegeDelete);
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

    public function update($id, UpdateCollegeDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeDelete = $this->collegeDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeDelete))
            {
                Flash::error('College Delete not found');
                return redirect(route('collegeDeletes.index'));
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
            
            if($user_id == $collegeDelete -> user_id || $isShared)
            {
                $collegeDelete = $this->collegeDeleteRepository->update($request->all(), $id);
            
                Flash::success('College Delete updated successfully.');
                return redirect(route('collegeDeletes.index'));
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
            $collegeDelete = $this->collegeDeleteRepository->findWithoutFail($id);
    
            if(empty($collegeDelete))
            {
                Flash::error('College Delete not found');
                return redirect(route('collegeDeletes.index'));
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
            
            if($user_id == $collegeDelete -> user_id || $isShared)
            {
                $this->collegeDeleteRepository->delete($id);
            
                Flash::success('College Delete deleted successfully.');
                return redirect(route('collegeDeletes.index'));
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