<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePublicFileViewRequest;
use App\Http\Requests\UpdatePublicFileViewRequest;
use App\Repositories\PublicFileViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PublicFileViewController extends AppBaseController
{
    private $publicFileViewRepository;

    public function __construct(PublicFileViewRepository $publicFileViewRepo)
    {
        $this->publicFileViewRepository = $publicFileViewRepo;
    }
    
    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->publicFileViewRepository->pushCriteria(new RequestCriteria($request));
            $publicFileViews = $this->publicFileViewRepository->all();
    
            return view('public_file_views.index')
                ->with('publicFileViews', $publicFileViews);
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
            return view('public_file_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreatePublicFileViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $publicFileView = $this->publicFileViewRepository->create($input);
                
                Flash::success('Public File View saved successfully.');
                return redirect(route('publicFileViews.index'));
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
            $publicFileView = $this->publicFileViewRepository->findWithoutFail($id);
    
            if(empty($publicFileView))
            {
                Flash::error('Public File View not found');
                return redirect(route('publicFileViews.index'));
            }
            
            if($user_id == $publicFileView -> user_id)
            {
                return view('public_file_views.show')->with('publicFileView', $publicFileView);
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
            $publicFileView = $this->publicFileViewRepository->findWithoutFail($id);
    
            if(empty($publicFileView))
            {
                Flash::error('Public File View not found');
                return redirect(route('publicFileViews.index'));
            }
            
            if($user_id == $publicFileView -> user_id)
            {
                return view('public_file_views.edit')->with('publicFileView', $publicFileView);
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

    public function update($id, UpdatePublicFileViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $publicFileView = $this->publicFileViewRepository->findWithoutFail($id);
    
            if(empty($publicFileView))
            {
                Flash::error('Public File View not found');
                return redirect(route('publicFileViews.index'));
            }
    
            if($user_id == $publicFileView -> user_id)
            {
                $publicFileView = $this->publicFileViewRepository->update($request->all(), $id);
                
                Flash::success('Public File View updated successfully.');
                return redirect(route('publicFileViews.index'));
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
            $publicFileView = $this->publicFileViewRepository->findWithoutFail($id);
    
            if(empty($publicFileView))
            {
                Flash::error('Public File View not found');
                return redirect(route('publicFileViews.index'));
            }
    
            if($user_id == $publicFileView -> user_id)
            {
                $this->publicFileViewRepository->delete($id);
                
                Flash::success('Public File View deleted successfully.');
                return redirect(route('publicFileViews.index'));
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