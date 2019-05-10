<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CollegeTopicSectionSearchController extends Controller
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
			$sections = DB::table('colleges')->join('college_topics', 'colleges.id', '=', 'college_topics.college_id')->join('college_topic_sections', 'college_topics.id', '=', 'college_topic_sections.college_topic_id')->where('college_topic_sections.name','LIKE','%'.$request->search."%")->where(function ($query) {$query->where('user_id', '=', Auth::user()->id);})->where(function ($query) {$query->where('college_topic_sections.deleted_at', '=', null);})->orderBy('college_topic_sections.name', 'asc')->limit(50)->get();
			
			if($sections)
 			{
				foreach ($sections as $key => $section)
				{
					$output.='<tr>'.'<td> <a href = "'.route("collegeTopicSections.show", [ $section -> id ]).'">'.$section->name.'</a> </td>'.'</tr>';
				}
 
				return Response($output);
 			}
 		}
 	}
}