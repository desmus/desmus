<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateContactCreateRequest;
use App\Http\Requests\UpdateContactCreateRequest;
use App\Repositories\ContactCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ContactCreateController extends AppBaseController
{
    private $contactCreateRepository;

    public function __construct(ContactCreateRepository $contactCreateRepo)
    {
        $this->contactCreateRepository = $contactCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->contactCreateRepository->pushCriteria(new RequestCriteria($request));
            $contactCreates = $this->contactCreateRepository->all();
    
            return view('contact_creates.index')
                ->with('contactCreates', $contactCreates);
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
            return view('contact_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateContactCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $contactCreate = $this->contactCreateRepository->create($input);
    
            Flash::success('Contact Create saved successfully.');
            return redirect(route('contactCreates.index'));
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
            $contactCreate = $this->contactCreateRepository->findWithoutFail($id);
    
            if(empty($contactCreate))
            {
                Flash::error('Contact Create not found');
                return redirect(route('contactCreates.index'));
            }
            
            $user = DB::table('contact_creates')->join('contacts', 'contact_creates.contact_id', '=', 'contacts.id')->where('contact_creates.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                return view('contact_creates.show')
                    ->with('contactCreate', $contactCreate);
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
            $contactCreate = $this->contactCreateRepository->findWithoutFail($id);
    
            if(empty($contactCreate))
            {
                Flash::error('Contact Create not found');
                return redirect(route('contactCreates.index'));
            }
    
            $user = DB::table('contact_creates')->join('contacts', 'contact_creates.contact_id', '=', 'contacts.id')->where('contact_creates.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                return view('contact_creates.edit')
                    ->with('contactCreate', $contactCreate);
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

    public function update($id, UpdateContactCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $contactCreate = $this->contactCreateRepository->findWithoutFail($id);
    
            if(empty($contactCreate))
            {
                Flash::error('Contact Create not found');
                return redirect(route('contactCreates.index'));
            }
    
            $user = DB::table('contact_creates')->join('contacts', 'contact_creates.contact_id', '=', 'contacts.id')->where('contact_creates.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $contactCreate = $this->contactCreateRepository->update($request->all(), $id);
            
                Flash::success('Contact Create updated successfully.');
                return redirect(route('contactCreates.index'));
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
            $contactCreate = $this->contactCreateRepository->findWithoutFail($id);
    
            if(empty($contactCreate))
            {
                Flash::error('Contact Create not found');
                return redirect(route('contactCreates.index'));
            }
    
            $user = DB::table('contact_creates')->join('contacts', 'contact_creates.contact_id', '=', 'contacts.id')->where('contact_creates.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $this->contactCreateRepository->delete($id);
            
                Flash::success('Contact Create deleted successfully.');
                return redirect(route('contactCreates.index'));
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