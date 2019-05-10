<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateContactWebUpdatesRequest;
use App\Http\Requests\UpdateContactWebUpdatesRequest;
use App\Repositories\ContactWebUpdatesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ContactWebUpdatesController extends AppBaseController
{
    private $contactWebUpdatesRepository;

    public function __construct(ContactWebUpdatesRepository $contactWebUpdatesRepo)
    {
        $this->contactWebUpdatesRepository = $contactWebUpdatesRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->contactWebUpdatesRepository->pushCriteria(new RequestCriteria($request));
            $contactWebUpdates = $this->contactWebUpdatesRepository->all();
    
            return view('contact_web_updates.index')
                ->with('contactWebUpdates', $contactWebUpdates);
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
            return view('contact_web_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateContactWebUpdatesRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $contactWebUpdates = $this->contactWebUpdatesRepository->create($input);
    
            Flash::success('Contact Web Updates saved successfully.');
            return redirect(route('contactWebUpdates.index'));
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
            $contactWebUpdates = $this->contactWebUpdatesRepository->findWithoutFail($id);
    
            if(empty($contactWebUpdates))
            {
                Flash::error('Contact Web Updates not found');
                return redirect(route('contactWebUpdates.index'));
            }
            
            $user = DB::table('contact_web_updates')->join('contact_webs', 'contact_web_updates.contact_web_id', '=', 'contact_webs.id')->join('contacts', 'contact_webs.contact_id', '=', 'contacts.id')->where('contact_web_updates.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                return view('contact_web_updates.show')
                    ->with('contactWebUpdates', $contactWebUpdates);
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
            $contactWebUpdates = $this->contactWebUpdatesRepository->findWithoutFail($id);
    
            if(empty($contactWebUpdates))
            {
                Flash::error('Contact Web Updates not found');
                return redirect(route('contactWebUpdates.index'));
            }
    
            $user = DB::table('contact_web_updates')->join('contact_webs', 'contact_web_updates.contact_web_id', '=', 'contact_webs.id')->join('contacts', 'contact_webs.contact_id', '=', 'contacts.id')->where('contact_web_updates.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                return view('contact_web_updates.edit')
                    ->with('contactWebUpdates', $contactWebUpdates);
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

    public function update($id, UpdateContactWebUpdatesRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $contactWebUpdates = $this->contactWebUpdatesRepository->findWithoutFail($id);
    
            if(empty($contactWebUpdates))
            {
                Flash::error('Contact Web Updates not found');
                return redirect(route('contactWebUpdates.index'));
            }
    
            $user = DB::table('contact_web_updates')->join('contact_webs', 'contact_web_updates.contact_web_id', '=', 'contact_webs.id')->join('contacts', 'contact_webs.contact_id', '=', 'contacts.id')->where('contact_web_updates.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $contactWebUpdates = $this->contactWebUpdatesRepository->update($request->all(), $id);
            
                Flash::success('Contact Web Updates updated successfully.');
                return redirect(route('contactWebUpdates.index'));
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
            $contactWebUpdates = $this->contactWebUpdatesRepository->findWithoutFail($id);
    
            if(empty($contactWebUpdates))
            {
                Flash::error('Contact Web Updates not found');
                return redirect(route('contactWebUpdates.index'));
            }
            
            $user = DB::table('contact_web_updates')->join('contact_webs', 'contact_web_updates.contact_web_id', '=', 'contact_webs.id')->join('contacts', 'contact_webs.contact_id', '=', 'contacts.id')->where('contact_web_updates.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $this->contactWebUpdatesRepository->delete($id);
            
                Flash::success('Contact Web Updates deleted successfully.');
                return redirect(route('contactWebUpdates.index'));
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