<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePublicAdvertisementLikeRequest;
use App\Http\Requests\UpdatePublicAdvertisementLikeRequest;
use App\Repositories\PublicAdvertisementLikeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PublicAdvertisementLikeController extends AppBaseController
{
    private $publicAdvertisementLikeRepository;

    public function __construct(PublicAdvertisementLikeRepository $publicAdvertisementLikeRepo)
    {
        $this->publicAdvertisementLikeRepository = $publicAdvertisementLikeRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->publicAdvertisementLikeRepository->pushCriteria(new RequestCriteria($request));
            $publicAdvertisementLikes = $this->publicAdvertisementLikeRepository->all();
    
            return view('public_advertisement_likes.index')
                ->with('publicAdvertisementLikes', $publicAdvertisementLikes);
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
            return view('public_advertisement_likes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreatePublicAdvertisementLikeRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            $liked = DB::table('public_advertisement_like')->where([['user_id', '=', $user_id],['public_advertisement_id', '=', $request -> public_advertisement_id]])->get();

            if(isset($liked[0]) == false)
            {
                $publicAdvertisementLike = $this->publicAdvertisementLikeRepository->create($input);
                
                DB::table('recent_activities')->insert(['name' => $publicAdvertisementLike -> status, 'status' => 'active', 'type' => 'p_ad_l_c', 'user_id' => $user_id, 'entity_id' => $publicAdvertisementLike -> id, 'created_at' => $now]);
        
                Flash::success('Public Advertisement Like saved successfully.');
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
            $publicAdvertisementLike = $this->publicAdvertisementLikeRepository->findWithoutFail($id);
    
            if(empty($publicAdvertisementLike))
            {
                Flash::error('Public Advertisement Like not found');
                return redirect(route('publicAdvertisementLikes.index'));
            }
    
            if($user_id == $publicAdvertisementLike -> user_id)
            {
                return view('public_advertisement_likes.show')->with('publicAdvertisementLike', $publicAdvertisementLike);
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
            $publicAdvertisementLike = $this->publicAdvertisementLikeRepository->findWithoutFail($id);
    
            if(empty($publicAdvertisementLike))
            {
                Flash::error('Public Advertisement Like not found');
                return redirect(route('publicAdvertisementLikes.index'));
            }
    
            if($user_id == $publicAdvertisementLike -> user_id)
            {
                return view('public_advertisement_likes.edit')->with('publicAdvertisementLike', $publicAdvertisementLike);
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

    public function update($id, UpdatePublicAdvertisementLikeRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $publicAdvertisementLike = $this->publicAdvertisementLikeRepository->findWithoutFail($id);
    
            if(empty($publicAdvertisementLike))
            {
                Flash::error('Public Advertisement Like not found');
                return redirect(route('publicAdvertisementLikes.index'));
            }
    
            if($user_id == $publicAdvertisementLike -> user_id)
            {
                $publicAdvertisementLike = $this->publicAdvertisementLikeRepository->update($request->all(), $id);
        
                DB::table('recent_activities')->insert(['name' => $publicAdvertisementLike -> status, 'status' => 'active', 'type' => 'p_ad_l_u', 'user_id' => $user_id, 'entity_id' => $publicAdvertisementLike -> id, 'created_at' => $now]);
        
                Flash::success('Public Advertisement Like updated successfully.');
                return redirect(route('publicAdvertisementLikes.index'));
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
            $publicAdvertisementLike = $this->publicAdvertisementLikeRepository->findWithoutFail($id);
    
            if(empty($publicAdvertisementLike))
            {
                Flash::error('Public Advertisement Like not found');
                return redirect(route('publicAdvertisementLikes.index'));
            }
    
            if($user_id == $publicAdvertisementLike -> user_id)
            {
                $this->publicAdvertisementLikeRepository->delete($id);
        
                DB::table('recent_activities')->insert(['name' => $publicAdvertisementLike -> status, 'status' => 'active', 'type' => 'p_ad_l_d', 'user_id' => $user_id, 'entity_id' => $publicAdvertisementLike -> id, 'created_at' => $now]);
        
                Flash::success('Public Advertisement Like deleted successfully.');
                return redirect(route('publicAdvertisementLikes.index'));
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