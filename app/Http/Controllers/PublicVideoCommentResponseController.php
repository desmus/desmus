<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePublicVideoCommentResponseRequest;
use App\Http\Requests\UpdatePublicVideoCommentResponseRequest;
use App\Repositories\PublicVideoCommentResponseRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PublicVideoCommentResponseController extends AppBaseController
{
    private $publicVideoCommentResponseRepository;

    public function __construct(PublicVideoCommentResponseRepository $publicVideoCommentResponseRepo)
    {
        $this->publicVideoCommentResponseRepository = $publicVideoCommentResponseRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->publicVideoCommentResponseRepository->pushCriteria(new RequestCriteria($request));
            $publicVideoCommentResponses = $this->publicVideoCommentResponseRepository->all();
    
            return view('public_video_comment_responses.index')
                ->with('publicVideoCommentResponses', $publicVideoCommentResponses);
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
            return view('public_video_comment_responses.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreatePublicVideoCommentResponseRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $publicVideoCommentResponse = $this->publicVideoCommentResponseRepository->create($input);
            
            DB::table('recent_activities')->insert(['name' => $publicVideoCommentResponse -> status, 'status' => 'active', 'type' => 'p_v_c_r_c', 'user_id' => $user_id, 'entity_id' => $publicVideoCommentResponse -> id, 'created_at' => $now]);
    
            Flash::success('Public Video Comment Response saved successfully.');
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
            $publicVideoCommentResponse = $this->publicVideoCommentResponseRepository->findWithoutFail($id);
    
            if(empty($publicVideoCommentResponse))
            {
                Flash::error('Public Video Comment Response not found');
                return redirect(route('publicVideoCommentResponses.index'));
            }
    
            if($user_id == $publicVideoCommentResponse -> user_id)
            {
                return view('public_video_comment_responses.show')->with('publicVideoCommentResponse', $publicVideoCommentResponse);
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
            $publicVideoCommentResponse = $this->publicVideoCommentResponseRepository->findWithoutFail($id);
    
            if(empty($publicVideoCommentResponse))
            {
                Flash::error('Public Video Comment Response not found');
                return redirect(route('publicVideoCommentResponses.index'));
            }
    
            if($user_id == $publicVideoCommentResponse -> user_id)
            {
                return view('public_video_comment_responses.edit')->with('publicVideoCommentResponse', $publicVideoCommentResponse);
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

    public function update($id, UpdatePublicVideoCommentResponseRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $publicVideoCommentResponse = $this->publicVideoCommentResponseRepository->findWithoutFail($id);
    
            if(empty($publicVideoCommentResponse))
            {
                Flash::error('Public Video Comment Response not found');
                return redirect(route('publicVideoCommentResponses.index'));
            }
    
            if($user_id == $publicVideoCommentResponse -> user_id)
            {
                $publicVideoCommentResponse = $this->publicVideoCommentResponseRepository->update($request->all(), $id);
        
                DB::table('recent_activities')->insert(['name' => $publicVideoCommentResponse -> status, 'status' => 'active', 'type' => 'p_v_c_r_u', 'user_id' => $user_id, 'entity_id' => $publicVideoCommentResponse -> id, 'created_at' => $now]);
        
                Flash::success('Public Video Comment Response updated successfully.');
                return redirect(route('publicVideoCommentResponses.index'));
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
            $publicVideoCommentResponse = $this->publicVideoCommentResponseRepository->findWithoutFail($id);
    
            if(empty($publicVideoCommentResponse))
            {
                Flash::error('Public Video Comment Response not found');
                return redirect(route('publicVideoCommentResponses.index'));
            }
    
            if($user_id == $publicVideoCommentResponse -> user_id)
            {
                $this->publicVideoCommentResponseRepository->delete($id);
        
                DB::table('recent_activities')->insert(['name' => $publicVideoCommentResponse -> status, 'status' => 'active', 'type' => 'p_v_c_r_d', 'user_id' => $user_id, 'entity_id' => $publicVideoCommentResponse -> id, 'created_at' => $now]);
        
                Flash::success('Public Video Comment Response deleted successfully.');
                return redirect(route('publicVideoCommentResponses.index'));
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