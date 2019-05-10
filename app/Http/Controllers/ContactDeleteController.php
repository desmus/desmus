<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateContactDeleteRequest;
use App\Http\Requests\UpdateContactDeleteRequest;
use App\Repositories\ContactDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ContactDeleteController extends AppBaseController
{
    private $contactDeleteRepository;

    public function __construct(ContactDeleteRepository $contactDeleteRepo)
    {
        $this->contactDeleteRepository = $contactDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->contactDeleteRepository->pushCriteria(new RequestCriteria($request));
            $contactDeletes = $this->contactDeleteRepository->all();
    
            return view('contact_deletes.index')
                ->with('contactDeletes', $contactDeletes);
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
            return view('contact_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateContactDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $contactDelete = $this->contactDeleteRepository->create($input);
    
            Flash::success('Contact Delete saved successfully.');
            return redirect(route('contactDeletes.index'));
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
            $contactDelete = $this->contactDeleteRepository->findWithoutFail($id);
    
            if(empty($contactDelete))
            {
                Flash::error('Contact Delete not found');
                return redirect(route('contactDeletes.index'));
            }
    
            $user = DB::table('contact_deletes')->join('contacts', 'contact_deletes.contact_id', '=', 'contacts.id')->where('contact_deletes.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                return view('contact_deletes.show')
                    ->with('contactDelete', $contactDelete);
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
            $contactDelete = $this->contactDeleteRepository->findWithoutFail($id);
    
            if(empty($contactDelete))
            {
                Flash::error('Contact Delete not found');
                return redirect(route('contactDeletes.index'));
            }
    
            $user = DB::table('contact_deletes')->join('contacts', 'contact_deletes.contact_id', '=', 'contacts.id')->where('contact_deletes.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                return view('contact_deletes.edit')
                    ->with('contactDelete', $contactDelete);
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

    public function update($id, UpdateContactDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $contactDelete = $this->contactDeleteRepository->findWithoutFail($id);
    
            if(empty($contactDelete))
            {
                Flash::error('Contact Delete not found');
                return redirect(route('contactDeletes.index'));
            }
    
            $user = DB::table('contact_deletes')->join('contacts', 'contact_deletes.contact_id', '=', 'contacts.id')->where('contact_deletes.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $contactDelete = $this->contactDeleteRepository->update($request->all(), $id);
            
                Flash::success('Contact Delete updated successfully.');
                return redirect(route('contactDeletes.index'));
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
            $contactDelete = $this->contactDeleteRepository->findWithoutFail($id);
    
            if(empty($contactDelete))
            {
                Flash::error('Contact Delete not found');
                return redirect(route('contactDeletes.index'));
            }
            
            $user = DB::table('contact_deletes')->join('contacts', 'contact_deletes.contact_id', '=', 'contacts.id')->where('contact_deletes.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $this->contactDeleteRepository->delete($id);
            
                Flash::success('Contact Delete deleted successfully.');
                return redirect(route('contactDeletes.index')); 
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