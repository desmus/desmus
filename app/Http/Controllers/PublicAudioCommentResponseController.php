<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePublicAudioCommentResponseRequest;
use App\Http\Requests\UpdatePublicAudioCommentResponseRequest;
use App\Repositories\PublicAudioCommentResponseRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PublicAudioCommentResponseController extends AppBaseController
{
    private $publicAudioCommentResponseRepository;

    public function __construct(PublicAudioCommentResponseRepository $publicAudioCommentResponseRepo)
    {
        $this->publicAudioCommentResponseRepository = $publicAudioCommentResponseRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->publicAudioCommentResponseRepository->pushCriteria(new RequestCriteria($request));
            $publicAudioCommentResponses = $this->publicAudioCommentResponseRepository->all();
    
            return view('public_audio_comment_responses.index')
                ->with('publicAudioCommentResponses', $publicAudioCommentResponses);
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
            return view('public_audio_comment_responses.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreatePublicAudioCommentResponseRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $publicAudioCommentResponse = $this->publicAudioCommentResponseRepository->create($input);
    
            DB::table('recent_activities')->insert(['name' => $publicAudioCommentResponse -> status, 'status' => 'active', 'type' => 'p_a_c_r_c', 'user_id' => $user_id, 'entity_id' => $publicAudioCommentResponse -> id, 'created_at' => $now]);
    
            Flash::success('Public Audio Comment Response saved successfully.');
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
            $publicAudioCommentResponse = $this->publicAudioCommentResponseRepository->findWithoutFail($id);
    
            if(empty($publicAudioCommentResponse))
            {
                Flash::error('Public Audio Comment Response not found');
                return redirect(route('publicAudioCommentResponses.index'));
            }
    
            if($user_id == $publicAudioCommentResponse -> user_id)
            {
                return view('public_audio_comment_responses.show')->with('publicAudioCommentResponse', $publicAudioCommentResponse);
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
            $publicAudioCommentResponse = $this->publicAudioCommentResponseRepository->findWithoutFail($id);
    
            if(empty($publicAudioCommentResponse))
            {
                Flash::error('Public Audio Comment Response not found');
                return redirect(route('publicAudioCommentResponses.index'));
            }
            
            if($user_id == $publicAudioCommentResponse -> user_id)
            {
                return view('public_audio_comment_responses.edit')->with('publicAudioCommentResponse', $publicAudioCommentResponse);
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

    public function update($id, UpdatePublicAudioCommentResponseRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $publicAudioCommentResponse = $this->publicAudioCommentResponseRepository->findWithoutFail($id);
    
            if(empty($publicAudioCommentResponse))
            {
                Flash::error('Public Audio Comment Response not found');
                return redirect(route('publicAudioCommentResponses.index'));
            }
    
            if($user_id == $publicAudioCommentResponse -> user_id)
            {
                $publicAudioCommentResponse = $this->publicAudioCommentResponseRepository->update($request->all(), $id);
        
                DB::table('recent_activities')->insert(['name' => $publicAudioCommentResponse -> status, 'status' => 'active', 'type' => 'p_a_c_r_u', 'user_id' => $user_id, 'entity_id' => $publicAudioCommentResponse -> id, 'created_at' => $now]);
        
                Flash::success('Public Audio Comment Response updated successfully.');
                return redirect(route('publicAudioCommentResponses.index'));
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
            $publicAudioCommentResponse = $this->publicAudioCommentResponseRepository->findWithoutFail($id);
    
            if(empty($publicAudioCommentResponse))
            {
                Flash::error('Public Audio Comment Response not found');
                return redirect(route('publicAudioCommentResponses.index'));
            }
            
            if($user_id == $publicAudioCommentResponse -> user_id)
            {
                $this->publicAudioCommentResponseRepository->delete($id);
        
                DB::table('recent_activities')->insert(['name' => $publicAudioCommentResponse -> status, 'status' => 'active', 'type' => 'p_a_c_r_d', 'user_id' => $user_id, 'entity_id' => $publicAudioCommentResponse -> id, 'created_at' => $now]);
        
                Flash::success('Public Audio Comment Response deleted successfully.');
                return redirect(route('publicAudioCommentResponses.index'));
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