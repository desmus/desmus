<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateContactWebCreateRequest;
use App\Http\Requests\UpdateContactWebCreateRequest;
use App\Repositories\ContactWebCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ContactWebCreateController extends AppBaseController
{
    private $contactWebCreateRepository;

    public function __construct(ContactWebCreateRepository $contactWebCreateRepo)
    {
        $this->contactWebCreateRepository = $contactWebCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->contactWebCreateRepository->pushCriteria(new RequestCriteria($request));
            $contactWebCreates = $this->contactWebCreateRepository->all();
    
            return view('contact_web_creates.index')
                ->with('contactWebCreates', $contactWebCreates);
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
            return view('contact_web_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateContactWebCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $contactWebCreate = $this->contactWebCreateRepository->create($input);
    
            Flash::success('Contact Web Create saved successfully.');
            return redirect(route('contactWebCreates.index'));
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
            $contactWebCreate = $this->contactWebCreateRepository->findWithoutFail($id);
    
            if(empty($contactWebCreate))
            {
                Flash::error('Contact Web Create not found');
                return redirect(route('contactWebCreates.index'));
            }
            
            $user = DB::table('contact_web_creates')->join('contact_webs', 'contact_web_creates.contact_web_id', '=', 'contact_webs.id')->join('contacts', 'contact_webs.contact_id', '=', 'contacts.id')->where('contact_web_creates.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                return view('contact_web_creates.show')
                    ->with('contactWebCreate', $contactWebCreate);
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
            $contactWebCreate = $this->contactWebCreateRepository->findWithoutFail($id);
    
            if(empty($contactWebCreate))
            {
                Flash::error('Contact Web Create not found');
                return redirect(route('contactWebCreates.index'));
            }
            
            $user = DB::table('contact_web_creates')->join('contact_webs', 'contact_web_creates.contact_web_id', '=', 'contact_webs.id')->join('contacts', 'contact_webs.contact_id', '=', 'contacts.id')->where('contact_web_creates.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                return view('contact_web_creates.edit')
                    ->with('contactWebCreate', $contactWebCreate);
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

    public function update($id, UpdateContactWebCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $contactWebCreate = $this->contactWebCreateRepository->findWithoutFail($id);
    
            if(empty($contactWebCreate))
            {
                Flash::error('Contact Web Create not found');
                return redirect(route('contactWebCreates.index'));
            }
    
            $user = DB::table('contact_web_creates')->join('contact_webs', 'contact_web_creates.contact_web_id', '=', 'contact_webs.id')->join('contacts', 'contact_webs.contact_id', '=', 'contacts.id')->where('contact_web_creates.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $contactWebCreate = $this->contactWebCreateRepository->update($request->all(), $id);
            
                Flash::success('Contact Web Create updated successfully.');
                return redirect(route('contactWebCreates.index'));
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
            $contactWebCreate = $this->contactWebCreateRepository->findWithoutFail($id);
    
            if(empty($contactWebCreate))
            {
                Flash::error('Contact Web Create not found');
                return redirect(route('contactWebCreates.index'));
            }
    
            $user = DB::table('contact_web_creates')->join('contact_webs', 'contact_web_creates.contact_web_id', '=', 'contact_webs.id')->join('contacts', 'contact_webs.contact_id', '=', 'contacts.id')->where('contact_web_creates.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $this->contactWebCreateRepository->delete($id);
            
                Flash::success('Contact Web Create deleted successfully.');
                return redirect(route('contactWebCreates.index'));
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