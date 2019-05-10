<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProjectTopicSearchController extends Controller
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
			$topics = DB::table('projects')->join('project_topics', 'projects.id', '=', 'project_topics.project_id')->where('project_topics.name','LIKE','%'.$request->search."%")->where(function ($query) {$query->where('user_id', '=', Auth::user()->id);})->where(function ($query) {$query->where('project_topics.deleted_at', '=', null);})->orderBy('project_topics.name', 'asc')->paginate(50);
 
			if($topics)
 			{
				foreach ($topics as $key => $topic)
				{
					$output.='<tr>'.'<td> <a href = "'.route("projectTopics.show", [ $topic -> id ]).'">'.$topic->name.'</a></td>'.'</tr>';
				}
 
				return Response($output);
 			}
 		}
 	}
}