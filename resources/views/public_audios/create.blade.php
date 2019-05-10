@extends('layouts.app')

@section('scripts')

  <script>
    
    $('#public_audio_create').on('submit', function() {
      
      var public_audio_name = document.getElementById("name").value;
      var public_audio_description = document.getElementById("description").value;
      var public_audio_file = document.getElementById("file").value;
      var extension = public_audio_file.split('.').pop();
      
      if(public_audio_name.length >= 100)
      {
        alert("Invalid character number for the audio name.");
        return false;
      }
      
      if(public_audio_description.length >= 1000)
      {
        alert("Invalid character number for the description.");
        return false;
      }
      
      if(public_audio_name == '' || public_audio_description == '' || public_audio_file == '')
      {
        alert("You need to complete all the fields.");
        return false;
      }
      
      if(extension != '3gp' && extension != 'aa' && extension != 'aac' && extension != 'aax' && extension != 'act' && extension != 'aiff' && extension != 'amr' && extension != 'ape' && extension != 'au' && extension != 'awb' && extension != 'dct' && extension != 'dss' && extension != 'dvf' && extension != 'flac' && extension != 'gsm' && extension != 'iklax' && extension != 'ivs' && extension != 'm4a' && extension != 'm4b' && extension != 'm4p' && extension != 'mmf' && extension != 'mp3' && extension != 'mpc' && extension != 'msv' && extension != 'nsf' && extension != 'ogg' && extension != 'oga' && extension != 'mogg' && extension != 'opus' && extension != 'ra' && extension != 'rm' && extension != 'raw' && extension != 'sln' && extension != 'tta' && extension != 'vox' && extension != 'wav' && extension != 'wma' && extension != 'wv' && extension != 'webm' && extension != '8svx')
      {
        alert("The audio type must be 3gp, aa, aac, aax, act, aiff, amr, ape, au, awb, dct, dss, dvf, flac, gsm, iklax, ivs, m4a, m4b, m4p, mmf, mp3, mpc, msv, nsf, ogg, oga, mogg, opus, ra, rm, raw, sln, tta, vox, wav, wma, wv, webm or 8svx.");
        return false;
      }
      
      if(public_audio_name != '' && public_audio_description != '' && public_audio_file != '' && (extension == '3gp' || extension == 'aa' || extension == 'aac' || extension == 'aax' || extension == 'act' || extension == 'aiff' || extension == 'amr' || extension == 'ape' || extension == 'au' || extension == 'awb' || extension == 'dct' || extension == 'dss' || extension == 'dvf' || extension == 'flac' || extension == 'gsm' || extension == 'iklax' || extension == 'ivs' || extension == 'm4a' || extension == 'm4b' || extension == 'm4p' || extension == 'mmf' || extension == 'mp3' || extension == 'mpc' || extension == 'msv' || extension == 'nsf' || extension == 'ogg' || extension == 'oga' || extension == 'mogg' || extension == 'opus' || extension == 'ra' || extension == 'rm' || extension == 'raw' || extension == 'sln' || extension == 'tta' || extension == 'vox' || extension == 'wav' || extension == 'wma' || extension == 'wv' || extension == 'webm' || extension == '8svx'))
      {
        return true;
      }
      
      return false;
      
    });
    
  </script>

@endsection

@section('content')
    
  <section class="content-header">
        
    <h1> Public Audio </h1>
    
  </section>
    
  <div class="content">
        
    @include('adminlte-templates::common.errors')
        
    <div class="box box-primary">

      <div class="box-body">
                
        <div class="row">
                    
          <form id = 'public_audio_create' action = "{!! URL::to('/store_public_audio') !!}" enctype = "multipart/form-data" method = "post">
            
            {{ csrf_field() }}

            @include('public_audios.create_fields')

          </form>
                
        </div>
            
      </div>
        
    </div>
    
  </div>
  
  <aside class="control-sidebar control-sidebar-dark control-sidebar-close" style="background: rgba(0,0,0,0.8);">
  
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      
      <li class="active">
        
        <a href="#public-file" data-toggle="tab">
        
          <i class="fa fa-file"></i>
        
        </a>
        
      </li>
      
      <li>
        
        <a href="#public-note" data-toggle="tab">
          
          <i class="fa fa-sticky-note"></i>
          
        </a>
        
      </li>
      
      <li>
      
        <a href="#public-image" data-toggle="tab">
          
          <i class="fa fa-file-image-o"></i>
          
        </a>
      
      </li>
    
    </ul>
    
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      
      <li>
      
        <a href="#public-audio" data-toggle="tab">
          
          <i class="fa fa-file-audio-o"></i>
          
        </a>
      
      </li>
      
      <li>
      
        <a href="#public-video" data-toggle="tab">
          
          <i class="fa fa-file-video-o"></i>
          
        </a>
      
      </li>
      
      <li>
      
        <a href="#public-advertisement" data-toggle="tab">
          
          <i class="fa fa-address-card"></i>
          
        </a>
      
      </li>
    
    </ul>
    
    <div class="tab-content" style="padding: 20px;">
    
      <div class="tab-pane active" id="public-file">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Public Files </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($files_list as $file_list)
            
              <li>
                
                <a href="{!! route('publicFiles.show', [$file_list -> id]) !!}">
                  
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
      
      <div id="public-note" class="tab-pane">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Public Notes </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($notes_list as $note_list)
            
              <li>
                
                <a href="{!! route('publicNotes.show', [$note_list -> id]) !!}">
                  
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

      <div class="tab-pane" id="public-image">
    
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Public Images </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($images_list as $image_list)
            
              <li>
                
                <a href="{!! route('publicImages.show', [$image_list -> id]) !!}">
                  
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
      
      <div class="tab-pane" id="public-audio">
    
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Public Audios </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($audios_list as $audio_list)
            
              <li>
                
                <a href="{!! route('publicAudios.show', [$audio_list -> id]) !!}">
                  
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
      
      <div class="tab-pane" id="public-video">
    
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Public Videos </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($videos_list as $video_list)
            
              <li>
                
                <a href="{!! route('publicVideos.show', [$video_list -> id]) !!}">
                  
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
      
      <div class="tab-pane" id="public-advertisement">
    
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Public Advertisements </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($advertisements_list as $advertisement_list)
            
              <li>
                
                <a href="{!! route('publicAdvertisements.show', [$advertisement_list -> id]) !!}">
                  
                  <i class="menu-icon fa fa-address-card bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $advertisement_list -> name !!} </h4>
                    <p> {!! $advertisement_list -> created_at !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>
        
      </div>
      
    </div>
    
  </aside>

@endsection