<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePublicNoteViewRequest;
use App\Http\Requests\UpdatePublicNoteViewRequest;
use App\Repositories\PublicNoteViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PublicNoteViewController extends AppBaseController
{
    private $publicNoteViewRepository;

    public function __construct(PublicNoteViewRepository $publicNoteViewRepo)
    {
        $this->publicNoteViewRepository = $publicNoteViewRepo;
    }
    
    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->publicNoteViewRepository->pushCriteria(new RequestCriteria($request));
            $publicNoteViews = $this->publicNoteViewRepository->all();
    
            return view('public_note_views.index')
                ->with('publicNoteViews', $publicNoteViews);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function create()
    {
        if(Auth::user() != null)
        {
            return view('public_note_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreatePublicNoteViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $publicNoteView = $this->publicNoteViewRepository->create($input);
                
                Flash::success('Public Note View saved successfully.');
                return redirect(route('publicNoteViews.index'));
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

    public function show($id)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $publicNoteView = $this->publicNoteViewRepository->findWithoutFail($id);
    
            if(empty($publicNoteView))
            {
                Flash::error('Public Note View not found');
                return redirect(route('publicNoteViews.index'));
            }
            
            if($user_id == $publicNoteView -> user_id)
            {
                return view('public_note_views.show')->with('publicNoteView', $publicNoteView);
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
            $user_id = Auth::user()->id;
            $publicNoteView = $this->publicNoteViewRepository->findWithoutFail($id);
    
            if(empty($publicNoteView))
            {
                Flash::error('Public Note View not found');
                return redirect(route('publicNoteViews.index'));
            }
            
            if($user_id == $publicNoteView -> user_id)
            {
                return view('public_note_views.edit')->with('publicNoteView', $publicNoteView);
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

    public function update($id, UpdatePublicNoteViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $publicNoteView = $this->publicNoteViewRepository->findWithoutFail($id);
    
            if(empty($publicNoteView))
            {
                Flash::error('Public Note View not found');
                return redirect(route('publicNoteViews.index'));
            }
    
            if($user_id == $publicNoteView -> user_id)
            {
                $publicNoteView = $this->publicNoteViewRepository->update($request->all(), $id);
                
                Flash::success('Public Note View updated successfully.');
                return redirect(route('publicNoteViews.index'));
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
            $user_id = Auth::user()->id;
            $publicNoteView = $this->publicNoteViewRepository->findWithoutFail($id);
    
            if(empty($publicNoteView))
            {
                Flash::error('Public Note View not found');
                return redirect(route('publicNoteViews.index'));
            }
    
            if($user_id == $publicNoteView -> user_id)
            {
                $this->publicNoteViewRepository->delete($id);
                
                Flash::success('Public Note View deleted successfully.');
                return redirect(route('publicNoteViews.index'));
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