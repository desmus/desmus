<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CollegeTSGaleryImageSearchController extends Controller
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
			$images = DB::table('college_t_s_galeries')->join('college_t_s_galery_images', 'college_topic_sections.id', '=', 'college_t_s_galery_images.college_id')->where('college_t_s_galery_images.name','LIKE','%'.$request->search."%")->where(function ($query) {$query->where('user_id', '=', Auth::user()->id);})->where(function ($query) {$query->where('college_t_s_galery_images.deleted_at', '=', null);})->orderBy('college_t_s_galery_images.name', 'asc')->limit(50)->get();
 
			if($images)
 			{
				foreach ($images as $key => $image)
				{
					$output.='<tr>'.'<td> <a href = "'.route("collegeTSGaleryImages.show", [ $image -> id ]).'">'.$image->name.'</a></td>'.'</tr>';
				}
 
				return Response($output);
 			}
 		}
 	}
}