@extends('layouts.app')

@section('scripts')

  <script>
    
    $('#job_t_s_p_audio_update').on('submit', function() {
      
      var job_t_s_p_audio_name = document.getElementById("name").value;
      var job_t_s_p_audio_description = document.getElementById("description").value;
      
      if(job_t_s_p_audio_name.length >= 100)
      {
        alert("Invalid character number for the audio name.");
        return false;
      }
      
      if(job_t_s_p_audio_description.length >= 1000)
      {
        alert("Invalid character number for the description.");
        return false;
      }
      
      if(job_t_s_p_audio_name == '' || job_t_s_p_audio_description == '')
      {
        alert("You need to complete all the fields.");
        return false;
      }
      
      if(job_t_s_p_audio_name != '' && job_t_s_p_audio_description != '')
      {
        return true;
      }
      
      return false;
      
    });
    
  </script>

@endsection

@section('content')
    
  <section class="content-header">
    
    <h1> {!! $jobTSPAudio->name !!} </h1>
  
  </section>
   
  <div class="content">
    
    @include('adminlte-templates::common.errors')
    
    <div class="box box-primary">
      
      <div class="box-body">
        
        <div class="row">
          
          {!! Form::model($jobTSPAudio, ['route' => ['jobTSPAudios.update', $jobTSPAudio->id], 'method' => 'patch', 'id' => 'job_t_s_p_audio_update']) !!}
          
            @include('job_t_s_p_audios.fields')
            
          {!! Form::close() !!}
          
        </div>
        
      </div>
      
    </div>
    
  </div>
  
  <aside class="control-sidebar control-sidebar-dark control-sidebar-close" style="background: rgba(0,0,0,0.8);">
  
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      
      <li class="active">
        
        <a href="#user_job_audios" data-toggle="tab">
        
          <i class="fa fa-share"></i>
        
        </a>
        
      </li>
        
      <li>
        
        <a href="#audio_views" data-toggle="tab">
        
          <i class="fa fa-eye"></i>
        
        </a>
        
      </li>
      
      <li>
        
        <a href="#audio_updates" data-toggle="tab">
        
          <i class="fa fa-edit"></i>
        
        </a>
        
      </li>
    
    </ul>
    
    <div class="tab-content" style="padding: 20px;">
      
      <div class="tab-pane active" id="user_job_audios">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Shared Job Audio Users </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($userJobTSPAudiosList as $userJobTSPAudioList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-share bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $userJobTSPAudioList -> name !!} </h4>
                    <p> {!! $userJobTSPAudioList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="audio_views">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Job Audio Views </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($jobTSPAudioViewsList as $jobTSPAudioViewList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-eye bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $jobTSPAudioViewList -> name !!} </h4>
                    <p> {!! $jobTSPAudioViewList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="audio_updates">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Job Audio Updates </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($jobTSPAudioUpdatesList as $jobTSPAudioUpdateList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-edit bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $jobTSPAudioUpdateList -> name !!} </h4>
                    <p> {!! $jobTSPAudioUpdateList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
    </div>
    
  </aside>

@endsection