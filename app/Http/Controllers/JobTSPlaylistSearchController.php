<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class JobTSPlaylistSearchController extends Controller
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
			$playlists = DB::table('jobs')->join('job_topics', 'jobs.id', '=', 'job_topics.job_id')->join('job_topic_sections', 'job_topics.id', '=', 'job_topic_sections.job_topic_id')->join('job_t_s_playlists', 'job_topic_sections.id', '=', 'job_t_s_playlists.j_t_s_id')->where('job_t_s_playlists.name','LIKE','%'.$request->search."%")->where(function ($query) {$query->where('user_id', '=', Auth::user()->id);})->where(function ($query) {$query->where('job_t_s_playlists.deleted_at', '=', null);})->orderBy('job_t_s_playlists.name', 'asc')->paginate(50);

			if($playlists)
 			{
				foreach ($playlists as $key => $playlist)
				{
					$output.='<tr>'.'<td> <a href = "'.route("jobTSPlaylists.show", [ $playlist -> id ]).'">'.$playlist->name.'</a></td>'.'</tr>';
				}
 
				return Response($output);
 			}
 		}
 	}
}