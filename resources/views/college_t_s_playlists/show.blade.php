@extends('layouts.app')

@section('scripts')

  <script>
    
    $('#college_t_s_p_todolist_create').on('submit', function() {
      
      var college_t_s_p_todolist_name = document.getElementById("name").value;
      var college_t_s_p_todolist_description = document.getElementById("description").value;
      var college_t_s_p_todolist_datetime = document.getElementById("datetime").value;
      
      if(college_t_s_p_todolist_name == '' || college_t_s_p_todolist_description == '' || college_t_s_p_todolist_datetime == '')
      {
        alert("You need to complete all the fields.");
        return false;
      }
      
      if(college_t_s_p_todolist_name != '' && college_t_s_p_todolist_description != '' && college_t_s_p_todolist_datetime != '')
      {
        return true;
      }
      
      return false;
      
    });
    
  </script>

@endsection

@section('content')
    
  <section class="content-header">
    
    <h1> {!! $collegeTSPlaylist->name !!} </h1>
    
  </section>
  
  <div class="content">
    
    <div class="box box-primary">
      
      <div class="box-body">
        
        <div class="row">
          
          @include('college_t_s_playlists.show_fields')
          <a href="{!! route('collegeTopicSections.show', [$collegeTSPlaylist -> c_t_s_id]) !!}" class="btn btn-default" style="margin-left: 20px;">Back</a>
          
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
        
        <a href="#user_college_playlists" data-toggle="tab">
        
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
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> College Playlist Audios </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($collegeTSPAudiosList as $collegeTSPAudioList)
            
              <li>
                
                <a href="{!! route('collegeTSPAudios.show', [$collegeTSPAudioList -> id]) !!}">
                  
                  <i class="menu-icon fa fa-file-audio-o bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $collegeTSPAudioList -> name !!} </h4>
                    <p> {!! $collegeTSPAudioList -> created_at !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="a_playlist_tasks">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> College Playlist Tasks </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($collegeTSPTodolistsList as $collegeTSPTodolistList)
            
              <li>
                
                <a href="{!! route('collegeTSPTodolists.show', [$collegeTSPTodolistList -> id]) !!}">
                  
                  <i class="menu-icon fa fa-square-o bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $collegeTSPTodolistList -> name !!} </h4>
                    <p> {!! $collegeTSPTodolistList -> created_at !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
          
        </ul>
          
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> College Playlist Completed Tasks </h3>
        
        <ul class="control-sidebar-menu">
            
          @foreach($collegeTSPTodolistsCompletedList as $collegeTSPTodolistCompletedList)
              
            <li>
                  
              <a href="{!! route('collegeTSPTodolists.show', [$collegeTSPTodolistCompletedList -> id]) !!}">
                    
                <i class="menu-icon fa fa-check-square-o bg-light-blue"></i>
      
                <div class="menu-info">
                      
                  <h4 class="control-sidebar-subheading"> {!! $collegeTSPTodolistCompletedList -> name !!} </h4>
                  <p> {!! $collegeTSPTodolistCompletedList -> created_at !!} </p>
                    
                </div>
                  
              </a>
                
            </li>
              
          @endforeach
          
        </ul>

      </div>
      
      <div class="tab-pane" id="user_college_playlists">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Shared College Playlist Users  </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($userCollegeTSPlaylistsList as $userCollegeTSPlaylistList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-share bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $userCollegeTSPlaylistList -> name !!} </h4>
                    <p> {!! $userCollegeTSPlaylistList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="playlist_views">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> College Playlist Views </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($collegeTSPlaylistViewsList as $collegeTSPlaylistViewList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-eye bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $collegeTSPlaylistViewList -> name !!} </h4>
                    <p> {!! $collegeTSPlaylistViewList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="playlist_updates">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> College Playlist Updates </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($collegeTSPlaylistUpdatesList as $collegeTSPlaylistUpdateList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-edit bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $collegeTSPlaylistUpdateList -> name !!} </h4>
                    <p> {!! $collegeTSPlaylistUpdateList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
    </div>
    
  </aside>

@endsection