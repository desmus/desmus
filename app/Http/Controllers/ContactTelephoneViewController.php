<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateContactTelephoneViewRequest;
use App\Http\Requests\UpdateContactTelephoneViewRequest;
use App\Repositories\ContactTelephoneViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ContactTelephoneViewController extends AppBaseController
{
    private $contactTelephoneViewRepository;

    public function __construct(ContactTelephoneViewRepository $contactTelephoneViewRepo)
    {
        $this->contactTelephoneViewRepository = $contactTelephoneViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->contactTelephoneViewRepository->pushCriteria(new RequestCriteria($request));
            $contactTelephoneViews = $this->contactTelephoneViewRepository->all();
    
            return view('contact_telephone_views.index')
                ->with('contactTelephoneViews', $contactTelephoneViews);
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
            return view('contact_telephone_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateContactTelephoneViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $contactTelephoneView = $this->contactTelephoneViewRepository->create($input);
    
            Flash::success('Contact Telephone View saved successfully.');
            return redirect(route('contactTelephoneViews.index'));
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
            $contactTelephoneView = $this->contactTelephoneViewRepository->findWithoutFail($id);
    
            if(empty($contactTelephoneView))
            {
                Flash::error('Contact Telephone View not found');
                return redirect(route('contactTelephoneViews.index'));
            }
            
            $user = DB::table('contact_telephone_views')->join('contact_telephones', 'contact_telephone_views.contact_telephone_id', '=', 'contact_telephones.id')->join('contacts', 'contact_telephones.contact_id', '=', 'contacts.id')->where('contact_telephone_views.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                return view('contact_telephone_views.show')
                    ->with('contactTelephoneView', $contactTelephoneView);
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
            $contactTelephoneView = $this->contactTelephoneViewRepository->findWithoutFail($id);
    
            if(empty($contactTelephoneView))
            {
                Flash::error('Contact Telephone View not found');
                return redirect(route('contactTelephoneViews.index'));
            }
    
            $user = DB::table('contact_telephone_views')->join('contact_telephones', 'contact_telephone_views.contact_telephone_id', '=', 'contact_telephones.id')->join('contacts', 'contact_telephones.contact_id', '=', 'contacts.id')->where('contact_telephone_views.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                return view('contact_telephone_views.edit')
                    ->with('contactTelephoneView', $contactTelephoneView);
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

    public function update($id, UpdateContactTelephoneViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $contactTelephoneView = $this->contactTelephoneViewRepository->findWithoutFail($id);
    
            if(empty($contactTelephoneView))
            {
                Flash::error('Contact Telephone View not found');
                return redirect(route('contactTelephoneViews.index'));
            }
            
            $user = DB::table('contact_telephone_views')->join('contact_telephones', 'contact_telephone_views.contact_telephone_id', '=', 'contact_telephones.id')->join('contacts', 'contact_telephones.contact_id', '=', 'contacts.id')->where('contact_telephone_views.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $contactTelephoneView = $this->contactTelephoneViewRepository->update($request->all(), $id);
            
                Flash::success('Contact Telephone View updated successfully.');
                return redirect(route('contactTelephoneViews.index'));
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
            $contactTelephoneView = $this->contactTelephoneViewRepository->findWithoutFail($id);
    
            if(empty($contactTelephoneView))
            {
                Flash::error('Contact Telephone View not found');
                return redirect(route('contactTelephoneViews.index'));
            }
    
            $user = DB::table('contact_telephone_views')->join('contact_telephones', 'contact_telephone_views.contact_telephone_id', '=', 'contact_telephones.id')->join('contacts', 'contact_telephones.contact_id', '=', 'contacts.id')->where('contact_telephone_views.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $this->contactTelephoneViewRepository->delete($id);
            
                Flash::success('Contact Telephone View deleted successfully.');
                return redirect(route('contactTelephoneViews.index'));
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