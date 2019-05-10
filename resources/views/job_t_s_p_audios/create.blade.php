@extends('layouts.app')

@section('scripts')

  <script>
    
    $('#job_t_s_p_audio_create').on('submit', function() {
      
      var job_t_s_p_audio_name = document.getElementById("name").value;
      var job_t_s_p_audio_description = document.getElementById("description").value;
      var job_t_s_p_audio_file = document.getElementById("file").value;
      var extension = job_t_s_p_audio_file.split('.').pop();
      
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
      
      if(job_t_s_p_audio_name == '' || job_t_s_p_audio_description == '' || job_t_s_p_audio_file == '')
      {
        alert("You need to complete all the fields.");
        return false;
      }
      
      if(extension != '3gp' && extension != 'aa' && extension != 'aac' && extension != 'aax' && extension != 'act' && extension != 'aiff' && extension != 'amr' && extension != 'ape' && extension != 'au' && extension != 'awb' && extension != 'dct' && extension != 'dss' && extension != 'dvf' && extension != 'flac' && extension != 'gsm' && extension != 'iklax' && extension != 'ivs' && extension != 'm4a' && extension != 'm4b' && extension != 'm4p' && extension != 'mmf' && extension != 'mp3' && extension != 'mpc' && extension != 'msv' && extension != 'nsf' && extension != 'ogg' && extension != 'oga' && extension != 'mogg' && extension != 'opus' && extension != 'ra' && extension != 'rm' && extension != 'raw' && extension != 'sln' && extension != 'tta' && extension != 'vox' && extension != 'wav' && extension != 'wma' && extension != 'wv' && extension != 'webm' && extension != '8svx')
      {
        alert("The audio type must be 3gp, aa, aac, aax, act, aiff, amr, ape, au, awb, dct, dss, dvf, flac, gsm, iklax, ivs, m4a, m4b, m4p, mmf, mp3, mpc, msv, nsf, ogg, oga, mogg, opus, ra, rm, raw, sln, tta, vox, wav, wma, wv, webm or 8svx.");
        return false;
      }
      
      if(job_t_s_p_audio_name != '' && job_t_s_p_audio_description != '' && job_t_s_p_audio_file != '' && (extension == '3gp' || extension == 'aa' || extension == 'aac' || extension == 'aax' || extension == 'act' || extension == 'aiff' || extension == 'amr' || extension == 'ape' || extension == 'au' || extension == 'awb' || extension == 'dct' || extension == 'dss' || extension == 'dvf' || extension == 'flac' || extension == 'gsm' || extension == 'iklax' || extension == 'ivs' || extension == 'm4a' || extension == 'm4b' || extension == 'm4p' || extension == 'mmf' || extension == 'mp3' || extension == 'mpc' || extension == 'msv' || extension == 'nsf' || extension == 'ogg' || extension == 'oga' || extension == 'mogg' || extension == 'opus' || extension == 'ra' || extension == 'rm' || extension == 'raw' || extension == 'sln' || extension == 'tta' || extension == 'vox' || extension == 'wav' || extension == 'wma' || extension == 'wv' || extension == 'webm' || extension == '8svx'))
      {
        return true;
      }
      
      return false;
      
    });
    
  </script>

@endsection

@section('content')
    
  <section class="content-header">
        
    <h1> Job Topic Section Playlist Audio </h1>
    
  </section>
    
  <div class="content">
        
    @include('adminlte-templates::common.errors')
        
    <div class="box box-primary">

      <div class="box-body">
                
        <div class="row">
                    
          <form id = 'job_t_s_p_audio_create' action = "{!! URL::to('/store_job_audio') !!}" enctype = "multipart/form-data" method = "post">
            
            {{ csrf_field() }}

            @include('job_t_s_p_audios.create_fields')

          </form>
                
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
    
    </ul>
    
    <div class="tab-content" style="padding: 20px;">
    
      <div class="tab-pane active" id="galeries">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Job Audios </h3>
        
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
    
    </div>
    
  </aside>

@endsection