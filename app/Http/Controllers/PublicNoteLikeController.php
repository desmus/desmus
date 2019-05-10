<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePublicNoteLikeRequest;
use App\Http\Requests\UpdatePublicNoteLikeRequest;
use App\Repositories\PublicNoteLikeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PublicNoteLikeController extends AppBaseController
{
    private $publicNoteLikeRepository;

    public function __construct(PublicNoteLikeRepository $publicNoteLikeRepo)
    {
        $this->publicNoteLikeRepository = $publicNoteLikeRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->publicNoteLikeRepository->pushCriteria(new RequestCriteria($request));
            $publicNoteLikes = $this->publicNoteLikeRepository->all();
    
            return view('public_note_likes.index')
                ->with('publicNoteLikes', $publicNoteLikes);
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
            return view('public_note_likes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreatePublicNoteLikeRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            $liked = DB::table('public_note_like')->where([['user_id', '=', $user_id],['public_note_id', '=', $request -> public_note_id]])->get();

            if(isset($liked[0]) == false)
            {
                $publicNoteLike = $this->publicNoteLikeRepository->create($input);
        
                DB::table('recent_activities')->insert(['name' => $publicNoteLike -> status, 'status' => 'active', 'type' => 'p_n_l_c', 'user_id' => $user_id, 'entity_id' => $publicNoteLike -> id, 'created_at' => $now]);
        
                Flash::success('Public Note Like saved successfully.');
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
            $publicNoteLike = $this->publicNoteLikeRepository->findWithoutFail($id);
    
            if(empty($publicNoteLike))
            {
                Flash::error('Public Note Like not found');
                return redirect(route('publicNoteLikes.index'));
            }
    
            if($user_id == $publicNoteLike -> user_id)
            {
                return view('public_note_likes.show')->with('publicNoteLike', $publicNoteLike);
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
            $publicNoteLike = $this->publicNoteLikeRepository->findWithoutFail($id);
    
            if(empty($publicNoteLike))
            {
                Flash::error('Public Note Like not found');
                return redirect(route('publicNoteLikes.index'));
            }
    
            if($user_id == $publicNoteLike -> user_id)
            {
                return view('public_note_likes.edit')->with('publicNoteLike', $publicNoteLike);
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

    public function update($id, UpdatePublicNoteLikeRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $publicNoteLike = $this->publicNoteLikeRepository->findWithoutFail($id);
    
            if(empty($publicNoteLike))
            {
                Flash::error('Public Note Like not found');
                return redirect(route('publicNoteLikes.index'));
            }
    
            if($user_id == $publicNoteLike -> user_id)
            {
                $publicNoteLike = $this->publicNoteLikeRepository->update($request->all(), $id);
        
                DB::table('recent_activities')->insert(['name' => $publicNoteLike -> status, 'status' => 'active', 'type' => 'p_n_l_u', 'user_id' => $user_id, 'entity_id' => $publicNoteLike -> id, 'created_at' => $now]);
        
                Flash::success('Public Note Like updated successfully.');
                return redirect(route('publicNoteLikes.index'));
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
            $publicNoteLike = $this->publicNoteLikeRepository->findWithoutFail($id);
    
            if(empty($publicNoteLike))
            {
                Flash::error('Public Note Like not found');
                return redirect(route('publicNoteLikes.index'));
            }
    
            if($user_id == $publicNoteLike -> user_id)
            {
                $this->publicNoteLikeRepository->delete($id);
        
                DB::table('recent_activities')->insert(['name' => $publicNoteLike -> status, 'status' => 'active', 'type' => 'p_n_l_d', 'user_id' => $user_id, 'entity_id' => $publicNoteLike -> id, 'created_at' => $now]);
        
                Flash::success('Public Note Like deleted successfully.');
                return redirect(route('publicNoteLikes.index'));
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