<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserSearchController extends Controller
{
	public function index()
	{
		return view('search.search');
	}
 
	public function search(Request $request)
	{
	    $user_id = Auth::user()->id;
 
		if($request->ajax())
		{
			$output="";
 			$users = DB::table('users')->where('name','LIKE','%'.$request->search.'%')->where('id', '!=', $user_id)->orderBy('name', 'asc')->get();
 			$contacts = DB::table('contacts')->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
 			
			if($users)
 			{
				foreach ($users as $user)
				{
		            $exist = false;
				  
		            foreach ($contacts as $contact)
		            {
		                $exist = false;
				    
                        if($user -> id == $contact -> contact_id)
				        {
				            $exist = true;
				            break;
				        }
				    }
				  
				    if(!$exist)
				    {
				        $output.='<tr>'.'<td>'.'<input type="radio" name="contact_id" value="'.$user->id.'">'.'</td>'.'<td>'.$user->name.'</td>'.'<td>'.$user->email.'</td>'.'</tr>';
				    }
				}
				
				return Response($output);
 			}
 		}
 	}
}