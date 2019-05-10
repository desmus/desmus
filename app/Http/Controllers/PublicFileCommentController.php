<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePublicFileCommentRequest;
use App\Http\Requests\UpdatePublicFileCommentRequest;
use App\Repositories\PublicFileCommentRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PublicFileCommentController extends AppBaseController
{
    private $publicFileCommentRepository;

    public function __construct(PublicFileCommentRepository $publicFileCommentRepo)
    {
        $this->publicFileCommentRepository = $publicFileCommentRepo;
    }
    
    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->publicFileCommentRepository->pushCriteria(new RequestCriteria($request));
            $publicFileComments = $this->publicFileCommentRepository->all();
    
            return view('public_file_comments.index')
                ->with('publicFileComments', $publicFileComments);
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
            return view('public_file_comments.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreatePublicFileCommentRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $publicFileComment = $this->publicFileCommentRepository->create($input);
            
            DB::table('recent_activities')->insert(['name' => $publicFileComment -> status, 'status' => 'active', 'type' => 'p_f_c_c', 'user_id' => $user_id, 'entity_id' => $publicFileComment -> id, 'created_at' => $now]);
    
            Flash::success('Public File Comment saved successfully.');
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
            $publicFileComment = $this->publicFileCommentRepository->findWithoutFail($id);

            if(empty($publicFileComment))
            {
                Flash::error('Public File Comment not found');
                return redirect(route('publicFileComments.index'));
            }
        
            if($user_id == $publicFileComment -> user_id)
            {
                return view('public_file_comments.show')->with('publicFileComment', $publicFileComment);
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
            $publicFileComment = $this->publicFileCommentRepository->findWithoutFail($id);
    
            if(empty($publicFileComment))
            {
                Flash::error('Public File Comment not found');
                return redirect(route('publicFileComments.index'));
            }
            
            if($user_id == $publicFileComment -> user_id)
            {
                return view('public_file_comments.edit')->with('publicFileComment', $publicFileComment);
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

    public function update($id, UpdatePublicFileCommentRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $publicFileComment = $this->publicFileCommentRepository->findWithoutFail($id);
    
            if(empty($publicFileComment))
            {
                Flash::error('Public File Comment not found');
                return redirect(route('publicFileComments.index'));
            }
    
            if($user_id == $publicFileComment -> user_id)
            {
                $publicFileComment = $this->publicFileCommentRepository->update($request->all(), $id);
            
                DB::table('recent_activities')->insert(['name' => $publicFileComment -> status, 'status' => 'active', 'type' => 'p_f_c_u', 'user_id' => $user_id, 'entity_id' => $publicFileComment -> id, 'created_at' => $now]);
    
                Flash::success('Public File Comment updated successfully.');
                return redirect(route('publicFileComments.index'));
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
            $publicFileComment = $this->publicFileCommentRepository->findWithoutFail($id);
    
            if(empty($publicFileComment)) 
            {
                Flash::error('Public File Comment not found');
                return redirect(route('publicFileComments.index'));
            }
    
            if($user_id == $publicFileComment -> user_id)
            {
                $this->publicFileCommentRepository->delete($id);
                
                DB::table('recent_activities')->insert(['name' => $publicFileComment -> status, 'status' => 'active', 'type' => 'p_f_c_d', 'user_id' => $user_id, 'entity_id' => $publicFileComment -> id, 'created_at' => $now]);
        
                Flash::success('Public File Comment deleted successfully.');
                return redirect(route('publicFileComments.index'));
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