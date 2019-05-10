<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class JobTSFileSearchController extends Controller
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
			$files = DB::table('jobs')->join('job_topics', 'jobs.id', '=', 'job_topics.job_id')->join('job_topic_sections', 'job_topics.id', '=', 'job_topic_sections.job_topic_id')->join('job_t_s_files', 'job_topic_sections.id', '=', 'job_t_s_files.job_topic_section_id')->where('job_t_s_files.name','LIKE','%'.$request->search."%")->where(function ($query) {$query->where('user_id', '=', Auth::user()->id);})->where(function ($query) {$query->where('job_t_s_files.deleted_at', '=', null);})->orderBy('job_t_s_files.name', 'asc')->paginate(50);

			if($files)
 			{
				foreach ($files as $key => $file)
				{
					$output.='<tr>'.'<td> <a href = "'.route("jobTSFiles.show", [ $file -> id ]).'">'.$file->name.'</a></td>'.'</tr>';
				}
 
				return Response($output);
 			}
 		}
 	}
}