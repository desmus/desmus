@extends('layouts.app')

@section('scripts')

  <script>
    
    $('#user_personal_data_t_s_playlist_update').on('submit', function() {
      
      var user_personal_data_t_s_playlist_permissions = document.getElementById("description").value;
      
      if(user_personal_data_t_s_playlist_permissions == '')
      {
        alert("You need to complete all the fields.");
        return false;
      }
      
      if(user_personal_data_t_s_playlist_permissions != '')
      {
        return true;
      }
      
      return false;
      
    });
    
  </script>

@endsection

@section('content')
    
  <section class="content-header">
        
    <h1> {!!$userPersonalDataTSP[0] -> name !!} </h1>
   
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($userPersonalDataTSP, ['route' => ['userPersonalDataTSPs.update', $userPersonalDataTSP[0]->id], 'method' => 'patch', 'id' => 'user_personal_data_t_s_playlist_update']) !!}

            @include('user_personal_data_t_s_ps.fields')

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