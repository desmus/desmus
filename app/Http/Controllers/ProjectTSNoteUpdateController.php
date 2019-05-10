<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProjectTSNoteUpdateRequest;
use App\Http\Requests\UpdateProjectTSNoteUpdateRequest;
use App\Repositories\ProjectTSNoteUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class ProjectTSNoteUpdateController extends AppBaseController
{
    private $projectTSNoteUpdateRepository;

    public function __construct(ProjectTSNoteUpdateRepository $projectTSNoteUpdateRepo)
    {
        $this->projectTSNoteUpdateRepository = $projectTSNoteUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->projectTSNoteUpdateRepository->pushCriteria(new RequestCriteria($request));
            $projectTSNoteUpdates = $this->projectTSNoteUpdateRepository->all();
    
            return view('project_t_s_note_updates.index')
                ->with('projectTSNoteUpdates', $projectTSNoteUpdates);
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
            return view('project_t_s_note_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateProjectTSNoteUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
    
            if($input -> user_id == $user_id)
            {
                $projectTSNoteUpdate = $this->projectTSNoteUpdateRepository->create($input);
                
                Flash::success('Project T S Note Update saved successfully.');
                return redirect(route('projectTSNoteUpdates.index'));
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
            $projectTSNoteUpdate = $this->projectTSNoteUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTSNoteUpdate))
            {
                Flash::error('Project T S Note Update not found');
                return redirect(route('projectTSNoteUpdates.index'));
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
            
            if($user_id == $projectTSNoteUpdate -> user_id || $isShared)
            {
                return view('project_t_s_note_updates.show')->with('projectTSNoteUpdate', $projectTSNoteUpdate);
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
            $projectTSNoteUpdate = $this->projectTSNoteUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTSNoteUpdate))
            {
                Flash::error('Project T S Note Update not found');
                return redirect(route('projectTSNoteUpdates.index'));
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
            
            if($user_id == $projectTSNoteUpdate -> user_id || $isShared)
            {
                return view('project_t_s_note_updates.edit')->with('projectTSNoteUpdate', $projectTSNoteUpdate);
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

    public function update($id, UpdateProjectTSNoteUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $projectTSNoteUpdate = $this->projectTSNoteUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTSNoteUpdate))
            {
                Flash::error('Project T S Note Update not found');
                return redirect(route('projectTSNoteUpdates.index'));
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
            
            if($user_id == $projectTSNoteUpdate -> user_id || $isShared)
            {
                $projectTSNoteUpdate = $this->projectTSNoteUpdateRepository->update($request->all(), $id);
                
                Flash::success('Project T S Note Update updated successfully.');
                return redirect(route('projectTSNoteUpdates.index'));
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
            $projectTSNoteUpdate = $this->projectTSNoteUpdateRepository->findWithoutFail($id);
    
            if(empty($projectTSNoteUpdate))
            {
                Flash::error('Project T S Note Update not found');
                return redirect(route('projectTSNoteUpdates.index'));
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
            
            if($user_id == $projectTSNoteUpdate -> user_id || $isShared)
            {
                $this->projectTSNoteUpdateRepository->delete($id);
                
                Flash::success('Project T S Note Update deleted successfully.');
                return redirect(route('projectTSNoteUpdates.index'));
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