<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateContactSocialUpdatesRequest;
use App\Http\Requests\UpdateContactSocialUpdatesRequest;
use App\Repositories\ContactSocialUpdatesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ContactSocialUpdatesController extends AppBaseController
{
    private $contactSocialUpdatesRepository;

    public function __construct(ContactSocialUpdatesRepository $contactSocialUpdatesRepo)
    {
        $this->contactSocialUpdatesRepository = $contactSocialUpdatesRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->contactSocialUpdatesRepository->pushCriteria(new RequestCriteria($request));
            $contactSocialUpdates = $this->contactSocialUpdatesRepository->all();
    
            return view('contact_social_updates.index')
                ->with('contactSocialUpdates', $contactSocialUpdates);
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
            return view('contact_social_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateContactSocialUpdatesRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $contactSocialUpdates = $this->contactSocialUpdatesRepository->create($input);
    
            Flash::success('Contact Social Updates saved successfully.');
            return redirect(route('contactSocialUpdates.index'));
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
            $contactSocialUpdates = $this->contactSocialUpdatesRepository->findWithoutFail($id);
    
            if(empty($contactSocialUpdates))
            {
                Flash::error('Contact Social Updates not found');
                return redirect(route('contactSocialUpdates.index'));
            }
    
            $user = DB::table('contact_social_updates')->join('contact_socials', 'contact_social_updates.contact_social_id', '=', 'contact_socials.id')->join('contacts', 'contact_socials.contact_id', '=', 'contacts.id')->where('contact_social_updates.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                return view('contact_social_updates.show')
                    ->with('contactSocialUpdates', $contactSocialUpdates);
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
            $contactSocialUpdates = $this->contactSocialUpdatesRepository->findWithoutFail($id);
    
            if(empty($contactSocialUpdates))
            {
                Flash::error('Contact Social Updates not found');
                return redirect(route('contactSocialUpdates.index'));
            }
    
            $user = DB::table('contact_social_updates')->join('contact_socials', 'contact_social_updates.contact_social_id', '=', 'contact_socials.id')->join('contacts', 'contact_socials.contact_id', '=', 'contacts.id')->where('contact_social_updates.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                return view('contact_social_updates.edit')
                    ->with('contactSocialUpdates', $contactSocialUpdates);
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

    public function update($id, UpdateContactSocialUpdatesRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $contactSocialUpdates = $this->contactSocialUpdatesRepository->findWithoutFail($id);
    
            if(empty($contactSocialUpdates))
            {
                Flash::error('Contact Social Updates not found');
                return redirect(route('contactSocialUpdates.index'));
            }
            
            $user = DB::table('contact_social_updates')->join('contact_socials', 'contact_social_updates.contact_social_id', '=', 'contact_socials.id')->join('contacts', 'contact_socials.contact_id', '=', 'contacts.id')->where('contact_social_updates.id', '=', $id)->get();
    
            if($user[0] -> user_id == $user_id)
            {
                $contactSocialUpdates = $this->contactSocialUpdatesRepository->update($request->all(), $id);
            
                Flash::success('Contact Social Updates updated successfully.');
                return redirect(route('contactSocialUpdates.index'));
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
            $contactSocialUpdates = $this->contactSocialUpdatesRepository->findWithoutFail($id);
    
            if(empty($contactSocialUpdates))
            {
                Flash::error('Contact Social Updates not found');
                return redirect(route('contactSocialUpdates.index'));
            }
            
            $user = DB::table('contact_social_updates')->join('contact_socials', 'contact_social_updates.contact_social_id', '=', 'contact_socials.id')->join('contacts', 'contact_socials.contact_id', '=', 'contacts.id')->where('contact_social_updates.id', '=', $id)->get();
    
            if($user[0] -> user_id == $user_id)
            {
                $this->contactSocialUpdatesRepository->delete($id);
            
                Flash::success('Contact Social Updates deleted successfully.');
                return redirect(route('contactSocialUpdates.index'));
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