<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateSharedProfileNoteLikeRequest;
use App\Http\Requests\UpdateSharedProfileNoteLikeRequest;
use App\Repositories\SharedProfileNoteLikeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class SharedProfileNoteLikeController extends AppBaseController
{
    /** @var  SharedProfileNoteLikeRepository */
    private $sharedProfileNoteLikeRepository;

    public function __construct(SharedProfileNoteLikeRepository $sharedProfileNoteLikeRepo)
    {
        $this->sharedProfileNoteLikeRepository = $sharedProfileNoteLikeRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->sharedProfileNoteLikeRepository->pushCriteria(new RequestCriteria($request));
            $sharedProfileNoteLikes = $this->sharedProfileNoteLikeRepository->all();
    
            return view('shared_profile_note_likes.index')
                ->with('sharedProfileNoteLikes', $sharedProfileNoteLikes);
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
            return view('shared_profile_note_likes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateSharedProfileNoteLikeRequest $request)
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
                $liked = DB::table('shared_profile_note_like')->where([['user_id', '=', $user_id],['s_p_n_id', '=', $request -> s_p_n_id]])->get();
    
                if(isset($liked[0]) == false)
                {
                    $sharedProfileNoteLike = $this->sharedProfileNoteLikeRepository->create($input);
            
                    DB::table('recent_activities')->insert(['name' => $sharedProfileNoteLike -> status, 'status' => 'active', 'type' => 's_p_n_l_c', 'user_id' => $user_id, 'entity_id' => $sharedProfileNoteLike -> id, 'created_at' => $now]);
            
                    Flash::success('Shared Profile Note Like saved successfully.');
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
            $sharedProfileNoteLike = $this->sharedProfileNoteLikeRepository->findWithoutFail($id);
    
            if(empty($sharedProfileNoteLike))
            {
                Flash::error('Shared Profile Note Like not found');
                return redirect(route('sharedProfileNoteLikes.index'));
            }
    
            if($user_id == $sharedProfileNoteLike -> user_id)
            {
                return view('shared_profile_note_likes.show')->with('sharedProfileNoteLike', $sharedProfileNoteLike);
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
            $sharedProfileNoteLike = $this->sharedProfileNoteLikeRepository->findWithoutFail($id);
    
            if(empty($sharedProfileNoteLike))
            {
                Flash::error('Shared Profile Note Like not found');
                return redirect(route('sharedProfileNoteLikes.index'));
            }
    
            if($user_id == $sharedProfileNoteLike -> user_id)
            {
                return view('shared_profile_note_likes.edit')->with('sharedProfileNoteLike', $sharedProfileNoteLike);
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

    public function update($id, UpdateSharedProfileNoteLikeRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $sharedProfileNoteLike = $this->sharedProfileNoteLikeRepository->findWithoutFail($id);
    
            if(empty($sharedProfileNoteLike))
            {
                Flash::error('Shared Profile Note Like not found');
                return redirect(route('sharedProfileNoteLikes.index'));
            }
    
            if($user_id == $sharedProfileNoteLike -> user_id)
            {
                $sharedProfileNoteLike = $this->sharedProfileNoteLikeRepository->update($request->all(), $id);
        
                DB::table('recent_activities')->insert(['name' => $sharedProfileNoteLike -> status, 'status' => 'active', 'type' => 's_p_n_l_u', 'user_id' => $user_id, 'entity_id' => $sharedProfileNoteLike -> id, 'created_at' => $now]);
        
                Flash::success('Shared Profile Note Like updated successfully.');
                return redirect(route('sharedProfileNoteLikes.index'));
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
            $sharedProfileNoteLike = $this->sharedProfileNoteLikeRepository->findWithoutFail($id);
    
            if(empty($sharedProfileNoteLike))
            {
                Flash::error('Shared Profile Note Like not found');
                return redirect(route('sharedProfileNoteLikes.index'));
            }
    
            if($user_id == $sharedProfileNoteLike -> user_id)
            {
                $this->sharedProfileNoteLikeRepository->delete($id);
        
                DB::table('recent_activities')->insert(['name' => $sharedProfileNoteLike -> status, 'status' => 'active', 'type' => 's_p_n_l_d', 'user_id' => $user_id, 'entity_id' => $sharedProfileNoteLike -> id, 'created_at' => $now]);
        
                Flash::success('Shared Profile Note Like deleted successfully.');
                return redirect(route('sharedProfileNoteLikes.index'));
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