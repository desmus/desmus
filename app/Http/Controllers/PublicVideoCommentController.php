<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePublicVideoCommentRequest;
use App\Http\Requests\UpdatePublicVideoCommentRequest;
use App\Repositories\PublicVideoCommentRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PublicVideoCommentController extends AppBaseController
{
    private $publicVideoCommentRepository;

    public function __construct(PublicVideoCommentRepository $publicVideoCommentRepo)
    {
        $this->publicVideoCommentRepository = $publicVideoCommentRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->publicVideoCommentRepository->pushCriteria(new RequestCriteria($request));
            $publicVideoComments = $this->publicVideoCommentRepository->all();
    
            return view('public_video_comments.index')
                ->with('publicVideoComments', $publicVideoComments);
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
            return view('public_video_comments.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreatePublicVideoCommentRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $publicVideoComment = $this->publicVideoCommentRepository->create($input);
    
            DB::table('recent_activities')->insert(['name' => $publicVideoComment -> status, 'status' => 'active', 'type' => 'p_v_c_c', 'user_id' => $user_id, 'entity_id' => $publicVideoComment -> id, 'created_at' => $now]);
    
            Flash::success('Public Video Comment saved successfully.');
            return redirect(route('publicProfile.index'));
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
            $publicVideoComment = $this->publicVideoCommentRepository->findWithoutFail($id);
    
            if(empty($publicVideoComment))
            {
                Flash::error('Public Video Comment not found');
                return redirect(route('publicVideoComments.index'));
            }
    
            if($user_id == $publicVideoComment -> user_id)
            {
                return view('public_video_comments.show')->with('publicVideoComment', $publicVideoComment);
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
            $publicVideoComment = $this->publicVideoCommentRepository->findWithoutFail($id);
    
            if(empty($publicVideoComment))
            {
                Flash::error('Public Video Comment not found');
                return redirect(route('publicVideoComments.index'));
            }
    
            if($user_id == $publicVideoComment -> user_id)
            {
                return view('public_video_comments.edit')->with('publicVideoComment', $publicVideoComment);
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

    public function update($id, UpdatePublicVideoCommentRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $publicVideoComment = $this->publicVideoCommentRepository->findWithoutFail($id);
    
            if (empty($publicVideoComment))
            {
                Flash::error('Public Video Comment not found');
                return redirect(route('publicVideoComments.index'));
            }
    
            if($user_id == $publicVideoComment -> user_id)
            {
                $publicVideoComment = $this->publicVideoCommentRepository->update($request->all(), $id);
        
                DB::table('recent_activities')->insert(['name' => $publicVideoComment -> status, 'status' => 'active', 'type' => 'p_v_c_u', 'user_id' => $user_id, 'entity_id' => $publicVideoComment -> id, 'created_at' => $now]);
        
                Flash::success('Public Video Comment updated successfully.');
                return redirect(route('publicVideoComments.index'));
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
            $publicVideoComment = $this->publicVideoCommentRepository->findWithoutFail($id);
    
            if (empty($publicVideoComment))
            {
                Flash::error('Public Video Comment not found');
                return redirect(route('publicVideoComments.index'));
            }
            
            if($user_id == $publicVideoComment -> user_id)
            {
                $this->publicVideoCommentRepository->delete($id);
        
                DB::table('recent_activities')->insert(['name' => $publicVideoComment -> status, 'status' => 'active', 'type' => 'p_v_c_d', 'user_id' => $user_id, 'entity_id' => $publicVideoComment -> id, 'created_at' => $now]);
        
                Flash::success('Public Video Comment deleted successfully.');
                return redirect(route('publicVideoComments.index'));
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