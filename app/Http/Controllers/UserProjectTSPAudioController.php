<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateUserProjectTSPAudioRequest;
use App\Http\Requests\UpdateUserProjectTSPAudioRequest;
use App\Repositories\UserProjectTSPAudioRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class UserProjectTSPAudioController extends AppBaseController
{
    private $userProjectTSPAudioRepository;

    public function __construct(UserProjectTSPAudioRepository $userProjectTSPAudioRepo)
    {
        $this->userProjectTSPAudioRepository = $userProjectTSPAudioRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->userProjectTSPAudioRepository->pushCriteria(new RequestCriteria($request));
            $userProjectTSPAudios = $this->userProjectTSPAudioRepository->all();
    
            return view('user_project_t_s_p_audios.index')
                ->with('userProjectTSPAudios', $userProjectTSPAudios);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function create($id)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $users = DB::table('contacts')->join('users', 'users.id', '=', 'contacts.contact_id')->select('name', 'contacts.user_id', 'users.id')->where('contacts.user_id', '=', $user_id)->where(function ($query) {$query->where('contacts.deleted_at', '=', null);})->orderBy('name', 'asc')->get();
            $select = [];
                
            foreach($users as $user)
            {
                $select[$user->id] = $user->name;
            }
            
            $userProjectTSPAudiosList = DB::table('user_project_t_s_p_audios')->join('users', 'user_project_t_s_p_audios.user_id', '=', 'users.id')->select('name', 'email', 'user_project_t_s_p_audios.description', 'permissions', 'user_project_t_s_p_audios.datetime', 'user_project_t_s_p_audios.id', 'p_t_s_p_a_id')->where('p_t_s_p_a_id', $id)->where(function ($query) {$query->where('user_project_t_s_p_audios.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
            $projectTSPAudioViewsList = DB::table('users')->join('project_t_s_p_audio_views', 'users.id', '=', 'project_t_s_p_audio_views.user_id')->where('p_t_s_p_a_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            $projectTSPAudioUpdatesList = DB::table('users')->join('project_t_s_p_audio_updates', 'users.id', '=', 'project_t_s_p_audio_updates.user_id')->where('p_t_s_p_a_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            
            return view('user_project_t_s_p_audios.create', compact('select'))
                ->with('id', $id)
                ->with('now', $now)
                ->with('userProjectTSPAudiosList', $userProjectTSPAudiosList)
                ->with('projectTSPAudioViewsList', $projectTSPAudioViewsList)
                ->with('projectTSPAudioUpdatesList', $projectTSPAudioUpdatesList);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateUserProjectTSPAudioRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $user = DB::table('project_t_s_p_audios')->join('project_t_s_playlists', 'project_t_s_p_audios.p_t_s_p_id', '=', 'project_t_s_playlists.id')->join('project_topic_sections', 'project_t_s_playlists.p_t_s_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->where('project_t_s_p_audios.id', '=', $request -> p_t_s_p_a_id)->get();
            
            $userProjectTSPAudioCheck = DB::table('user_project_t_s_p_audios')->where('user_id', '=', $request -> user_id)->where('p_t_s_p_a_id', '=', $request -> p_t_s_p_a_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
    
            if($userProjectTSPAudioCheck->isEmpty())
            {
                if($user[0] -> user_id == $user_id)
                {
                    $userProjectTSPAudio = $this->userProjectTSPAudioRepository->create($input);
                    $user = DB::table('user_project_t_s_p_audios')->join('users', 'users.id', '=', 'user_project_t_s_p_audios.user_id')->where('user_project_t_s_p_audios.id', '=', $userProjectTSPAudio -> id)->select('name')->get();
                    
                    DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_p_t_s_p_a_c', 'user_id' => $user_id, 'entity_id' => $userProjectTSPAudio -> p_t_s_p_a_id, 'created_at' => $now]);
                    DB::table('u_p_t_s_p_audio_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_t_s_p_a_id' => $userProjectTSPAudio -> id]);
                
                    Flash::success('User Project T S P Audio saved successfully.');
                    return redirect(route('userProjectTSPAudios.show', [$userProjectTSPAudio -> p_t_s_p_a_id]));
                }
                
                else
                {
                    return view('deniedAccess');
                }
            }
    
            return redirect(route('userProjectTSPAudios.show', [$request -> p_t_s_p_a_id]));
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
            $userProjectTSPAudio = $this->userProjectTSPAudioRepository->findWithoutFail($id);
            $userProjectTSPAudios = DB::table('user_project_t_s_p_audios')->join('users', 'user_project_t_s_p_audios.user_id', '=', 'users.id')->select('name', 'email', 'user_project_t_s_p_audios.description', 'permissions', 'user_project_t_s_p_audios.datetime', 'user_project_t_s_p_audios.id', 'p_t_s_p_a_id')->where('p_t_s_p_a_id', $id)->where(function ($query) {$query->where('user_project_t_s_p_audios.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
    
            if(empty($userProjectTSPAudios[0]))
            {
                return redirect(route('userProjectTSPAudios.create', [$id]));
            }
            
            $user = DB::table('project_t_s_p_audios')->join('project_t_s_playlists', 'project_t_s_p_audios.p_t_s_p_id', '=', 'project_t_s_playlists.id')->join('project_topic_sections', 'project_t_s_playlists.p_t_s_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->where('project_t_s_p_audios.id', '=', $userProjectTSPAudios[0] -> p_t_s_p_a_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $projectTSPAudio = DB::table('project_t_s_p_audios')->where('id', '=', $userProjectTSPAudios[0] -> p_t_s_p_a_id)->get();
    
                $userProjectTSPAudiosList = DB::table('user_project_t_s_p_audios')->join('users', 'user_project_t_s_p_audios.user_id', '=', 'users.id')->select('name', 'email', 'user_project_t_s_p_audios.description', 'permissions', 'user_project_t_s_p_audios.datetime', 'user_project_t_s_p_audios.id', 'p_t_s_p_a_id')->where('p_t_s_p_a_id', $id)->where(function ($query) {$query->where('user_project_t_s_p_audios.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $projectTSPAudioViewsList = DB::table('users')->join('project_t_s_p_audio_views', 'users.id', '=', 'project_t_s_p_audio_views.user_id')->where('p_t_s_p_a_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $projectTSPAudioUpdatesList = DB::table('users')->join('project_t_s_p_audio_updates', 'users.id', '=', 'project_t_s_p_audio_updates.user_id')->where('p_t_s_p_a_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
    
                return view('user_project_t_s_p_audios.show')
                    ->with('userProjectTSPAudios', $userProjectTSPAudios)
                    ->with('id', $id)
                    ->with('projectTSPAudio', $projectTSPAudio)
                    ->with('userProjectTSPAudiosList', $userProjectTSPAudiosList)
                    ->with('projectTSPAudioViewsList', $projectTSPAudioViewsList)
                    ->with('projectTSPAudioUpdatesList', $projectTSPAudioUpdatesList);
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
            $userProjectTSPAudio = DB::table('users')->join('user_project_t_s_p_audios', 'user_project_t_s_p_audios.user_id', '=', 'users.id')->where('user_project_t_s_p_audios.id', $id)->where(function ($query) {$query->where('user_project_t_s_p_audios.deleted_at', '=', null);})->get();
    
            if(empty($userProjectTSPAudio))
            {
                Flash::error('User Project T S P Audio not found');
                return redirect(route('userProjectTSPAudios.index'));
            }
    
            $user = DB::table('project_t_s_p_audios')->join('project_t_s_playlists', 'project_t_s_p_audios.p_t_s_p_id', '=', 'project_t_s_playlists.id')->join('project_topic_sections', 'project_t_s_playlists.p_t_s_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->where('project_t_s_p_audios.id', '=', $userProjectTSPAudio[0] -> p_t_s_p_a_id)->get();
            
            $userProjectTSPAudiosList = DB::table('user_project_t_s_p_audios')->join('users', 'user_project_t_s_p_audios.user_id', '=', 'users.id')->select('name', 'email', 'user_project_t_s_p_audios.description', 'permissions', 'user_project_t_s_p_audios.datetime', 'user_project_t_s_p_audios.id', 'p_t_s_p_a_id')->where('p_t_s_p_a_id', $id)->where(function ($query) {$query->where('user_project_t_s_p_audios.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
            $projectTSPAudioViewsList = DB::table('users')->join('project_t_s_p_audio_views', 'users.id', '=', 'project_t_s_p_audio_views.user_id')->where('p_t_s_p_a_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            $projectTSPAudioUpdatesList = DB::table('users')->join('project_t_s_p_audio_updates', 'users.id', '=', 'project_t_s_p_audio_updates.user_id')->where('p_t_s_p_a_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                return view('user_project_t_s_p_audios.edit')
                    ->with('userProjectTSPAudio', $userProjectTSPAudio)
                    ->with('id', $userProjectTSPAudio[0] -> p_t_s_p_a_id)
                    ->with('userProjectTSPAudiosList', $userProjectTSPAudiosList)
                    ->with('projectTSPAudioViewsList', $projectTSPAudioViewsList)
                    ->with('projectTSPAudioUpdatesList', $projectTSPAudioUpdatesList);
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

    public function update($id, UpdateUserProjectTSPAudioRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $userProjectTSPAudio = $this->userProjectTSPAudioRepository->findWithoutFail($id);
    
            if(empty($userProjectTSPAudio))
            {
                Flash::error('User Project T S P Audio not found');
                return redirect(route('userProjectTSPAudios.index'));
            }
            
            $user = DB::table('project_t_s_p_audios')->join('project_t_s_playlists', 'project_t_s_p_audios.p_t_s_p_id', '=', 'project_t_s_playlists.id')->join('project_topic_sections', 'project_t_s_playlists.p_t_s_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->where('project_t_s_p_audios.id', '=', $userProjectTSPAudio -> p_t_s_p_a_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $userProjectTSPAudio = $this->userProjectTSPAudioRepository->update($request->all(), $id);
                $user = DB::table('user_project_t_s_p_audios')->join('users', 'users.id', '=', 'user_project_t_s_p_audios.user_id')->where('user_project_t_s_p_audios.id', '=', $userProjectTSPAudio -> id)->select('name')->get();
                
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_p_t_s_p_a_u', 'user_id' => $user_id, 'entity_id' => $userProjectTSPAudio -> p_t_s_p_a_id, 'created_at' => $now]);
                DB::table('u_p_t_s_p_audio_updates')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_t_s_p_a_id' => $userProjectTSPAudio -> id]);
            
                Flash::success('User Project T S P Audio updated successfully.');
                return redirect(route('userProjectTSPAudios.show', [$userProjectTSPAudio -> p_t_s_p_a_id]));
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
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $userProjectTSPAudio = $this->userProjectTSPAudioRepository->findWithoutFail($id);
    
            if(empty($userProjectTSPAudio))
            {
                Flash::error('User Project T S P Audio not found');
                return redirect(route('userProjectTSPAudios.index'));
            }
            
            $user = DB::table('project_t_s_p_audios')->join('project_t_s_playlists', 'project_t_s_p_audios.p_t_s_p_id', '=', 'project_t_s_playlists.id')->join('project_topic_sections', 'project_t_s_playlists.p_t_s_id', '=', 'project_topic_sections.id')->join('project_topics', 'project_topic_sections.project_topic_id', '=', 'project_topics.id')->join('projects', 'project_topics.project_id', '=', 'projects.id')->where('project_t_s_p_audios.id', '=', $userProjectTSPAudio -> p_t_s_p_a_id)->get();
            
            if($user[0] -> user_id == $user_id)
            {
                $this->userProjectTSPAudioRepository->delete($id);
                $user = DB::table('user_project_t_s_p_audios')->join('users', 'users.id', '=', 'user_project_t_s_p_audios.user_id')->where('user_project_t_s_p_audios.id', '=', $userProjectTSPAudio -> id)->select('name')->get();
                
                DB::table('recent_activities')->insert(['name' => $user[0] -> name, 'status' => 'active', 'type' => 'u_p_t_s_p_a_d', 'user_id' => $user_id, 'entity_id' => $userProjectTSPAudio -> p_t_s_p_a_id, 'created_at' => $now]);
                DB::table('u_p_t_s_p_audio_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_t_s_p_a_id' => $userProjectTSPAudio -> id]);
            
                Flash::success('User Project T S P Audio deleted successfully.');
                return redirect(route('userProjectTSPAudios.show', [$userProjectTSPAudio -> p_t_s_p_a_id]));
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