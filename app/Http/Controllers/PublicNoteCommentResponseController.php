<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePublicNoteCommentResponseRequest;
use App\Http\Requests\UpdatePublicNoteCommentResponseRequest;
use App\Repositories\PublicNoteCommentResponseRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PublicNoteCommentResponseController extends AppBaseController
{
    private $publicNoteCommentResponseRepository;

    public function __construct(PublicNoteCommentResponseRepository $publicNoteCommentResponseRepo)
    {
        $this->publicNoteCommentResponseRepository = $publicNoteCommentResponseRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->publicNoteCommentResponseRepository->pushCriteria(new RequestCriteria($request));
            $publicNoteCommentResponses = $this->publicNoteCommentResponseRepository->all();
    
            return view('public_note_comment_responses.index')
                ->with('publicNoteCommentResponses', $publicNoteCommentResponses);
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
            return view('public_note_comment_responses.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreatePublicNoteCommentResponseRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $publicNoteCommentResponse = $this->publicNoteCommentResponseRepository->create($input);
    
            DB::table('recent_activities')->insert(['name' => $publicNoteCommentResponse -> status, 'status' => 'active', 'type' => 'p_n_c_r_c', 'user_id' => $user_id, 'entity_id' => $publicNoteCommentResponse -> id, 'created_at' => $now]);
    
            Flash::success('Public Note Comment Response saved successfully.');
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
            $publicNoteCommentResponse = $this->publicNoteCommentResponseRepository->findWithoutFail($id);
    
            if(empty($publicNoteCommentResponse))
            {
                Flash::error('Public Note Comment Response not found');
                return redirect(route('publicNoteCommentResponses.index'));
            }
    
            if($user_id == $publicNoteCommentResponse -> user_id)
            {
                return view('public_note_comment_responses.show')->with('publicNoteCommentResponse', $publicNoteCommentResponse);
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
            $publicNoteCommentResponse = $this->publicNoteCommentResponseRepository->findWithoutFail($id);
    
            if (empty($publicNoteCommentResponse))
            {
                Flash::error('Public Note Comment Response not found');
                return redirect(route('publicNoteCommentResponses.index'));
            }
    
            if($user_id == $publicNoteCommentResponse -> user_id)
            {
                return view('public_note_comment_responses.edit')->with('publicNoteCommentResponse', $publicNoteCommentResponse);
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

    public function update($id, UpdatePublicNoteCommentResponseRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $publicNoteCommentResponse = $this->publicNoteCommentResponseRepository->findWithoutFail($id);
    
            if (empty($publicNoteCommentResponse))
            {
                Flash::error('Public Note Comment Response not found');
                return redirect(route('publicNoteCommentResponses.index'));
            }
    
            if($user_id == $publicNoteCommentResponse -> user_id)
            {
                $publicNoteCommentResponse = $this->publicNoteCommentResponseRepository->update($request->all(), $id);
    
                DB::table('recent_activities')->insert(['name' => $publicNoteCommentResponse -> status, 'status' => 'active', 'type' => 'p_n_c_r_u', 'user_id' => $user_id, 'entity_id' => $publicNoteCommentResponse -> id, 'created_at' => $now]);
        
                Flash::success('Public Note Comment Response updated successfully.');
                return redirect(route('publicNoteCommentResponses.index'));
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
            $publicNoteCommentResponse = $this->publicNoteCommentResponseRepository->findWithoutFail($id);
    
            if(empty($publicNoteCommentResponse))
            {
                Flash::error('Public Note Comment Response not found');
                return redirect(route('publicNoteCommentResponses.index'));
            }
    
            if($user_id == $publicNoteCommentResponse -> user_id)
            {
                $this->publicNoteCommentResponseRepository->delete($id);
        
                DB::table('recent_activities')->insert(['name' => $publicNoteCommentResponse -> status, 'status' => 'active', 'type' => 'p_n_c_r_d', 'user_id' => $user_id, 'entity_id' => $publicNoteCommentResponse -> id, 'created_at' => $now]);
        
                Flash::success('Public Note Comment Response deleted successfully.');
                return redirect(route('publicNoteCommentResponses.index'));
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