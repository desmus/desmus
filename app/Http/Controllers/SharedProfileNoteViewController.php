<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateSharedProfileNoteViewRequest;
use App\Http\Requests\UpdateSharedProfileNoteViewRequest;
use App\Repositories\SharedProfileNoteViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class SharedProfileNoteViewController extends AppBaseController
{
    /** @var  SharedProfileNoteViewRepository */
    private $sharedProfileNoteViewRepository;

    public function __construct(SharedProfileNoteViewRepository $sharedProfileNoteViewRepo)
    {
        $this->sharedProfileNoteViewRepository = $sharedProfileNoteViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->sharedProfileNoteViewRepository->pushCriteria(new RequestCriteria($request));
            $sharedProfileNoteViews = $this->sharedProfileNoteViewRepository->all();
    
            return view('shared_profile_note_views.index')
                ->with('sharedProfileNoteViews', $sharedProfileNoteViews);
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
            return view('shared_profile_note_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateSharedProfileNoteViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $sharedProfileNoteView = $this->sharedProfileNoteViewRepository->create($input);
                
                Flash::success('Shared Profile Note View saved successfully.');
                return redirect(route('sharedProfileNoteViews.index'));
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
            $sharedProfileNoteView = $this->sharedProfileNoteViewRepository->findWithoutFail($id);
    
            if(empty($sharedProfileNoteView))
            {
                Flash::error('Shared Profile Note View not found');
                return redirect(route('sharedProfileNoteViews.index'));
            }
            
            if($user_id == $sharedProfileNoteView -> user_id)
            {
                return view('shared_profile_note_views.show')->with('sharedProfileNoteView', $sharedProfileNoteView);
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
            $sharedProfileNoteView = $this->sharedProfileNoteViewRepository->findWithoutFail($id);
    
            if(empty($sharedProfileNoteView))
            {
                Flash::error('Shared Profile Note View not found');
                return redirect(route('sharedProfileNoteViews.index'));
            }
            
            if($user_id == $sharedProfileNoteView -> user_id)
            {
                return view('shared_profile_note_views.edit')->with('sharedProfileNoteView', $sharedProfileNoteView);
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

    public function update($id, UpdateSharedProfileNoteViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $sharedProfileNoteView = $this->sharedProfileNoteViewRepository->findWithoutFail($id);
    
            if(empty($sharedProfileNoteView))
            {
                Flash::error('Shared Profile Note View not found');
                return redirect(route('sharedProfileNoteViews.index'));
            }
    
            if($user_id == $sharedProfileNoteView -> user_id)
            {
                $sharedProfileNoteView = $this->sharedProfileNoteViewRepository->update($request->all(), $id);
                
                Flash::success('Shared Profile Note View updated successfully.');
                return redirect(route('sharedProfileNoteViews.index'));
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
            $sharedProfileNoteView = $this->sharedProfileNoteViewRepository->findWithoutFail($id);
    
            if(empty($sharedProfileNoteView))
            {
                Flash::error('Shared Profile Note View not found');
                return redirect(route('sharedProfileNoteViews.index'));
            }
    
            if($user_id == $sharedProfileNoteView -> user_id)
            {
                $this->sharedProfileNoteViewRepository->delete($id);
                
                Flash::success('Shared Profile Note View deleted successfully.');
                return redirect(route('sharedProfileNoteViews.index'));
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
