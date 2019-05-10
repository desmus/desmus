<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CollegeTSPlaylistSearchController extends Controller
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
			$playlists = DB::table('colleges')->join('college_topics', 'colleges.id', '=', 'college_topics.college_id')->join('college_topic_sections', 'college_topics.id', '=', 'college_topic_sections.college_topic_id')->join('college_t_s_playlists', 'college_topic_sections.id', '=', 'college_t_s_playlists.c_t_s_id')->where('college_t_s_playlists.name','LIKE','%'.$request->search."%")->where(function ($query) {$query->where('user_id', '=', Auth::user()->id);})->where(function ($query) {$query->where('college_t_s_playlists.deleted_at', '=', null);})->orderBy('college_t_s_playlists.name', 'asc')->limit(50)->get();

			if($playlists)
 			{
				foreach ($playlists as $key => $playlist)
				{
					$output.='<tr>'.'<td> <a href = "'.route("collegeTSPlaylists.show", [ $playlist -> id ]).'">'.$playlist->name.'</a></td>'.'</tr>';
				}
 
				return Response($output);
 			}
 		}
 	}
}