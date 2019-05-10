<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePublicAudioLikeRequest;
use App\Http\Requests\UpdatePublicAudioLikeRequest;
use App\Repositories\PublicAudioLikeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PublicAudioLikeController extends AppBaseController
{
    private $publicAudioLikeRepository;

    public function __construct(PublicAudioLikeRepository $publicAudioLikeRepo)
    {
        $this->publicAudioLikeRepository = $publicAudioLikeRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->publicAudioLikeRepository->pushCriteria(new RequestCriteria($request));
            $publicAudioLikes = $this->publicAudioLikeRepository->all();
    
            return view('public_audio_likes.index')
                ->with('publicAudioLikes', $publicAudioLikes);
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
            return view('public_audio_likes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreatePublicAudioLikeRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            $liked = DB::table('public_audio_like')->where([['user_id', '=', $user_id],['public_audio_id', '=', $request -> public_audio_id]])->get();

            if(isset($liked[0]) == false)
            {
                $publicAudioLike = $this->publicAudioLikeRepository->create($input);
    
                DB::table('recent_activities')->insert(['name' => $publicAudioLike -> status, 'status' => 'active', 'type' => 'p_a_l_c', 'user_id' => $user_id, 'entity_id' => $publicAudioLike -> id, 'created_at' => $now]);
    
                Flash::success('Public Audio Like saved successfully.');
                return redirect(route('publicProfile.index'));
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
            $publicAudioLike = $this->publicAudioLikeRepository->findWithoutFail($id);
    
            if(empty($publicAudioLike))
            {
                Flash::error('Public Audio Like not found');
                return redirect(route('publicAudioLikes.index'));
            }
    
            if($user_id == $publicAudioLike -> user_id)
            {
                return view('public_audio_likes.show')->with('publicAudioLike', $publicAudioLike);
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
            $publicAudioLike = $this->publicAudioLikeRepository->findWithoutFail($id);
    
            if(empty($publicAudioLike))
            {
                Flash::error('Public Audio Like not found');
                return redirect(route('publicAudioLikes.index'));
            }
    
            if($user_id == $publicAudioLike -> user_id)
            {
                return view('public_audio_likes.edit')->with('publicAudioLike', $publicAudioLike);
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

    public function update($id, UpdatePublicAudioLikeRequest $request)
    {
        $now = Carbon::now();
        $user_id = Auth::user()->id;
        $publicAudioLike = $this->publicAudioLikeRepository->findWithoutFail($id);

        if(empty($publicAudioLike))
        {
            Flash::error('Public Audio Like not found');
            return redirect(route('publicAudioLikes.index'));
        }

        if($user_id == $publicAudioLike -> user_id)
        {
            $publicAudioLike = $this->publicAudioLikeRepository->update($request->all(), $id);
    
            DB::table('recent_activities')->insert(['name' => $publicAudioLike -> status, 'status' => 'active', 'type' => 'p_a_l_u', 'user_id' => $user_id, 'entity_id' => $publicAudioLike -> id, 'created_at' => $now]);
    
            Flash::success('Public Audio Like updated successfully.');
            return redirect(route('publicAudioLikes.index'));
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
            $publicAudioLike = $this->publicAudioLikeRepository->findWithoutFail($id);
    
            if (empty($publicAudioLike))
            {
                Flash::error('Public Audio Like not found');
                return redirect(route('publicAudioLikes.index'));
            }
    
            if($user_id == $publicAudioLike -> user_id)
            {
                $this->publicAudioLikeRepository->delete($id);
        
                DB::table('recent_activities')->insert(['name' => $publicAudioLike -> status, 'status' => 'active', 'type' => 'p_a_l_d', 'user_id' => $user_id, 'entity_id' => $publicAudioLike -> id, 'created_at' => $now]);
        
                Flash::success('Public Audio Like deleted successfully.');
                return redirect(route('publicAudioLikes.index'));
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