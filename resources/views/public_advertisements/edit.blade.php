@extends('layouts.app')

@section('scripts')

  <script>
    
    $('#public_advertisement_update').on('submit', function() {
      
      var public_advertisement_name = document.getElementById("name").value;
      var public_advertisement_link = document.getElementById("link").value;
      var public_advertisement_email = document.getElementById("email").value;
      var public_advertisement_telephone = document.getElementById("telephone").value;
      var public_advertisement_address = document.getElementById("address").value;
      var public_advertisement_description = document.getElementById("description").value;
      var public_advertisement_image = document.getElementById("image").value;
      var public_advertisement_video = document.getElementById("video").value;
      var image_extension = public_advertisement_image.split('.').pop();
      var video_extension = public_advertisement_video.split('.').pop();
      
      if(public_advertisement_name.length >= 100)
      {
        alert("Invalid character number for the image name.");
        return false;
      }
      
      if(public_advertisement_link.length >= 500)
      {
        alert("Invalid character number for the link.");
        return false;
      }
      
      var email_format = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      
      if(public_advertisement_email != '')
      {
        if(email_formats = public_advertisement_email.match(email_format))
        {
          if(public_advertisement_email.length >= 50)
          {
            alert("Invalid value for email: " + public_advertisement_email);
            return false;
          }
        }
      
        else
        {
          alert("Invalid email format: " + public_advertisement_email);
          return false;
        }
      }
      
      if(public_advertisement_telephone.length >= 15 || public_advertisement_telephone.length <= 7)
      {
        alert("Invalid character number for the telephone.");
        return false;
      }
      
      if(public_advertisement_address.length >= 500)
      {
        alert("Invalid character number for the address.");
        return false;
      }
      
      if(public_advertisement_description.length >= 1000)
      {
        alert("Invalid character number for the description.");
        return false;
      }
      
      if(public_advertisement_name == '' || public_advertisement_link == '' || public_advertisement_email == '' || public_advertisement_telephone == '' || public_advertisement_address == '' || public_advertisement_description == '' || public_advertisement_image == '' || public_advertisement_video == '')
      {
        alert("You need to complete all the fields.");
        return false;
      }
      
      if(image_extension != 'jpg' && image_extension != 'jpeg' && image_extension != 'bmp' && image_extension != 'gif' && image_extension != 'png')
      {
        alert("The image type must be jpg, jpeg, bmp, gif or png.");
        return false;
      }
      
      if(video_extension != 'webm' && video_extension != 'mkv' && video_extension != 'flv' && video_extension != 'vob' && video_extension != 'ogv' && video_extension != 'ogg' && video_extension != 'drc' && video_extension != 'gif' && video_extension != 'gifv' && video_extension != 'mng' && video_extension != 'avi' && video_extension != 'MTS' && video_extension != 'M2TS' && video_extension != 'mov' && video_extension != 'qt' && video_extension != 'wmv' && video_extension != 'yuv' && video_extension != 'rm' && video_extension != 'rmvb' && video_extension != 'asf' && video_extension != 'amv' && video_extension != 'mp4' && video_extension != 'm4p' && video_extension != 'mpg' && video_extension != 'mp2' && video_extension != 'mpeg' && video_extension != 'mpe' && video_extension != 'mpv' && video_extension != 'mpg' && video_extension != 'mpeg' && video_extension != 'm2v' && video_extension != 'm4v' && video_extension != 'svi' && video_extension != '3gp' && video_extension != '3g2' && video_extension != 'mxf' && video_extension != 'roq' && video_extension != 'nsv' && video_extension != 'flv' && video_extension != 'f4v' && video_extension != 'f4p' && video_extension != 'f4a' && video_extension != 'f4b')
      {
        alert("The audio type must be webm, mkv, flv, vob, ogv, ogg, drc, gif, gifv, mng, avi, mts, m2ts, mov, qt, wmv, yuv, rm, rmvb, asf, amv, mp4, m4p, mpg, mp2, mpeg, mpe, mpv, mpg, mpeg, m2v, m4v, svi, 3gp, 3g2, mxf, roq, nsv, flv, f4v, f4p, f4a, f4b.");
        return false;
      }
      
      if(public_advertisement_name != '' && public_advertisement_link != '' && public_advertisement_email != '' && public_advertisement_telephone != '' && public_advertisement_address != '' &&  public_advertisement_description != '' && public_advertisement_image != '' && public_advertisement_video != '')
      {
        return true;
      }
      
      return false;
      
    });
    
  </script>

@endsection

@section('content')
    
  <section class="content-header">
        
    <h1> {!! $publicAdvertisement->name !!} </h1>
  
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($publicAdvertisement, ['route' => ['publicAdvertisements.update', $publicAdvertisement->id], 'method' => 'patch', 'id' => 'public_advertisement_update']) !!}
            
            @include('public_advertisements.fields')
            
          {!! Form::close() !!}
            
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