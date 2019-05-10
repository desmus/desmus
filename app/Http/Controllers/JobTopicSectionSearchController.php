<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class JobTopicSectionSearchController extends Controller
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
			$sections = DB::table('jobs')->join('job_topics', 'jobs.id', '=', 'job_topics.job_id')->join('job_topic_sections', 'job_topics.id', '=', 'job_topic_sections.job_topic_id')->where('job_topic_sections.name','LIKE','%'.$request->search."%")->where(function ($query) {$query->where('user_id', '=', Auth::user()->id);})->where(function ($query) {$query->where('job_topic_sections.deleted_at', '=', null);})->orderBy('job_topic_sections.name', 'asc')->paginate(50);

			if($sections)
 			{
				foreach ($sections as $key => $section)
				{
					$output.='<tr>'.'<td> <a href = "'.route("jobTopicSections.show", [ $section -> id ]).'">'.$section->name.'</a> </td>'.'</tr>';
				}
 
				return Response($output);
 			}
 		}
 	}
}