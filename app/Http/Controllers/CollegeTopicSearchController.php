<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CollegeTopicSearchController extends Controller
{
	public function index()
	{
		return view('search.search');
	}
 
	public function search(Request $request)
	{
		if($request->ajax()) 
		{
			$output="";
			$topics = DB::table('colleges')->join('college_topics', 'colleges.id', '=', 'college_topics.college_id')->where('college_topics.name','LIKE','%'.$request->search."%")->where(function ($query) {$query->where('user_id', '=', Auth::user()->id);})->where(function ($query) {$query->where('college_topics.deleted_at', '=', null);})->orderBy('college_topics.name', 'asc')->limit(50)->get();
 
			if($topics)
 			{
				foreach ($topics as $key => $topic)
				{
					$output.='<tr>'.'<td> <a href = "'.route("collegeTopics.show", [ $topic -> id ]).'">'.$topic->name.'</a></td>'.'</tr>';
				}
 
				return Response($output);
 			}
 		}
 	}
}