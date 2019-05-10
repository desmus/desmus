<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PersonalDataTopicSearchController extends Controller
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
			$topics = DB::table('personal_datas')->join('personal_data_topics', 'personal_datas.id', '=', 'personal_data_topics.personal_data_id')->where('personal_data_topics.name','LIKE','%'.$request->search."%")->where(function ($query) {$query->where('user_id', '=', Auth::user()->id);})->where(function ($query) {$query->where('personal_data_topics.deleted_at', '=', null);})->orderBy('personal_data_topics.name', 'asc')->paginate(50);
 
			if($topics)
 			{
				foreach ($topics as $key => $topic)
				{
					$output.='<tr>'.'<td> <a href = "'.route("personalDataTopics.show", [ $topic -> id ]).'">'.$topic->name.'</a></td>'.'</tr>';
				}
 
				return Response($output);
 			}
 		}
 	}
}