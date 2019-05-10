<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PersonalDataTSNoteSearchController extends Controller
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
			$notes = DB::table('personal_datas')->join('personal_data_topics', 'personal_datas.id', '=', 'personal_data_topics.personal_data_id')->join('personal_data_topic_sections', 'personal_data_topics.id', '=', 'personal_data_topic_sections.personal_data_topic_id')->join('personal_data_t_s_notes', 'personal_data_topic_sections.id', '=', 'personal_data_t_s_notes.personal_data_t_s_id')->where('personal_data_t_s_notes.name','LIKE','%'.$request->search."%")->where(function ($query) {$query->where('user_id', '=', Auth::user()->id);})->where(function ($query) {$query->where('personal_data_t_s_notes.deleted_at', '=', null);})->orderBy('personal_data_t_s_notes.name', 'asc')->paginate(50);

			if($notes)
 			{
				foreach ($notes as $key => $note)
				{
					$output.='<tr>'.'<td> <a href = "'.route("personalDataTSNotes.show", [ $note -> id ]).'">'.$note->name.'</a></td>'.'</tr>';
				}
 
				return Response($output);
 			}
 		}
 	}
}