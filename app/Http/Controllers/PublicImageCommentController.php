<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePublicImageCommentRequest;
use App\Http\Requests\UpdatePublicImageCommentRequest;
use App\Repositories\PublicImageCommentRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PublicImageCommentController extends AppBaseController
{
    private $publicImageCommentRepository;

    public function __construct(PublicImageCommentRepository $publicImageCommentRepo)
    {
        $this->publicImageCommentRepository = $publicImageCommentRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->publicImageCommentRepository->pushCriteria(new RequestCriteria($request));
            $publicImageComments = $this->publicImageCommentRepository->all();
    
            return view('public_image_comments.index')
                ->with('publicImageComments', $publicImageComments);
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
            return view('public_image_comments.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreatePublicImageCommentRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $publicImageComment = $this->publicImageCommentRepository->create($input);
    
            DB::table('recent_activities')->insert(['name' => $publicImageComment -> status, 'status' => 'active', 'type' => 'p_i_c_c', 'user_id' => $user_id, 'entity_id' => $publicImageComment -> id, 'created_at' => $now]);
    
            Flash::success('Public Image Comment saved successfully.');
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
            $publicImageComment = $this->publicImageCommentRepository->findWithoutFail($id);
    
            if(empty($publicImageComment))
            {
                Flash::error('Public Image Comment not found');
                return redirect(route('publicImageComments.index'));
            }
    
            if($user_id == $publicImageComment -> user_id)
            {
                return view('public_image_comments.show')->with('publicImageComment', $publicImageComment);
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
            $publicImageComment = $this->publicImageCommentRepository->findWithoutFail($id);
    
            if(empty($publicImageComment))
            {
                Flash::error('Public Image Comment not found');
                return redirect(route('publicImageComments.index'));
            }
    
            if($user_id == $publicImageComment -> user_id)
            {
                return view('public_image_comments.edit')->with('publicImageComment', $publicImageComment);
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

    public function update($id, UpdatePublicImageCommentRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $publicImageComment = $this->publicImageCommentRepository->findWithoutFail($id);
    
            if(empty($publicImageComment))
            {
                Flash::error('Public Image Comment not found');
                return redirect(route('publicImageComments.index'));
            }
    
            if($user_id == $publicImageComment -> user_id)
            {
                $publicImageComment = $this->publicImageCommentRepository->update($request->all(), $id);
                
                DB::table('recent_activities')->insert(['name' => $publicImageComment -> status, 'status' => 'active', 'type' => 'p_i_c_u', 'user_id' => $user_id, 'entity_id' => $publicImageComment -> id, 'created_at' => $now]);
        
                Flash::success('Public Image Comment updated successfully.');
                return redirect(route('publicImageComments.index'));
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
            $publicImageComment = $this->publicImageCommentRepository->findWithoutFail($id);
    
            if(empty($publicImageComment))
            {
                Flash::error('Public Image Comment not found');
                return redirect(route('publicImageComments.index'));
            }
    
            if($user_id == $publicImageComment -> user_id)
            {
                $this->publicImageCommentRepository->delete($id);
    
                DB::table('recent_activities')->insert(['name' => $publicImageComment -> status, 'status' => 'active', 'type' => 'p_i_c_d', 'user_id' => $user_id, 'entity_id' => $publicImageComment -> id, 'created_at' => $now]);
    
                Flash::success('Public Image Comment deleted successfully.');
                return redirect(route('publicImageComments.index'));
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