<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateMessageCreateRequest;
use App\Http\Requests\UpdateMessageCreateRequest;
use App\Repositories\MessageCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class MessageCreateController extends AppBaseController
{
    private $messageCreateRepository;

    public function __construct(MessageCreateRepository $messageCreateRepo)
    {
        $this->messageCreateRepository = $messageCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->messageCreateRepository->pushCriteria(new RequestCriteria($request));
            $messageCreates = $this->messageCreateRepository->all();
    
            return view('message_creates.index')
                ->with('messageCreates', $messageCreates);
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
            return view('message_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateMessageCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $messageCreate = $this->messageCreateRepository->create($input);
    
            Flash::success('Message Create saved successfully.');
            return redirect(route('messageCreates.index'));
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
            $messageCreate = $this->messageCreateRepository->findWithoutFail($id);
    
            if(empty($messageCreate))
            {
                Flash::error('Message Create not found');
                return redirect(route('messageCreates.index'));
            }
            
            $user = DB::table('message_creates')->join('messages', 'message_creates.message_id', '=', 'messages.id')->where('message_creates.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                return view('message_creates.show')
                    ->with('messageCreate', $messageCreate);
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
            $messageCreate = $this->messageCreateRepository->findWithoutFail($id);
    
            if(empty($messageCreate))
            {
                Flash::error('Message Create not found');
                return redirect(route('messageCreates.index'));
            }
    
            $user = DB::table('message_creates')->join('messages', 'message_creates.message_id', '=', 'messages.id')->where('message_creates.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                return view('message_creates.edit')
                    ->with('messageCreate', $messageCreate);
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

    public function update($id, UpdateMessageCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $messageCreate = $this->messageCreateRepository->findWithoutFail($id);
    
            if(empty($messageCreate))
            {
                Flash::error('Message Create not found');
                return redirect(route('messageCreates.index'));
            }
    
            $user = DB::table('message_creates')->join('messages', 'message_creates.message_id', '=', 'messages.id')->where('message_creates.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $messageCreate = $this->messageCreateRepository->update($request->all(), $id);
            
                Flash::success('Message Create updated successfully.');
                return redirect(route('messageCreates.index'));
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
            $messageCreate = $this->messageCreateRepository->findWithoutFail($id);
    
            if(empty($messageCreate))
            {
                Flash::error('Message Create not found');
                return redirect(route('messageCreates.index'));
            }
            
            $user = DB::table('message_creates')->join('messages', 'message_creates.message_id', '=', 'messages.id')->where('message_creates.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $this->messageCreateRepository->delete($id);
            
                Flash::success('Message Create deleted successfully.');
                return redirect(route('messageCreates.index'));
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