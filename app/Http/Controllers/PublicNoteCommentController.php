<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePublicNoteCommentRequest;
use App\Http\Requests\UpdatePublicNoteCommentRequest;
use App\Repositories\PublicNoteCommentRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PublicNoteCommentController extends AppBaseController
{
    private $publicNoteCommentRepository;

    public function __construct(PublicNoteCommentRepository $publicNoteCommentRepo)
    {
        $this->publicNoteCommentRepository = $publicNoteCommentRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->publicNoteCommentRepository->pushCriteria(new RequestCriteria($request));
            $publicNoteComments = $this->publicNoteCommentRepository->all();
    
            return view('public_note_comments.index')
                ->with('publicNoteComments', $publicNoteComments);
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
            return view('public_note_comments.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreatePublicNoteCommentRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $publicNoteComment = $this->publicNoteCommentRepository->create($input);
    
            DB::table('recent_activities')->insert(['name' => $publicNoteComment -> status, 'status' => 'active', 'type' => 'p_n_c_c', 'user_id' => $user_id, 'entity_id' => $publicNoteComment -> id, 'created_at' => $now]);
    
            Flash::success('Public Note Comment saved successfully.');
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
            $publicNoteComment = $this->publicNoteCommentRepository->findWithoutFail($id);
    
            if(empty($publicNoteComment))
            {
                Flash::error('Public Note Comment not found');
                return redirect(route('publicNoteComments.index'));
            }
            
            if($user_id == $publicNoteComment -> user_id)
            {
                return view('public_note_comments.show')->with('publicNoteComment', $publicNoteComment);
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
            $publicNoteComment = $this->publicNoteCommentRepository->findWithoutFail($id);
    
            if(empty($publicNoteComment))
            {
                Flash::error('Public Note Comment not found');
                return redirect(route('publicNoteComments.index'));
            }
    
            if($user_id == $publicNoteComment -> user_id)
            {
                return view('public_note_comments.edit')->with('publicNoteComment', $publicNoteComment);
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

    public function update($id, UpdatePublicNoteCommentRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $publicNoteComment = $this->publicNoteCommentRepository->findWithoutFail($id);
    
            if(empty($publicNoteComment))
            {
                Flash::error('Public Note Comment not found');
                return redirect(route('publicNoteComments.index'));
            }
    
            if($user_id == $publicNoteComment -> user_id)
            {
                $publicNoteComment = $this->publicNoteCommentRepository->update($request->all(), $id);
                DB::table('recent_activities')->insert(['name' => $publicNoteComment -> status, 'status' => 'active', 'type' => 'p_n_c_u', 'user_id' => $user_id, 'entity_id' => $publicNoteComment -> id, 'created_at' => $now]);
    
                Flash::success('Public Note Comment updated successfully.');
                return redirect(route('publicNoteComments.index'));
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
            $publicNoteComment = $this->publicNoteCommentRepository->findWithoutFail($id);
    
            if(empty($publicNoteComment))
            {
                Flash::error('Public Note Comment not found');
                return redirect(route('publicNoteComments.index'));
            }
    
            if($user_id == $publicNoteComment -> user_id)
            {
                $this->publicNoteCommentRepository->delete($id);
                DB::table('recent_activities')->insert(['name' => $publicNoteComment -> status, 'status' => 'active', 'type' => 'p_n_c_d', 'user_id' => $user_id, 'entity_id' => $publicNoteComment -> id, 'created_at' => $now]);
        
                Flash::success('Public Note Comment deleted successfully.');
                return redirect(route('publicNoteComments.index'));
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