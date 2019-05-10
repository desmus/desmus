<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTSNoteDeleteRequest;
use App\Http\Requests\UpdateProjectTSNoteDeleteRequest;
use App\Repositories\ProjectTSNoteDeleteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTSNoteDeleteController extends AppBaseController
{
    private $projectTSNoteDeleteRepository;

    public function __construct(ProjectTSNoteDeleteRepository $projectTSNoteDeleteRepo)
    {
        $this->projectTSNoteDeleteRepository = $projectTSNoteDeleteRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTSNoteDeleteRepository->pushCriteria(new RequestCriteria($request));
            $projectTSNoteDeletes = $this->projectTSNoteDeleteRepository->all();
    
            return view('project_t_s_note_deletes.index')
                ->with('projectTSNoteDeletes', $projectTSNoteDeletes);
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
            return view('project_t_s_note_deletes.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTSNoteDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
    
            if($input -> user_id == $user_id)
            {
                $projectTSNoteDelete = $this->projectTSNoteDeleteRepository->create($input);
                
                Flash::success('Project T S Note Delete saved successfully.');
                return redirect(route('projectTSNoteDeletes.index'));
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
            $projectTSNoteDelete = $this->projectTSNoteDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTSNoteDelete))
            {
                Flash::error('Project T S Note Delete not found');
                return redirect(route('projectTSNoteDeletes.index'));
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
            
            if($user_id == $projectTSNoteDelete -> user_id || $isShared)
            {
                return view('project_t_s_note_deletes.show')->with('projectTSNoteDelete', $projectTSNoteDelete);
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
            $projectTSNoteDelete = $this->projectTSNoteDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTSNoteDelete))
            {
                Flash::error('Project T S Note Delete not found');
                return redirect(route('projectTSNoteDeletes.index'));
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
            
            if($user_id == $projectTSNoteDelete -> user_id || $isShared)
            {
                return view('project_t_s_note_deletes.edit')->with('projectTSNoteDelete', $projectTSNoteDelete);
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

    public function update($id, UpdateProjectTSNoteDeleteRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTSNoteDelete = $this->projectTSNoteDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTSNoteDelete))
            {
                Flash::error('Project T S Note Delete not found');
                return redirect(route('projectTSNoteDeletes.index'));
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
            
            if($user_id == $projectTSNoteDelete -> user_id || $isShared)
            {
                $projectTSNoteDelete = $this->projectTSNoteDeleteRepository->update($request->all(), $id);
                
                Flash::success('Project T S Note Delete updated successfully.');
                return redirect(route('projectTSNoteDeletes.index'));
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
            $projectTSNoteDelete = $this->projectTSNoteDeleteRepository->findWithoutFail($id);
    
            if(empty($projectTSNoteDelete))
            {
                Flash::error('Project T S Note Delete not found');
                return redirect(route('projectTSNoteDeletes.index'));
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
            
            if($user_id == $projectTSNoteDelete -> user_id || $isShared)
            {
                $this->projectTSNoteDeleteRepository->delete($id);
                
                Flash::success('Project T S Note Delete deleted successfully.');
                return redirect(route('projectTSNoteDeletes.index'));
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