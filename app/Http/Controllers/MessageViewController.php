<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateMessageViewRequest;
use App\Http\Requests\UpdateMessageViewRequest;
use App\Repositories\MessageViewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class MessageViewController extends AppBaseController
{
    private $messageViewRepository;

    public function __construct(MessageViewRepository $messageViewRepo)
    {
        $this->messageViewRepository = $messageViewRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->messageViewRepository->pushCriteria(new RequestCriteria($request));
            $messageViews = $this->messageViewRepository->all();
    
            return view('message_views.index')
                ->with('messageViews', $messageViews);
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
            return view('message_views.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(ViewMessageViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $messageView = $this->messageViewRepository->create($input);
    
            Flash::success('Message View saved successfully.');
            return redirect(route('messageViews.index'));
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
            $messageView = $this->messageViewRepository->findWithoutFail($id);
    
            if(empty($messageView))
            {
                Flash::error('Message View not found');
                return redirect(route('messageViews.index'));
            }
            
            $user = DB::table('message_views')->join('messages', 'message_views.message_id', '=', 'messages.id')->where('message_views.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                return view('message_views.show')
                    ->with('messageView', $messageView);
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
            $messageView = $this->messageViewRepository->findWithoutFail($id);
    
            if(empty($messageView))
            {
                Flash::error('Message View not found');
                return redirect(route('messageViews.index'));
            }
    
            $user = DB::table('message_views')->join('messages', 'message_views.message_id', '=', 'messages.id')->where('message_views.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                return view('message_views.edit')
                    ->with('messageView', $messageView);
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

    public function update($id, UpdateMessageViewRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $messageView = $this->messageViewRepository->findWithoutFail($id);
    
            if(empty($messageView))
            {
                Flash::error('Message View not found');
                return redirect(route('messageViews.index'));
            }
    
            $user = DB::table('message_views')->join('messages', 'message_views.message_id', '=', 'messages.id')->where('message_views.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $messageView = $this->messageViewRepository->update($request->all(), $id);
            
                Flash::success('Message View updated successfully.');
                return redirect(route('messageViews.index'));
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
            $messageView = $this->messageViewRepository->findWithoutFail($id);
    
            if(empty($messageView))
            {
                Flash::error('Message View not found');
                return redirect(route('messageViews.index'));
            }
            
            $user = DB::table('message_views')->join('messages', 'message_views.message_id', '=', 'messages.id')->where('message_views.id', '=', $id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $this->messageViewRepository->delete($id);
            
                Flash::success('Message View deleted successfully.');
                return redirect(route('messageViews.index'));
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