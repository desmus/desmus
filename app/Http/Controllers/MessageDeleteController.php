<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateMessageDeleteRequest;
use App\Http\Requests\UpdateMessageDeleteRequest;
use App\Repositories\MessageDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class MessageDeleteController extends AppBaseController
{
    private $messageDeleteRepository;

    public function __construct(MessageDeleteRepository $messageDeleteRepo)
    {
        $this->messageDeleteRepository = $messageDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->messageDeleteRepository->pushCriteria(new RequestCriteria($request));
            $messageDeletes = $this->messageDeleteRepository->all();
    
            return view('message_deletes.index')
                ->with('messageDeletes', $messageDeletes);
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
            return view('message_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(DeleteMessageDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $messageDelete = $this->messageDeleteRepository->create($input);
    
            Flash::success('Message Delete saved successfully.');
            return redirect(route('messageDeletes.index'));
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
            $messageDelete = $this->messageDeleteRepository->findWithoutFail($id);
    
            if(empty($messageDelete))
            {
                Flash::error('Message Delete not found');
                return redirect(route('messageDeletes.index'));
            }
            
            $user = DB::table('message_deletes')->join('messages', 'message_deletes.message_id', '=', 'messages.id')->where('message_deletes.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                return view('message_deletes.show')
                    ->with('messageDelete', $messageDelete);
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
            $messageDelete = $this->messageDeleteRepository->findWithoutFail($id);
    
            if(empty($messageDelete))
            {
                Flash::error('Message Delete not found');
                return redirect(route('messageDeletes.index'));
            }
    
            $user = DB::table('message_deletes')->join('messages', 'message_deletes.message_id', '=', 'messages.id')->where('message_deletes.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                return view('message_deletes.edit')
                    ->with('messageDelete', $messageDelete);
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

    public function update($id, UpdateMessageDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $messageDelete = $this->messageDeleteRepository->findWithoutFail($id);
    
            if(empty($messageDelete))
            {
                Flash::error('Message Delete not found');
                return redirect(route('messageDeletes.index'));
            }
    
            $user = DB::table('message_deletes')->join('messages', 'message_deletes.message_id', '=', 'messages.id')->where('message_deletes.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $messageDelete = $this->messageDeleteRepository->update($request->all(), $id);
            
                Flash::success('Message Delete updated successfully.');
                return redirect(route('messageDeletes.index'));
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
            $messageDelete = $this->messageDeleteRepository->findWithoutFail($id);
    
            if(empty($messageDelete))
            {
                Flash::error('Message Delete not found');
                return redirect(route('messageDeletes.index'));
            }
            
            $user = DB::table('message_deletes')->join('messages', 'message_deletes.message_id', '=', 'messages.id')->where('message_deletes.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $this->messageDeleteRepository->delete($id);
            
                Flash::success('Message Delete deleted successfully.');
                return redirect(route('messageDeletes.index'));
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