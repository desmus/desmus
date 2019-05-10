<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateContactSocialCreateRequest;
use App\Http\Requests\UpdateContactSocialCreateRequest;
use App\Repositories\ContactSocialCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ContactSocialCreateController extends AppBaseController
{
    private $contactSocialCreateRepository;

    public function __construct(ContactSocialCreateRepository $contactSocialCreateRepo)
    {
        $this->contactSocialCreateRepository = $contactSocialCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->contactSocialCreateRepository->pushCriteria(new RequestCriteria($request));
            $contactSocialCreates = $this->contactSocialCreateRepository->all();
    
            return view('contact_social_creates.index')
                ->with('contactSocialCreates', $contactSocialCreates);
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
            return view('contact_social_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateContactSocialCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $contactSocialCreate = $this->contactSocialCreateRepository->create($input);
    
            Flash::success('Contact Social Create saved successfully.');
            return redirect(route('contactSocialCreates.index'));
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
            $contactSocialCreate = $this->contactSocialCreateRepository->findWithoutFail($id);
    
            if(empty($contactSocialCreate))
            {
                Flash::error('Contact Social Create not found');
                return redirect(route('contactSocialCreates.index'));
            }
            
            $user = DB::table('contact_social_creates')->join('contact_socials', 'contact_social_creates.contact_social_id', '=', 'contact_socials.id')->join('contacts', 'contact_socials.contact_id', '=', 'contacts.id')->where('contact_social_creates.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                return view('contact_social_creates.show')
                    ->with('contactSocialCreate', $contactSocialCreate);
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
            $contactSocialCreate = $this->contactSocialCreateRepository->findWithoutFail($id);
    
            if(empty($contactSocialCreate))
            {
                Flash::error('Contact Social Create not found');
                return redirect(route('contactSocialCreates.index'));
            }
    
            $user = DB::table('contact_social_creates')->join('contact_socials', 'contact_social_creates.contact_social_id', '=', 'contact_socials.id')->join('contacts', 'contact_socials.contact_id', '=', 'contacts.id')->where('contact_social_creates.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                return view('contact_social_creates.edit')
                    ->with('contactSocialCreate', $contactSocialCreate);
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

    public function update($id, UpdateContactSocialCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $contactSocialCreate = $this->contactSocialCreateRepository->findWithoutFail($id);
    
            if(empty($contactSocialCreate))
            {
                Flash::error('Contact Social Create not found');
                return redirect(route('contactSocialCreates.index'));
            }
    
            $user = DB::table('contact_social_creates')->join('contact_socials', 'contact_social_creates.contact_social_id', '=', 'contact_socials.id')->join('contacts', 'contact_socials.contact_id', '=', 'contacts.id')->where('contact_social_creates.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $contactSocialCreate = $this->contactSocialCreateRepository->update($request->all(), $id);
            
                Flash::success('Contact Social Create updated successfully.');
                return redirect(route('contactSocialCreates.index'));
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
            $contactSocialCreate = $this->contactSocialCreateRepository->findWithoutFail($id);
    
            if(empty($contactSocialCreate))
            {
                Flash::error('Contact Social Create not found');
                return redirect(route('contactSocialCreates.index'));
            }
            
            $user = DB::table('contact_social_creates')->join('contact_socials', 'contact_social_creates.contact_social_id', '=', 'contact_socials.id')->join('contacts', 'contact_socials.contact_id', '=', 'contacts.id')->where('contact_social_creates.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $this->contactSocialCreateRepository->delete($id);
            
                Flash::success('Contact Social Create deleted successfully.');
                return redirect(route('contactSocialCreates.index'));
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