@extends('layouts.app')

@section('scripts')

  <script>
    
    $('#job_t_s_p_todolist_create').on('submit', function() {
      
      var job_t_s_p_todolist_name = document.getElementById("name").value;
      var job_t_s_p_todolist_description = document.getElementById("description").value;
      var job_t_s_p_todolist_datetime = document.getElementById("datetime").value;
      
      if(job_t_s_p_todolist_name == '' || job_t_s_p_todolist_description == '' || job_t_s_p_todolist_datetime == '')
      {
        alert("You need to complete all the fields.");
        return false;
      }
      
      if(job_t_s_p_todolist_name != '' && job_t_s_p_todolist_description != '' && job_t_s_p_todolist_datetime != '')
      {
        return true;
      }
      
      return false;
      
    });
    
  </script>

@endsection

@section('content')
    
  <section class="content-header">
    
    <h1> {!! $jobTSPlaylist->name !!} </h1>
    
  </section>
  
  <div class="content">
    
    <div class="box box-primary">
      
      <div class="box-body">
        
        <div class="row">
          
          @include('job_t_s_playlists.show_fields')
          <a href="{!! route('jobTopicSections.show', [$jobTSPlaylist -> j_t_s_id]) !!}" class="btn btn-default" style="margin-left: 20px;">Back</a>
          
        </div>
        
      </div>
      
    </div>
    
  </div>
  
  <aside class="control-sidebar control-sidebar-dark control-sidebar-close" style="background: rgba(0,0,0,0.8);">
  
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      
      <li class="active">
        
        <a href="#audios" data-toggle="tab">
        
          <i class="fa fa-file-audio-o"></i>
        
        </a>
        
      </li>
      
      <li>
        
        <a href="#a_playlist_tasks" data-toggle="tab">
        
          <i class="fa fa-list"></i>
        
        </a>
        
      </li>
      
      <li>
        
        <a href="#user_job_playlists" data-toggle="tab">
        
          <i class="fa fa-share"></i>
        
        </a>
        
      </li>
      
      <li>
        
        <a href="#playlist_views" data-toggle="tab">
        
          <i class="fa fa-eye"></i>
        
        </a>
        
      </li>
      
      <li>
        
        <a href="#playlist_updates" data-toggle="tab">
        
          <i class="fa fa-edit"></i>
        
        </a>
        
      </li>
    
    </ul>
    
    <div class="tab-content" style="padding: 20px;">
      
      <div class="tab-pane active" id="audios">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Job Playlist Audios </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($jobTSPAudiosList as $jobTSPAudioList)
            
              <li>
                
                <a href="{!! route('jobTSPAudios.show', [$jobTSPAudioList -> id]) !!}">
                  
                  <i class="menu-icon fa fa-file-audio-o bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $jobTSPAudioList -> name !!} </h4>
                    <p> {!! $jobTSPAudioList -> created_at !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="a_playlist_tasks">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Job Playlist Tasks </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($jobTSPTodolistsList as $jobTSPTodolistList)
            
              <li>
                
                <a href="{!! route('jobTSPTodolists.show', [$jobTSPTodolistList -> id]) !!}">
                  
                  <i class="menu-icon fa fa-square-o bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $jobTSPTodolistList -> name !!} </h4>
                    <p> {!! $jobTSPTodolistList -> created_at !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
          
        </ul>
          
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Job Playlist Completed Tasks </h3>
        
        <ul class="control-sidebar-menu">
            
          @foreach($jobTSPTodolistsCompletedList as $jobTSPTodolistCompletedList)
              
            <li>
                  
              <a href="{!! route('jobTSPTodolists.show', [$jobTSPTodolistCompletedList -> id]) !!}">
                    
                <i class="menu-icon fa fa-check-square-o bg-light-blue"></i>
      
                <div class="menu-info">
                      
                  <h4 class="control-sidebar-subheading"> {!! $jobTSPTodolistCompletedList -> name !!} </h4>
                  <p> {!! $jobTSPTodolistCompletedList -> created_at !!} </p>
                    
                </div>
                  
              </a>
                
            </li>
              
          @endforeach
          
        </ul>

      </div>
      
      <div class="tab-pane" id="user_job_playlists">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Shared Job Playlist Users  </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($userJobTSPlaylistsList as $userJobTSPlaylistList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-share bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $userJobTSPlaylistList -> name !!} </h4>
                    <p> {!! $userJobTSPlaylistList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="playlist_views">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Job Playlist Views </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($jobTSPlaylistViewsList as $jobTSPlaylistViewList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-eye bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $jobTSPlaylistViewList -> name !!} </h4>
                    <p> {!! $jobTSPlaylistViewList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="playlist_updates">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Job Playlist Updates </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($jobTSPlaylistUpdatesList as $jobTSPlaylistUpdateList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-edit bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $jobTSPlaylistUpdateList -> name !!} </h4>
                    <p> {!! $jobTSPlaylistUpdateList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
    </div>
    
  </aside>

@endsection