<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProjectTopicSectionSearchController extends Controller
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
			$sections = DB::table('projects')->join('project_topics', 'projects.id', '=', 'project_topics.project_id')->join('project_topic_sections', 'project_topics.id', '=', 'project_topic_sections.project_topic_id')->where('project_topic_sections.name','LIKE','%'.$request->search."%")->where(function ($query) {$query->where('user_id', '=', Auth::user()->id);})->where(function ($query) {$query->where('project_topic_sections.deleted_at', '=', null);})->orderBy('project_topic_sections.name', 'asc')->paginate(50);

			if($sections)
 			{
				foreach ($sections as $key => $section)
				{
					$output.='<tr>'.'<td> <a href = "'.route("projectTopicSections.show", [ $section -> id ]).'">'.$section->name.'</a> </td>'.'</tr>';
				}
 
				return Response($output);
 			}
 		}
 	}
}