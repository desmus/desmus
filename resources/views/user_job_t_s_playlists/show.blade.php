@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> {!! $jobTSPlaylist[0] -> name !!} - Share List </h1>
    
  </section>
    
  <div class="content">
        
    <div class="box box-primary">
            
      <div class="box-body">
                
        <div class="row" style="padding-left: 20px">
                    
          @include('user_job_t_s_playlists.show_fields')
          <a href="{!! route('jobTopicSections.show', [$jobTSPlaylist[0] -> j_t_s_id]) !!}" class="btn btn-default">Back</a>
                
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