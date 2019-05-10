<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePublicAdvertisementCResponseRequest;
use App\Http\Requests\UpdatePublicAdvertisementCResponseRequest;
use App\Repositories\PublicAdvertisementCResponseRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class PublicAdvertisementCResponseController extends AppBaseController
{
    private $publicAdvertisementCResponseRepository;

    public function __construct(PublicAdvertisementCResponseRepository $publicAdvertisementCResponseRepo)
    {
        $this->publicAdvertisementCResponseRepository = $publicAdvertisementCResponseRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->publicAdvertisementCResponseRepository->pushCriteria(new RequestCriteria($request));
            $publicAdvertisementCResponses = $this->publicAdvertisementCResponseRepository->all();
    
            return view('public_advertisement_c_responses.index')
                ->with('publicAdvertisementCResponses', $publicAdvertisementCResponses);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function create()
    {
        $user_id = Auth::user()->id;
        
        if(Auth::user() != null)
        {
            return view('public_advertisement_c_responses.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreatePublicAdvertisementCResponseRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $publicAdvertisementCResponse = $this->publicAdvertisementCResponseRepository->create($input);
            
            DB::table('recent_activities')->insert(['name' => $publicAdvertisementCResponse -> status, 'status' => 'active', 'type' => 'p_ad_c_r_c', 'user_id' => $user_id, 'entity_id' => $publicAdvertisementCResponse -> id, 'created_at' => $now]);
    
            Flash::success('Public Advertisement C Response saved successfully.');
            return redirect(route('publicProfile.index'));
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
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $publicAdvertisementCResponse = $this->publicAdvertisementCResponseRepository->findWithoutFail($id);
    
            if(empty($publicAdvertisementCResponse))
            {
                Flash::error('Public Advertisement C Response not found');
                return redirect(route('publicAdvertisementCResponses.index'));
            }
    
            if($user_id == $publicAdvertisementCResponse -> user_id)
            {
                return view('public_advertisement_c_responses.show')->with('publicAdvertisementCResponse', $publicAdvertisementCResponse);
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
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $publicAdvertisementCResponse = $this->publicAdvertisementCResponseRepository->findWithoutFail($id);
    
            if(empty($publicAdvertisementCResponse))
            {
                Flash::error('Public Advertisement C Response not found');
                return redirect(route('publicAdvertisementCResponses.index'));
            }
    
            if($user_id == $publicAdvertisementCResponse -> user_id)
            {
                return view('public_advertisement_c_responses.edit')->with('publicAdvertisementCResponse', $publicAdvertisementCResponse);
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

    public function update($id, UpdatePublicAdvertisementCResponseRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $publicAdvertisementCResponse = $this->publicAdvertisementCResponseRepository->findWithoutFail($id);
    
            if(empty($publicAdvertisementCResponse))
            {
                Flash::error('Public Advertisement C Response not found');
                return redirect(route('publicAdvertisementCResponses.index'));
            }
    
            if($user_id == $publicAdvertisementCResponse -> user_id)
            {
                $publicAdvertisementCResponse = $this->publicAdvertisementCResponseRepository->update($request->all(), $id);
        
                DB::table('recent_activities')->insert(['name' => $publicAdvertisementCResponse -> status, 'status' => 'active', 'type' => 'p_ad_c_r_u', 'user_id' => $user_id, 'entity_id' => $publicAdvertisementCResponse -> id, 'created_at' => $now]);
        
                Flash::success('Public Advertisement C Response updated successfully.');
                return redirect(route('publicAdvertisementCResponses.index'));
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
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $publicAdvertisementCResponse = $this->publicAdvertisementCResponseRepository->findWithoutFail($id);
    
            if(empty($publicAdvertisementCResponse))
            {
                Flash::error('Public Advertisement C Response not found');
                return redirect(route('publicAdvertisementCResponses.index'));
            }
    
            if($user_id == $publicAdvertisementCResponse -> user_id)
            {
                $this->publicAdvertisementCResponseRepository->delete($id);
        
                DB::table('recent_activities')->insert(['name' => $publicAdvertisementCResponse -> status, 'status' => 'active', 'type' => 'p_ad_c_r_d', 'user_id' => $user_id, 'entity_id' => $publicAdvertisementCResponse -> id, 'created_at' => $now]);
        
                Flash::success('Public Advertisement C Response deleted successfully.');
                return redirect(route('publicAdvertisementCResponses.index'));
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