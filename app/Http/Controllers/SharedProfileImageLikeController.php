<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateSharedProfileImageLikeRequest;
use App\Http\Requests\UpdateSharedProfileImageLikeRequest;
use App\Repositories\SharedProfileImageLikeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class SharedProfileImageLikeController extends AppBaseController
{
    /** @var  SharedProfileImageLikeRepository */
    private $sharedProfileImageLikeRepository;

    public function __construct(SharedProfileImageLikeRepository $sharedProfileImageLikeRepo)
    {
        $this->sharedProfileImageLikeRepository = $sharedProfileImageLikeRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->sharedProfileImageLikeRepository->pushCriteria(new RequestCriteria($request));
            $sharedProfileImageLikes = $this->sharedProfileImageLikeRepository->all();
    
            return view('shared_profile_image_likes.index')
                ->with('sharedProfileImageLikes', $sharedProfileImageLikes);
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
            return view('shared_profile_image_likes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateSharedProfileImageLikeRequest $request)
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
                $liked = DB::table('shared_profile_image_like')->where([['user_id', '=', $user_id],['s_p_i_id', '=', $request -> s_p_i_id]])->get();

                if(isset($liked[0]) == false)
                {
                    $sharedProfileImageLike = $this->sharedProfileImageLikeRepository->create($input);
            
                    DB::table('recent_activities')->insert(['name' => $sharedProfileImageLike -> status, 'status' => 'active', 'type' => 's_p_i_l_c', 'user_id' => $user_id, 'entity_id' => $sharedProfileImageLike -> id, 'created_at' => $now]);
            
                    Flash::success('Shared Profile Image Like saved successfully.');
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
            $sharedProfileImageLike = $this->sharedProfileImageLikeRepository->findWithoutFail($id);
    
            if(empty($sharedProfileImageLike))
            {
                Flash::error('Shared Profile Image Like not found');
                return redirect(route('sharedProfileImageLikes.index'));
            }
    
            if($user_id == $sharedProfileImageLike -> user_id)
            {
                return view('shared_profile_image_likes.show')->with('sharedProfileImageLike', $sharedProfileImageLike);
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
            $sharedProfileImageLike = $this->sharedProfileImageLikeRepository->findWithoutFail($id);
    
            if(empty($sharedProfileImageLike))
            {
                Flash::error('Shared Profile Image Like not found');
                return redirect(route('sharedProfileImageLikes.index'));
            }
    
            if($user_id == $sharedProfileImageLike -> user_id)
            {
                return view('shared_profile_image_likes.edit')->with('sharedProfileImageLike', $sharedProfileImageLike);
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

    public function update($id, UpdateSharedProfileImageLikeRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $sharedProfileImageLike = $this->sharedProfileImageLikeRepository->findWithoutFail($id);
    
            if(empty($sharedProfileImageLike))
            {
                Flash::error('Shared Profile Image Like not found');
                return redirect(route('sharedProfileImageLikes.index'));
            }
    
            if($user_id == $sharedProfileImageLike -> user_id)
            {
                $sharedProfileImageLike = $this->sharedProfileImageLikeRepository->update($request->all(), $id);
        
                DB::table('recent_activities')->insert(['name' => $sharedProfileImageLike -> status, 'status' => 'active', 'type' => 's_p_i_l_u', 'user_id' => $user_id, 'entity_id' => $sharedProfileImageLike -> id, 'created_at' => $now]);
        
                Flash::success('Shared Profile Image Like updated successfully.');
                return redirect(route('sharedProfileImageLikes.index'));
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
            $sharedProfileImageLike = $this->sharedProfileImageLikeRepository->findWithoutFail($id);
    
            if(empty($sharedProfileImageLike))
            {
                Flash::error('Shared Profile Image Like not found');
                return redirect(route('sharedProfileImageLikes.index'));
            }
    
            if($user_id == $sharedProfileImageLike -> user_id)
            {
                $this->sharedProfileImageLikeRepository->delete($id);
        
                DB::table('recent_activities')->insert(['name' => $sharedProfileImageLike -> status, 'status' => 'active', 'type' => 's_p_i_l_d', 'user_id' => $user_id, 'entity_id' => $sharedProfileImageLike -> id, 'created_at' => $now]);
        
                Flash::success('Shared Profile Image Like deleted successfully.');
                return redirect(route('sharedProfileImageLikes.index'));
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