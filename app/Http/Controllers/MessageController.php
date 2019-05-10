<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateMessageRequest;
use App\Http\Requests\UpdateMessageRequest;
use App\Repositories\MessageRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class MessageController extends AppBaseController
{
    private $messageRepository;

    public function __construct(MessageRepository $messageRepo)
    {
        $this->messageRepository = $messageRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->messageRepository->pushCriteria(new RequestCriteria($request));
            $messages = $this->messageRepository->all();
    
            return view('messages.index')
                ->with('messages', $messages);
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
            return view('messages.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateMessageRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $message = $this->messageRepository->create($input);
            $user = DB::table('messages')->join('users', 'users.id', '=', 'messages.s_user_id')->where('messages.id', '=', $message -> id)->select('name', 'users.id')->get();
            
            if($user[0] -> id == $user_id)
            {
                $user = DB::table('messages')->join('users', 'users.id', '=', 'messages.d_user_id')->where('messages.id', '=', $message -> id)->select('name', 'users.id')->get();

                DB::table('message_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'message_id' => $message -> id]);
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'm_c', 'user_id' => $user_id, 'entity_id' => $message -> id, 'created_at' => $now]);
            
                Flash::success('Message saved successfully.');
                return redirect(route('homes.index'));
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

    public function show($id)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $message = $this->messageRepository->findWithoutFail($id);
            
            if(empty($message))
            {
                Flash::error('Message not found');
                return redirect(route('homes.index'));
            }
            
            $s_user = DB::table('messages')->join('users', 'users.id', '=', 'messages.s_user_id')->where('messages.id', '=', $message -> id)->select('name', 'users.id')->get();
            $d_user = DB::table('messages')->join('users', 'users.id', '=', 'messages.d_user_id')->where('messages.id', '=', $message -> id)->select('name', 'users.id')->get();
            
            if($s_user[0] -> id == $user_id || $d_user[0] -> id = $user_id)
            {
                DB::table('message_views')->insert(['datetime' => $now, 'user_id' => $user_id, 'message_id' => $id]);
                DB::table('messages')->where('id', $id)->update(['views_quantity' => DB::raw('views_quantity + 1')]);
                
                $message = $this->messageRepository->findWithoutFail($id);
                $messageViews = DB::table('users')->join('message_views', 'users.id', "=", 'message_views.user_id')->where('message_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
    
                $messageViewsList = DB::table('users')->join('message_views', 'users.id', '=', 'message_views.user_id')->where('message_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
    
                return view('messages.show')
                    ->with('message', $message)
                    ->with('messageViews', $messageViews)
                    ->with('messageViewsList', $messageViewsList);
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
            $message = $this->messageRepository->findWithoutFail($id);
            $user = DB::table('messages')->join('users', 'users.id', '=', 'messages.s_user_id')->where('messages.id', '=', $message -> id)->select('name', 'users.id')->get();
    
            if(empty($message))
            {
                Flash::error('Message not found');
                return redirect(route('homes.index'));
            }
            
            if($user[0] -> id == $user_id)
            {
                return view('messages.edit')
                    ->with('message', $message);
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

    public function update($id, UpdateMessageRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $message = $this->messageRepository->findWithoutFail($id);
            $user = DB::table('messages')->join('users', 'users.id', '=', 'messages.s_user_id')->where('messages.id', '=', $message -> id)->select('name', 'users.id')->get();
    
            if(empty($message))
            {
                Flash::error('Message not found');
                return redirect(route('homes.index'));
            }
    
            if($user[0] -> id == $user_id)
            {
                $message = $this->messageRepository->update($request->all(), $id);
                $user = DB::table('messages')->join('users', 'users.id', '=', 'messages.d_user_id')->where('messages.id', '=', $message -> id)->select('name', 'users.id')->get();
                
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'm_u', 'user_id' => $user_id, 'entity_id' => $message -> id, 'created_at' => $now]);
            
                Flash::success('Message updated successfully.');
                return redirect(route('homes.index'));
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
            $message = $this->messageRepository->findWithoutFail($id);
            $user = DB::table('messages')->join('users', 'users.id', '=', 'messages.s_user_id')->where('messages.id', '=', $message -> id)->select('name', 'users.id')->get();
    
            if(empty($message))
            {
                Flash::error('Message not found');
                return redirect(route('homes.index'));
            }
            
            if($user[0] -> id == $user_id)
            {
                $this->messageRepository->delete($id);
                $user = DB::table('messages')->join('users', 'users.id', '=', 'messages.d_user_id')->where('messages.id', '=', $message -> id)->select('name', 'users.id')->get();
                
                DB::table('message_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'message_id' => $message -> id]);
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'm_d', 'user_id' => $user_id, 'entity_id' => $message -> id, 'created_at' => $now]);
            
                Flash::success('Message deleted successfully.');
                return redirect(route('homes.index'));
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