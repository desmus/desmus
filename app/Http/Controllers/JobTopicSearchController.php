<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class JobTopicSearchController extends Controller
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
			$topics = DB::table('jobs')->join('job_topics', 'jobs.id', '=', 'job_topics.job_id')->where('job_topics.name','LIKE','%'.$request->search."%")->where(function ($query) {$query->where('user_id', '=', Auth::user()->id);})->where(function ($query) {$query->where('job_topics.deleted_at', '=', null);})->orderBy('job_topics.name', 'asc')->paginate(50);
 
			if($topics)
 			{
				foreach ($topics as $key => $topic)
				{
					$output.='<tr>'.'<td> <a href = "'.route("jobTopics.show", [ $topic -> id ]).'">'.$topic->name.'</a></td>'.'</tr>';
				}
 
				return Response($output);
 			}
 		}
 	}
}