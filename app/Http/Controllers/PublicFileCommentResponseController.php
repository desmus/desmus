<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePublicFileCommentResponseRequest;
use App\Http\Requests\UpdatePublicFileCommentResponseRequest;
use App\Repositories\PublicFileCommentResponseRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PublicFileCommentResponseController extends AppBaseController
{
    private $publicFileCommentResponseRepository;

    public function __construct(PublicFileCommentResponseRepository $publicFileCommentResponseRepo)
    {
        $this->publicFileCommentResponseRepository = $publicFileCommentResponseRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->publicFileCommentResponseRepository->pushCriteria(new RequestCriteria($request));
            $publicFileCommentResponses = $this->publicFileCommentResponseRepository->all();
    
            return view('public_file_comment_responses.index')
                ->with('publicFileCommentResponses', $publicFileCommentResponses);
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
            return view('public_file_comment_responses.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreatePublicFileCommentResponseRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $publicFileCommentResponse = $this->publicFileCommentResponseRepository->create($input);
            
            DB::table('recent_activities')->insert(['name' => $publicFileCommentResponse -> status, 'status' => 'active', 'type' => 'p_f_c_r_c', 'user_id' => $user_id, 'entity_id' => $publicFileCommentResponse -> id, 'created_at' => $now]);
    
            Flash::success('Public File Comment Response saved successfully.');
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
            $publicFileCommentResponse = $this->publicFileCommentResponseRepository->findWithoutFail($id);
    
            if(empty($publicFileCommentResponse))
            {
                Flash::error('Public File Comment Response not found');
                return redirect(route('publicFileCommentResponses.index'));
            }
    
            if($user_id == $publicFileCommentResponse -> user_id)
            {
                return view('public_file_comment_responses.show')->with('publicFileCommentResponse', $publicFileCommentResponse);
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
            $publicFileCommentResponse = $this->publicFileCommentResponseRepository->findWithoutFail($id);
    
            if(empty($publicFileCommentResponse))
            {
                Flash::error('Public File Comment Response not found');
                return redirect(route('publicFileCommentResponses.index'));
            }
    
            if($user_id == $publicFileCommentResponse -> user_id)
            {
                return view('public_file_comment_responses.edit')->with('publicFileCommentResponse', $publicFileCommentResponse);
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

    public function update($id, UpdatePublicFileCommentResponseRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $publicFileCommentResponse = $this->publicFileCommentResponseRepository->findWithoutFail($id);
    
            if(empty($publicFileCommentResponse))
            {
                Flash::error('Public File Comment Response not found');
                return redirect(route('publicFileCommentResponses.index'));
            }
            
            if($user_id == $publicFileCommentResponse -> user_id)
            {
                $publicFileCommentResponse = $this->publicFileCommentResponseRepository->update($request->all(), $id);
        
                DB::table('recent_activities')->insert(['name' => $publicFileCommentResponse -> status, 'status' => 'active', 'type' => 'p_f_c_r_u', 'user_id' => $user_id, 'entity_id' => $publicFileCommentResponse -> id, 'created_at' => $now]);
        
                Flash::success('Public File Comment Response updated successfully.');
                return redirect(route('publicFileCommentResponses.index'));
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
            $publicFileCommentResponse = $this->publicFileCommentResponseRepository->findWithoutFail($id);
    
            if(empty($publicFileCommentResponse))
            {
                Flash::error('Public File Comment Response not found');
                return redirect(route('publicFileCommentResponses.index'));
            }
    
            if($user_id == $publicFileCommentResponse -> user_id)
            {
                $this->publicFileCommentResponseRepository->delete($id);
        
                DB::table('recent_activities')->insert(['name' => $publicFileCommentResponse -> status, 'status' => 'active', 'type' => 'p_f_c_r_d', 'user_id' => $user_id, 'entity_id' => $publicFileCommentResponse -> id, 'created_at' => $now]);
        
                Flash::success('Public File Comment Response deleted successfully.');
                return redirect(route('publicFileCommentResponses.index'));
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