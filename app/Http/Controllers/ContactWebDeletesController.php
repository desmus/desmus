<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateContactWebDeletesRequest;
use App\Http\Requests\UpdateContactWebDeletesRequest;
use App\Repositories\ContactWebDeletesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ContactWebDeletesController extends AppBaseController
{
    private $contactWebDeletesRepository;

    public function __construct(ContactWebDeletesRepository $contactWebDeletesRepo)
    {
        $this->contactWebDeletesRepository = $contactWebDeletesRepo;
    }
    
    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->contactWebDeletesRepository->pushCriteria(new RequestCriteria($request));
            $contactWebDeletes = $this->contactWebDeletesRepository->all();
    
            return view('contact_web_deletes.index')
                ->with('contactWebDeletes', $contactWebDeletes);
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
            return view('contact_web_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateContactWebDeletesRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $contactWebDeletes = $this->contactWebDeletesRepository->create($input);
    
            Flash::success('Contact Web Deletes saved successfully.');
            return redirect(route('contactWebDeletes.index'));
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
            $contactWebDeletes = $this->contactWebDeletesRepository->findWithoutFail($id);
    
            if(empty($contactWebDeletes))
            {
                Flash::error('Contact Web Deletes not found');
                return redirect(route('contactWebDeletes.index'));
            }
    
            $user = DB::table('contact_web_deletes')->join('contact_webs', 'contact_web_deletes.contact_web_id', '=', 'contact_webs.id')->join('contacts', 'contact_webs.contact_id', '=', 'contacts.id')->where('contact_web_deletes.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                return view('contact_web_deletes.show')
                    ->with('contactWebDeletes', $contactWebDeletes);
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
            $contactWebDeletes = $this->contactWebDeletesRepository->findWithoutFail($id);
    
            if(empty($contactWebDeletes))
            {
                Flash::error('Contact Web Deletes not found');
                return redirect(route('contactWebDeletes.index'));
            }
            
            $user = DB::table('contact_web_deletes')->join('contact_webs', 'contact_web_deletes.contact_web_id', '=', 'contact_webs.id')->join('contacts', 'contact_webs.contact_id', '=', 'contacts.id')->where('contact_web_deletes.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                return view('contact_web_deletes.edit')
                    ->with('contactWebDeletes', $contactWebDeletes);
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

    public function update($id, UpdateContactWebDeletesRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $contactWebDeletes = $this->contactWebDeletesRepository->findWithoutFail($id);
    
            if(empty($contactWebDeletes))
            {
                Flash::error('Contact Web Deletes not found');
                return redirect(route('contactWebDeletes.index'));
            }
            
            $user = DB::table('contact_web_deletes')->join('contact_webs', 'contact_web_deletes.contact_web_id', '=', 'contact_webs.id')->join('contacts', 'contact_webs.contact_id', '=', 'contacts.id')->where('contact_web_deletes.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $contactWebDeletes = $this->contactWebDeletesRepository->update($request->all(), $id);
            
                Flash::success('Contact Web Deletes updated successfully.');
                return redirect(route('contactWebDeletes.index'));
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
            $contactWebDeletes = $this->contactWebDeletesRepository->findWithoutFail($id);
    
            if(empty($contactWebDeletes))
            {
                Flash::error('Contact Web Deletes not found');
                return redirect(route('contactWebDeletes.index'));
            }
            
            $user = DB::table('contact_web_deletes')->join('contact_webs', 'contact_web_deletes.contact_web_id', '=', 'contact_webs.id')->join('contacts', 'contact_webs.contact_id', '=', 'contacts.id')->where('contact_web_deletes.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $this->contactWebDeletesRepository->delete($id);
            
                Flash::success('Contact Web Deletes deleted successfully.');
                return redirect(route('contactWebDeletes.index'));
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