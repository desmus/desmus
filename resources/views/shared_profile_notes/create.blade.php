@extends('layouts.app')

@section('scripts')

  <script>
    
    $('#shared_profile_note_create').on('submit', function() {
      
      var shared_profile_note_name = document.getElementById("name").value;
      var shared_profile_note_description = document.getElementById("description").value;
      
      if(shared_profile_note_name.length >= 100)
      {
        alert("Invalid character number for the note name.");
        return false;
      }
      
      if(shared_profile_note_description.length >= 1000)
      {
        alert("Invalid character number for the description.");
        return false;
      }
      
      if(shared_profile_note_name == '' || shared_profile_note_description == '')
      {
        alert("You need to complete all the fields.");
        return false;
      }
      
      if(shared_profile_note_name != '' && shared_profile_note_description != '')
      {
        return true;
      }
      
      return false;
      
    });
    
  </script>

@endsection

@section('content')
    
  <section class="content-header">
        
    <h1> Shared Profile Note </h1>
    
  </section>
    
  <div class="content">
        
    @include('adminlte-templates::common.errors')
        
    <div class="box box-primary">

      <div class="box-body">
                
        <div class="row">
                    
          {!! Form::open(['route' => 'sharedProfileNotes.store', 'id' => 'shared_profile_note_create']) !!}

            @include('shared_profile_notes.create_fields')

          {!! Form::close() !!}
                
        </div>
            
      </div>
        
    </div>
  
  </div>
  
  <aside class="control-sidebar control-sidebar-dark control-sidebar-close" style="background: rgba(0,0,0,0.8);">
  
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      
      <li class="active">
        
        <a href="#sharedProfile-file" data-toggle="tab">
        
          <i class="fa fa-file"></i>
        
        </a>
        
      </li>
      
      <li>
        
        <a href="#sharedProfile-note" data-toggle="tab">
          
          <i class="fa fa-sticky-note"></i>
          
        </a>
        
      </li>
      
      <li>
      
        <a href="#sharedProfile-image" data-toggle="tab">
          
          <i class="fa fa-file-image-o"></i>
          
        </a>
      
      </li>
    
    </ul>
    
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      
      <li>
      
        <a href="#sharedProfile-audio" data-toggle="tab">
          
          <i class="fa fa-file-audio-o"></i>
          
        </a>
      
      </li>
      
      <li>
      
        <a href="#sharedProfile-video" data-toggle="tab">
          
          <i class="fa fa-file-video-o"></i>
          
        </a>
      
      </li>
    
    </ul>
    
    <div class="tab-content" style="padding: 20px;">
    
      <div class="tab-pane active" id="sharedProfile-file">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Shared Profile Files </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($files_list as $file_list)
            
              <li>
                
                <a href="{!! route('sharedProfileFiles.show', [$file_list -> id]) !!}">
                  
                  <i class="menu-icon fa fa-download bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $file_list -> name !!} </h4>
                    <p> {!! $file_list -> created_at !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div id="sharedProfile-note" class="tab-pane">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Shared Profile Notes </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($notes_list as $note_list)
            
              <li>
                
                <a href="{!! route('sharedProfileNotes.show', [$note_list -> id]) !!}">
                  
                  <i class="menu-icon fa fa-sticky-note bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $note_list -> name !!} </h4>
                    <p> {!! $note_list -> created_at !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>
        
      </div>

      <div class="tab-pane" id="sharedProfile-image">
    
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Shared Profile Images </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($images_list as $image_list)
            
              <li>
                
                <a href="{!! route('sharedProfileImages.show', [$image_list -> id]) !!}">
                  
                  <i class="menu-icon fa fa-file-image-o bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $image_list -> name !!} </h4>
                    <p> {!! $image_list -> created_at !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>
        
      </div>
      
      <div class="tab-pane" id="sharedProfile-audio">
    
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Shared Profile Audios </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($audios_list as $audio_list)
            
              <li>
                
                <a href="{!! route('sharedProfileAudios.show', [$audio_list -> id]) !!}">
                  
                  <i class="menu-icon fa fa-file-audio-o bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $audio_list -> name !!} </h4>
                    <p> {!! $audio_list -> created_at !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>
        
      </div>
      
      <div class="tab-pane" id="sharedProfile-video">
    
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Shared Profile Videos </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($videos_list as $video_list)
            
              <li>
                
                <a href="{!! route('sharedProfileVideos.show', [$video_list -> id]) !!}">
                  
                  <i class="menu-icon fa fa-file-video-o bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $video_list -> name !!} </h4>
                    <p> {!! $video_list -> created_at !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>
        
      </div>
      
    </div>
    
  </aside>

@endsection