<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProjectTSToolSearchController extends Controller
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
			$tools = DB::table('projects')->join('project_topics', 'projects.id', '=', 'project_topics.project_id')->join('project_topic_sections', 'project_topics.id', '=', 'project_topic_sections.project_topic_id')->join('project_t_s_tools', 'project_topic_sections.id', '=', 'project_t_s_tools.project_topic_section_id')->where('project_t_s_tools.name','LIKE','%'.$request->search."%")->where(function ($query) {$query->where('user_id', '=', Auth::user()->id);})->where(function ($query) {$query->where('project_t_s_tools.deleted_at', '=', null);})->orderBy('project_t_s_tools.name', 'asc')->paginate(50);

			if($tools)
 			{
				foreach ($tools as $key => $tool)
				{
					$output.='<tr>'.'<td> <a href = "'.route("projectTSTools.show", [ $tool -> id ]).'">'.$tool->name.'</a></td>'.'</tr>';
				}
 
				return Response($output);
 			}
 		}
 	}
}