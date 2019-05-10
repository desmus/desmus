<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateSharedProfileFileViewRequest;
use App\Http\Requests\UpdateSharedProfileFileViewRequest;
use App\Repositories\SharedProfileFileViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class SharedProfileFileViewController extends AppBaseController
{
    /** @var  SharedProfileFileViewRepository */
    private $sharedProfileFileViewRepository;

    public function __construct(SharedProfileFileViewRepository $sharedProfileFileViewRepo)
    {
        $this->sharedProfileFileViewRepository = $sharedProfileFileViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->sharedProfileFileViewRepository->pushCriteria(new RequestCriteria($request));
            $sharedProfileFileViews = $this->sharedProfileFileViewRepository->all();
    
            return view('shared_profile_file_views.index')
                ->with('sharedProfileFileViews', $sharedProfileFileViews);
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
            return view('shared_profile_file_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateSharedProfileFileViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $sharedProfileFileView = $this->sharedProfileFileViewRepository->create($input);
                
                Flash::success('Shared Profile File View saved successfully.');
                return redirect(route('sharedProfileFileViews.index'));
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
            $sharedProfileFileView = $this->sharedProfileFileViewRepository->findWithoutFail($id);
    
            if(empty($sharedProfileFileView))
            {
                Flash::error('Shared Profile File View not found');
                return redirect(route('sharedProfileFileViews.index'));
            }
            
            if($user_id == $sharedProfileFileView -> user_id)
            {
                return view('shared_profile_file_views.show')->with('sharedProfileFileView', $sharedProfileFileView);
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
            $sharedProfileFileView = $this->sharedProfileFileViewRepository->findWithoutFail($id);
    
            if(empty($sharedProfileFileView))
            {
                Flash::error('Shared Profile File View not found');
                return redirect(route('sharedProfileFileViews.index'));
            }
            
            if($user_id == $sharedProfileFileView -> user_id)
            {
                return view('shared_profile_file_views.edit')->with('sharedProfileFileView', $sharedProfileFileView);
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

    public function update($id, UpdateSharedProfileFileViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $sharedProfileFileView = $this->sharedProfileFileViewRepository->findWithoutFail($id);
    
            if(empty($sharedProfileFileView))
            {
                Flash::error('Shared Profile File View not found');
                return redirect(route('sharedProfileFileViews.index'));
            }
    
            if($user_id == $sharedProfileFileView -> user_id)
            {
                $sharedProfileFileView = $this->sharedProfileFileViewRepository->update($request->all(), $id);
                
                Flash::success('Shared Profile File View updated successfully.');
                return redirect(route('sharedProfileFileViews.index'));
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
            $sharedProfileFileView = $this->sharedProfileFileViewRepository->findWithoutFail($id);
    
            if(empty($sharedProfileFileView))
            {
                Flash::error('Shared Profile File View not found');
                return redirect(route('sharedProfileFileViews.index'));
            }
    
            if($user_id == $sharedProfileFileView -> user_id)
            {
                $this->sharedProfileFileViewRepository->delete($id);
                
                Flash::success('Shared Profile File View deleted successfully.');
                return redirect(route('sharedProfileFileViews.index'));
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