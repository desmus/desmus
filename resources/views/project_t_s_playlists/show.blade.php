@extends('layouts.app')

@section('scripts')

  <script>
    
    $('#project_t_s_p_todolist_create').on('submit', function() {
      
      var project_t_s_p_todolist_name = document.getElementById("name").value;
      var project_t_s_p_todolist_description = document.getElementById("description").value;
      var project_t_s_p_todolist_datetime = document.getElementById("datetime").value;
      
      if(project_t_s_p_todolist_name == '' || project_t_s_p_todolist_description == '' || project_t_s_p_todolist_datetime == '')
      {
        alert("You need to complete all the fields.");
        return false;
      }
      
      if(project_t_s_p_todolist_name != '' && project_t_s_p_todolist_description != '' && project_t_s_p_todolist_datetime != '')
      {
        return true;
      }
      
      return false;
      
    });
    
  </script>

@endsection

@section('content')
    
  <section class="content-header">
    
    <h1> {!! $projectTSPlaylist->name !!} </h1>
    
  </section>
  
  <div class="content">
    
    <div class="box box-primary">
      
      <div class="box-body">
        
        <div class="row">
          
          @include('project_t_s_playlists.show_fields')
          <a href="{!! route('projectTopicSections.show', [$projectTSPlaylist -> p_t_s_id]) !!}" class="btn btn-default" style="margin-left: 20px;">Back</a>
          
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
        
        <a href="#user_project_playlists" data-toggle="tab">
        
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
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Project Playlist Audios </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($projectTSPAudiosList as $projectTSPAudioList)
            
              <li>
                
                <a href="{!! route('projectTSPAudios.show', [$projectTSPAudioList -> id]) !!}">
                  
                  <i class="menu-icon fa fa-file-audio-o bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $projectTSPAudioList -> name !!} </h4>
                    <p> {!! $projectTSPAudioList -> created_at !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="a_playlist_tasks">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Project Playlist Tasks </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($projectTSPTodolistsList as $projectTSPTodolistList)
            
              <li>
                
                <a href="{!! route('projectTSPTodolists.show', [$projectTSPTodolistList -> id]) !!}">
                  
                  <i class="menu-icon fa fa-square-o bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $projectTSPTodolistList -> name !!} </h4>
                    <p> {!! $projectTSPTodolistList -> created_at !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
          
        </ul>
          
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Project Playlist Completed Tasks </h3>
        
        <ul class="control-sidebar-menu">
            
          @foreach($projectTSPTodolistsCompletedList as $projectTSPTodolistCompletedList)
              
            <li>
                  
              <a href="{!! route('projectTSPTodolists.show', [$projectTSPTodolistCompletedList -> id]) !!}">
                    
                <i class="menu-icon fa fa-check-square-o bg-light-blue"></i>
      
                <div class="menu-info">
                      
                  <h4 class="control-sidebar-subheading"> {!! $projectTSPTodolistCompletedList -> name !!} </h4>
                  <p> {!! $projectTSPTodolistCompletedList -> created_at !!} </p>
                    
                </div>
                  
              </a>
                
            </li>
              
          @endforeach
          
        </ul>

      </div>
      
      <div class="tab-pane" id="user_project_playlists">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Shared Project Playlist Users  </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($userProjectTSPlaylistsList as $userProjectTSPlaylistList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-share bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $userProjectTSPlaylistList -> name !!} </h4>
                    <p> {!! $userProjectTSPlaylistList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="playlist_views">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Project Playlist Views </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($projectTSPlaylistViewsList as $projectTSPlaylistViewList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-eye bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $projectTSPlaylistViewList -> name !!} </h4>
                    <p> {!! $projectTSPlaylistViewList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="playlist_updates">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Project Playlist Updates </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($projectTSPlaylistUpdatesList as $projectTSPlaylistUpdateList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-edit bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $projectTSPlaylistUpdateList -> name !!} </h4>
                    <p> {!! $projectTSPlaylistUpdateList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
    </div>
    
  </aside>

@endsection