<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\UserRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserController extends AppBaseController
{
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userRepository->pushCriteria(new RequestCriteria($request));
            $users = $this->userRepository->all();
    
            return view('users.index')
                ->with('users', $users);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(CreateUserRequest $request)
    {
        $input = $request->all();
        $user = $this->userRepository->create($input);
    
        Flash::success('User saved successfully.');
        return redirect(route('users.index'));
    }

    public function show($id)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $user = $this->userRepository->findWithoutFail($id);
    
            if(empty($user))
            {
                Flash::error('User not found');
                return redirect(route('users.index'));
            }
    
            return view('users.show')
                ->with('user', $user);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function edit($id)
    {
        $user = $this->userRepository->findWithoutFail($id);
    
        if(empty($user))
        {
            Flash::error('User not found');
            return redirect(route('users.index'));
        }
    
        return view('users.edit')
            ->with('user', $user);
    }

    public function update($id, UpdateUserRequest $request)
    {
        if(Auth::user() != null)
        {
            $user = $this->userRepository->findWithoutFail($id);
            
            if(empty($user))
            {
                Flash::error('User not found');
                return redirect(route('users.index'));
            }
            
            $user = DB::table('users')->where('id', $id)->get();
            $actual_password = $request->actual_password;
            $password = $request->password;
            $password_confirmation = $request->password_confirmation;
            
            if(Hash::check($actual_password, $user[0] -> password) && ($password == $password_confirmation))
            {
                $encrypted = Hash::make($request->password);
                $request->merge(['password' => $encrypted]);
                $request->merge(['password_confirmation' => $encrypted]);
                $user = $this->userRepository->update($request->all(), $id);
            
                Flash::success('User updated successfully.');
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
    
    public function update_image($id, UpdateUserRequest $request)
    {
        
        // Access
        
        if(Auth::user() != null)
        {
            $user = $this->userRepository->findWithoutFail($id);
            
            if(empty($user))
            {
                Flash::error('User not found');
                return redirect(route('users.index'));
            }
            
            $file = $request->file('image');
            $new_file = 'image_' . $user -> id . '.' . $file -> getClientOriginalExtension();
            $file->move(public_path("images/users/"), $new_file);
            $fileType = $file -> getClientOriginalExtension();
    
            DB::table('users')->where('id', $user->id)->update(['image_type' => $fileType]);
            
            $user = $this->userRepository->update($request->all(), $id);
            
            Flash::success('User updated successfully.');
            return redirect(route('homes.index'));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function destroy($id)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $user = $this->userRepository->findWithoutFail($id);
    
            if(empty($user))
            {
                Flash::error('User not found');
                return redirect(route('users.index'));
            }
    
            $this->userRepository->delete($id);
    
            Flash::success('User deleted successfully.');
            return redirect(route('users.index'));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }
}