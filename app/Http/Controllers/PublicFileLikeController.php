<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePublicFileLikeRequest;
use App\Http\Requests\UpdatePublicFileLikeRequest;
use App\Repositories\PublicFileLikeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PublicFileLikeController extends AppBaseController
{
    private $publicFileLikeRepository;

    public function __construct(PublicFileLikeRepository $publicFileLikeRepo)
    {
        $this->publicFileLikeRepository = $publicFileLikeRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->publicFileLikeRepository->pushCriteria(new RequestCriteria($request));
            $publicFileLikes = $this->publicFileLikeRepository->all();
    
            return view('public_file_likes.index')
                ->with('publicFileLikes', $publicFileLikes);
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
            return view('public_file_likes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreatePublicFileLikeRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            $liked = DB::table('public_file_like')->where([['user_id', '=', $user_id],['public_file_id', '=', $request -> public_file_id]])->get();
            
            if(isset($liked[0]) == false)
            {
                $publicFileLike = $this->publicFileLikeRepository->create($input);
    
                DB::table('recent_activities')->insert(['name' => $publicFileLike -> status, 'status' => 'active', 'type' => 'p_f_l_c', 'user_id' => $user_id, 'entity_id' => $publicFileLike -> id, 'created_at' => $now]);
    
                Flash::success('Public File Like saved successfully.');
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
            $publicFileLike = $this->publicFileLikeRepository->findWithoutFail($id);
    
            if(empty($publicFileLike))
            {
                Flash::error('Public File Like not found');
                return redirect(route('publicFileLikes.index'));
            }
    
            if($user_id == $publicFileLike -> user_id)
            {
                return view('public_file_likes.show')->with('publicFileLike', $publicFileLike);
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
            $publicFileLike = $this->publicFileLikeRepository->findWithoutFail($id);
    
            if(empty($publicFileLike))
            {
                Flash::error('Public File Like not found');
                return redirect(route('publicFileLikes.index'));
            }
    
            if($user_id == $publicFileLike -> user_id)
            {
                return view('public_file_likes.edit')->with('publicFileLike', $publicFileLike);
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

    public function update($id, UpdatePublicFileLikeRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $publicFileLike = $this->publicFileLikeRepository->findWithoutFail($id);
    
            if(empty($publicFileLike))
            {
                Flash::error('Public File Like not found');
                return redirect(route('publicFileLikes.index'));
            }
    
            if($user_id == $publicFileLike -> user_id)
            {
                $publicFileLike = $this->publicFileLikeRepository->update($request->all(), $id);
        
                DB::table('recent_activities')->insert(['name' => $publicFileLike -> status, 'status' => 'active', 'type' => 'p_f_l_u', 'user_id' => $user_id, 'entity_id' => $publicFileLike -> id, 'created_at' => $now]);
        
                Flash::success('Public File Like updated successfully.');
                return redirect(route('publicFileLikes.index'));
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
            $publicFileLike = $this->publicFileLikeRepository->findWithoutFail($id);
    
            if(empty($publicFileLike))
            {
                Flash::error('Public File Like not found');
                return redirect(route('publicFileLikes.index'));
            }
    
            if($user_id == $publicFileLike -> user_id)
            {
                $this->publicFileLikeRepository->delete($id);
        
                DB::table('recent_activities')->insert(['name' => $publicFileLike -> status, 'status' => 'active', 'type' => 'p_f_l_d', 'user_id' => $user_id, 'entity_id' => $publicFileLike -> id, 'created_at' => $now]);
        
                Flash::success('Public File Like deleted successfully.');
                return redirect(route('publicFileLikes.index'));
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