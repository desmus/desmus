<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CollegeTSToolFileSearchController extends Controller
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
			$files = DB::table('college_topic_sections')->join('college_t_s_tool_files', 'college_topic_sections.id', '=', 'college_t_s_tool_files.college_id')->where('college_t_s_tool_files.name','LIKE','%'.$request->search."%")->where(function ($query) {$query->where('user_id', '=', Auth::user()->id);})->where(function ($query) {$query->where('college_t_s_tool_files.deleted_at', '=', null);})->orderBy('college_t_s_tool_files.name', 'asc')->limit(50)->get();
 
			if($files)
 			{
				foreach ($files as $key => $file)
				{
					$output.='<tr>'.'<td> <a href = "'.route("collegeTSToolFiles.show", [ $file -> id ]).'">'.$file->name.'</a></td>'.'</tr>';
				}
 
				return Response($output);
 			}
 		}
 	}
}