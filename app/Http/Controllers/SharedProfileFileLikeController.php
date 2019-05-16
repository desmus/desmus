<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateSharedProfileFileLikeRequest;
use App\Http\Requests\UpdateSharedProfileFileLikeRequest;
use App\Repositories\SharedProfileFileLikeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class SharedProfileFileLikeController extends AppBaseController
{
    /** @var  SharedProfileFileLikeRepository */
    private $sharedProfileFileLikeRepository;

    public function __construct(SharedProfileFileLikeRepository $sharedProfileFileLikeRepo)
    {
        $this->sharedProfileFileLikeRepository = $sharedProfileFileLikeRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->sharedProfileFileLikeRepository->pushCriteria(new RequestCriteria($request));
            $sharedProfileFileLikes = $this->sharedProfileFileLikeRepository->all();
    
            return view('shared_profile_file_likes.index')
                ->with('sharedProfileFileLikes', $sharedProfileFileLikes);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function create()
    {
        $user_id = Auth::user()->id;
        
        if(Auth::user() != null)
        {
            return view('shared_profile_file_likes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateSharedProfileFileLikeRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            
            $userSharedProfiles = DB::table('user_shared_profile')->where('shared_user_id', '=', $request -> user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userSharedProfiles as $userSharedProfile)
            {
                if($userSharedProfile -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            if($user_id == $request -> user_id || $isShared)
            {
                $input = $request->all();
                $liked = DB::table('shared_profile_file_like')->where([['user_id', '=', $user_id],['s_p_f_id', '=', $request -> s_p_f_id]])->get();
                
                if(isset($liked[0]) == false)
                {
                    $sharedProfileFileLike = $this->sharedProfileFileLikeRepository->create($input);
        
                    DB::table('recent_activities')->insert(['name' => $sharedProfileFileLike -> status, 'status' => 'active', 'type' => 's_p_f_l_c', 'user_id' => $user_id, 'entity_id' => $sharedProfileFileLike -> id, 'created_at' => $now]);
        
                    Flash::success('Shared Profile File Like saved successfully.');
                    return redirect(route('sharedProfile.index'));
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
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function show($id)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $sharedProfileFileLike = $this->sharedProfileFileLikeRepository->findWithoutFail($id);
    
            if(empty($sharedProfileFileLike))
            {
                Flash::error('Shared Profile File Like not found');
                return redirect(route('sharedProfileFileLikes.index'));
            }
    
            if($user_id == $sharedProfileFileLike -> user_id)
            {
                return view('shared_profile_file_likes.show')->with('sharedProfileFileLike', $sharedProfileFileLike);
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
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $sharedProfileFileLike = $this->sharedProfileFileLikeRepository->findWithoutFail($id);
    
            if(empty($sharedProfileFileLike))
            {
                Flash::error('Shared Profile File Like not found');
                return redirect(route('sharedProfileFileLikes.index'));
            }
    
            if($user_id == $sharedProfileFileLike -> user_id)
            {
                return view('shared_profile_file_likes.edit')->with('sharedProfileFileLike', $sharedProfileFileLike);
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

    public function update($id, UpdateSharedProfileFileLikeRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $sharedProfileFileLike = $this->sharedProfileFileLikeRepository->findWithoutFail($id);
    
            if(empty($sharedProfileFileLike))
            {
                Flash::error('Shared Profile File Like not found');
                return redirect(route('sharedProfileFileLikes.index'));
            }
    
            if($user_id == $sharedProfileFileLike -> user_id)
            {
                $sharedProfileFileLike = $this->sharedProfileFileLikeRepository->update($request->all(), $id);
        
                DB::table('recent_activities')->insert(['name' => $sharedProfileFileLike -> status, 'status' => 'active', 'type' => 's_p_f_l_u', 'user_id' => $user_id, 'entity_id' => $sharedProfileFileLike -> id, 'created_at' => $now]);
        
                Flash::success('Shared Profile File Like updated successfully.');
                return redirect(route('sharedProfileFileLikes.index'));
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
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $sharedProfileFileLike = $this->sharedProfileFileLikeRepository->findWithoutFail($id);
    
            if(empty($sharedProfileFileLike))
            {
                Flash::error('Shared Profile File Like not found');
                return redirect(route('sharedProfileFileLikes.index'));
            }
    
            if($user_id == $sharedProfileFileLike -> user_id)
            {
                $this->sharedProfileFileLikeRepository->delete($id);
        
                DB::table('recent_activities')->insert(['name' => $sharedProfileFileLike -> status, 'status' => 'active', 'type' => 's_p_f_l_d', 'user_id' => $user_id, 'entity_id' => $sharedProfileFileLike -> id, 'created_at' => $now]);
        
                Flash::success('Shared Profile File Like deleted successfully.');
                return redirect(route('sharedProfileFileLikes.index'));
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