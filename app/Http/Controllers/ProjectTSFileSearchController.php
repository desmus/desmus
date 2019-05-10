<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProjectTSFileSearchController extends Controller
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
			$files = DB::table('projects')->join('project_topics', 'projects.id', '=', 'project_topics.project_id')->join('project_topic_sections', 'project_topics.id', '=', 'project_topic_sections.project_topic_id')->join('project_t_s_files', 'project_topic_sections.id', '=', 'project_t_s_files.project_topic_section_id')->where('project_t_s_files.name','LIKE','%'.$request->search."%")->where(function ($query) {$query->where('user_id', '=', Auth::user()->id);})->where(function ($query) {$query->where('project_t_s_files.deleted_at', '=', null);})->orderBy('project_t_s_files.name', 'asc')->paginate(50);

			if($files)
 			{
				foreach ($files as $key => $file)
				{
					$output.='<tr>'.'<td> <a href = "'.route("projectTSFiles.show", [ $file -> id ]).'">'.$file->name.'</a></td>'.'</tr>';
				}
 
				return Response($output);
 			}
 		}
 	}
}