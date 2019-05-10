<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePublicImageCommentResponseRequest;
use App\Http\Requests\UpdatePublicImageCommentResponseRequest;
use App\Repositories\PublicImageCommentResponseRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PublicImageCommentResponseController extends AppBaseController
{
    private $publicImageCommentResponseRepository;

    public function __construct(PublicImageCommentResponseRepository $publicImageCommentResponseRepo)
    {
        $this->publicImageCommentResponseRepository = $publicImageCommentResponseRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->publicImageCommentResponseRepository->pushCriteria(new RequestCriteria($request));
            $publicImageCommentResponses = $this->publicImageCommentResponseRepository->all();
    
            return view('public_image_comment_responses.index')
                ->with('publicImageCommentResponses', $publicImageCommentResponses);
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
            return view('public_image_comment_responses.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreatePublicImageCommentResponseRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $publicImageCommentResponse = $this->publicImageCommentResponseRepository->create($input);
    
            DB::table('recent_activities')->insert(['name' => $publicImageCommentResponse -> status, 'status' => 'active', 'type' => 'p_i_c_r_c', 'user_id' => $user_id, 'entity_id' => $publicImageCommentResponse -> id, 'created_at' => $now]);
    
            Flash::success('Public Image Comment Response saved successfully.');
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
            $publicImageCommentResponse = $this->publicImageCommentResponseRepository->findWithoutFail($id);
    
            if(empty($publicImageCommentResponse))
            {
                Flash::error('Public Image Comment Response not found');
                return redirect(route('publicImageCommentResponses.index'));
            }
    
            if($user_id == $publicImageCommentResponse -> user_id)
            {
                return view('public_image_comment_responses.show')->with('publicImageCommentResponse', $publicImageCommentResponse);
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
            $publicImageCommentResponse = $this->publicImageCommentResponseRepository->findWithoutFail($id);
    
            if(empty($publicImageCommentResponse))
            {
                Flash::error('Public Image Comment Response not found');
                return redirect(route('publicImageCommentResponses.index'));
            }
    
            if($user_id == $publicImageCommentResponse -> user_id)
            {
                return view('public_image_comment_responses.edit')->with('publicImageCommentResponse', $publicImageCommentResponse);
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

    public function update($id, UpdatePublicImageCommentResponseRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $publicImageCommentResponse = $this->publicImageCommentResponseRepository->findWithoutFail($id);
    
            if(empty($publicImageCommentResponse))
            {
                Flash::error('Public Image Comment Response not found');
                return redirect(route('publicImageCommentResponses.index'));
            }
    
            if($user_id == $publicImageCommentResponse -> user_id)
            {
                $publicImageCommentResponse = $this->publicImageCommentResponseRepository->update($request->all(), $id);
        
                DB::table('recent_activities')->insert(['name' => $publicImageCommentResponse -> status, 'status' => 'active', 'type' => 'p_i_c_r_u', 'user_id' => $user_id, 'entity_id' => $publicImageCommentResponse -> id, 'created_at' => $now]);
        
                Flash::success('Public Image Comment Response updated successfully.');
                return redirect(route('publicImageCommentResponses.index'));
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
            $publicImageCommentResponse = $this->publicImageCommentResponseRepository->findWithoutFail($id);
    
            if(empty($publicImageCommentResponse))
            {
                Flash::error('Public Image Comment Response not found');
                return redirect(route('publicImageCommentResponses.index'));
            }
    
            if($user_id == $publicImageCommentResponse -> user_id)
            {
                $this->publicImageCommentResponseRepository->delete($id);
        
                DB::table('recent_activities')->insert(['name' => $publicImageCommentResponse -> status, 'status' => 'active', 'type' => 'p_i_c_r_d', 'user_id' => $user_id, 'entity_id' => $publicImageCommentResponse -> id, 'created_at' => $now]);
        
                Flash::success('Public Image Comment Response deleted successfully.');
                return redirect(route('publicImageCommentResponses.index'));
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