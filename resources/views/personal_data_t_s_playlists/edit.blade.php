@extends('layouts.app')

@section('scripts')

  <script>
    
    $('#personal_data_t_s_playlist_update').on('submit', function() {
      
      var personal_data_t_s_playlist_name = document.getElementById("name").value;
      var personal_data_t_s_playlist_description = document.getElementById("description").value;
      
      if(personal_data_t_s_playlist_name.length >= 50)
      {
        alert("Invalid character number for the playlist name.");
        return false;
      }
      
      if(personal_data_t_s_playlist_description.length >= 1000)
      {
        alert("Invalid character number for the description.");
        return false;
      }
      
      if(personal_data_t_s_playlist_name == '' || personal_data_t_s_playlist_description == '')
      {
        alert("You need to complete all the fields.");
        return false;
      }
      
      if(personal_data_t_s_playlist_name != '' && personal_data_t_s_playlist_description != '')
      {
        return true;
      }
      
      return false;
      
    });
    
  </script>

@endsection

@section('content')
    
  <section class="content-header">
    
    <h1> Personal Data Topic Section Playlist </h1>
   
  </section>
   
  <div class="content">
    
    @include('adminlte-templates::common.errors')
    
    <div class="box box-primary">
        
      <div class="box-body">
          
        <div class="row">
            
          {!! Form::model($personalDataTSPlaylist, ['route' => ['personalDataTSPlaylists.update', $personalDataTSPlaylist->id], 'method' => 'patch', 'id' => 'personal_data_t_s_playlist_update']) !!}
            
            @include('personal_data_t_s_playlists.fields')
              
          {!! Form::close() !!}
            
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
        
        <a href="#user_personal_data_playlists" data-toggle="tab">
        
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
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Personal Data Playlist Audios </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($personalDataTSPAudiosList as $personalDataTSPAudioList)
            
              <li>
                
                <a href="{!! route('personalDataTSPAudios.show', [$personalDataTSPAudioList -> id]) !!}">
                  
                  <i class="menu-icon fa fa-file-audio-o bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $personalDataTSPAudioList -> name !!} </h4>
                    <p> {!! $personalDataTSPAudioList -> created_at !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="a_playlist_tasks">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Personal Data Playlist Tasks </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($personalDataTSPTodolistsList as $personalDataTSPTodolistList)
            
              <li>
                
                <a href="{!! route('personalDataTSPTodolists.show', [$personalDataTSPTodolistList -> id]) !!}">
                  
                  <i class="menu-icon fa fa-square-o bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $personalDataTSPTodolistList -> name !!} </h4>
                    <p> {!! $personalDataTSPTodolistList -> created_at !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
          
        </ul>
          
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Personal Data Playlist Completed Tasks </h3>
        
        <ul class="control-sidebar-menu">
            
          @foreach($personalDataTSPTodolistsCompletedList as $personalDataTSPTodolistCompletedList)
              
            <li>
                  
              <a href="{!! route('personalDataTSPTodolists.show', [$personalDataTSPTodolistCompletedList -> id]) !!}">
                    
                <i class="menu-icon fa fa-check-square-o bg-light-blue"></i>
      
                <div class="menu-info">
                      
                  <h4 class="control-sidebar-subheading"> {!! $personalDataTSPTodolistCompletedList -> name !!} </h4>
                  <p> {!! $personalDataTSPTodolistCompletedList -> created_at !!} </p>
                    
                </div>
                  
              </a>
                
            </li>
              
          @endforeach
          
        </ul>

      </div>
      
      <div class="tab-pane" id="user_personal_data_playlists">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Shared Personal Data Playlist Users  </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($userPersonalDataTSPlaylistsList as $userPersonalDataTSPlaylistList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-share bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $userPersonalDataTSPlaylistList -> name !!} </h4>
                    <p> {!! $userPersonalDataTSPlaylistList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="playlist_views">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Personal Data Playlist Views </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($personalDataTSPlaylistViewsList as $personalDataTSPlaylistViewList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-eye bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $personalDataTSPlaylistViewList -> name !!} </h4>
                    <p> {!! $personalDataTSPlaylistViewList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="playlist_updates">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Personal Data Playlist Updates </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($personalDataTSPlaylistUpdatesList as $personalDataTSPlaylistUpdateList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-edit bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $personalDataTSPlaylistUpdateList -> name !!} </h4>
                    <p> {!! $personalDataTSPlaylistUpdateList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
    </div>
    
  </aside>
   
@endsection