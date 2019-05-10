<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePublicImageLikeRequest;
use App\Http\Requests\UpdatePublicImageLikeRequest;
use App\Repositories\PublicImageLikeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PublicImageLikeController extends AppBaseController
{
    private $publicImageLikeRepository;

    public function __construct(PublicImageLikeRepository $publicImageLikeRepo)
    {
        $this->publicImageLikeRepository = $publicImageLikeRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->publicImageLikeRepository->pushCriteria(new RequestCriteria($request));
            $publicImageLikes = $this->publicImageLikeRepository->all();
    
            return view('public_image_likes.index')
                ->with('publicImageLikes', $publicImageLikes);
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
            return view('public_image_likes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreatePublicImageLikeRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            $liked = DB::table('public_image_like')->where([['user_id', '=', $user_id],['public_image_id', '=', $request -> public_image_id]])->get();

            if(isset($liked[0]) == false)
            {
                $publicImageLike = $this->publicImageLikeRepository->create($input);
        
                DB::table('recent_activities')->insert(['name' => $publicImageLike -> status, 'status' => 'active', 'type' => 'p_i_l_c', 'user_id' => $user_id, 'entity_id' => $publicImageLike -> id, 'created_at' => $now]);
        
                Flash::success('Public Image Like saved successfully.');
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
            $publicImageLike = $this->publicImageLikeRepository->findWithoutFail($id);
    
            if(empty($publicImageLike))
            {
                Flash::error('Public Image Like not found');
                return redirect(route('publicImageLikes.index'));
            }
    
            if($user_id == $publicImageLike -> user_id)
            {
                return view('public_image_likes.show')->with('publicImageLike', $publicImageLike);
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
            $publicImageLike = $this->publicImageLikeRepository->findWithoutFail($id);
    
            if(empty($publicImageLike))
            {
                Flash::error('Public Image Like not found');
                return redirect(route('publicImageLikes.index'));
            }
    
            if($user_id == $publicImageLike -> user_id)
            {
                return view('public_image_likes.edit')->with('publicImageLike', $publicImageLike);
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

    public function update($id, UpdatePublicImageLikeRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $publicImageLike = $this->publicImageLikeRepository->findWithoutFail($id);
    
            if(empty($publicImageLike))
            {
                Flash::error('Public Image Like not found');
                return redirect(route('publicImageLikes.index'));
            }
    
            if($user_id == $publicImageLike -> user_id)
            {
                $publicImageLike = $this->publicImageLikeRepository->update($request->all(), $id);
        
                DB::table('recent_activities')->insert(['name' => $publicImageLike -> status, 'status' => 'active', 'type' => 'p_i_l_u', 'user_id' => $user_id, 'entity_id' => $publicImageLike -> id, 'created_at' => $now]);
        
                Flash::success('Public Image Like updated successfully.');
                return redirect(route('publicImageLikes.index'));
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
            $publicImageLike = $this->publicImageLikeRepository->findWithoutFail($id);
    
            if(empty($publicImageLike))
            {
                Flash::error('Public Image Like not found');
                return redirect(route('publicImageLikes.index'));
            }
    
            if($user_id == $publicImageLike -> user_id)
            {
                $this->publicImageLikeRepository->delete($id);
        
                DB::table('recent_activities')->insert(['name' => $publicImageLike -> status, 'status' => 'active', 'type' => 'p_i_l_d', 'user_id' => $user_id, 'entity_id' => $publicImageLike -> id, 'created_at' => $now]);
        
                Flash::success('Public Image Like deleted successfully.');
                return redirect(route('publicImageLikes.index'));
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