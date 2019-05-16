<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateSharedProfileAudioLikeRequest;
use App\Http\Requests\UpdateSharedProfileAudioLikeRequest;
use App\Repositories\SharedProfileAudioLikeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class SharedProfileAudioLikeController extends AppBaseController
{
    private $sharedProfileAudioLikeRepository;

    public function __construct(SharedProfileAudioLikeRepository $sharedProfileAudioLikeRepo)
    {
        $this->sharedProfileAudioLikeRepository = $sharedProfileAudioLikeRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->sharedProfileAudioLikeRepository->pushCriteria(new RequestCriteria($request));
            $sharedProfileAudioLikes = $this->sharedProfileAudioLikeRepository->all();
    
            return view('shared_profile_audio_likes.index')
                ->with('sharedProfileAudioLikes', $sharedProfileAudioLikes);
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
            return view('shared_profile_audio_likes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateSharedProfileAudioLikeRequest $request)
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
                $liked = DB::table('shared_profile_audio_like')->where([['user_id', '=', $user_id],['s_p_a_id', '=', $request -> s_p_a_id]])->get();
    
                if(isset($liked[0]) == false)
                {
                    $sharedProfileAudioLike = $this->sharedProfileAudioLikeRepository->create($input);
        
                    DB::table('recent_activities')->insert(['name' => $sharedProfileAudioLike -> status, 'status' => 'active', 'type' => 's_p_a_l_c', 'user_id' => $user_id, 'entity_id' => $sharedProfileAudioLike -> id, 'created_at' => $now]);
        
                    Flash::success('Shared Profile Audio Like saved successfully.');
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
            $sharedProfileAudioLike = $this->sharedProfileAudioLikeRepository->findWithoutFail($id);
    
            if(empty($sharedProfileAudioLike))
            {
                Flash::error('Shared Profile Audio Like not found');
                return redirect(route('sharedProfileAudioLikes.index'));
            }
    
            if($user_id == $sharedProfileAudioLike -> user_id)
            {
                return view('shared_profile_audio_likes.show')->with('sharedProfileAudioLike', $sharedProfileAudioLike);
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
            $sharedProfileAudioLike = $this->sharedProfileAudioLikeRepository->findWithoutFail($id);
    
            if(empty($sharedProfileAudioLike))
            {
                Flash::error('Shared Profile Audio Like not found');
                return redirect(route('sharedProfileAudioLikes.index'));
            }
    
            if($user_id == $sharedProfileAudioLike -> user_id)
            {
                return view('shared_profile_audio_likes.edit')->with('sharedProfileAudioLike', $sharedProfileAudioLike);
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

    public function update($id, UpdateSharedProfileAudioLikeRequest $request)
    {
        $now = Carbon::now();
        $user_id = Auth::user()->id;
        $sharedProfileAudioLike = $this->sharedProfileAudioLikeRepository->findWithoutFail($id);

        if(empty($sharedProfileAudioLike))
        {
            Flash::error('Shared Profile Audio Like not found');
            return redirect(route('sharedProfileAudioLikes.index'));
        }

        if($user_id == $sharedProfileAudioLike -> user_id)
        {
            $sharedProfileAudioLike = $this->sharedProfileAudioLikeRepository->update($request->all(), $id);
    
            DB::table('recent_activities')->insert(['name' => $sharedProfileAudioLike -> status, 'status' => 'active', 'type' => 's_p_a_l_u', 'user_id' => $user_id, 'entity_id' => $sharedProfileAudioLike -> id, 'created_at' => $now]);
    
            Flash::success('Shared Profile Audio Like updated successfully.');
            return redirect(route('sharedProfileAudioLikes.index'));
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
            $sharedProfileAudioLike = $this->sharedProfileAudioLikeRepository->findWithoutFail($id);
    
            if (empty($sharedProfileAudioLike))
            {
                Flash::error('Shared Profile Audio Like not found');
                return redirect(route('sharedProfileAudioLikes.index'));
            }
    
            if($user_id == $sharedProfileAudioLike -> user_id)
            {
                $this->sharedProfileAudioLikeRepository->delete($id);
        
                DB::table('recent_activities')->insert(['name' => $sharedProfileAudioLike -> status, 'status' => 'active', 'type' => 's_p_a_l_d', 'user_id' => $user_id, 'entity_id' => $sharedProfileAudioLike -> id, 'created_at' => $now]);
        
                Flash::success('Shared Profile Audio Like deleted successfully.');
                return redirect(route('sharedProfileAudioLikes.index'));
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