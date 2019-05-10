<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePublicVideoLikeRequest;
use App\Http\Requests\UpdatePublicVideoLikeRequest;
use App\Repositories\PublicVideoLikeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PublicVideoLikeController extends AppBaseController
{
    private $publicVideoLikeRepository;

    public function __construct(PublicVideoLikeRepository $publicVideoLikeRepo)
    {
        $this->publicVideoLikeRepository = $publicVideoLikeRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->publicVideoLikeRepository->pushCriteria(new RequestCriteria($request));
            $publicVideoLikes = $this->publicVideoLikeRepository->all();
    
            return view('public_video_likes.index')
                ->with('publicVideoLikes', $publicVideoLikes);
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
            return view('public_video_likes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreatePublicVideoLikeRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            $liked = DB::table('public_video_like')->where([['user_id', '=', $user_id],['public_video_id', '=', $request -> public_video_id]])->get();

            if(isset($liked[0]) == false)
            {
                $publicVideoLike = $this->publicVideoLikeRepository->create($input);
    
                DB::table('recent_activities')->insert(['name' => $publicVideoLike -> status, 'status' => 'active', 'type' => 'p_v_l_c', 'user_id' => $user_id, 'entity_id' => $publicVideoLike -> id, 'created_at' => $now]);
    
                Flash::success('Public Video Like saved successfully.');
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
            $publicVideoLike = $this->publicVideoLikeRepository->findWithoutFail($id);
    
            if(empty($publicVideoLike))
            {
                Flash::error('Public Video Like not found');
                return redirect(route('publicVideoLikes.index'));
            }
    
            if($user_id == $publicVideoLike -> user_id)
            {
                return view('public_video_likes.show')->with('publicVideoLike', $publicVideoLike);
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
            $publicVideoLike = $this->publicVideoLikeRepository->findWithoutFail($id);
    
            if(empty($publicVideoLike))
            {
                Flash::error('Public Video Like not found');
                return redirect(route('publicVideoLikes.index'));
            }
    
            if($user_id == $publicVideoLike -> user_id)
            {
                return view('public_video_likes.edit')->with('publicVideoLike', $publicVideoLike);
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

    public function update($id, UpdatePublicVideoLikeRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $publicVideoLike = $this->publicVideoLikeRepository->findWithoutFail($id);
    
            if(empty($publicVideoLike))
            {
                Flash::error('Public Video Like not found');
                return redirect(route('publicVideoLikes.index'));
            }
    
            if($user_id == $publicVideoLike -> user_id)
            {
                $publicVideoLike = $this->publicVideoLikeRepository->update($request->all(), $id);
        
                DB::table('recent_activities')->insert(['name' => $publicVideoLike -> status, 'status' => 'active', 'type' => 'p_v_l_u', 'user_id' => $user_id, 'entity_id' => $publicVideoLike -> id, 'created_at' => $now]);
        
                Flash::success('Public Video Like updated successfully.');
                return redirect(route('publicVideoLikes.index'));
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
            $publicVideoLike = $this->publicVideoLikeRepository->findWithoutFail($id);
    
            if(empty($publicVideoLike))
            {
                Flash::error('Public Video Like not found');
                return redirect(route('publicVideoLikes.index'));
            }
    
            if($user_id == $publicVideoLike -> user_id)
            {
                $this->publicVideoLikeRepository->delete($id);
        
                DB::table('recent_activities')->insert(['name' => $publicVideoLike -> status, 'status' => 'active', 'type' => 'p_v_l_d', 'user_id' => $user_id, 'entity_id' => $publicVideoLike -> id, 'created_at' => $now]);
        
                Flash::success('Public Video Like deleted successfully.');
                return redirect(route('publicVideoLikes.index'));
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