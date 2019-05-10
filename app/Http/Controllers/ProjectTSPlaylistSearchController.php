<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProjectTSPlaylistSearchController extends Controller
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
			$playlists = DB::table('projects')->join('project_topics', 'projects.id', '=', 'project_topics.project_id')->join('project_topic_sections', 'project_topics.id', '=', 'project_topic_sections.project_topic_id')->join('project_t_s_playlists', 'project_topic_sections.id', '=', 'project_t_s_playlists.p_t_s_id')->where('project_t_s_playlists.name','LIKE','%'.$request->search."%")->where(function ($query) {$query->where('user_id', '=', Auth::user()->id);})->where(function ($query) {$query->where('project_t_s_playlists.deleted_at', '=', null);})->orderBy('project_t_s_playlists.name', 'asc')->paginate(50);

			if($playlists)
 			{
				foreach ($playlists as $key => $playlist)
				{
					$output.='<tr>'.'<td> <a href = "'.route("projectTSPlaylists.show", [ $playlist -> id ]).'">'.$playlist->name.'</a></td>'.'</tr>';
				}
 
				return Response($output);
 			}
 		}
 	}
}