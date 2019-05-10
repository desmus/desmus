<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePublicAdvertisementCommentRequest;
use App\Http\Requests\UpdatePublicAdvertisementCommentRequest;
use App\Repositories\PublicAdvertisementCommentRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PublicAdvertisementCommentController extends AppBaseController
{
    private $publicAdvertisementCommentRepository;

    public function __construct(PublicAdvertisementCommentRepository $publicAdvertisementCommentRepo)
    {
        $this->publicAdvertisementCommentRepository = $publicAdvertisementCommentRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->publicAdvertisementCommentRepository->pushCriteria(new RequestCriteria($request));
            $publicAdvertisementComments = $this->publicAdvertisementCommentRepository->all();
    
            return view('public_advertisement_comments.index')
                ->with('publicAdvertisementComments', $publicAdvertisementComments);
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
            return view('public_advertisement_comments.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreatePublicAdvertisementCommentRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $publicAdvertisementComment = $this->publicAdvertisementCommentRepository->create($input);
    
            DB::table('recent_activities')->insert(['name' => $publicAdvertisementComment -> status, 'status' => 'active', 'type' => 'p_ad_c_c', 'user_id' => $user_id, 'entity_id' => $publicAdvertisementComment -> id, 'created_at' => $now]);
    
            Flash::success('Public Advertisement Comment saved successfully.');
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
            $user_id = Auth::user()->id;
            $publicAdvertisementComment = $this->publicAdvertisementCommentRepository->findWithoutFail($id);
    
            if(empty($publicAdvertisementComment))
            {
                Flash::error('Public Advertisement Comment not found');
                return redirect(route('publicAdvertisementComments.index'));
            }
    
            if($user_id == $publicAdvertisementComment -> user_id)
            {
                return view('public_advertisement_comments.show')->with('publicAdvertisementComment', $publicAdvertisementComment);
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
            $publicAdvertisementComment = $this->publicAdvertisementCommentRepository->findWithoutFail($id);
    
            if(empty($publicAdvertisementComment))
            {
                Flash::error('Public Advertisement Comment not found');
                return redirect(route('publicAdvertisementComments.index'));
            }
    
            if($user_id == $publicAdvertisementComment -> user_id)
            {
                return view('public_advertisement_comments.edit')->with('publicAdvertisementComment', $publicAdvertisementComment);
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

    public function update($id, UpdatePublicAdvertisementCommentRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $publicAdvertisementComment = $this->publicAdvertisementCommentRepository->findWithoutFail($id);
    
            if(empty($publicAdvertisementComment))
            {
                Flash::error('Public Advertisement Comment not found');
                return redirect(route('publicAdvertisementComments.index'));
            }
    
            if($user_id == $publicAdvertisementComment -> user_id)
            {
                $publicAdvertisementComment = $this->publicAdvertisementCommentRepository->update($request->all(), $id);
        
                DB::table('recent_activities')->insert(['name' => $publicAdvertisementComment -> status, 'status' => 'active', 'type' => 'p_ad_c_u', 'user_id' => $user_id, 'entity_id' => $publicAdvertisementComment -> id, 'created_at' => $now]);
        
                Flash::success('Public Advertisement Comment updated successfully.');
                return redirect(route('publicAdvertisementComments.index'));
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
            $publicAdvertisementComment = $this->publicAdvertisementCommentRepository->findWithoutFail($id);
    
            if(empty($publicAdvertisementComment))
            {
                Flash::error('Public Advertisement Comment not found');
                return redirect(route('publicAdvertisementComments.index'));
            }
    
            if($user_id == $publicAdvertisementComment -> user_id)
            {
                $this->publicAdvertisementCommentRepository->delete($id);
        
                DB::table('recent_activities')->insert(['name' => $publicAdvertisementComment -> status, 'status' => 'active', 'type' => 'p_ad_c_d', 'user_id' => $user_id, 'entity_id' => $publicAdvertisementComment -> id, 'created_at' => $now]);
        
                Flash::success('Public Advertisement Comment deleted successfully.');
                return redirect(route('publicAdvertisementComments.index'));
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