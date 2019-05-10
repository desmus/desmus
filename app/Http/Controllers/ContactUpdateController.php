<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateContactUpdateRequest;
use App\Http\Requests\UpdateContactUpdateRequest;
use App\Repositories\ContactUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ContactUpdateController extends AppBaseController
{
    private $contactUpdateRepository;

    public function __construct(ContactUpdateRepository $contactUpdateRepo)
    {
        $this->contactUpdateRepository = $contactUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->contactUpdateRepository->pushCriteria(new RequestCriteria($request));
            $contactUpdates = $this->contactUpdateRepository->all();
    
            return view('contact_updates.index')
                ->with('contactUpdates', $contactUpdates);
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
            return view('contact_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateContactUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $contactUpdate = $this->contactUpdateRepository->create($input);
    
            Flash::success('Contact Update saved successfully.');
            return redirect(route('contactUpdates.index'));
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
            $contactUpdate = $this->contactUpdateRepository->findWithoutFail($id);
    
            if(empty($contactUpdate))
            {
                Flash::error('Contact Update not found');
                return redirect(route('contactUpdates.index'));
            }
            
            $user = DB::table('contact_updates')->join('contacts', 'contact_updates.contact_id', '=', 'contacts.id')->where('contact_updates.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                return view('contact_updates.show')
                    ->with('contactUpdate', $contactUpdate);
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
            $contactUpdate = $this->contactUpdateRepository->findWithoutFail($id);
    
            if(empty($contactUpdate))
            {
                Flash::error('Contact Update not found');
                return redirect(route('contactUpdates.index'));
            }
    
            $user = DB::table('contact_updates')->join('contacts', 'contact_updates.contact_id', '=', 'contacts.id')->where('contact_updates.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                return view('contact_updates.edit')
                    ->with('contactUpdate', $contactUpdate);
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

    public function update($id, UpdateContactUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $contactUpdate = $this->contactUpdateRepository->findWithoutFail($id);
    
            if(empty($contactUpdate))
            {
                Flash::error('Contact Update not found');
                return redirect(route('contactUpdates.index'));
            }
    
            $user = DB::table('contact_updates')->join('contacts', 'contact_updates.contact_id', '=', 'contacts.id')->where('contact_updates.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $contactUpdate = $this->contactUpdateRepository->update($request->all(), $id);
            
                Flash::success('Contact Update updated successfully.');
                return redirect(route('contactUpdates.index'));
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
            $contactUpdate = $this->contactUpdateRepository->findWithoutFail($id);
    
            if(empty($contactUpdate))
            {
                Flash::error('Contact Update not found');
                return redirect(route('contactUpdates.index'));
            }
            
            $user = DB::table('contact_updates')->join('contacts', 'contact_updates.contact_id', '=', 'contacts.id')->where('contact_updates.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $this->contactUpdateRepository->delete($id);
            
                Flash::success('Contact Update deleted successfully.');
                return redirect(route('contactUpdates.index'));
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