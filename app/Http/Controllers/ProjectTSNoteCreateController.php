<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTSNoteCreateRequest;
use App\Http\Requests\UpdateProjectTSNoteCreateRequest;
use App\Repositories\ProjectTSNoteCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTSNoteCreateController extends AppBaseController
{
    private $projectTSNoteCreateRepository;

    public function __construct(ProjectTSNoteCreateRepository $projectTSNoteCreateRepo)
    {
        $this->projectTSNoteCreateRepository = $projectTSNoteCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTSNoteCreateRepository->pushCriteria(new RequestCriteria($request));
            $projectTSNoteCreates = $this->projectTSNoteCreateRepository->all();
    
            return view('project_t_s_note_creates.index')
                ->with('projectTSNoteCreates', $projectTSNoteCreates);
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
            return view('project_t_s_note_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTSNoteCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $projectTSNoteCreate = $this->projectTSNoteCreateRepository->create($input);
                
                Flash::success('Project T S Note Create saved successfully.');
                return redirect(route('projectTSNoteCreates.index'));
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

    public function show($id)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTSNoteCreate = $this->projectTSNoteCreateRepository->findWithoutFail($id);
    
            if(empty($projectTSNoteCreate))
            {
                Flash::error('Project T S Note Create not found');
                return redirect(route('projectTSNoteCreates.index'));
            }
            
            $userProjectTSNotes = DB::table('user_project_t_s_notes')->where('project_t_s_note_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userProjectTSNotes as $userProjectTSNote)
            {
                if($userProjectTSNote -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('project_t_s_notes')->join('project_topic_sections', 'project_t_s_notes.project_topic_section_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->join('users', 'users.id', '=', 'projects.user_id')->where('project_t_s_notes.id', '=', $id)->get();
            
            if($user_id == $projectTSNoteCreate -> user_id || $isShared)
            {
                return view('project_t_s_note_creates.show')->with('projectTSNoteCreate', $projectTSNoteCreate);
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
            $user_id = Auth::user()->id;
            $projectTSNoteCreate = $this->projectTSNoteCreateRepository->findWithoutFail($id);
    
            if(empty($projectTSNoteCreate))
            {
                Flash::error('Project T S Note Create not found');
                return redirect(route('projectTSNoteCreates.index'));
            }
            
            $userProjectTSNotes = DB::table('user_project_t_s_notes')->where('project_t_s_note_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userProjectTSNotes as $userProjectTSNote)
            {
                if($userProjectTSNote -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('project_t_s_notes')->join('project_topic_sections', 'project_t_s_notes.project_topic_section_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->join('users', 'users.id', '=', 'projects.user_id')->where('project_t_s_notes.id', '=', $id)->get();
            
            if($user_id == $projectTSNoteCreate -> user_id || $isShared)
            {
                return view('project_t_s_note_creates.edit')->with('projectTSNoteCreate', $projectTSNoteCreate);
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

    public function update($id, UpdateProjectTSNoteCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTSNoteCreate = $this->projectTSNoteCreateRepository->findWithoutFail($id);
    
            if(empty($projectTSNoteCreate))
            {
                Flash::error('Project T S Note Create not found');
                return redirect(route('projectTSNoteCreates.index'));
            }
    
            $userProjectTSNotes = DB::table('user_project_t_s_notes')->where('project_t_s_note_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userProjectTSNotes as $userProjectTSNote)
            {
                if($userProjectTSNote -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('project_t_s_notes')->join('project_topic_sections', 'project_t_s_notes.project_topic_section_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->join('users', 'users.id', '=', 'projects.user_id')->where('project_t_s_notes.id', '=', $id)->get();
            
            if($user_id == $projectTSNoteCreate -> user_id || $isShared)
            {
                $projectTSNoteCreate = $this->projectTSNoteCreateRepository->update($request->all(), $id);
                
                Flash::success('Project T S Note Create updated successfully.');
                return redirect(route('projectTSNoteCreates.index'));
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
            $user_id = Auth::user()->id;
            $projectTSNoteCreate = $this->projectTSNoteCreateRepository->findWithoutFail($id);
    
            if(empty($projectTSNoteCreate))
            {
                Flash::error('Project T S Note Create not found');
                return redirect(route('projectTSNoteCreates.index'));
            }
            
            $userProjectTSNotes = DB::table('user_project_t_s_notes')->where('project_t_s_note_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userProjectTSNotes as $userProjectTSNote)
            {
                if($userProjectTSNote -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('project_t_s_notes')->join('project_topic_sections', 'project_t_s_notes.project_topic_section_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->join('users', 'users.id', '=', 'projects.user_id')->where('project_t_s_notes.id', '=', $id)->get();
            
            if($user_id == $projectTSNoteCreate -> user_id || $isShared)
            {
                $this->projectTSNoteCreateRepository->delete($id);
                
                Flash::success('Project T S Note Create deleted successfully.');
                return redirect(route('projectTSNoteCreates.index'));
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