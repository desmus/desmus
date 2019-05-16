<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateSharedProfileVideoLikeRequest;
use App\Http\Requests\UpdateSharedProfileVideoLikeRequest;
use App\Repositories\SharedProfileVideoLikeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class SharedProfileVideoLikeController extends AppBaseController
{
    /** @var  SharedProfileVideoLikeRepository */
    private $sharedProfileVideoLikeRepository;

    public function __construct(SharedProfileVideoLikeRepository $sharedProfileVideoLikeRepo)
    {
        $this->sharedProfileVideoLikeRepository = $sharedProfileVideoLikeRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->sharedProfileVideoLikeRepository->pushCriteria(new RequestCriteria($request));
            $sharedProfileVideoLikes = $this->sharedProfileVideoLikeRepository->all();
    
            return view('shared_profile_video_likes.index')
                ->with('sharedProfileVideoLikes', $sharedProfileVideoLikes);
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
            return view('shared_profile_video_likes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateSharedProfileVideoLikeRequest $request)
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
                $liked = DB::table('shared_profile_video_like')->where([['user_id', '=', $user_id],['s_p_v_id', '=', $request -> s_p_v_id]])->get();
    
                if(isset($liked[0]) == false)
                {
                    $sharedProfileVideoLike = $this->sharedProfileVideoLikeRepository->create($input);
        
                    DB::table('recent_activities')->insert(['name' => $sharedProfileVideoLike -> status, 'status' => 'active', 'type' => 's_p_v_l_c', 'user_id' => $user_id, 'entity_id' => $sharedProfileVideoLike -> id, 'created_at' => $now]);
        
                    Flash::success('Shared Profile Video Like saved successfully.');
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
            $sharedProfileVideoLike = $this->sharedProfileVideoLikeRepository->findWithoutFail($id);
    
            if(empty($sharedProfileVideoLike))
            {
                Flash::error('Shared Profile Video Like not found');
                return redirect(route('sharedProfileVideoLikes.index'));
            }
    
            if($user_id == $sharedProfileVideoLike -> user_id)
            {
                return view('shared_profile_video_likes.show')->with('sharedProfileVideoLike', $sharedProfileVideoLike);
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
            $sharedProfileVideoLike = $this->sharedProfileVideoLikeRepository->findWithoutFail($id);
    
            if(empty($sharedProfileVideoLike))
            {
                Flash::error('Shared Profile Video Like not found');
                return redirect(route('sharedProfileVideoLikes.index'));
            }
    
            if($user_id == $sharedProfileVideoLike -> user_id)
            {
                return view('shared_profile_video_likes.edit')->with('sharedProfileVideoLike', $sharedProfileVideoLike);
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

    public function update($id, UpdateSharedProfileVideoLikeRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $sharedProfileVideoLike = $this->sharedProfileVideoLikeRepository->findWithoutFail($id);
    
            if(empty($sharedProfileVideoLike))
            {
                Flash::error('Shared Profile Video Like not found');
                return redirect(route('sharedProfileVideoLikes.index'));
            }
    
            if($user_id == $sharedProfileVideoLike -> user_id)
            {
                $sharedProfileVideoLike = $this->sharedProfileVideoLikeRepository->update($request->all(), $id);
        
                DB::table('recent_activities')->insert(['name' => $sharedProfileVideoLike -> status, 'status' => 'active', 'type' => 's_p_v_l_u', 'user_id' => $user_id, 'entity_id' => $sharedProfileVideoLike -> id, 'created_at' => $now]);
        
                Flash::success('Shared Profile Video Like updated successfully.');
                return redirect(route('sharedProfileVideoLikes.index'));
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
            $sharedProfileVideoLike = $this->sharedProfileVideoLikeRepository->findWithoutFail($id);
    
            if(empty($sharedProfileVideoLike))
            {
                Flash::error('Shared Profile Video Like not found');
                return redirect(route('sharedProfileVideoLikes.index'));
            }
    
            if($user_id == $sharedProfileVideoLike -> user_id)
            {
                $this->sharedProfileVideoLikeRepository->delete($id);
        
                DB::table('recent_activities')->insert(['name' => $sharedProfileVideoLike -> status, 'status' => 'active', 'type' => 's_p_v_l_d', 'user_id' => $user_id, 'entity_id' => $sharedProfileVideoLike -> id, 'created_at' => $now]);
        
                Flash::success('Shared Profile Video Like deleted successfully.');
                return redirect(route('sharedProfileVideoLikes.index'));
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
