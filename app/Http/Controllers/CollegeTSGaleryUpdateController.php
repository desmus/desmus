<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTSGaleryUpdateRequest;
use App\Http\Requests\UpdateCollegeTSGaleryUpdateRequest;
use App\Repositories\CollegeTSGaleryUpdateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTSGaleryUpdateController extends AppBaseController
{
    private $collegeTSGaleryUpdateRepository;

    public function __construct(CollegeTSGaleryUpdateRepository $collegeTSGaleryUpdateRepo)
    {
        $this->collegeTSGaleryUpdateRepository = $collegeTSGaleryUpdateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTSGaleryUpdateRepository->pushCriteria(new RequestCriteria($request));
            $collegeTSGaleryUpdates = $this->collegeTSGaleryUpdateRepository->all();
    
            return view('college_t_s_galery_updates.index')
                ->with('collegeTSGaleryUpdates', $collegeTSGaleryUpdates);
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
            return view('college_t_s_galery_updates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTSGaleryUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $collegeTSGaleryUpdate = $this->collegeTSGaleryUpdateRepository->create($input);
            
                Flash::success('College T S Galery Update saved successfully.');
                return redirect(route('collegeTSGaleryUpdates.index'));
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
            $collegeTSGaleryUpdate = $this->collegeTSGaleryUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTSGaleryUpdate))
            {
                Flash::error('College T S Galery Update not found');
                return redirect(route('collegeTSGaleryUpdates.index'));
            }
            
            $userCollegeTSGaleries = DB::table('user_college_t_s_galeries')->where('college_t_s_galery_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userCollegeTSGaleries as $userCollegeTSGalerie)
            {
                if($userCollegeTSGalerie -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('college_t_s_galeries')->join('college_topic_sections', 'college_t_s_galeries.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->join('users', 'users.id', '=', 'colleges.user_id')->where('college_t_s_galeries.id', '=', $id)->get();
            
            if($user_id == $collegeTSGaleryUpdate -> user_id || $isShared)
            {
                return view('college_t_s_galery_updates.show')->with('collegeTSGaleryUpdate', $collegeTSGaleryUpdate);
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
            $collegeTSGaleryUpdate = $this->collegeTSGaleryUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTSGaleryUpdate))
            {
                Flash::error('College T S Galery Update not found');
                return redirect(route('collegeTSGaleryUpdates.index'));
            }
    
            $userCollegeTSGaleries = DB::table('user_college_t_s_galeries')->where('college_t_s_galery_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userCollegeTSGaleries as $userCollegeTSGalerie)
            {
                if($userCollegeTSGalerie -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('college_t_s_galeries')->join('college_topic_sections', 'college_t_s_galeries.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->join('users', 'users.id', '=', 'colleges.user_id')->where('college_t_s_galeries.id', '=', $id)->get();
            
            if($user_id == $collegeTSGaleryUpdate -> user_id || $isShared)
            {
                return view('college_t_s_galery_updates.edit')->with('collegeTSGaleryUpdate', $collegeTSGaleryUpdate);
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

    public function update($id, UpdateCollegeTSGaleryUpdateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTSGaleryUpdate = $this->collegeTSGaleryUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTSGaleryUpdate))
            {
                Flash::error('College T S Galery Update not found');
                return redirect(route('collegeTSGaleryUpdates.index'));
            }
    
            $userCollegeTSGaleries = DB::table('user_college_t_s_galeries')->where('college_t_s_galery_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userCollegeTSGaleries as $userCollegeTSGalerie)
            {
                if($userCollegeTSGalerie -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('college_t_s_galeries')->join('college_topic_sections', 'college_t_s_galeries.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->join('users', 'users.id', '=', 'colleges.user_id')->where('college_t_s_galeries.id', '=', $id)->get();
            
            if($user_id == $collegeTSGaleryUpdate -> user_id || $isShared)
            {
                $collegeTSGaleryUpdate = $this->collegeTSGaleryUpdateRepository->update($request->all(), $id);
            
                Flash::success('College T S Galery Update updated successfully.');
                return redirect(route('collegeTSGaleryUpdates.index'));
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
            $collegeTSGaleryUpdate = $this->collegeTSGaleryUpdateRepository->findWithoutFail($id);
    
            if(empty($collegeTSGaleryUpdate))
            {
                Flash::error('College T S Galery Update not found');
                return redirect(route('collegeTSGaleryUpdates.index'));
            }
            
            $userCollegeTSGaleries = DB::table('user_college_t_s_galeries')->where('college_t_s_galery_id', '=', $id)->where('user_id', '=', $user_id)->where(function ($query) {$query->where('deleted_at', '=', null);})->get();
            $isShared = false;
            
            foreach($userCollegeTSGaleries as $userCollegeTSGalerie)
            {
                if($userCollegeTSGalerie -> user_id == $user_id)
                {
                    $isShared = true;
                    break;
                }
            }
            
            $user = DB::table('college_t_s_galeries')->join('college_topic_sections', 'college_t_s_galeries.college_topic_section_id', '=', 'college_topic_sections.id')->join('college_topics', 'college_topic_sections.college_topic_id', '=', 'college_topics.id')->join('colleges', 'college_topics.college_id', '=', 'colleges.id')->join('users', 'users.id', '=', 'colleges.user_id')->where('college_t_s_galeries.id', '=', $id)->get();
            
            if($user_id == $collegeTSGaleryUpdate -> user_id || $isShared)
            {
                $this->collegeTSGaleryUpdateRepository->delete($id);
            
                Flash::success('College T S Galery Update deleted successfully.');
                return redirect(route('collegeTSGaleryUpdates.index'));
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