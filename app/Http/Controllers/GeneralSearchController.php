<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateGeneralSearchRequest;
use App\Http\Requests\UpdateGeneralSearchRequest;
use App\Repositories\GeneralSearchRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use App\Models\GeneralSearch;
use Illuminate\Support\Carbon;

class GeneralSearchController extends AppBaseController
{
    private $generalSearchRepository;

    public function __construct(GeneralSearchRepository $generalSearchRepo)
    {
        $this->generalSearchRepository = $generalSearchRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $now = Carbon::now();
            
            $this->generalSearchRepository->pushCriteria(new RequestCriteria($request));
            $generalSearches = GeneralSearch::where('user_id', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->get();
    
            $output="";
    		
    		$colleges = DB::table('colleges')->where('colleges.name','LIKE','%'.$request->search."%")->where(function ($query) {$query->where('user_id', '=', Auth::user()->id);})->where(function ($query) {$query->where('colleges.deleted_at', '=', null);})->orderBy('colleges.name', 'asc')->paginate(50);
    		$college_topics = DB::table('colleges')->join('college_topics', 'colleges.id', '=', 'college_topics.college_id')->where('college_topics.name','LIKE','%'.$request->search."%")->where(function ($query) {$query->where('user_id', '=', Auth::user()->id);})->where(function ($query) {$query->where('college_topics.deleted_at', '=', null);})->orderBy('college_topics.name', 'asc')->paginate(50);
            $college_sections = DB::table('colleges')->join('college_topics', 'colleges.id', '=', 'college_topics.college_id')->join('college_topic_sections', 'college_topics.id', '=', 'college_topic_sections.college_topic_id')->where('college_topic_sections.name','LIKE','%'.$request->search."%")->where(function ($query) {$query->where('user_id', '=', Auth::user()->id);})->where(function ($query) {$query->where('college_topic_sections.deleted_at', '=', null);})->orderBy('college_topic_sections.name', 'asc')->paginate(50);
            $college_files = DB::table('colleges')->join('college_topics', 'colleges.id', '=', 'college_topics.college_id')->join('college_topic_sections', 'college_topics.id', '=', 'college_topic_sections.college_topic_id')->join('college_t_s_files', 'college_topic_sections.id', '=', 'college_t_s_files.college_topic_section_id')->where('college_t_s_files.name','LIKE','%'.$request->search."%")->where(function ($query) {$query->where('user_id', '=', Auth::user()->id);})->where(function ($query) {$query->where('college_t_s_files.deleted_at', '=', null);})->orderBy('college_t_s_files.name', 'asc')->paginate(50);
    		$college_notes = DB::table('colleges')->join('college_topics', 'colleges.id', '=', 'college_topics.college_id')->join('college_topic_sections', 'college_topics.id', '=', 'college_topic_sections.college_topic_id')->join('college_t_s_notes', 'college_topic_sections.id', '=', 'college_t_s_notes.college_topic_section_id')->where('college_t_s_notes.name','LIKE','%'.$request->search."%")->where(function ($query) {$query->where('user_id', '=', Auth::user()->id);})->where(function ($query) {$query->where('college_t_s_notes.deleted_at', '=', null);})->orderBy('college_t_s_notes.name', 'asc')->paginate(50);
    		$college_galeries = DB::table('colleges')->join('college_topics', 'colleges.id', '=', 'college_topics.college_id')->join('college_topic_sections', 'college_topics.id', '=', 'college_topic_sections.college_topic_id')->join('college_t_s_galeries', 'college_topic_sections.id', '=', 'college_t_s_galeries.college_topic_section_id')->where('college_t_s_galeries.name','LIKE','%'.$request->search."%")->where(function ($query) {$query->where('user_id', '=', Auth::user()->id);})->where(function ($query) {$query->where('college_t_s_galeries.deleted_at', '=', null);})->orderBy('college_t_s_galeries.name', 'asc')->paginate(50);
    		$college_playlists = DB::table('colleges')->join('college_topics', 'colleges.id', '=', 'college_topics.college_id')->join('college_topic_sections', 'college_topics.id', '=', 'college_topic_sections.college_topic_id')->join('college_t_s_playlists', 'college_topic_sections.id', '=', 'college_t_s_playlists.c_t_s_id')->where('college_t_s_playlists.name','LIKE','%'.$request->search."%")->where(function ($query) {$query->where('user_id', '=', Auth::user()->id);})->where(function ($query) {$query->where('college_t_s_playlists.deleted_at', '=', null);})->orderBy('college_t_s_playlists.name', 'asc')->paginate(50);
    		$college_tools = DB::table('colleges')->join('college_topics', 'colleges.id', '=', 'college_topics.college_id')->join('college_topic_sections', 'college_topics.id', '=', 'college_topic_sections.college_topic_id')->join('college_t_s_tools', 'college_topic_sections.id', '=', 'college_t_s_tools.college_topic_section_id')->where('college_t_s_tools.name','LIKE','%'.$request->search."%")->where(function ($query) {$query->where('user_id', '=', Auth::user()->id);})->where(function ($query) {$query->where('college_t_s_tools.deleted_at', '=', null);})->orderBy('college_t_s_tools.name', 'asc')->paginate(50);
     
            $jobs = DB::table('jobs')->where('jobs.name','LIKE','%'.$request->search."%")->where(function ($query) {$query->where('user_id', '=', Auth::user()->id);})->where(function ($query) {$query->where('jobs.deleted_at', '=', null);})->orderBy('jobs.name', 'asc')->paginate(50);
            $job_topics = DB::table('jobs')->join('job_topics', 'jobs.id', '=', 'job_topics.job_id')->where('job_topics.name','LIKE','%'.$request->search."%")->where(function ($query) {$query->where('user_id', '=', Auth::user()->id);})->where(function ($query) {$query->where('job_topics.deleted_at', '=', null);})->orderBy('job_topics.name', 'asc')->paginate(50);
            $job_sections = DB::table('jobs')->join('job_topics', 'jobs.id', '=', 'job_topics.job_id')->join('job_topic_sections', 'job_topics.id', '=', 'job_topic_sections.job_topic_id')->where('job_topic_sections.name','LIKE','%'.$request->search."%")->where(function ($query) {$query->where('user_id', '=', Auth::user()->id);})->where(function ($query) {$query->where('job_topic_sections.deleted_at', '=', null);})->orderBy('job_topic_sections.name', 'asc')->paginate(50);
            $job_files = DB::table('jobs')->join('job_topics', 'jobs.id', '=', 'job_topics.job_id')->join('job_topic_sections', 'job_topics.id', '=', 'job_topic_sections.job_topic_id')->join('job_t_s_files', 'job_topic_sections.id', '=', 'job_t_s_files.job_topic_section_id')->where('job_t_s_files.name','LIKE','%'.$request->search."%")->where(function ($query) {$query->where('user_id', '=', Auth::user()->id);})->where(function ($query) {$query->where('job_t_s_files.deleted_at', '=', null);})->orderBy('job_t_s_files.name', 'asc')->paginate(50);
    		$job_notes = DB::table('jobs')->join('job_topics', 'jobs.id', '=', 'job_topics.job_id')->join('job_topic_sections', 'job_topics.id', '=', 'job_topic_sections.job_topic_id')->join('job_t_s_notes', 'job_topic_sections.id', '=', 'job_t_s_notes.job_topic_section_id')->where('job_t_s_notes.name','LIKE','%'.$request->search."%")->where(function ($query) {$query->where('user_id', '=', Auth::user()->id);})->where(function ($query) {$query->where('job_t_s_notes.deleted_at', '=', null);})->orderBy('job_t_s_notes.name', 'asc')->paginate(50);
    		$job_galeries = DB::table('jobs')->join('job_topics', 'jobs.id', '=', 'job_topics.job_id')->join('job_topic_sections', 'job_topics.id', '=', 'job_topic_sections.job_topic_id')->join('job_t_s_galeries', 'job_topic_sections.id', '=', 'job_t_s_galeries.job_topic_section_id')->where('job_t_s_galeries.name','LIKE','%'.$request->search."%")->where(function ($query) {$query->where('user_id', '=', Auth::user()->id);})->where(function ($query) {$query->where('job_t_s_galeries.deleted_at', '=', null);})->orderBy('job_t_s_galeries.name', 'asc')->paginate(50);
    		$job_playlists = DB::table('jobs')->join('job_topics', 'jobs.id', '=', 'job_topics.job_id')->join('job_topic_sections', 'job_topics.id', '=', 'job_topic_sections.job_topic_id')->join('job_t_s_playlists', 'job_topic_sections.id', '=', 'job_t_s_playlists.j_t_s_id')->where('job_t_s_playlists.name','LIKE','%'.$request->search."%")->where(function ($query) {$query->where('user_id', '=', Auth::user()->id);})->where(function ($query) {$query->where('job_t_s_playlists.deleted_at', '=', null);})->orderBy('job_t_s_playlists.name', 'asc')->paginate(50);
    		$job_tools = DB::table('jobs')->join('job_topics', 'jobs.id', '=', 'job_topics.job_id')->join('job_topic_sections', 'job_topics.id', '=', 'job_topic_sections.job_topic_id')->join('job_t_s_tools', 'job_topic_sections.id', '=', 'job_t_s_tools.job_topic_section_id')->where('job_t_s_tools.name','LIKE','%'.$request->search."%")->where(function ($query) {$query->where('user_id', '=', Auth::user()->id);})->where(function ($query) {$query->where('job_t_s_tools.deleted_at', '=', null);})->orderBy('job_t_s_tools.name', 'asc')->paginate(50);
    
            $projects = DB::table('projects')->where('projects.name','LIKE','%'.$request->search."%")->where(function ($query) {$query->where('user_id', '=', Auth::user()->id);})->where(function ($query) {$query->where('projects.deleted_at', '=', null);})->orderBy('projects.name', 'asc')->paginate(50);
            $project_topics = DB::table('projects')->join('project_topics', 'projects.id', '=', 'project_topics.project_id')->where('project_topics.name','LIKE','%'.$request->search."%")->where(function ($query) {$query->where('user_id', '=', Auth::user()->id);})->where(function ($query) {$query->where('project_topics.deleted_at', '=', null);})->orderBy('project_topics.name', 'asc')->paginate(50);
            $project_sections = DB::table('projects')->join('project_topics', 'projects.id', '=', 'project_topics.project_id')->join('project_topic_sections', 'project_topics.id', '=', 'project_topic_sections.project_topic_id')->where('project_topic_sections.name','LIKE','%'.$request->search."%")->where(function ($query) {$query->where('user_id', '=', Auth::user()->id);})->where(function ($query) {$query->where('project_topic_sections.deleted_at', '=', null);})->orderBy('project_topic_sections.name', 'asc')->paginate(50);
            $project_files = DB::table('projects')->join('project_topics', 'projects.id', '=', 'project_topics.project_id')->join('project_topic_sections', 'project_topics.id', '=', 'project_topic_sections.project_topic_id')->join('project_t_s_files', 'project_topic_sections.id', '=', 'project_t_s_files.project_topic_section_id')->where('project_t_s_files.name','LIKE','%'.$request->search."%")->where(function ($query) {$query->where('user_id', '=', Auth::user()->id);})->where(function ($query) {$query->where('project_t_s_files.deleted_at', '=', null);})->orderBy('project_t_s_files.name', 'asc')->paginate(50);
    		$project_notes = DB::table('projects')->join('project_topics', 'projects.id', '=', 'project_topics.project_id')->join('project_topic_sections', 'project_topics.id', '=', 'project_topic_sections.project_topic_id')->join('project_t_s_notes', 'project_topic_sections.id', '=', 'project_t_s_notes.project_topic_section_id')->where('project_t_s_notes.name','LIKE','%'.$request->search."%")->where(function ($query) {$query->where('user_id', '=', Auth::user()->id);})->where(function ($query) {$query->where('project_t_s_notes.deleted_at', '=', null);})->orderBy('project_t_s_notes.name', 'asc')->paginate(50);
    		$project_galeries = DB::table('projects')->join('project_topics', 'projects.id', '=', 'project_topics.project_id')->join('project_topic_sections', 'project_topics.id', '=', 'project_topic_sections.project_topic_id')->join('project_t_s_galeries', 'project_topic_sections.id', '=', 'project_t_s_galeries.project_topic_section_id')->where('project_t_s_galeries.name','LIKE','%'.$request->search."%")->where(function ($query) {$query->where('user_id', '=', Auth::user()->id);})->where(function ($query) {$query->where('project_t_s_galeries.deleted_at', '=', null);})->orderBy('project_t_s_galeries.name', 'asc')->paginate(50);
    		$project_playlists = DB::table('projects')->join('project_topics', 'projects.id', '=', 'project_topics.project_id')->join('project_topic_sections', 'project_topics.id', '=', 'project_topic_sections.project_topic_id')->join('project_t_s_playlists', 'project_topic_sections.id', '=', 'project_t_s_playlists.p_t_s_id')->where('project_t_s_playlists.name','LIKE','%'.$request->search."%")->where(function ($query) {$query->where('user_id', '=', Auth::user()->id);})->where(function ($query) {$query->where('project_t_s_playlists.deleted_at', '=', null);})->orderBy('project_t_s_playlists.name', 'asc')->paginate(50);
    		$project_tools = DB::table('projects')->join('project_topics', 'projects.id', '=', 'project_topics.project_id')->join('project_topic_sections', 'project_topics.id', '=', 'project_topic_sections.project_topic_id')->join('project_t_s_tools', 'project_topic_sections.id', '=', 'project_t_s_tools.project_topic_section_id')->where('project_t_s_tools.name','LIKE','%'.$request->search."%")->where(function ($query) {$query->where('user_id', '=', Auth::user()->id);})->where(function ($query) {$query->where('project_t_s_tools.deleted_at', '=', null);})->orderBy('project_t_s_tools.name', 'asc')->paginate(50);
     
            $personal_datas = DB::table('personal_datas')->where('personal_datas.name','LIKE','%'.$request->search."%")->where(function ($query) {$query->where('user_id', '=', Auth::user()->id);})->where(function ($query) {$query->where('personal_datas.deleted_at', '=', null);})->orderBy('personal_datas.name', 'asc')->paginate(50);
            $personal_data_topics = DB::table('personal_datas')->join('personal_data_topics', 'personal_datas.id', '=', 'personal_data_topics.personal_data_id')->where('personal_data_topics.name','LIKE','%'.$request->search."%")->where(function ($query) {$query->where('user_id', '=', Auth::user()->id);})->where(function ($query) {$query->where('personal_data_topics.deleted_at', '=', null);})->orderBy('personal_data_topics.name', 'asc')->paginate(50);
            $personal_data_sections = DB::table('personal_datas')->join('personal_data_topics', 'personal_datas.id', '=', 'personal_data_topics.personal_data_id')->join('personal_data_topic_sections', 'personal_data_topics.id', '=', 'personal_data_topic_sections.personal_data_topic_id')->where('personal_data_topic_sections.name','LIKE','%'.$request->search."%")->where(function ($query) {$query->where('user_id', '=', Auth::user()->id);})->where(function ($query) {$query->where('personal_data_topic_sections.deleted_at', '=', null);})->orderBy('personal_data_topic_sections.name', 'asc')->paginate(50);
            $personal_data_files = DB::table('personal_datas')->join('personal_data_topics', 'personal_datas.id', '=', 'personal_data_topics.personal_data_id')->join('personal_data_topic_sections', 'personal_data_topics.id', '=', 'personal_data_topic_sections.personal_data_topic_id')->join('personal_data_t_s_files', 'personal_data_topic_sections.id', '=', 'personal_data_t_s_files.personal_data_t_s_id')->where('personal_data_t_s_files.name','LIKE','%'.$request->search."%")->where(function ($query) {$query->where('user_id', '=', Auth::user()->id);})->where(function ($query) {$query->where('personal_data_t_s_files.deleted_at', '=', null);})->orderBy('personal_data_t_s_files.name', 'asc')->paginate(50);
            $personal_data_notes = DB::table('personal_datas')->join('personal_data_topics', 'personal_datas.id', '=', 'personal_data_topics.personal_data_id')->join('personal_data_topic_sections', 'personal_data_topics.id', '=', 'personal_data_topic_sections.personal_data_topic_id')->join('personal_data_t_s_notes', 'personal_data_topic_sections.id', '=', 'personal_data_t_s_notes.personal_data_t_s_id')->where('personal_data_t_s_notes.name','LIKE','%'.$request->search."%")->where(function ($query) {$query->where('user_id', '=', Auth::user()->id);})->where(function ($query) {$query->where('personal_data_t_s_notes.deleted_at', '=', null);})->orderBy('personal_data_t_s_notes.name', 'asc')->paginate(50);
            $personal_data_galeries = DB::table('personal_datas')->join('personal_data_topics', 'personal_datas.id', '=', 'personal_data_topics.personal_data_id')->join('personal_data_topic_sections', 'personal_data_topics.id', '=', 'personal_data_topic_sections.personal_data_topic_id')->join('personal_data_t_s_galeries', 'personal_data_topic_sections.id', '=', 'personal_data_t_s_galeries.personal_data_t_s_id')->where('personal_data_t_s_galeries.name','LIKE','%'.$request->search."%")->where(function ($query) {$query->where('user_id', '=', Auth::user()->id);})->where(function ($query) {$query->where('personal_data_t_s_galeries.deleted_at', '=', null);})->orderBy('personal_data_t_s_galeries.name', 'asc')->paginate(50);
            $personal_data_playlists = DB::table('personal_datas')->join('personal_data_topics', 'personal_datas.id', '=', 'personal_data_topics.personal_data_id')->join('personal_data_topic_sections', 'personal_data_topics.id', '=', 'personal_data_topic_sections.personal_data_topic_id')->join('personal_data_t_s_playlists', 'personal_data_topic_sections.id', '=', 'personal_data_t_s_playlists.p_d_t_s_id')->where('personal_data_t_s_playlists.name','LIKE','%'.$request->search."%")->where(function ($query) {$query->where('user_id', '=', Auth::user()->id);})->where(function ($query) {$query->where('personal_data_t_s_playlists.deleted_at', '=', null);})->orderBy('personal_data_t_s_playlists.name', 'asc')->paginate(50);
            $personal_data_tools = DB::table('personal_datas')->join('personal_data_topics', 'personal_datas.id', '=', 'personal_data_topics.personal_data_id')->join('personal_data_topic_sections', 'personal_data_topics.id', '=', 'personal_data_topic_sections.personal_data_topic_id')->join('personal_data_t_s_tools', 'personal_data_topic_sections.id', '=', 'personal_data_t_s_tools.personal_data_topic_section_id')->where('personal_data_t_s_tools.name','LIKE','%'.$request->search."%")->where(function ($query) {$query->where('user_id', '=', Auth::user()->id);})->where(function ($query) {$query->where('personal_data_t_s_tools.deleted_at', '=', null);})->orderBy('personal_data_t_s_tools.name', 'asc')->paginate(50);
     
            $calendar_events = DB::table('calendar_events')->where('user_id', '=', $user_id)->where('name', 'LIKE', '%'.$request->search."%")->where(function ($query) {$query->where('calendar_events.deleted_at', '=', null);})->paginate(50);
            $messages = DB::table('messages')->where('s_user_id', '=', $user_id)->where('subject', 'LIKE', '%'.$request->search."%")->where(function ($query) {$query->where('messages.deleted_at', '=', null);})->paginate(50);
            $contacts = DB::table('contacts')->join('users', 'contacts.contact_id', '=', 'users.id')->where('user_id', '=', $user_id)->where('name', 'LIKE', '%'.$request->search."%")->where(function ($query) {$query->where('contacts.deleted_at', '=', null);})->paginate(50);
     
            if($request->search)
            {
        		if($colleges->isNotEmpty())
         		{
         		    DB::table('general_search')->insert(['search' => $request->search, 'entity_type' => 'c_s', 'entity_id' => $colleges[0] -> id, 'user_id' => $user_id, 'updated_at' => $now]);
         		    
        			foreach ($colleges as $key => $college)
        			{
        				$output.='<tr>'.'<td> <a href = "'.route("colleges.show", [ $college -> id ]).'">'.$college->name.'</a></td>'.'</tr>';
        			}
         		}
         		
         		if($college_topics->isNotEmpty())
         		{
         		    DB::table('general_search')->insert(['search' => $request->search, 'entity_type' => 'c_t_s', 'entity_id' => $college_topics[0] -> id, 'user_id' => $user_id, 'updated_at' => $now]);
    
        			foreach ($college_topics as $key => $college_topic)
        			{
        				$output.='<tr>'.'<td> <a href = "'.route("collegeTopics.show", [ $college_topic -> id ]).'">'.$college_topic->name.'</a></td>'.'</tr>';
        			}
         		}
         		
         		if($college_sections->isNotEmpty())
         		{
         		    DB::table('general_search')->insert(['search' => $request->search, 'entity_type' => 'c_t_s_s', 'entity_id' => $college_sections[0] -> id, 'user_id' => $user_id, 'updated_at' => $now]);
    
        			foreach ($college_sections as $key => $college_section)
        			{
        				$output.='<tr>'.'<td> <a href = "'.route("collegeTopicSections.show", [ $college_section -> id ]).'">'.$college_section->name.'</a></td>'.'</tr>';
        			}
         		}
         		
         		if($college_files->isNotEmpty())
         		{
         		    DB::table('general_search')->insert(['search' => $request->search, 'entity_type' => 'c_t_s_f_s', 'entity_id' => $college_files[0] -> id, 'user_id' => $user_id, 'updated_at' => $now]);
    
        			foreach ($college_files as $key => $college_file)
        			{
        				$output.='<tr>'.'<td> <a href = "'.route("collegeTSFiles.show", [ $college_file -> id ]).'">'.$college_file->name.'</a></td>'.'</tr>';
        			}
         		}
         		
         		if($college_notes->isNotEmpty())
         		{
         		    DB::table('general_search')->insert(['search' => $request->search, 'entity_type' => 'c_t_s_n_s', 'entity_id' => $college_notes[0] -> id, 'user_id' => $user_id, 'updated_at' => $now]);
    
        			foreach ($college_notes as $key => $college_note)
        			{
        				$output.='<tr>'.'<td> <a href = "'.route("collegeTSNotes.show", [ $college_note -> id ]).'">'.$college_note->name.'</a></td>'.'</tr>';
        			}
         		}
         		
         		if($college_galeries->isNotEmpty())
         		{
         		    DB::table('general_search')->insert(['search' => $request->search, 'entity_type' => 'c_t_s_g_s', 'entity_id' => $college_galeries[0] -> id, 'user_id' => $user_id, 'updated_at' => $now]);
    
        			foreach ($college_galeries as $key => $college_galerie)
        			{
        				$output.='<tr>'.'<td> <a href = "'.route("collegeTSGaleries.show", [ $college_galerie -> id ]).'">'.$college_galerie->name.'</a></td>'.'</tr>';
        			}
         		}
         		
         		if($college_playlists->isNotEmpty())
         		{
         		    DB::table('general_search')->insert(['search' => $request->search, 'entity_type' => 'c_t_s_p_s', 'entity_id' => $college_playlists[0] -> id, 'user_id' => $user_id, 'updated_at' => $now]);
    
        			foreach ($college_playlists as $key => $college_playlist)
        			{
        				$output.='<tr>'.'<td> <a href = "'.route("collegeTSPlaylists.show", [ $college_playlist -> id ]).'">'.$college_playlist->name.'</a></td>'.'</tr>';
        			}
         		}
         		
         		if($college_tools->isNotEmpty())
         		{
         		    DB::table('general_search')->insert(['search' => $request->search, 'entity_type' => 'c_t_s_t_s', 'entity_id' => $college_tools[0] -> id, 'user_id' => $user_id, 'updated_at' => $now]);
    
        			foreach ($college_tools as $key => $college_tool)
        			{
        				$output.='<tr>'.'<td> <a href = "'.route("collegeTSTools.show", [ $college_tool -> id ]).'">'.$college_tool->name.'</a></td>'.'</tr>';
        			}
         		}
         		
         		if($jobs->isNotEmpty())
         		{
         		    DB::table('general_search')->insert(['search' => $request->search, 'entity_type' => 'j_s', 'entity_id' => $jobs[0] -> id, 'user_id' => $user_id, 'updated_at' => $now]);
         		    
        			foreach ($jobs as $key => $job)
        			{
        				$output.='<tr>'.'<td> <a href = "'.route("jobs.show", [ $job -> id ]).'">'.$job->name.'</a></td>'.'</tr>';
        			}
         		}
         		
         		if($job_topics->isNotEmpty())
         		{
         		    DB::table('general_search')->insert(['search' => $request->search, 'entity_type' => 'j_t_s', 'entity_id' => $job_topics[0] -> id, 'user_id' => $user_id, 'updated_at' => $now]);
    
        			foreach ($job_topics as $key => $job_topic)
        			{
        				$output.='<tr>'.'<td> <a href = "'.route("jobTopics.show", [ $job_topic -> id ]).'">'.$job_topic->name.'</a></td>'.'</tr>';
        			}
         		}
         		
         		if($job_sections->isNotEmpty())
         		{
         		    DB::table('general_search')->insert(['search' => $request->search, 'entity_type' => 'j_t_s_s', 'entity_id' => $job_sections[0] -> id, 'user_id' => $user_id, 'updated_at' => $now]);
         		    
        			foreach ($job_sections as $key => $job_section)
        			{
        				$output.='<tr>'.'<td> <a href = "'.route("jobTopicSections.show", [ $job_section -> id ]).'">'.$job_section->name.'</a></td>'.'</tr>';
        			}
         		}
         		
         		if($job_files->isNotEmpty())
         		{
         		    DB::table('general_search')->insert(['search' => $request->search, 'entity_type' => 'j_t_s_f_s', 'entity_id' => $job_files[0] -> id, 'user_id' => $user_id, 'updated_at' => $now]);
    
        			foreach ($job_files as $key => $job_file)
        			{
        				$output.='<tr>'.'<td> <a href = "'.route("jobTSFiles.show", [ $job_file -> id ]).'">'.$job_file->name.'</a></td>'.'</tr>';
        			}
         		}
         		
         		if($job_notes->isNotEmpty())
         		{
         		    DB::table('general_search')->insert(['search' => $request->search, 'entity_type' => 'j_t_s_n_s', 'entity_id' => $college_notes[0] -> id, 'user_id' => $user_id, 'updated_at' => $now]);
         		    
        			foreach ($job_notes as $key => $job_note)
        			{
        				$output.='<tr>'.'<td> <a href = "'.route("jobTSNotes.show", [ $job_note -> id ]).'">'.$job_note->name.'</a></td>'.'</tr>';
        			}
         		}
         		
         		if($job_galeries->isNotEmpty())
         		{
         		    DB::table('general_search')->insert(['search' => $request->search, 'entity_type' => 'j_t_s_g_s', 'entity_id' => $college_galeries[0] -> id, 'user_id' => $user_id, 'updated_at' => $now]);
    
        			foreach ($job_galeries as $key => $job_galerie)
        			{
        				$output.='<tr>'.'<td> <a href = "'.route("jobTSGaleries.show", [ $job_galerie -> id ]).'">'.$job_galerie->name.'</a></td>'.'</tr>';
        			}
         		}
         		
         		if($job_playlists->isNotEmpty())
         		{
         		    DB::table('general_search')->insert(['search' => $request->search, 'entity_type' => 'j_t_s_p_s', 'entity_id' => $college_playlists[0] -> id, 'user_id' => $user_id, 'updated_at' => $now]);
    
        			foreach ($job_playlists as $key => $job_playlist)
        			{
        				$output.='<tr>'.'<td> <a href = "'.route("jobTSPlaylists.show", [ $job_playlist -> id ]).'">'.$job_playlist->name.'</a></td>'.'</tr>';
        			}
         		}
         		
         		if($job_tools->isNotEmpty())
         		{
         		    DB::table('general_search')->insert(['search' => $request->search, 'entity_type' => 'j_t_s_t_s', 'entity_id' => $college_tools[0] -> id, 'user_id' => $user_id, 'updated_at' => $now]);
    
        			foreach ($job_tools as $key => $job_tool)
        			{
        				$output.='<tr>'.'<td> <a href = "'.route("jobTSTools.show", [ $job_tool -> id ]).'">'.$job_tool->name.'</a></td>'.'</tr>';
        			}
         		}
         		
         		if($projects->isNotEmpty())
         		{
         		    DB::table('general_search')->insert(['search' => $request->search, 'entity_type' => 'p_s', 'entity_id' => $projects[0] -> id, 'user_id' => $user_id, 'updated_at' => $now]);
    
        			foreach ($projects as $key => $project)
        			{
        				$output.='<tr>'.'<td> <a href = "'.route("projects.show", [ $project -> id ]).'">'.$project->name.'</a></td>'.'</tr>';
        			}
         		}
         		
         		if($project_topics->isNotEmpty())
         		{
         		    DB::table('general_search')->insert(['search' => $request->search, 'entity_type' => 'p_t_s', 'entity_id' => $project_topics[0] -> id, 'user_id' => $user_id, 'updated_at' => $now]);
    
        			foreach ($project_topics as $key => $project_topic)
        			{
        				$output.='<tr>'.'<td> <a href = "'.route("projectTopics.show", [ $project_topic -> id ]).'">'.$project_topic->name.'</a></td>'.'</tr>';
        			}
         		}
         		
         		if($project_sections->isNotEmpty())
         		{
         		    DB::table('general_search')->insert(['search' => $request->search, 'entity_type' => 'p_t_s_s', 'entity_id' => $project_sections[0] -> id, 'user_id' => $user_id, 'updated_at' => $now]);
    
        			foreach ($project_sections as $key => $project_section)
        			{
        				$output.='<tr>'.'<td> <a href = "'.route("projectTopicSections.show", [ $project_section -> id ]).'">'.$project_section->name.'</a></td>'.'</tr>';
        			}
         		}
         		
         		if($project_files->isNotEmpty())
         		{
         		    DB::table('general_search')->insert(['search' => $request->search, 'entity_type' => 'p_t_s_f_s', 'entity_id' => $project_files[0] -> id, 'user_id' => $user_id, 'updated_at' => $now]);
    
        			foreach ($project_files as $key => $project_file)
        			{
        				$output.='<tr>'.'<td> <a href = "'.route("projectTSFiles.show", [ $project_file -> id ]).'">'.$project_file->name.'</a></td>'.'</tr>';
        			}
         		}
         		
         		if($project_notes->isNotEmpty())
         		{
         		    DB::table('general_search')->insert(['search' => $request->search, 'entity_type' => 'p_t_s_n_s', 'entity_id' => $project_notes[0] -> id, 'user_id' => $user_id, 'updated_at' => $now]);
    
        			foreach ($project_notes as $key => $project_note)
        			{
        				$output.='<tr>'.'<td> <a href = "'.route("projectTSNotes.show", [ $project_note -> id ]).'">'.$project_note->name.'</a></td>'.'</tr>';
        			}
         		}
         		
         		if($project_galeries->isNotEmpty())
         		{
         		    DB::table('general_search')->insert(['search' => $request->search, 'entity_type' => 'p_t_s_g_s', 'entity_id' => $project_galeries[0] -> id, 'user_id' => $user_id, 'updated_at' => $now]);
    
        			foreach ($project_galeries as $key => $project_galerie)
        			{
        				$output.='<tr>'.'<td> <a href = "'.route("projectTSGaleries.show", [ $project_galerie -> id ]).'">'.$project_galerie->name.'</a></td>'.'</tr>';
        			}
         		}
         		
         		if($project_playlists->isNotEmpty())
         		{
         		    DB::table('general_search')->insert(['search' => $request->search, 'entity_type' => 'p_t_s_p_s', 'entity_id' => $project_playlists[0] -> id, 'user_id' => $user_id, 'updated_at' => $now]);
    
        			foreach ($project_playlists as $key => $project_playlist)
        			{
        				$output.='<tr>'.'<td> <a href = "'.route("projectTSPlaylists.show", [ $project_playlist -> id ]).'">'.$project_playlist->name.'</a></td>'.'</tr>';
        			}
         		}
         		
         		if($project_tools->isNotEmpty())
         		{
         		    DB::table('general_search')->insert(['search' => $request->search, 'entity_type' => 'p_t_s_t_s', 'entity_id' => $project_tools[0] -> id, 'user_id' => $user_id, 'updated_at' => $now]);
    
        			foreach ($project_tools as $key => $project_tool)
        			{
        				$output.='<tr>'.'<td> <a href = "'.route("projectTSTools.show", [ $project_tool -> id ]).'">'.$project_tool->name.'</a></td>'.'</tr>';
        			}
         		}
         		
         		if($personal_datas->isNotEmpty())
         		{
         		    DB::table('general_search')->insert(['search' => $request->search, 'entity_type' => 'p_d_s', 'entity_id' => $personal_datas[0] -> id, 'user_id' => $user_id, 'updated_at' => $now]);
         		    
        			foreach ($personal_datas as $key => $personal_data)
        			{
        				$output.='<tr>'.'<td> <a href = "'.route("personalDatas.show", [ $personal_data -> id ]).'">'.$personal_data->name.'</a></td>'.'</tr>';
        			}
         		}
         		
         		if($personal_data_topics->isNotEmpty())
         		{
         		    DB::table('general_search')->insert(['search' => $request->search, 'entity_type' => 'p_d_t_s', 'entity_id' => $personal_data_topics[0] -> id, 'user_id' => $user_id, 'updated_at' => $now]);
    
        			foreach ($personal_data_topics as $key => $personal_data_topic)
        			{
        				$output.='<tr>'.'<td> <a href = "'.route("personalDataTopics.show", [ $personal_data_topic -> id ]).'">'.$personal_data_topic->name.'</a></td>'.'</tr>';
        			}
         		}
         		
         		if($personal_data_sections->isNotEmpty())
         		{
         		    DB::table('general_search')->insert(['search' => $request->search, 'entity_type' => 'p_d_t_s_s', 'entity_id' => $personal_data_sections[0] -> id, 'user_id' => $user_id, 'updated_at' => $now]);
    
        			foreach ($personal_data_sections as $key => $personal_data_section)
        			{
        				$output.='<tr>'.'<td> <a href = "'.route("personalDataTopicSections.show", [ $personal_data_section -> id ]).'">'.$personal_data_section->name.'</a></td>'.'</tr>';
        			}
         		}
         		
         		if($personal_data_files->isNotEmpty())
         		{
         		    DB::table('general_search')->insert(['search' => $request->search, 'entity_type' => 'p_d_t_s_f_s', 'entity_id' => $personal_data_files[0] -> id, 'user_id' => $user_id, 'updated_at' => $now]);
    
        			foreach ($personal_data_files as $key => $personal_data_file)
        			{
        				$output.='<tr>'.'<td> <a href = "'.route("personalDataTSFiles.show", [ $personal_data_file -> id ]).'">'.$personal_data_file->name.'</a></td>'.'</tr>';
        			}
         		}
         		
         		if($personal_data_notes->isNotEmpty())
         		{
         		    DB::table('general_search')->insert(['search' => $request->search, 'entity_type' => 'p_d_t_s_n_s', 'entity_id' => $personal_data_notes[0] -> id, 'user_id' => $user_id, 'updated_at' => $now]);
    
        			foreach ($personal_data_notes as $key => $personal_data_note)
        			{
        				$output.='<tr>'.'<td> <a href = "'.route("personalDataTSNotes.show", [ $personal_data_note -> id ]).'">'.$personal_data_note->name.'</a></td>'.'</tr>';
        			}
         		}
         		
         		if($personal_data_galeries->isNotEmpty())
         		{
         		    DB::table('general_search')->insert(['search' => $request->search, 'entity_type' => 'p_d_t_s_g_s', 'entity_id' => $personal_data_galeries[0] -> id, 'user_id' => $user_id, 'updated_at' => $now]);
    
        			foreach ($personal_data_galeries as $key => $personal_data_galerie)
        			{
        				$output.='<tr>'.'<td> <a href = "'.route("personalDataTSGaleries.show", [ $personal_data_galerie -> id ]).'">'.$personal_data_galerie->name.'</a></td>'.'</tr>';
        			}
         		}
         		
         		if($personal_data_playlists->isNotEmpty())
         		{
         		    DB::table('general_search')->insert(['search' => $request->search, 'entity_type' => 'p_d_t_s_p_s', 'entity_id' => $personal_data_playlists[0] -> id, 'user_id' => $user_id, 'updated_at' => $now]);
    
        			foreach ($personal_data_playlists as $key => $personal_data_playlist)
        			{
        				$output.='<tr>'.'<td> <a href = "'.route("personalDataTSPlaylists.show", [ $personal_data_playlist -> id ]).'">'.$personal_data_playlist->name.'</a></td>'.'</tr>';
        			}
         		}
         		
         		if($personal_data_tools->isNotEmpty())
         		{
         		    DB::table('general_search')->insert(['search' => $request->search, 'entity_type' => 'p_d_t_s_t_s', 'entity_id' => $personal_data_tools[0] -> id, 'user_id' => $user_id, 'updated_at' => $now]);
    
        			foreach ($personal_data_tools as $key => $personal_data_tool)
        			{
        				$output.='<tr>'.'<td> <a href = "'.route("personalDataTSTools.show", [ $personal_data_tool -> id ]).'">'.$personal_data_tool->name.'</a></td>'.'</tr>';
        			}
         		}
         		
         		if($calendar_events->isNotEmpty())
         		{
         		    DB::table('general_search')->insert(['search' => $request->search, 'entity_type' => 'c_e_s', 'entity_id' => $calendar_events[0] -> id, 'user_id' => $user_id, 'updated_at' => $now]);
    
        			foreach ($calendar_events as $key => $calendar_event)
        			{
        				$output.='<tr>'.'<td> <a href = "'.route("calendarEvents.show", [ $calendar_event -> id ]).'">'.$calendar_event->name.'</a></td>'.'</tr>';
        			}
         		}
         		
         		if($messages->isNotEmpty())
         		{
         		    DB::table('general_search')->insert(['search' => $request->search, 'entity_type' => 'm_s', 'entity_id' => $messages[0] -> id, 'user_id' => $user_id, 'updated_at' => $now]);
    
        			foreach ($messages as $key => $message)
        			{
        				$output.='<tr>'.'<td> <a href = "'.route("messages.show", [ $message -> id ]).'">'.$message->subject.'</a></td>'.'</tr>';
        			}
         		}
         		
         		if($contacts->isNotEmpty())
         		{
         		    DB::table('general_search')->insert(['search' => $request->search, 'entity_type' => 'c_o_s', 'entity_id' => $contacts[0] -> id, 'user_id' => $user_id, 'updated_at' => $now]);
    
        			foreach ($contacts as $key => $contact)
        			{
        				$output.='<tr>'.'<td> <a href = "'.route("contacts.show", [ $contact -> id ]).'">'.$contact->name.'</a></td>'.'</tr>';
        			}
         		}
            
                return view('general_searches.search')
    			    ->with('output', $output);
            }
    
            return view('general_searches.index')
                ->with('generalSearches', $generalSearches);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function create()
    {
        if(Auth::user() != null)
        {
            return view('general_searches.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateGeneralSearchRequest $request)
    {
        if(Auth::user() != null)
        {
            $input = $request->all();
            $generalSearch = $this->generalSearchRepository->create($input);
    
            Flash::success('General Search saved successfully.');
            return redirect(route('generalSearches.index'));
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function show($id)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $generalSearch = $this->generalSearchRepository->findWithoutFail($id);
    
            if(empty($generalSearch))
            {
                Flash::error('General Search not found');
                return redirect(route('generalSearches.index'));
            }
    
            if($user_id == $generalSearch -> user_id)
            {
                return view('general_searches.show')
                    ->with('generalSearch', $generalSearch);
            }
            
            else
            {
                return view('deniedAccess');
            }
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function edit($id)
    {
        if(Auth::user() != null)
        {
            $user_email = Auth::user()->email;
            $generalSearch = $this->generalSearchRepository->findWithoutFail($id);
    
            if(empty($generalSearch))
            {
                Flash::error('General Search not found');
                return redirect(route('generalSearches.index'));
            }
    
            if($user_email == 'josemsoberonpenaloza@gmail.com')
            {
                return view('general_searches.edit')
                    ->with('generalSearch', $generalSearch);
            }
            
            else
            {
                return view('deniedAccess');
            }
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function update($id, UpdateGeneralSearchRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_email = Auth::user()->email;
            $generalSearch = $this->generalSearchRepository->findWithoutFail($id);
    
            if(empty($generalSearch))
            {
                Flash::error('General Search not found');
                return redirect(route('generalSearches.index'));
            }
    
            if($user_email == 'josemsoberonpenaloza@gmail.com')
            {
                $generalSearch = $this->generalSearchRepository->update($request->all(), $id);
            
                Flash::success('General Search updated successfully.');
                return redirect(route('generalSearches.index'));
            }
            
            else
            {
                return view('deniedAccess');
            }
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function destroy($id)
    {
        if(Auth::user() != null)
        {
            $user_email = Auth::user()->email;
            $generalSearch = $this->generalSearchRepository->findWithoutFail($id);
    
            if(empty($generalSearch))
            {
                Flash::error('General Search not found');
                return redirect(route('generalSearches.index'));
            }
    
            if($user_email == 'josemsoberonpenaloza@gmail.com')
            {
                $this->generalSearchRepository->delete($id);
    
                Flash::success('General Search deleted successfully.');
                return redirect(route('generalSearches.index'));
            }
            
            else
            {
                return view('deniedAccess');
            }
        }
        
        else
        {
            return view('deniedAccess');
        }
    }
}