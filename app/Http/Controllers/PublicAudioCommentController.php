<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePublicAudioCommentRequest;
use App\Http\Requests\UpdatePublicAudioCommentRequest;
use App\Repositories\PublicAudioCommentRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PublicAudioCommentController extends AppBaseController
{
    private $publicAudioCommentRepository;

    public function __construct(PublicAudioCommentRepository $publicAudioCommentRepo)
    {
        $this->publicAudioCommentRepository = $publicAudioCommentRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->publicAudioCommentRepository->pushCriteria(new RequestCriteria($request));
            $publicAudioComments = $this->publicAudioCommentRepository->all();
    
            return view('public_audio_comments.index')
                ->with('publicAudioComments', $publicAudioComments);
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
            return view('public_audio_comments.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreatePublicAudioCommentRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $publicAudioComment = $this->publicAudioCommentRepository->create($input);
            
            DB::table('recent_activities')->insert(['name' => $publicAudioComment -> status, 'status' => 'active', 'type' => 'p_a_c_c', 'user_id' => $user_id, 'entity_id' => $publicAudioComment -> id, 'created_at' => $now]);
    
            Flash::success('Public Audio Comment saved successfully.');
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
            $publicAudioComment = $this->publicAudioCommentRepository->findWithoutFail($id);
    
            if(empty($publicAudioComment))
            {
                Flash::error('Public Audio Comment not found');
                return redirect(route('publicAudioComments.index'));
            }
    
            if($user_id == $publicAudioComment -> user_id)
            {
                return view('public_audio_comments.show')->with('publicAudioComment', $publicAudioComment);
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
            $publicAudioComment = $this->publicAudioCommentRepository->findWithoutFail($id);
    
            if(empty($publicAudioComment))
            {
                Flash::error('Public Audio Comment not found');
                return redirect(route('publicAudioComments.index'));
            }
    
            if($user_id == $publicAudioComment -> user_id)
            {
                return view('public_audio_comments.edit')->with('publicAudioComment', $publicAudioComment);
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

    public function update($id, UpdatePublicAudioCommentRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $publicAudioComment = $this->publicAudioCommentRepository->findWithoutFail($id);
    
            if(empty($publicAudioComment)) 
            {
                Flash::error('Public Audio Comment not found');
                return redirect(route('publicAudioComments.index'));
            }
    
            if($user_id == $publicAudioComment -> user_id)
            {
                $publicAudioComment = $this->publicAudioCommentRepository->update($request->all(), $id);
        
                DB::table('recent_activities')->insert(['name' => $publicAudioComment -> status, 'status' => 'active', 'type' => 'p_a_c_u', 'user_id' => $user_id, 'entity_id' => $publicAudioComment -> id, 'created_at' => $now]);
        
                Flash::success('Public Audio Comment updated successfully.');
                return redirect(route('publicAudioComments.index'));
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
            $publicAudioComment = $this->publicAudioCommentRepository->findWithoutFail($id);
    
            if(empty($publicAudioComment))
            {
                Flash::error('Public Audio Comment not found');
                return redirect(route('publicAudioComments.index'));
            }
    
            if($user_id == $publicAudioComment -> user_id)
            {
                $this->publicAudioCommentRepository->delete($id);
                
                DB::table('recent_activities')->insert(['name' => $publicAudioComment -> status, 'status' => 'active', 'type' => 'p_a_c_d', 'user_id' => $user_id, 'entity_id' => $publicAudioComment -> id, 'created_at' => $now]);
        
                Flash::success('Public Audio Comment deleted successfully.');
                return redirect(route('publicAudioComments.index'));
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