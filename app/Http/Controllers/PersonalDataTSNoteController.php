<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePersonalDataTSNoteRequest;
use App\Http\Requests\UpdatePersonalDataTSNoteRequest;
use App\Repositories\PersonalDataTSNoteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use App\Models\PersonalDataTSNote;
use Illuminate\Support\Carbon;
use GoogleCloudVision\GoogleCloudVision;
use GoogleCloudVision\Request\AnnotateImageRequest;

class PersonalDataTSNoteController extends AppBaseController
{
    private $personalDataTSNoteRepository;

    public function __construct(PersonalDataTSNoteRepository $personalDataTSNoteRepo)
    {
        $this->personalDataTSNoteRepository = $personalDataTSNoteRepo;
    }
    
    public function annotateImage($id, Request $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $personalDataTSNote = $this->personalDataTSNoteRepository->findWithoutFail($id);
            
            if(empty($personalDataTSNote))
            {
                Flash::error('PersonalData T S Note not found');
                return redirect(route('personalDataTSNotes.index'));
            }
            
            $userPersonalDataTSNotes = DB::table('user_personal_data_t_s_notes')->where('personal_data_t_s_note_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userPersonalDataTSNotes as $userPersonalDataTSNote)
            {
                if($userPersonalDataTSNote -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('personal_data_t_s_notes')->join('personal_data_topic_sections', 'personal_data_t_s_notes.personal_data_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('colleges', 'personal_data_topics.personal_data_id', '=', 'colleges.id')->join('users', 'users.id', '=', 'colleges.user_id')->where('personal_data_t_s_notes.id', '=', $id)->get();
            
            if($user_id == $user[0] -> id || $isShared)
            {
                DB::table('personal_data_t_s_note_views')->insert(['datetime' => $now, 'user_id' => $user_id, 'personal_data_t_s_note_id' => $id]);
                DB::table('personal_data_t_s_notes')->where('id', $id)->update(['views_quantity' => DB::raw('views_quantity + 1')]);
               
                $personalDataTSNote = $this->personalDataTSNoteRepository->findWithoutFail($id);
                $personalDataopicSectionNoteViews = DB::table('users')->join('personal_data_t_s_note_views', 'users.id', '=', 'personal_data_t_s_note_views.user_id')->where('personal_data_t_s_note_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
                $personalDataopicSectionNoteUpdates = DB::table('users')->join('personal_data_t_s_note_updates', 'users.id', '=', 'personal_data_t_s_note_updates.user_id')->where('personal_data_t_s_note_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
                $personalDataTSNoteTodolist = DB::table('colleges')->join('personal_data_topics', 'colleges.id', '=', 'personal_data_topics.personal_data_id')->join('personal_data_topic_sections', 'personal_data_topics.id', '=', 'personal_data_topic_sections.personal_data_topic_id')->join('personal_data_t_s_notes', 'personal_data_topic_sections.id', '=', 'personal_data_t_s_notes.personal_data_t_s_id')->join('personal_data_t_s_n_todolists', 'personal_data_t_s_notes.id', '=', 'personal_data_t_s_n_todolists.p_d_t_s_n_id')->where('personal_data_t_s_n_todolists.p_d_t_s_n_id', '=', $personalDataTSNote -> id)->where(function ($query) {$query->where('personal_data_t_s_n_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('personal_data_t_s_n_todolists.status', '=', 'active');})->orderBy('personal_data_t_s_n_todolists.datetime', 'desc')->limit(50)->get();
                $personalDataTSNoteTodolistCompleted = DB::table('colleges')->join('personal_data_topics', 'colleges.id', '=', 'personal_data_topics.personal_data_id')->join('personal_data_topic_sections', 'personal_data_topics.id', '=', 'personal_data_topic_sections.personal_data_topic_id')->join('personal_data_t_s_notes', 'personal_data_topic_sections.id', '=', 'personal_data_t_s_notes.personal_data_t_s_id')->join('personal_data_t_s_n_todolists', 'personal_data_t_s_notes.id', '=', 'personal_data_t_s_n_todolists.p_d_t_s_n_id')->where('personal_data_t_s_n_todolists.p_d_t_s_n_id', '=', $personalDataTSNote -> id)->where(function ($query) {$query->where('personal_data_t_s_n_todolists.status', '=', 'finalized');})->where(function ($query) {$query->where('personal_data_t_s_n_todolists.deleted_at', '=', null);})->orderBy('personal_data_t_s_n_todolists.datetime', 'desc')->limit(50)->get();
            
                $text = $personalDataTSNote -> content;
            
                if($request->file('image'))
                {
                    $image = base64_encode(file_get_contents($request->file('image')));
                    $request = new AnnotateImageRequest();
                    $request->setImage($image);
                    $request->setFeature("TEXT_DETECTION");
                    $gcvRequest = new GoogleCloudVision([$request], 'AIzaSyCiYAx75dCXDnjUNPIOzlqTp0H7Up9AQh8');
                    $response = $gcvRequest->annotate();
            
                    $text = $text . $response->responses[0]->fullTextAnnotation->text;
                }
                
                $personalDataTSNoteTodolistsList = DB::table('colleges')->join('personal_data_topics', 'colleges.id', '=', 'personal_data_topics.personal_data_id')->join('personal_data_topic_sections', 'personal_data_topics.id', '=', 'personal_data_topic_sections.personal_data_topic_id')->join('personal_data_t_s_notes', 'personal_data_topic_sections.id', '=', 'personal_data_t_s_notes.personal_data_t_s_id')->join('personal_data_t_s_n_todolists', 'personal_data_t_s_notes.id', '=', 'personal_data_t_s_n_todolists.p_d_t_s_n_id')->where('personal_data_t_s_n_todolists.p_d_t_s_n_id', '=', $personalDataTSNote -> id)->where(function ($query) {$query->where('personal_data_t_s_n_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('personal_data_t_s_n_todolists.status', '=', 'active');})->orderBy('personal_data_t_s_n_todolists.datetime', 'desc')->limit(5)->get();
                $personalDataTSNoteTodolistsCompletedList = DB::table('colleges')->join('personal_data_topics', 'colleges.id', '=', 'personal_data_topics.personal_data_id')->join('personal_data_topic_sections', 'personal_data_topics.id', '=', 'personal_data_topic_sections.personal_data_topic_id')->join('personal_data_t_s_notes', 'personal_data_topic_sections.id', '=', 'personal_data_t_s_notes.personal_data_t_s_id')->join('personal_data_t_s_n_todolists', 'personal_data_t_s_notes.id', '=', 'personal_data_t_s_n_todolists.p_d_t_s_n_id')->where('personal_data_t_s_n_todolists.p_d_t_s_n_id', '=', $personalDataTSNote -> id)->where(function ($query) {$query->where('personal_data_t_s_n_todolists.status', '=', 'finalized');})->where(function ($query) {$query->where('personal_data_t_s_n_todolists.deleted_at', '=', null);})->orderBy('personal_data_t_s_n_todolists.datetime', 'desc')->limit(5)->get();
                $userPersonalDataTSNotesList = DB::table('user_personal_data_t_s_notes')->join('users', 'user_personal_data_t_s_notes.user_id', '=', 'users.id')->select('name', 'email', 'user_personal_data_t_s_notes.description', 'permissions', 'user_personal_data_t_s_notes.datetime', 'user_personal_data_t_s_notes.id', 'personal_data_t_s_note_id')->where('personal_data_t_s_note_id', $id)->where(function ($query) {$query->where('user_personal_data_t_s_notes.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $personalDataopicSectionNoteViewsList = DB::table('users')->join('personal_data_t_s_note_views', 'users.id', '=', 'personal_data_t_s_note_views.user_id')->where('personal_data_t_s_note_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $personalDataopicSectionNoteUpdatesList = DB::table('users')->join('personal_data_t_s_note_updates', 'users.id', '=', 'personal_data_t_s_note_updates.user_id')->where('personal_data_t_s_note_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
            
                return view('personal_data_t_s_notes.show')
                    ->with('personalDataTSNote', $personalDataTSNote)
                    ->with('personalDataTSNoteViews', $personalDataopicSectionNoteViews)
                    ->with('personalDataTSNoteUpdates', $personalDataopicSectionNoteUpdates)
                    ->with('personalDataTSNoteTodolist', $personalDataTSNoteTodolist)
                    ->with('personalDataTSNoteTodolistCompleted', $personalDataTSNoteTodolistCompleted)
                    ->with('user', $user)
                    ->with('now', $now)
                    ->with('id', $id)
                    ->with('text', $text)
                    ->with('personalDataTSNoteTodolistsList', $personalDataTSNoteTodolistsList)
                    ->with('personalDataTSNoteTodolistsCompletedList', $personalDataTSNoteTodolistsCompletedList)
                    ->with('userPersonalDataTSNotesList', $userPersonalDataTSNotesList)
                    ->with('personalDataTSNoteViewsList', $personalDataopicSectionNoteViewsList)
                    ->with('personalDataTSNoteUpdatesList', $personalDataopicSectionNoteUpdatesList);
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

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->personalDataTSNoteRepository->pushCriteria(new RequestCriteria($request));
            $personalDataTSNotes = $this->personalDataTSNoteRepository->all();
    
            return view('personal_data_t_s_notes.index')
                ->with('personalDataTSNotes', $personalDataTSNotes);
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
            $personalDataTSNotesList = PersonalDataTSNote::where('personal_data_t_s_id', $id)->where(function ($query) {$query->where('deleted_at', '=', null);})->orderBy('id', 'desc')->limit(5)->get();

            return view('personal_data_t_s_notes.create')
                ->with('id', $id)
                ->with('personalDataTSNotesList', $personalDataTSNotesList);
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreatePersonalDataTSNoteRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $input = $request->all();
            $personalDataTSNote = $this->personalDataTSNoteRepository->create($input);
            
            DB::table('personal_data_t_s_note_creates')->insert(['datetime' => $now, 'user_id' => $user_id, 'personal_data_t_s_note_id' => $personalDataTSNote -> id]);
            DB::table('recent_activities')->insert(['name' => $personalDataTSNote -> name, 'status' => 'active', 'type' => 'p_d_t_s_n_c', 'user_id' => $user_id, 'entity_id' => $personalDataTSNote -> id, 'created_at' => $now]);
    
            Flash::success('PersonalData T S Note saved successfully.');
            return redirect(route('personalDataTopicSections.show', [$personalDataTSNote -> personal_data_t_s_id]));
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
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $personalDataTSNote = $this->personalDataTSNoteRepository->findWithoutFail($id);
            
            if(empty($personalDataTSNote))
            {
                Flash::error('PersonalData T S Note not found');
                return redirect(route('personalDataTSNotes.index'));
            }
            
            $userPersonalDataTSNotes = DB::table('user_personal_data_t_s_notes')->where('personal_data_t_s_note_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userPersonalDataTSNotes as $userPersonalDataTSNote)
            {
                if($userPersonalDataTSNote -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('personal_data_t_s_notes')->join('personal_data_topic_sections', 'personal_data_t_s_notes.personal_data_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->join('users', 'users.id', '=', 'personal_datas.user_id')->where('personal_data_t_s_notes.id', '=', $id)->get();
            
            if($user_id == $user[0] -> id || $isShared)
            {
                DB::table('personal_data_t_s_note_views')->insert(['datetime' => $now, 'user_id' => $user_id, 'personal_data_t_s_note_id' => $id]);
                DB::table('personal_data_t_s_notes')->where('id', $id)->update(['views_quantity' => DB::raw('views_quantity + 1')]);
        
                $personalDataTSNote = $this->personalDataTSNoteRepository->findWithoutFail($id);
                $personalDataTopicSectionNoteViews = DB::table('users')->join('personal_data_t_s_note_views', 'users.id', '=', 'personal_data_t_s_note_views.user_id')->where('personal_data_t_s_note_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
                $personalDataTopicSectionNoteUpdates = DB::table('users')->join('personal_data_t_s_note_updates', 'users.id', '=', 'personal_data_t_s_note_updates.user_id')->where('personal_data_t_s_note_id', $id)->orderBy('datetime', 'desc')->limit(50)->get();
                $personalDataTSNoteTodolist = DB::table('personal_datas')->join('personal_data_topics', 'personal_datas.id', '=', 'personal_data_topics.personal_data_id')->join('personal_data_topic_sections', 'personal_data_topics.id', '=', 'personal_data_topic_sections.personal_data_topic_id')->join('personal_data_t_s_notes', 'personal_data_topic_sections.id', '=', 'personal_data_t_s_notes.personal_data_t_s_id')->join('personal_data_t_s_n_todolists', 'personal_data_t_s_notes.id', '=', 'personal_data_t_s_n_todolists.p_d_t_s_n_id')->where('personal_data_t_s_n_todolists.p_d_t_s_n_id', '=', $personalDataTSNote -> id)->where(function ($query) {$query->where('personal_data_t_s_n_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('personal_data_t_s_n_todolists.status', '=', 'active');})->orderBy('personal_data_t_s_n_todolists.datetime', 'desc')->limit(50)->get();
                $personalDataTSNoteTodolistCompleted = DB::table('personal_datas')->join('personal_data_topics', 'personal_datas.id', '=', 'personal_data_topics.personal_data_id')->join('personal_data_topic_sections', 'personal_data_topics.id', '=', 'personal_data_topic_sections.personal_data_topic_id')->join('personal_data_t_s_notes', 'personal_data_topic_sections.id', '=', 'personal_data_t_s_notes.personal_data_t_s_id')->join('personal_data_t_s_n_todolists', 'personal_data_t_s_notes.id', '=', 'personal_data_t_s_n_todolists.p_d_t_s_n_id')->where('personal_data_t_s_n_todolists.p_d_t_s_n_id', '=', $personalDataTSNote -> id)->where(function ($query) {$query->where('personal_data_t_s_n_todolists.status', '=', 'finalized');})->where(function ($query) {$query->where('personal_data_t_s_n_todolists.deleted_at', '=', null);})->orderBy('personal_data_t_s_n_todolists.datetime', 'desc')->limit(50)->get();

                $personalDataTSNoteViewsList = DB::table('users')->join('personal_data_t_s_note_views', 'users.id', '=', 'personal_data_t_s_note_views.user_id')->where('personal_data_t_s_note_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $personalDataTSNoteUpdatesList = DB::table('users')->join('personal_data_t_s_note_updates', 'users.id', '=', 'personal_data_t_s_note_updates.user_id')->where('personal_data_t_s_note_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $userPersonalDataTSNotesList = DB::table('user_personal_data_t_s_notes')->join('users', 'user_personal_data_t_s_notes.user_id', '=', 'users.id')->select('name', 'email', 'user_personal_data_t_s_notes.description', 'permissions', 'user_personal_data_t_s_notes.datetime', 'user_personal_data_t_s_notes.id', 'personal_data_t_s_note_id')->where('personal_data_t_s_note_id', $id)->where(function ($query) {$query->where('user_personal_data_t_s_notes.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $personalDataTSNoteTodolistsList = DB::table('personal_datas')->join('personal_data_topics', 'personal_datas.id', '=', 'personal_data_topics.personal_data_id')->join('personal_data_topic_sections', 'personal_data_topics.id', '=', 'personal_data_topic_sections.personal_data_topic_id')->join('personal_data_t_s_notes', 'personal_data_topic_sections.id', '=', 'personal_data_t_s_notes.personal_data_t_s_id')->join('personal_data_t_s_n_todolists', 'personal_data_t_s_notes.id', '=', 'personal_data_t_s_n_todolists.p_d_t_s_n_id')->where('personal_data_t_s_n_todolists.p_d_t_s_n_id', '=', $personalDataTSNote -> id)->where(function ($query) {$query->where('personal_data_t_s_n_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('personal_data_t_s_n_todolists.status', '=', 'active');})->orderBy('personal_data_t_s_n_todolists.datetime', 'desc')->limit(5)->get();
                $personalDataTSNoteTodolistsCompletedList = DB::table('personal_datas')->join('personal_data_topics', 'personal_datas.id', '=', 'personal_data_topics.personal_data_id')->join('personal_data_topic_sections', 'personal_data_topics.id', '=', 'personal_data_topic_sections.personal_data_topic_id')->join('personal_data_t_s_notes', 'personal_data_topic_sections.id', '=', 'personal_data_t_s_notes.personal_data_t_s_id')->join('personal_data_t_s_n_todolists', 'personal_data_t_s_notes.id', '=', 'personal_data_t_s_n_todolists.p_d_t_s_n_id')->where('personal_data_t_s_n_todolists.p_d_t_s_n_id', '=', $personalDataTSNote -> id)->where(function ($query) {$query->where('personal_data_t_s_n_todolists.status', '=', 'finalized');})->where(function ($query) {$query->where('personal_data_t_s_n_todolists.deleted_at', '=', null);})->orderBy('personal_data_t_s_n_todolists.datetime', 'desc')->limit(5)->get();
            
                $text = '';
            
                return view('personal_data_t_s_notes.show')
                    ->with('personalDataTSNote', $personalDataTSNote)
                    ->with('personalDataTSNoteViews', $personalDataTopicSectionNoteViews)
                    ->with('personalDataTSNoteUpdates', $personalDataTopicSectionNoteUpdates)
                    ->with('personalDataTSNoteTodolist', $personalDataTSNoteTodolist)
                    ->with('personalDataTSNoteTodolistCompleted', $personalDataTSNoteTodolistCompleted)
                    ->with('user', $user)
                    ->with('now', $now)
                    ->with('id', $id)
                    ->with('text', $text)
                    ->with('personalDataTSNoteViewsList', $personalDataTSNoteViewsList)
                    ->with('personalDataTSNoteUpdatesList', $personalDataTSNoteUpdatesList)
                    ->with('userPersonalDataTSNotesList', $userPersonalDataTSNotesList)
                    ->with('personalDataTSNoteTodolistsList', $personalDataTSNoteTodolistsList)
                    ->with('personalDataTSNoteTodolistsCompletedList', $personalDataTSNoteTodolistsCompletedList);
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
            $personalDataTSNote = $this->personalDataTSNoteRepository->findWithoutFail($id);
    
            if(empty($personalDataTSNote))
            {
                Flash::error('PersonalData T S Note not found');
                return redirect(route('personalDataTSNotes.index'));
            }
            
            $userPersonalDataTSNotes = DB::table('user_personal_data_t_s_notes')->where('personal_data_t_s_note_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userPersonalDataTSNotes as $userPersonalDataTSNote)
            {
                if($userPersonalDataTSNote -> user_id == $user_id && $userPersonalDataTSNote -> permissions == 'advanced')
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('personal_data_t_s_notes')->join('personal_data_topic_sections', 'personal_data_t_s_notes.personal_data_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->join('users', 'users.id', '=', 'personal_datas.user_id')->where('personal_data_t_s_notes.id', '=', $id)->get();
            
            if($user_id == $user[0] -> id || $isShared)
            {
                $personalDataTSNoteViewsList = DB::table('users')->join('personal_data_t_s_note_views', 'users.id', '=', 'personal_data_t_s_note_views.user_id')->where('personal_data_t_s_note_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $personalDataTSNoteUpdatesList = DB::table('users')->join('personal_data_t_s_note_updates', 'users.id', '=', 'personal_data_t_s_note_updates.user_id')->where('personal_data_t_s_note_id', $id)->orderBy('datetime', 'desc')->limit(10)->get();
                $userPersonalDataTSNotesList = DB::table('user_personal_data_t_s_notes')->join('users', 'user_personal_data_t_s_notes.user_id', '=', 'users.id')->select('name', 'email', 'user_personal_data_t_s_notes.description', 'permissions', 'user_personal_data_t_s_notes.datetime', 'user_personal_data_t_s_notes.id', 'personal_data_t_s_note_id')->where('personal_data_t_s_note_id', $id)->where(function ($query) {$query->where('user_personal_data_t_s_notes.deleted_at', '=', null);})->orderBy('datetime', 'desc')->get();
                $personalDataTSNoteTodolistsList = DB::table('personal_datas')->join('personal_data_topics', 'personal_datas.id', '=', 'personal_data_topics.personal_data_id')->join('personal_data_topic_sections', 'personal_data_topics.id', '=', 'personal_data_topic_sections.personal_data_topic_id')->join('personal_data_t_s_notes', 'personal_data_topic_sections.id', '=', 'personal_data_t_s_notes.personal_data_t_s_id')->join('personal_data_t_s_n_todolists', 'personal_data_t_s_notes.id', '=', 'personal_data_t_s_n_todolists.p_d_t_s_n_id')->where('personal_data_t_s_n_todolists.p_d_t_s_n_id', '=', $personalDataTSNote -> id)->where(function ($query) {$query->where('personal_data_t_s_n_todolists.deleted_at', '=', null);})->where(function ($query) {$query->where('personal_data_t_s_n_todolists.status', '=', 'active');})->orderBy('personal_data_t_s_n_todolists.datetime', 'desc')->limit(5)->get();
                $personalDataTSNoteTodolistsCompletedList = DB::table('personal_datas')->join('personal_data_topics', 'personal_datas.id', '=', 'personal_data_topics.personal_data_id')->join('personal_data_topic_sections', 'personal_data_topics.id', '=', 'personal_data_topic_sections.personal_data_topic_id')->join('personal_data_t_s_notes', 'personal_data_topic_sections.id', '=', 'personal_data_t_s_notes.personal_data_t_s_id')->join('personal_data_t_s_n_todolists', 'personal_data_t_s_notes.id', '=', 'personal_data_t_s_n_todolists.p_d_t_s_n_id')->where('personal_data_t_s_n_todolists.p_d_t_s_n_id', '=', $personalDataTSNote -> id)->where(function ($query) {$query->where('personal_data_t_s_n_todolists.status', '=', 'finalized');})->where(function ($query) {$query->where('personal_data_t_s_n_todolists.deleted_at', '=', null);})->orderBy('personal_data_t_s_n_todolists.datetime', 'desc')->limit(5)->get();

                return view('personal_data_t_s_notes.edit')
                    ->with('personalDataTSNote', $personalDataTSNote)
                    ->with('personalDataTSNoteViewsList', $personalDataTSNoteViewsList)
                    ->with('personalDataTSNoteUpdatesList', $personalDataTSNoteUpdatesList)
                    ->with('userPersonalDataTSNotesList', $userPersonalDataTSNotesList)
                    ->with('personalDataTSNoteTodolistsList', $personalDataTSNoteTodolistsList)
                    ->with('personalDataTSNoteTodolistsCompletedList', $personalDataTSNoteTodolistsCompletedList);
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

    public function update($id, UpdatePersonalDataTSNoteRequest $request)
    {
        if(Auth::user() != null)
        {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $personalDataTSNote = $this->personalDataTSNoteRepository->findWithoutFail($id);
    
            if(empty($personalDataTSNote))
            {
                Flash::error('PersonalData T S Note not found');
                return redirect(route('personalDataTSNotes.index'));
            }
            
            $userPersonalDataTSNotes = DB::table('user_personal_data_t_s_notes')->where('personal_data_t_s_note_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userPersonalDataTSNotes as $userPersonalDataTSNote)
            {
                if($userPersonalDataTSNote -> user_id == $user_id && $userPersonalDataTSNote -> permissions == 'advanced')
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('personal_data_t_s_notes')->join('personal_data_topic_sections', 'personal_data_t_s_notes.personal_data_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->join('users', 'users.id', '=', 'personal_datas.user_id')->where('personal_data_t_s_notes.id', '=', $id)->get();
            
            $size = 0;
            $personal_data_data_sizes = DB::table('colleges')->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            
            foreach($personal_data_data_sizes as $personal_data_data_size)
            {
                $size += $personal_data_data_size -> specific_info_size;
                $personal_data_topic_data_sizes = DB::table('personal_data_topics')->where('personal_data_id', '=', $personal_data_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
        
                foreach($personal_data_topic_data_sizes as $personal_data_topic_data_size)
                {
                    $size += $personal_data_topic_data_size -> specific_info_size;
                    $personal_data_section_data_sizes = DB::table('personal_data_topic_sections')->where('personal_data_topic_id', '=', $personal_data_topic_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                        
                    foreach($personal_data_section_data_sizes as $personal_data_section_data_size)
                    {
                        $size += $personal_data_section_data_size -> specific_info_size;
                        $personal_data_file_data_sizes = DB::table('personal_data_t_s_files')->where('personal_data_t_s_id', '=', $personal_data_section_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                
                        foreach($personal_data_file_data_sizes as $personal_data_file_data_size)
                        {
                            $size += $personal_data_file_data_size -> file_size;
                        }
                
                        $personal_data_note_data_sizes = DB::table('personal_data_t_s_notes')->where('personal_data_t_s_id', '=', $personal_data_section_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                        foreach($personal_data_note_data_sizes as $personal_data_note_data_size)
                        {
                            $size += $personal_data_note_data_size -> specific_info_size;
                        }
                                
                        $personal_data_galery_data_sizes = DB::table('personal_data_t_s_galeries')->where('personal_data_t_s_id', '=', $personal_data_section_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                        foreach($personal_data_galery_data_sizes as $personal_data_galery_data_size)
                        {
                            //$size += $personal_data_galery_data_size -> specific_info_size;
                            $personal_data_image_data_sizes = DB::table('personal_data_t_s_galery_images')->where('personal_data_t_s_g_id', '=', $personal_data_galery_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                    
                            foreach($personal_data_image_data_sizes as $personal_data_image_data_size)
                            {
                                $size += $personal_data_image_data_size -> file_size;
                            }
                        }
                                
                        $personal_data_playlist_data_sizes = DB::table('personal_data_t_s_playlists')->where('p_d_t_s_id', '=', $personal_data_section_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                        foreach($personal_data_playlist_data_sizes as $personal_data_playlist_data_size)
                        {
                            //$size += $personal_data_playlist_data_size -> specific_info_size;
                            $personal_data_audio_data_sizes = DB::table('personal_data_t_s_p_audios')->where('p_d_t_s_p_id', '=', $personal_data_playlist_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                    
                            foreach($personal_data_audio_data_sizes as $personal_data_audio_data_size)
                            {
                                $size += $personal_data_audio_data_size -> file_size;
                            }
                        }
                                
                        $personal_data_tool_data_sizes = DB::table('personal_data_t_s_tools')->where('personal_data_topic_section_id', '=', $personal_data_section_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                        foreach($personal_data_tool_data_sizes as $personal_data_tool_data_size)
                        {
                            //$size += $personal_data_tool_data_size -> specific_info_size;
                            $personal_data_tool_file_data_sizes = DB::table('personal_data_t_s_tool_files')->where('personal_data_t_s_t_id', '=', $personal_data_tool_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                    
                            foreach($personal_data_tool_file_data_sizes as $personal_data_tool_file_data_size)
                            {
                                $size += $personal_data_tool_file_data_size -> file_size;
                            }
                        }
                    }
                }
            }
            
            $job_data_sizes = DB::table('jobs')->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();

            foreach($job_data_sizes as $job_data_size)
            {
                $size += $job_data_size -> specific_info_size;
                $job_topic_data_sizes = DB::table('job_topics')->where('job_id', '=', $job_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
        
                foreach($job_topic_data_sizes as $job_topic_data_size)
                {
                    $size += $job_topic_data_size -> specific_info_size;
                    $job_section_data_sizes = DB::table('job_topic_sections')->where('job_topic_id', '=', $job_topic_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                        
                    foreach($job_section_data_sizes as $job_section_data_size)
                    {
                        $size += $job_section_data_size -> specific_info_size;
                        $job_file_data_sizes = DB::table('job_t_s_files')->where('job_topic_section_id', '=', $job_section_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                
                        foreach($job_file_data_sizes as $job_file_data_size)
                        {
                            $size += $job_file_data_size -> file_size;
                        }
                
                        $job_note_data_sizes = DB::table('job_t_s_notes')->where('job_topic_section_id', '=', $job_section_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                        foreach($job_note_data_sizes as $job_note_data_size)
                        {
                            $size += $job_note_data_size -> specific_info_size;
                        }
                                
                        $job_galery_data_sizes = DB::table('job_t_s_galeries')->where('job_topic_section_id', '=', $job_section_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                        foreach($job_galery_data_sizes as $job_galery_data_size)
                        {
                            //$size += $job_galery_data_size -> specific_info_size;
                            $job_image_data_sizes = DB::table('job_t_s_galery_images')->where('job_t_s_g_id', '=', $job_galery_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                    
                            foreach($job_image_data_sizes as $job_image_data_size)
                            {
                                $size += $job_image_data_size -> file_size;
                            }
                        }
                                
                        $job_playlist_data_sizes = DB::table('job_t_s_playlists')->where('j_t_s_id', '=', $job_section_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                        foreach($job_playlist_data_sizes as $job_playlist_data_size)
                        {
                            //$size += $job_playlist_data_size -> specific_info_size;
                            $job_audio_data_sizes = DB::table('job_t_s_p_audios')->where('j_t_s_p_id', '=', $job_playlist_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                    
                            foreach($job_audio_data_sizes as $job_audio_data_size)
                            {
                                $size += $job_audio_data_size -> file_size;
                            }
                        }
                                
                        $job_tool_data_sizes = DB::table('job_t_s_tools')->where('job_topic_section_id', '=', $job_section_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                        foreach($job_tool_data_sizes as $job_tool_data_size)
                        {
                            //$size += $job_tool_data_size -> specific_info_size;
                            $job_tool_file_data_sizes = DB::table('job_t_s_tool_files')->where('job_t_s_t_id', '=', $job_tool_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                    
                            foreach($job_tool_file_data_sizes as $job_tool_file_data_size)
                            {
                                $size += $job_tool_file_data_size -> file_size;
                            }
                        }
                    }
                }
            }
            
            $project_data_sizes = DB::table('projects')->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            
            foreach($project_data_sizes as $project_data_size)
            {
                $size += $project_data_size -> specific_info_size;
                $project_topic_data_sizes = DB::table('project_topics')->where('project_id', '=', $project_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
        
                foreach($project_topic_data_sizes as $project_topic_data_size)
                {
                    $size += $project_topic_data_size -> specific_info_size;
                    $project_section_data_sizes = DB::table('project_topic_sections')->where('project_topic_id', '=', $project_topic_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                        
                    foreach($project_section_data_sizes as $project_section_data_size)
                    {
                        $size += $project_section_data_size -> specific_info_size;
                        $project_file_data_sizes = DB::table('project_t_s_files')->where('project_topic_section_id', '=', $project_section_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                
                        foreach($project_file_data_sizes as $project_file_data_size)
                        {
                            $size += $project_file_data_size -> file_size;
                        }
                
                        $project_note_data_sizes = DB::table('project_t_s_notes')->where('project_topic_section_id', '=', $project_section_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                        foreach($project_note_data_sizes as $project_note_data_size)
                        {
                            $size += $project_note_data_size -> specific_info_size;
                        }
                                
                        $project_galery_data_sizes = DB::table('project_t_s_galeries')->where('project_topic_section_id', '=', $project_section_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                        foreach($project_galery_data_sizes as $project_galery_data_size)
                        {
                            //$size += $project_galery_data_size -> specific_info_size;
                            $project_image_data_sizes = DB::table('project_t_s_galery_images')->where('project_t_s_g_id', '=', $project_galery_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                    
                            foreach($project_image_data_sizes as $project_image_data_size)
                            {
                                $size += $project_image_data_size -> file_size;
                            }
                        }
                                
                        $project_playlist_data_sizes = DB::table('project_t_s_playlists')->where('p_t_s_id', '=', $project_section_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                        foreach($project_playlist_data_sizes as $project_playlist_data_size)
                        {
                            //$size += $project_playlist_data_size -> specific_info_size;
                            $project_audio_data_sizes = DB::table('project_t_s_p_audios')->where('p_t_s_p_id', '=', $project_playlist_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                    
                            foreach($project_audio_data_sizes as $project_audio_data_size)
                            {
                                $size += $project_audio_data_size -> file_size;
                            }
                        }
                                
                        $project_tool_data_sizes = DB::table('project_t_s_tools')->where('project_topic_section_id', '=', $project_section_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                        foreach($project_tool_data_sizes as $project_tool_data_size)
                        {
                            //$size += $project_tool_data_size -> specific_info_size;
                            $project_tool_file_data_sizes = DB::table('project_t_s_tool_files')->where('project_t_s_t_id', '=', $project_tool_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                    
                            foreach($project_tool_file_data_sizes as $project_tool_file_data_size)
                            {
                                $size += $project_tool_file_data_size -> file_size;
                            }
                        }
                    }
                }
            }
            
            $personal_data_data_sizes = DB::table('personal_datas')->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            
            foreach($personal_data_data_sizes as $personal_data_data_size)
            {
                $size += $personal_data_data_size -> specific_info_size;
                $personal_data_topic_data_sizes = DB::table('personal_data_topics')->where('personal_data_id', '=', $personal_data_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
        
                foreach($personal_data_topic_data_sizes as $personal_data_topic_data_size)
                {
                    $size += $personal_data_topic_data_size -> specific_info_size;
                    $personal_data_section_data_sizes = DB::table('personal_data_topic_sections')->where('personal_data_topic_id', '=', $personal_data_topic_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                        
                    foreach($personal_data_section_data_sizes as $personal_data_section_data_size)
                    {
                        $size += $personal_data_section_data_size -> specific_info_size;
                        $personal_data_file_data_sizes = DB::table('personal_data_t_s_files')->where('personal_data_t_s_id', '=', $personal_data_section_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                
                        foreach($personal_data_file_data_sizes as $personal_data_file_data_size)
                        {
                            $size += $personal_data_file_data_size -> file_size;
                        }
                
                        $personal_data_note_data_sizes = DB::table('personal_data_t_s_notes')->where('personal_data_t_s_id', '=', $personal_data_section_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                        foreach($personal_data_note_data_sizes as $personal_data_note_data_size)
                        {
                            $size += $personal_data_note_data_size -> specific_info_size;
                        }
                                
                        $personal_data_galery_data_sizes = DB::table('personal_data_t_s_galeries')->where('personal_data_t_s_id', '=', $personal_data_section_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                        foreach($personal_data_galery_data_sizes as $personal_data_galery_data_size)
                        {
                            //$size += $personal_data_galery_data_size -> specific_info_size;
                            $personal_data_image_data_sizes = DB::table('personal_data_t_s_galery_images')->where('personal_data_t_s_g_id', '=', $personal_data_galery_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                    
                            foreach($personal_data_image_data_sizes as $personal_data_image_data_size)
                            {
                                $size += $personal_data_image_data_size -> file_size;
                            }
                        }
                                
                        $personal_data_playlist_data_sizes = DB::table('personal_data_t_s_playlists')->where('p_d_t_s_id', '=', $personal_data_section_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                        foreach($personal_data_playlist_data_sizes as $personal_data_playlist_data_size)
                        {
                            //$size += $personal_data_playlist_data_size -> specific_info_size;
                            $personal_data_audio_data_sizes = DB::table('personal_data_t_s_p_audios')->where('p_d_t_s_p_id', '=', $personal_data_playlist_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                    
                            foreach($personal_data_audio_data_sizes as $personal_data_audio_data_size)
                            {
                                $size += $personal_data_audio_data_size -> file_size;
                            }
                        }
                                
                        $personal_data_tool_data_sizes = DB::table('personal_data_t_s_tools')->where('personal_data_topic_section_id', '=', $personal_data_section_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                
                        foreach($personal_data_tool_data_sizes as $personal_data_tool_data_size)
                        {
                            //$size += $personal_data_tool_data_size -> specific_info_size;
                            $personal_data_tool_file_data_sizes = DB::table('personal_data_t_s_tool_files')->where('personal_data_t_s_t_id', '=', $personal_data_tool_data_size -> id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
                                    
                            foreach($personal_data_tool_file_data_sizes as $personal_data_tool_file_data_size)
                            {
                                $size += $personal_data_tool_file_data_size -> file_size;
                            }
                        }
                    }
                }
            }
            
            if(($user_id == $user[0] -> id || $isShared) && $size <= 1073741824)
            {
                $newPersonalDataTSNote = $this->personalDataTSNoteRepository->update($request->all(), $id);
                $specific_info_size = strlen($request -> content);
        
                DB::table('personal_data_t_s_notes')->where('id', $id)->update(['updates_quantity' => DB::raw('updates_quantity + 1'), 'specific_info_size' => $specific_info_size]);
                DB::table('personal_data_t_s_note_updates')->insert(['actual_name' => $newPersonalDataTSNote -> name, 'past_name' => $personalDataTSNote -> name, 'datetime' => $now, 'personal_data_t_s_note_id' => $id, 'user_id' => $user_id]);
                DB::table('recent_activities')->insert(['name' => $personalDataTSNote -> name, 'status' => 'active', 'type' => 'p_d_t_s_n_u', 'user_id' => $user_id, 'entity_id' => $personalDataTSNote -> id, 'created_at' => $now]);
                
                Flash::success('PersonalData T S Note updated successfully.');
                return redirect(route('personalDataTSNotes.show', [$id]));
            }
            
            else
            {
                if($size > 1073741824)
                {
                    Flash::error('Your storage space is exhausted, you can get more space at only 15 dollars per month.');
                    return redirect(route('colleges.index'));
                }
                
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
            $personalDataTSNote = $this->personalDataTSNoteRepository->findWithoutFail($id);
            
            if(empty($personalDataTSNote))
            {
                Flash::error('PersonalData T S Note not found');
                return redirect(route('personalDataTSNotes.index'));
            }
            
            $user = DB::table('personal_data_t_s_notes')->join('personal_data_topic_sections', 'personal_data_t_s_notes.personal_data_t_s_id', '=', 'personal_data_topic_sections.id')->join('personal_data_topics', 'personal_data_topic_sections.personal_data_topic_id', '=', 'personal_data_topics.id')->join('personal_datas', 'personal_data_topics.personal_data_id', '=', 'personal_datas.id')->join('users', 'users.id', '=', 'personal_datas.user_id')->where('personal_data_t_s_notes.id', '=', $id)->get();
            
            if($user_id == $user[0] -> id)
            {
                DB::table('user_personal_data_t_s_notes')->where('personal_data_t_s_note_id', $personalDataTSNote -> id)->update(['deleted_at' => $now]);
                
                $userPersonalDataTSNote = DB::table('user_personal_data_t_s_notes')->where('personal_data_t_s_note_id', '=', $personalDataTSNote -> id)->orderBy('datetime', 'desc')->limit(1)->get();
                
                if($userPersonalDataTSNote == null)
                {
                    DB::table('user_personal_data_t_s_note_d')->insert(['datetime' => $now, 'user_id' => $user_id, 'u_p_d_t_s_n_id' => $userPersonalDataTSNote[0] -> id]);
                }
                
                $this->personalDataTSNoteRepository->delete($id);
                
                DB::table('personal_data_t_s_note_deletes')->insert(['datetime' => $now, 'user_id' => $user_id, 'personal_data_t_s_note_id' => $personalDataTSNote -> id]);
                DB::table('recent_activities')->insert(['name' => $personalDataTSNote -> name, 'status' => 'active', 'type' => 'p_d_t_s_n_d', 'user_id' => $user_id, 'entity_id' => $personalDataTSNote -> id, 'created_at' => $now]);
            
                Flash::success('PersonalData T S Note deleted successfully.');
                return redirect(route('personalDataTopicSections.show', [$personalDataTSNote -> personal_data_t_s_id]));
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