<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateContactSocialDeletesRequest;
use App\Http\Requests\UpdateContactSocialDeletesRequest;
use App\Repositories\ContactSocialDeletesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ContactSocialDeletesController extends AppBaseController
{
    private $contactSocialDeletesRepository;

    public function __construct(ContactSocialDeletesRepository $contactSocialDeletesRepo)
    {
        $this->contactSocialDeletesRepository = $contactSocialDeletesRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->contactSocialDeletesRepository->pushCriteria(new RequestCriteria($request));
            $contactSocialDeletes = $this->contactSocialDeletesRepository->all();
    
            return view('contact_social_deletes.index')
                ->with('contactSocialDeletes', $contactSocialDeletes);
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
            return view('contact_social_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateContactSocialDeletesRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $contactSocialDeletes = $this->contactSocialDeletesRepository->create($input);
    
            Flash::success('Contact Social Deletes saved successfully.');
            return redirect(route('contactSocialDeletes.index'));
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
            $contactSocialDeletes = $this->contactSocialDeletesRepository->findWithoutFail($id);
    
            if(empty($contactSocialDeletes))
            {
                Flash::error('Contact Social Deletes not found');
                return redirect(route('contactSocialDeletes.index'));
            }
    
            $user = DB::table('contact_social_deletes')->join('contact_socials', 'contact_social_deletes.contact_social_id', '=', 'contact_socials.id')->join('contacts', 'contact_socials.contact_id', '=', 'contacts.id')->where('contact_social_deletes.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                return view('contact_social_deletes.show')
                    ->with('contactSocialDeletes', $contactSocialDeletes);
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
            $contactSocialDeletes = $this->contactSocialDeletesRepository->findWithoutFail($id);
    
            if(empty($contactSocialDeletes))
            {
                Flash::error('Contact Social Deletes not found');
                return redirect(route('contactSocialDeletes.index'));
            }
            
            $user = DB::table('contact_social_deletes')->join('contact_socials', 'contact_social_deletes.contact_social_id', '=', 'contact_socials.id')->join('contacts', 'contact_socials.contact_id', '=', 'contacts.id')->where('contact_social_deletes.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                return view('contact_social_deletes.edit')
                    ->with('contactSocialDeletes', $contactSocialDeletes);
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

    public function update($id, UpdateContactSocialDeletesRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $contactSocialDeletes = $this->contactSocialDeletesRepository->findWithoutFail($id);
    
            if(empty($contactSocialDeletes))
            {
                Flash::error('Contact Social Deletes not found');
                return redirect(route('contactSocialDeletes.index'));
            }
    
            $user = DB::table('contact_social_deletes')->join('contact_socials', 'contact_social_deletes.contact_social_id', '=', 'contact_socials.id')->join('contacts', 'contact_socials.contact_id', '=', 'contacts.id')->where('contact_social_deletes.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $contactSocialDeletes = $this->contactSocialDeletesRepository->update($request->all(), $id);
            
                Flash::success('Contact Social Deletes updated successfully.');
                return redirect(route('contactSocialDeletes.index'));
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
            $contactSocialDeletes = $this->contactSocialDeletesRepository->findWithoutFail($id);
    
            if(empty($contactSocialDeletes))
            {
                Flash::error('Contact Social Deletes not found');
                return redirect(route('contactSocialDeletes.index'));
            }
    
            $user = DB::table('contact_social_deletes')->join('contact_socials', 'contact_social_deletes.contact_social_id', '=', 'contact_socials.id')->join('contacts', 'contact_socials.contact_id', '=', 'contacts.id')->where('contact_social_deletes.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $this->contactSocialDeletesRepository->delete($id);
            
                Flash::success('Contact Social Deletes deleted successfully.');
                return redirect(route('contactSocialDeletes.index'));
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