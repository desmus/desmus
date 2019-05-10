<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class JobTSToolSearchController extends Controller
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
			$tools = DB::table('jobs')->join('job_topics', 'jobs.id', '=', 'job_topics.job_id')->join('job_topic_sections', 'job_topics.id', '=', 'job_topic_sections.job_topic_id')->join('job_t_s_tools', 'job_topic_sections.id', '=', 'job_t_s_tools.job_topic_section_id')->where('job_t_s_tools.name','LIKE','%'.$request->search."%")->where(function ($query) {$query->where('user_id', '=', Auth::user()->id);})->where(function ($query) {$query->where('job_t_s_tools.deleted_at', '=', null);})->orderBy('job_t_s_tools.name', 'asc')->paginate(50);

			if($tools)
 			{
				foreach ($tools as $key => $tool)
				{
					$output.='<tr>'.'<td> <a href = "'.route("jobTSTools.show", [ $tool -> id ]).'">'.$tool->name.'</a></td>'.'</tr>';
				}
 
				return Response($output);
 			}
 		}
 	}
}