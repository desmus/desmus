<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateContactSocialViewRequest;
use App\Http\Requests\UpdateContactSocialViewRequest;
use App\Repositories\ContactSocialViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ContactSocialViewController extends AppBaseController
{
    private $contactSocialViewRepository;

    public function __construct(ContactSocialViewRepository $contactSocialViewRepo)
    {
        $this->contactSocialViewRepository = $contactSocialViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->contactSocialViewRepository->pushCriteria(new RequestCriteria($request));
            $contactSocialViews = $this->contactSocialViewRepository->all();
    
            return view('contact_social_views.index')
                ->with('contactSocialViews', $contactSocialViews);
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
            return view('contact_social_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateContactSocialViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $contactSocialView = $this->contactSocialViewRepository->create($input);
    
            Flash::success('Contact Social View saved successfully.');
            return redirect(route('contactSocialViews.index'));
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
            $contactSocialView = $this->contactSocialViewRepository->findWithoutFail($id);
    
            if(empty($contactSocialView))
            {
                Flash::error('Contact Social View not found');
                return redirect(route('contactSocialViews.index'));
            }
    
            $user = DB::table('contact_social_views')->join('contact_socials', 'contact_social_views.contact_social_id', '=', 'contact_socials.id')->join('contacts', 'contact_socials.contact_id', '=', 'contacts.id')->where('contact_social_views.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                return view('contact_social_views.show')
                    ->with('contactSocialView', $contactSocialView);
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
            $contactSocialView = $this->contactSocialViewRepository->findWithoutFail($id);
    
            if(empty($contactSocialView))
            {
                Flash::error('Contact Social View not found');
                return redirect(route('contactSocialViews.index'));
            }
    
            $user = DB::table('contact_social_views')->join('contact_socials', 'contact_social_views.contact_social_id', '=', 'contact_socials.id')->join('contacts', 'contact_socials.contact_id', '=', 'contacts.id')->where('contact_social_views.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                return view('contact_social_views.edit')
                    ->with('contactSocialView', $contactSocialView);
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

    public function update($id, UpdateContactSocialViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $contactSocialView = $this->contactSocialViewRepository->findWithoutFail($id);
    
            if(empty($contactSocialView))
            {
                Flash::error('Contact Social View not found');
                return redirect(route('contactSocialViews.index'));
            }
    
            $user = DB::table('contact_social_views')->join('contact_socials', 'contact_social_views.contact_social_id', '=', 'contact_socials.id')->join('contacts', 'contact_socials.contact_id', '=', 'contacts.id')->where('contact_social_views.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $contactSocialView = $this->contactSocialViewRepository->update($request->all(), $id);
            
                Flash::success('Contact Social View updated successfully.');
                return redirect(route('contactSocialViews.index'));
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
            $contactSocialView = $this->contactSocialViewRepository->findWithoutFail($id);
    
            if(empty($contactSocialView))
            {
                Flash::error('Contact Social View not found');
                return redirect(route('contactSocialViews.index'));
            }
    
            $user = DB::table('contact_social_views')->join('contact_socials', 'contact_social_views.contact_social_id', '=', 'contact_socials.id')->join('contacts', 'contact_socials.contact_id', '=', 'contacts.id')->where('contact_social_views.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $this->contactSocialViewRepository->delete($id);
            
                Flash::success('Contact Social View deleted successfully.');
                return redirect(route('contactSocialViews.index'));
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