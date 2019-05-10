<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCollegeTSGaleryCreateRequest;
use App\Http\Requests\UpdateCollegeTSGaleryCreateRequest;
use App\Repositories\CollegeTSGaleryCreateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Illuminate\Support\Carbon;

class CollegeTSGaleryCreateController extends AppBaseController
{
    private $collegeTSGaleryCreateRepository;

    public function __construct(CollegeTSGaleryCreateRepository $collegeTSGaleryCreateRepo)
    {
        $this->collegeTSGaleryCreateRepository = $collegeTSGaleryCreateRepo;
    }

    public function index(Request $request)
    {
        if(Auth::user() != null && Auth::user()->email == 'josemsoberonpenaloza@gmail.com')
        {
            $this->collegeTSGaleryCreateRepository->pushCriteria(new RequestCriteria($request));
            $collegeTSGaleryCreates = $this->collegeTSGaleryCreateRepository->all();
    
            return view('college_t_s_galery_creates.index')
                ->with('collegeTSGaleryCreates', $collegeTSGaleryCreates);
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
            return view('college_t_s_galery_creates.create');
        }
        
        else
        {
            return view('deniedAccess');
        }
    }

    public function store(CreateCollegeTSGaleryCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $input = $request->all();
            
            if($input -> user_id == $user_id)
            {
                $collegeTSGaleryCreate = $this->collegeTSGaleryCreateRepository->create($input);
            
                Flash::success('College T S Galery Create saved successfully.');
                return redirect(route('collegeTSGaleryCreates.index'));
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
            $collegeTSGaleryCreate = $this->collegeTSGaleryCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTSGaleryCreate))
            {
                Flash::error('College T S Galery Create not found');
                return redirect(route('collegeTSGaleryCreates.index'));
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
            
            if($user_id == $collegeTSGaleryCreate -> user_id || $isShared)
            {
                return view('college_t_s_galery_creates.show')
                    ->with('collegeTSGaleryCreate', $collegeTSGaleryCreate);
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
            $collegeTSGaleryCreate = $this->collegeTSGaleryCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTSGaleryCreate))
            {
                Flash::error('College T S Galery Create not found');
                return redirect(route('collegeTSGaleryCreates.index'));
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
            
            if($user_id == $collegeTSGaleryCreate -> user_id || $isShared)
            {
                return view('college_t_s_galery_creates.edit')
                    ->with('collegeTSGaleryCreate', $collegeTSGaleryCreate);
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

    public function update($id, UpdateCollegeTSGaleryCreateRequest $request)
    {
        if(Auth::user() != null)
        {
            $user_id = Auth::user()->id;
            $collegeTSGaleryCreate = $this->collegeTSGaleryCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTSGaleryCreate))
            {
                Flash::error('College T S Galery Create not found');
                return redirect(route('collegeTSGaleryCreates.index'));
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
            
            if($user_id == $collegeTSGaleryCreate -> user_id || $isShared)
            {
                $collegeTSGaleryCreate = $this->collegeTSGaleryCreateRepository->update($request->all(), $id);
            
                Flash::success('College T S Galery Create updated successfully.');
                return redirect(route('collegeTSGaleryCreates.index'));
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
            $collegeTSGaleryCreate = $this->collegeTSGaleryCreateRepository->findWithoutFail($id);
    
            if(empty($collegeTSGaleryCreate))
            {
                Flash::error('College T S Galery Create not found');
                return redirect(route('collegeTSGaleryCreates.index'));
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
            
            if($user_id == $collegeTSGaleryCreate -> user_id || $isShared)
            {
                $this->collegeTSGaleryCreateRepository->delete($id);
            
                Flash::success('College T S Galery Create deleted successfully.');
                return redirect(route('collegeTSGaleryCreates.index'));
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