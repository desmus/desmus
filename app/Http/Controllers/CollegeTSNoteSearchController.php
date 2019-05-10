<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CollegeTSNoteSearchController extends Controller
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
			$notes = DB::table('colleges')->join('college_topics', 'colleges.id', '=', 'college_topics.college_id')->join('college_topic_sections', 'college_topics.id', '=', 'college_topic_sections.college_topic_id')->join('college_t_s_notes', 'college_topic_sections.id', '=', 'college_t_s_notes.college_topic_section_id')->where('college_t_s_notes.name','LIKE','%'.$request->search."%")->where(function ($query) {$query->where('user_id', '=', Auth::user()->id);})->where(function ($query) {$query->where('college_t_s_notes.deleted_at', '=', null);})->orderBy('college_t_s_notes.name', 'asc')->limit(50)->get();

			if($notes)
 			{
				foreach ($notes as $key => $note)
				{
					$output.='<tr>'.'<td> <a href = "'.route("collegeTSNotes.show", [ $note -> id ]).'">'.$note->name.'</a></td>'.'</tr>';
				}
 
				return Response($output);
 			}
 		}
 	}
}