@extends('layouts.app')

@section('scripts')

  <script>
    
    $('#shared_profile_file_comment').on('submit', function() {
      
      console.log('file_comment');
      
      var shared_profile_file_comment = document.getElementById("shared_profile_file_comment_content").value;
      
      if(shared_profile_file_comment.length >= 1000)
      {
        alert("Invalid character number for the file comment.");
        return false;
      }
      
      if(shared_profile_file_comment == '')
      {
        alert("You need to complete the field to post a comment.");
        return false;
      }
      
      if(shared_profile_file_comment != '')
      {
        return true;
      }
      
      return false;
      
    });
    
    $('#shared_profile_file_comment_r').on('submit', function() {
      
      console.log('file_comment_r');
      
      var shared_profile_file_comment = document.getElementById("shared_profile_file_comment_r_content").value;
      
      if(shared_profile_file_comment.length >= 1000)
      {
        alert("Invalid character number for the file comment.");
        return false;
      }
      
      if(shared_profile_file_comment == '')
      {
        alert("You need to complete the field to post a comment.");
        return false;
      }
      
      if(shared_profile_file_comment != '')
      {
        return true;
      }
      
      return false;
      
    });
    
    $('#shared_profile_note_comment').on('submit', function() {
      
      console.log('note_comment');
      
      var shared_profile_note_comment = document.getElementById("shared_profile_note_comment_content").value;
      
      if(shared_profile_note_comment.length >= 1000)
      {
        alert("Invalid character number for the note comment.");
        return false;
      }
      
      if(shared_profile_note_comment == '')
      {
        alert("You need to complete the field to post a comment.");
        return false;
      }
      
      if(shared_profile_note_comment != '')
      {
        return true;
      }
      
      return false;
      
    });
    
    $('#shared_profile_note_comment_response').on('submit', function() {
      
      console.log('note_comment_response');
      
      var shared_profile_note_comment_response = document.getElementById("shared_profile_note_comment_response_content").value;
      
      if(shared_profile_note_comment_response.length >= 1000)
      {
        alert("Invalid character number for the note comment response.");
        return false;
      }
      
      if(shared_profile_note_comment_response == '')
      {
        alert("You need to complete the field to post a comment response.");
        return false;
      }
      
      if(shared_profile_note_comment_response != '')
      {
        return true;
      }
      
      return false;
      
    });
    
    $('#shared_profile_note_comment_r').on('submit', function() {
      
      console.log('note_comment_r');
      
      var shared_profile_note_comment = document.getElementById("shared_profile_note_comment_r_content").value;
      
      if(shared_profile_note_comment.length >= 1000)
      {
        alert("Invalid character number for the note comment.");
        return false;
      }
      
      if(shared_profile_note_comment == '')
      {
        alert("You need to complete the field to post a comment.");
        return false;
      }
      
      if(shared_profile_note_comment != '')
      {
        return true;
      }
      
      return false;
      
    });
    
    $('#shared_profile_image_comment').on('submit', function() {
      
      console.log('image_comment');
      
      var shared_profile_image_comment = document.getElementById("shared_profile_image_comment_content").value;
      
      if(shared_profile_image_comment.length >= 1000)
      {
        alert("Invalid character number for the image comment.");
        return false;
      }
      
      if(shared_profile_image_comment == '')
      {
        alert("You need to complete the field to post a comment.");
        return false;
      }
      
      if(shared_profile_image_comment != '')
      {
        return true;
      }
      
      return false;
      
    });
    
    $('#shared_profile_image_comment_response').on('submit', function() {
      
      console.log('image_comment_response');
      
      var shared_profile_image_comment_response = document.getElementById("shared_profile_image_comment_response_content").value;
      
      if(shared_profile_image_comment_response.length >= 1000)
      {
        alert("Invalid character number for the image comment response.");
        return false;
      }
      
      if(shared_profile_image_comment_response == '')
      {
        alert("You need to complete the field to post a comment response.");
        return false;
      }
      
      if(shared_profile_image_comment_response != '')
      {
        return true;
      }
      
      return false;
      
    });
    
    $('#shared_profile_image_comment_r').on('submit', function() {
      
      console.log('image_comment_r');
      
      var shared_profile_image_comment = document.getElementById("shared_profile_image_comment_r_content").value;
      
      if(shared_profile_image_comment.length >= 1000)
      {
        alert("Invalid character number for the image comment.");
        return false;
      }
      
      if(shared_profile_image_comment == '')
      {
        alert("You need to complete the field to post a comment.");
        return false;
      }
      
      if(shared_profile_image_comment != '')
      {
        return true;
      }
      
      return false;
      
    });
    
    $('#shared_profile_audio_comment').on('submit', function() {
      
      console.log('audio_comment');
      
      var shared_profile_audio_comment = document.getElementById("shared_profile_audio_comment_content").value;
      
      if(shared_profile_audio_comment.length >= 1000)
      {
        alert("Invalid character number for the audio comment.");
        return false;
      }
      
      if(shared_profile_audio_comment == '')
      {
        alert("You need to complete the field to post a comment.");
        return false;
      }
      
      if(shared_profile_audio_comment != '')
      {
        return true;
      }
      
      return false;
      
    });
    
    $('#shared_profile_audio_comment_response').on('submit', function() {
      
      console.log('audio_comment_response');
      
      var shared_profile_audio_comment_response = document.getElementById("shared_profile_audio_comment_response_content").value;
      
      if(shared_profile_audio_comment_response.length >= 1000)
      {
        alert("Invalid character number for the audio comment response.");
        return false;
      }
      
      if(shared_profile_audio_comment_response == '')
      {
        alert("You need to complete the field to post a comment response.");
        return false;
      }
      
      if(shared_profile_audio_comment_response != '')
      {
        return true;
      }
      
      return false;
      
    });
    
    $('#shared_profile_audio_comment_r').on('submit', function() {
      
      console.log('naudio_comment_r');
      
      var shared_profile_audio_comment = document.getElementById("shared_profile_audio_comment_r_content").value;
      
      if(shared_profile_audio_comment.length >= 1000)
      {
        alert("Invalid character number for the audio comment.");
        return false;
      }
      
      if(shared_profile_audio_comment == '')
      {
        alert("You need to complete the field to post a comment.");
        return false;
      }
      
      if(shared_profile_audio_comment != '')
      {
        return true;
      }
      
      return false;
      
    });
    
    $('#shared_profile_video_comment').on('submit', function() {
      
      console.log('video_comment');
      
      var shared_profile_video_comment = document.getElementById("shared_profile_video_comment_content").value;
      
      if(shared_profile_video_comment.length >= 1000)
      {
        alert("Invalid character number for the video comment.");
        return false;
      }
      
      if(shared_profile_video_comment == '')
      {
        alert("You need to complete the field to post a comment.");
        return false;
      }
      
      if(shared_profile_video_comment != '')
      {
        return true;
      }
      
      return false;
      
    });
    
    $('#shared_profile_video_comment_response').on('submit', function() {
      
      console.log('video_comment_response');
      
      var shared_profile_video_comment_response = document.getElementById("shared_profile_video_comment_response_content").value;
      
      if(shared_profile_video_comment_response.length >= 1000)
      {
        alert("Invalid character number for the video comment response.");
        return false;
      }
      
      if(shared_profile_video_comment_response == '')
      {
        alert("You need to complete the field to post a comment response.");
        return false;
      }
      
      if(shared_profile_video_comment_response != '')
      {
        return true;
      }
      
      return false;
      
    });
    
    $('#shared_profile_video_comment_r').on('submit', function() {
      
      console.log('video_comment_r');
      
      var shared_profile_video_comment = document.getElementById("shared_profile_video_comment_r_content").value;
      
      if(shared_profile_video_comment.length >= 1000)
      {
        alert("Invalid character number for the video comment.");
        return false;
      }
      
      if(shared_profile_video_comment == '')
      {
        alert("You need to complete the field to post a comment.");
        return false;
      }
      
      if(shared_profile_video_comment != '')
      {
        return true;
      }
      
      return false;
      
    });
    
  </script>
  
  @if(isset($sharedProfileFileComments))
              
    @foreach($sharedProfileFileComments as $sharedProfileFileCommentArray)
                                  
      @if(isset($sharedProfileFileCommentArray[0]))
                
        @foreach($sharedProfileFileCommentArray as $sharedProfileFileComment)
        
          <script>
                                              
            $('#shared_profile_file_comment_response_{!! $sharedProfileFileComment -> id !!}').on('submit', function() {
                                                  
              var shared_profile_file_comment_response = document.getElementById("shared_profile_file_comment_response_content_{!! $sharedProfileFileComment -> id !!}").value;
                                                  
              if(shared_profile_file_comment_response.length >= 1000)
              {
                  alert("Invalid character number for the file comment response.");
                  return false;
              }
                                                  
              if(shared_profile_file_comment_response == '')
              {
                alert("You need to complete the field to post a comment response.");
                return false;
              }
                                                  
              if(shared_profile_file_comment_response != '')
              {
                return true;
              }
                                                  
              return false;
                                                  
            });
                                                
          </script>
          
        @endforeach
          
      @endif
      
    @endforeach
      
  @endif
  
  @if(isset($sharedProfileNoteComments))
              
    @foreach($sharedProfileNoteComments as $sharedProfileNoteCommentArray)
                                  
      @if(isset($sharedProfileNoteCommentArray[0]))
                
        @foreach($sharedProfileNoteCommentArray as $sharedProfileNoteComment)
        
          <script>
                                              
            $('#shared_profile_note_comment_response_{!! $sharedProfileNoteComment -> id !!}').on('submit', function() {
                                                  
              var shared_profile_note_comment_response = document.getElementById("shared_profile_note_comment_response_content_{!! $sharedProfileNoteComment -> id !!}").value;
                                                  
              if(shared_profile_note_comment_response.length >= 1000)
              {
                  alert("Invalid character number for the note comment response.");
                  return false;
              }
                                                  
              if(shared_profile_note_comment_response == '')
              {
                alert("You need to complete the field to post a comment response.");
                return false;
              }
                                                  
              if(shared_profile_note_comment_response != '')
              {
                return true;
              }
                                                  
              return false;
                                                  
            });
                                                
          </script>
          
        @endforeach
          
      @endif
      
    @endforeach
      
  @endif
  
  @if(isset($sharedProfileImageComments))
              
    @foreach($sharedProfileImageComments as $sharedProfileImageCommentArray)
                                  
      @if(isset($sharedProfileImageCommentArray[0]))
                
        @foreach($sharedProfileImageCommentArray as $sharedProfileImageComment)
        
          <script>
                                              
            $('#shared_profile_image_comment_response_{!! $sharedProfileImageComment -> id !!}').on('submit', function() {
                                                  
              var shared_profile_image_comment_response = document.getElementById("shared_profile_image_comment_response_content_{!! $sharedProfileImageComment -> id !!}").value;
                                                  
              if(shared_profile_image_comment_response.length >= 1000)
              {
                  alert("Invalid character number for the image comment response.");
                  return false;
              }
                                                  
              if(shared_profile_image_comment_response == '')
              {
                alert("You need to complete the field to post a comment response.");
                return false;
              }
                                                  
              if(shared_profile_image_comment_response != '')
              {
                return true;
              }
                                                  
              return false;
                                                  
            });
                                                
          </script>
          
        @endforeach
          
      @endif
      
    @endforeach
      
  @endif
  
  @if(isset($sharedProfileAudioComments))
              
    @foreach($sharedProfileAudioComments as $sharedProfileAudioCommentArray)
                                  
      @if(isset($sharedProfileAudioCommentArray[0]))
                
        @foreach($sharedProfileAudioCommentArray as $sharedProfileAudioComment)
        
          <script>
                                              
            $('#shared_profile_audio_comment_response_{!! $sharedProfileAudioComment -> id !!}').on('submit', function() {
                                                  
              var shared_profile_audio_comment_response = document.getElementById("shared_profile_audio_comment_response_content_{!! $sharedProfileAudioComment -> id !!}").value;
                                                  
              if(shared_profile_audio_comment_response.length >= 1000)
              {
                  alert("Invalid character number for the audio comment response.");
                  return false;
              }
                                                  
              if(shared_profile_audio_comment_response == '')
              {
                alert("You need to complete the field to post a comment response.");
                return false;
              }
                                                  
              if(shared_profile_audio_comment_response != '')
              {
                return true;
              }
                                                  
              return false;
                                                  
            });
                                                
          </script>
          
        @endforeach
          
      @endif
      
    @endforeach
      
  @endif
  
  @if(isset($sharedProfileVideoComments))
              
    @foreach($sharedProfileVideoComments as $sharedProfileVideoCommentArray)
                                  
      @if(isset($sharedProfileVideoCommentArray[0]))
                
        @foreach($sharedProfileVideoCommentArray as $sharedProfileVideoComment)
        
          <script>
                                              
            $('#shared_profile_video_comment_response_{!! $sharedProfileVideoComment -> id !!}').on('submit', function() {
                                                  
              var shared_profile_video_comment_response = document.getElementById("shared_profile_video_comment_response_content_{!! $sharedProfileVideoComment -> id !!}").value;
                                                  
              if(shared_profile_video_comment_response.length >= 1000)
              {
                  alert("Invalid character number for the video comment response.");
                  return false;
              }
                                                  
              if(shared_profile_video_comment_response == '')
              {
                alert("You need to complete the field to post a comment response.");
                return false;
              }
                                                  
              if(shared_profile_video_comment_response != '')
              {
                return true;
              }
                                                  
              return false;
                                                  
            });
                                                
          </script>
          
        @endforeach
          
      @endif
      
    @endforeach
      
  @endif

@endsection

@section('content')

  <div id="share_file" class="modal fade" role="dialog">
      
    <div class="modal-dialog modal-lg">
        
      <div class="modal-content">
          
        <div class="modal-header">
            
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              
            <span aria-hidden="true">×</span>
            
          </button>
            
          <h4 class="modal-title"> File Name </h4>
            
        </div>
          
        <div class="modal-body">
            
        </div>
          
        <div class="modal-footer">
            
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal"> Close </button>
          <button type="submit" class="btn btn-primary"> Copy Link </button>
            
        </div>
          
      </div>
        
    </div>
      
  </div>
  
  <div id="share_note" class="modal fade" role="dialog">
      
    <div class="modal-dialog modal-lg">
        
      <div class="modal-content">
          
        <div class="modal-header">
            
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              
            <span aria-hidden="true">×</span>
            
          </button>
            
          <h4 class="modal-title"> Note Name </h4>
            
        </div>
          
        <div class="modal-body">
          
          <p style="margin: 20px;"> http://www.desmus.com.mx/publicProfile </p>
            
        </div>
          
        <div class="modal-footer">
            
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal"> Close </button>
          <button type="submit" class="btn btn-primary"> Copy Link </button>
            
        </div>
          
      </div>
        
    </div>
      
  </div>
  
  <div id="share_image" class="modal fade" role="dialog">
      
    <div class="modal-dialog modal-lg">
        
      <div class="modal-content">
          
        <div class="modal-header">
            
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              
            <span aria-hidden="true">×</span>
            
          </button>
            
          <h4 class="modal-title"> Image Name </h4>
            
        </div>
          
        <div class="modal-body">
          
          <p style="margin: 20px;"> http://www.desmus.com.mx/publicProfile </p>
            
        </div>
          
        <div class="modal-footer">
            
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal"> Close </button>
          <button type="submit" class="btn btn-primary"> Copy Link </button>
            
        </div>
          
      </div>
        
    </div>
      
  </div>
  
  <div id="share_audio" class="modal fade" role="dialog">
      
    <div class="modal-dialog modal-lg">
        
      <div class="modal-content">
          
        <div class="modal-header">
            
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              
            <span aria-hidden="true">×</span>
            
          </button>
            
          <h4 class="modal-title"> Audio Name </h4>
            
        </div>
          
        <div class="modal-body">
          
          <p style="margin: 20px;"> http://www.desmus.com.mx/publicProfile </p>
            
        </div>
          
        <div class="modal-footer">
            
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal"> Close </button>
          <button type="submit" class="btn btn-primary"> Copy Link </button>
            
        </div>
          
      </div>
        
    </div>
      
  </div>
  
  <div id="share_video" class="modal fade" role="dialog">
      
    <div class="modal-dialog modal-lg">
        
      <div class="modal-content">
          
        <div class="modal-header">
            
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              
            <span aria-hidden="true">×</span>
            
          </button>
            
          <h4 class="modal-title"> Video Name </h4>
            
        </div>
          
        <div class="modal-body">
          
          <p style="margin: 20px;"> http://www.desmus.com.mx/publicProfile </p>
            
        </div>
          
        <div class="modal-footer">
            
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal"> Close </button>
          <button type="submit" class="btn btn-primary"> Copy Link </button>
          
        </div>
        
      </div>
      
    </div>
    
  </div>
    
  <section class="content-header">
        
    <h1 class="pull-left">Shared Profile</h1>
    
  </section>
  
  <div class="content" style = "padding-right: 10px; padding-left: 10px; padding-bottom: 5px; margin-top: 20px;">
    
    <div class="clearfix"></div>

    @include('flash::message')

    <div class="clearfix"></div>
    
    <div class="box box-primary">
            
      <div class="box-body" style="padding-bottom: 0;">

        <div class="row">
 
          <div class="col-md-12">
          
            <div class="nav-tabs-custom" style="margin-bottom: 10px;">
            
              <ul class="nav nav-tabs">

                <li class = "active"><a href="#shared_profile_section" data-toggle="tab"> Shared Profile </a></li>
                <li><a href="#shared_profile_files" data-toggle="tab"> Files </a></li>
                <li><a href="#shared_profile_notes" data-toggle="tab"> Notes  </a></li>
                <li><a href="#shared_profile_images" data-toggle="tab"> Images </a></li>
                <li><a href="#shared_profile_audios" data-toggle="tab"> Audios </a></li>
                <li><a href="#shared_profile_videos" data-toggle="tab"> Videos </a></li>
                <li><a href="#shared_profiles_section" data-toggle="tab"> Shared Profiles </a></li>
                
                @if(isset($user_id))
                
                  <li><a href="{!! route('userSharedProfiles.show', [$user_id]) !!}"> Share Profile </a></li>

                @endif

              </ul>
          
              <div id = "tab-content" class="tab-content clearfix" style = "padding: 0;">
          
                <div class = "tab-pane active" id = "shared_profile_section">

                  <div class="row">
                  
                    <div class="col-md-12" style="padding: 0 10px";>
                        
                      @foreach($sharedProfileFiles as $sharedProfileFile)
                      
                        <div class="col-md-12" style="margin-top: 10px;">
          
                          <div class="box box-primary" style="margin-bottom: 10px;">
            
                            <div class="box-header with-border">
              
                              <div class="user-block">
                
                                @if(isset($sharedProfileFileUsers))
                
                                  @foreach($sharedProfileFileUsers as $sharedProfileFileUserArray)
                                  
                                    @if(isset($sharedProfileFileUserArray[0]))
                                    
                                      @if($sharedProfileFile -> user_id == $sharedProfileFileUserArray[0] -> id)
                                    
                                        <img class="img-circle" src="images/users/image_{!! $sharedProfileFile -> user_id !!}.{!! $sharedProfileFileUserArray[0] -> image_type !!}" alt="User Image">
                                    
                                        <span class="username"><a href="{!! route('sharedProfileUser.show', [$sharedProfileFile -> user_id]) !!}">{!! $sharedProfileFileUserArray[0] -> name !!}</a></span>
                                        
                                        <?php break; ?>
                                    
                                      @endif
                                      
                                    @endif
                                  
                                  @endforeach
                                  
                                @endif
                                
                                <span class="description">Shared publicly - {!! $sharedProfileFile -> created_at !!}</span>
              
                              </div>
              
                              <div class="box-tools">
                              
                                <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Mark as read"><a href="{!! route('sharedProfileFiles.show', [$sharedProfileFile -> id]) !!}"><i class="fa fa-eye"></i></a></button>
                              
                                @if(isset($user_id))
                              
                                  {!! Form::open(['route' => 'sharedProfileFileLikes.store', 'id' => 'shared_profile_file_like_create', 'style' => 'display: inline-block']) !!}
                                
                                    {!! Form::hidden('status', 'Status:') !!}
                                    {!! Form::hidden('status', 'on', ['class' => 'form-control']) !!}
                                    
                                    {!! Form::hidden('datetime', 'Datetime:') !!}
                                    {!! Form::hidden('datetime', $now, ['class' => 'form-control']) !!}
                                    
                                    {!! Form::hidden('s_p_f_id', 'Shared Profile File Id:') !!}
                                    {!! Form::hidden('s_p_f_id', $sharedProfileFile -> id, ['class' => 'form-control']) !!}
                                    
                                    {!! Form::hidden('user_id', 'User Id:') !!}
                                    {!! Form::hidden('user_id', $user_id, ['class' => 'form-control']) !!}
                                    
                                    <button type="submit" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Mark as read"><i class="fa fa-thumbs-o-up"></i></button>
                  
                                  {!! Form::close() !!}
                                  
                                @endif
                                
                                <button type="button" class="btn btn-box-tool" data-toggle="collapse" data-target="#file_{!! $sharedProfileFile -> id  !!}"><i class="fa fa-minus"></i></button>
              
                              </div>
            
                            </div>
            
                            <div id="file_{!! $sharedProfileFile -> id  !!}" class="box-body">
                              
                              <div class="info-box bg-yellow">
                                
                                <a href = "/files/shared_profile_files/file_{!! $sharedProfileFile -> id !!}.{!! $sharedProfileFile -> file_type !!}" style = "color: #fff;" download> <span class="info-box-icon glyphicon glyphicon-download-alt"></span> </a>
                    
                                <div class="info-box-content">
                                  
                                  <span class="info-box-text">Size (bytes)</span>
                                  <span class="info-box-number"> {!! $sharedProfileFile -> file_size !!} </span>
                    
                                  <div class="progress">
                                    
                                    <div class="progress-bar" style="width: 100%"></div>
                                  
                                  </div>
                                  
                                  <span class="progress-description"> {!! $sharedProfileFile -> name !!} </span>
                                
                                </div>
                              
                              </div>
                              
                              <p class="text-muted well well-sm no-shadow" style="margin-top: 10px; margin-bottom: 15px; text-align: justify;"> {!! $sharedProfileFile -> description  !!} </p>

                              <span class="pull-right text-muted" style="background: rgba(0,0,0,0.2); color: #fff; margin: 10px; padding: 0 5px;">
                                
                                @if(isset($sharedProfileFileLikes))
                                
                                  @foreach($sharedProfileFileLikes as $sharedProfileFileLikeArray)
                                    
                                    @if(isset($sharedProfileFileLikeArray[0]))
                                    
                                      @if($sharedProfileFile -> id == $sharedProfileFileLikeArray[0] -> s_p_f_id)
                                    
                                        {!! sizeof($sharedProfileFileLikeArray) !!} likes -
                                    
                                      @endif
                                      
                                    @endif
                                  
                                  @endforeach
                                  
                                @endif
                                
                                @if(isset($sharedProfileFileCommentCounts))
                                
                                  @foreach($sharedProfileFileCommentCounts as $sharedProfileFileCommentCountArray)
                
                                    @if(isset($sharedProfileFileCommentCountArray[0]))
                
                                      @if($sharedProfileFile -> id == $sharedProfileFileCommentCountArray[0] -> s_p_f_id)
                                    
                                        {!! sizeof($sharedProfileFileCommentCountArray) !!} comments
                                    
                                      @endif
                                      
                                    @endif
                                  
                                  @endforeach
                                  
                                @endif
                                
                              </span>
            
                              <div class="box-footer box-comments" style="padding-top: 40px;">
              
                                @if(isset($sharedProfileFileComments))
              
                                  @foreach($sharedProfileFileComments as $sharedProfileFileCommentArray)
                                  
                                    @if(isset($sharedProfileFileCommentArray[0]))
                
                                      @foreach($sharedProfileFileCommentArray as $sharedProfileFileComment)
                  
                                        @if($sharedProfileFile -> id == $sharedProfileFileComment -> s_p_f_id)
                  
                                          <div class="box-comment">
                                            
                                            @if(isset($sharedProfileFileCommentUsers))
                            
                                              @foreach($sharedProfileFileCommentUsers as $sharedProfileFileCommentUserArray)
                                              
                                                @if(isset($sharedProfileFileCommentUserArray[0]))
                                        
                                                  @foreach($sharedProfileFileCommentUserArray as $sharedProfileFileCommentUser)
                                          
                                                    @if($sharedProfileFileComment -> user_id == $sharedProfileFileCommentUser -> user_id && $sharedProfileFileComment -> id == $sharedProfileFileCommentUser -> id)
        
                                                      <img class="img-circle" src="images/users/image_{!! $sharedProfileFileComment -> user_id !!}.{!! $sharedProfileFileCommentUser -> image_type !!}" alt="User Image">
                
                                                      <?php break; ?>
                                            
                                                    @endif
                                                        
                                                  @endforeach
                                                  
                                                @endif
                                      
                                              @endforeach
                                              
                                            @endif
            
                                            <div class="comment-text" style="text-align:justify; padding-right: 10px;">
                                  
                                              <a href="{!! route('sharedProfileUser.show', [$sharedProfileFileComment -> user_id]) !!}">
                                                
                                                <span class="username">
                                                  
                                                  @if(isset($sharedProfileFileCommentUsers))
                                                  
                                                    @foreach($sharedProfileFileCommentUsers as $sharedProfileFileCommentUserArray)
                                                    
                                                      @if(isset($sharedProfileFileCommentUserArray[0]))
                                          
                                                        @foreach($sharedProfileFileCommentUserArray as $sharedProfileFileCommentUser)
                                            
                                                          @if($sharedProfileFileComment -> user_id == $sharedProfileFileCommentUser -> user_id && $sharedProfileFileComment -> id == $sharedProfileFileCommentUser -> id)
                                              
                                                            {!! $sharedProfileFileCommentUser -> name !!}
                                                  
                                                            <?php break; ?>
                                              
                                                          @endif
                                                          
                                                        @endforeach
                                                        
                                                      @endif
                                        
                                                    @endforeach
                                                    
                                                  @endif
                                      
                                                  <span class="text-muted pull-right" style="background: rgba(0,0,0,0.1); color: #000; padding: 0 5px;">{!! $sharedProfileFileComment -> datetime !!}</span>
                                    
                                                </span>
                                              
                                              </a>
                              
                                              {!! $sharedProfileFileComment -> content !!}
                                              
                                            </div>
                                            
                                            @if(isset($sharedProfileFileCommentResponses))
                                            
                                              @foreach($sharedProfileFileCommentResponses as $sharedProfileFileCommentResponseArray)
                                              
                                                @if(isset($sharedProfileFileCommentResponseArray[0]))
                    
                                                  @foreach($sharedProfileFileCommentResponseArray as $sharedProfileFileCommentResponse)
                      
                                                    @if($sharedProfileFileComment -> id == $sharedProfileFileCommentResponse -> s_p_f_c_id)
                                                
                                                      <div style="margin-left: 10px;" class="box-comment">
                                      
                                                        @if(isset($sharedProfileFileCommentResponseUsers))
                                      
                                                          @foreach($sharedProfileFileCommentResponseUsers as $sharedProfileFileCommentResponseUserArray)
                                                          
                                                            @if(isset($sharedProfileFileCommentUserArray[0]))
                                            
                                                              @foreach($sharedProfileFileCommentResponseUserArray as $sharedProfileFileCommentResponseUser)
                                                      
                                                                @if($sharedProfileFileCommentResponse -> user_id == $sharedProfileFileCommentResponseUser -> user_id && $sharedProfileFileCommentResponse -> id == $sharedProfileFileCommentResponseUser -> id)
            
                                                                  <img class="img-circle" src="images/users/image_{!! $sharedProfileFileCommentResponse -> user_id !!}.{!! $sharedProfileFileCommentResponseUser -> image_type !!}" alt="User Image">
                                                            
                                                                  <?php break; ?>
                                                            
                                                                @endif
                                                                    
                                                              @endforeach
                                                              
                                                            @endif
                                                  
                                                          @endforeach
                                                          
                                                        @endif
                                                        
                                                        <div class="comment-text" style="text-align:justify; padding-right: 10px;">
                                              
                                                          <a href="{!! route('sharedProfileUser.show', [$sharedProfileFileCommentResponse -> user_id]) !!}">
                                              
                                                            <span class="username">
                                                              
                                                              @if(isset($sharedProfileFileCommentResponseUsers))
                                                                
                                                                @foreach($sharedProfileFileCommentResponseUsers as $sharedProfileFileCommentResponseUserArray)
                                                                
                                                                  @if(isset($sharedProfileFileCommentResponseUsers))
                                              
                                                                    @foreach($sharedProfileFileCommentResponseUserArray as $sharedProfileFileCommentResponseUser)
                                                        
                                                                      @if($sharedProfileFileCommentResponse -> user_id == $sharedProfileFileCommentResponseUser -> user_id && $sharedProfileFileCommentResponse -> id == $sharedProfileFileCommentResponseUser -> id)
                                                          
                                                                        {!! $sharedProfileFileCommentResponseUser -> name !!}
                                                              
                                                                        <?php break; ?>
                                                          
                                                                      @endif
                                                                      
                                                                    @endforeach
                                                                    
                                                                  @endif
                                                    
                                                                @endforeach
                                                                
                                                              @endif
                                                  
                                                              <span class="text-muted pull-right" style="background: rgba(0,0,0,0.1); color: #000; padding: 0 5px;">{!! $sharedProfileFileCommentResponse -> datetime !!}</span>
                                                
                                                            </span>
                                                            
                                                          </a>
                                          
                                                          {!! $sharedProfileFileCommentResponse -> content !!}
                                                          
                                                        </div>
                                      
                                                      </div>
                                                
                                                    @endif
                                            
                                                  @endforeach
                                                  
                                                @endif
                                      
                                              @endforeach
                                              
                                            @endif
                          
                                          </div>
                                          
                                          <div class="box-footer">
                                    
                                            @if(isset($user_id))
                                              
                                              <form id='shared_profile_file_comment_response_{!! $sharedProfileFileComment -> id !!}' action = "{!! URL::to('/store_shared_profile_file_comment_response') !!}" method = "post">
                          
                                                {{ csrf_field() }}
                                
                                                <img class="img-responsive img-circle img-sm" src="images/users/image_{!! $user_id !!}.{!! $user[0] -> image_type !!}" alt="Alt Text">
                                
                                                <div class="img-push">
                                
                                                  <input id="s_p_f_c_id" name="s_p_f_c_id" type="hidden" value="{!! $sharedProfileFileComment -> id !!}">
                                                  <input id="status" name="status" type="hidden" value="on">
                                                  <input id="datetime" name="datetime" type="hidden" value="{!! $now !!}">
                                                  <input id="user_id" name="user_id" type="hidden" value="{!! $user_id !!}">
                                                  
                                                  <input id="shared_profile_file_comment_response_content_{!! $sharedProfileFileComment -> id !!}" name="content" type="text" class="form-control input-sm" placeholder="Press enter to post comment">
                                
                                                </div>
                              
                                              </form>
                                            
                                            @endif
                          
                                          </div>
                                        
                                        @endif
                                        
                                      @endforeach
                                      
                                    @endif
                                  
                                  @endforeach
                                  
                                @endif
              
                              </div>
              
                              <div class="box-footer">
                                
                                @if(isset($user_id))
                                
                                  <form id='shared_profile_file_comment' action = "{!! URL::to('/store_shared_profile_file_comment') !!}" method = "post">
              
                                    {{ csrf_field() }}
                    
                                    <img class="img-responsive img-circle img-sm" src="images/users/image_{!! $user_id !!}.{!! $user[0] -> image_type !!}" alt="Alt Text">
                    
                                    <div class="img-push">
                    
                                      <input id="s_p_f_id" name="s_p_f_id" type="hidden" value="{!! $sharedProfileFile -> id !!}">
                                      <input id="status" name="status" type="hidden" value="on">
                                      <input id="datetime" name="datetime" type="hidden" value="{!! $now !!}">
                                      <input id="user_id" name="user_id" type="hidden" value="{!! $user_id !!}">
                                      
                                      <input id="shared_profile_file_comment_content" name="content" type="text" class="form-control input-sm" placeholder="Press enter to post comment">
                    
                                    </div>
                  
                                  </form>
                                  
                                @endif
              
                              </div>
            
                            </div>
          
                          </div>
        
                        </div>
                      
                      @endforeach
                      
                      @foreach($sharedProfileNotes as $sharedProfileNote)
                        
                        <div class="col-md-12" style="margin-top: 10px;">
          
                          <div class="box box-primary" style="margin-bottom: 10px;">
            
                            <div class="box-header with-border">
              
                              <div class="user-block">
                                
                                @if(isset($sharedProfileNoteUsers))
                                
                                  @foreach($sharedProfileNoteUsers as $sharedProfileNoteUserArray)
                                  
                                    @if(isset($sharedProfileNoteUserArray[0]))
                                    
                                      @if($sharedProfileNote -> user_id == $sharedProfileNoteUserArray[0] -> id)
                                      
                                        <img class="img-circle" src="images/users/image_{!! $sharedProfileNote -> user_id !!}.{!! $sharedProfileNoteUserArray[0] -> image_type !!}" alt="User Image">
                                    
                                        <span class="username"><a href="{!! route('sharedProfileUser.show', [$sharedProfileNote -> user_id]) !!}">{!! $sharedProfileNoteUserArray[0] -> name !!}</a></span>
                                        
                                        <?php break; ?>
                                    
                                      @endif
                                      
                                    @endif
                                  
                                  @endforeach
                                  
                                @endif
                                
                                <span class="description">Shared publicly - {!! $sharedProfileNote -> created_at !!} </span>
              
                              </div>
              
                              <div class="box-tools">
                
                                <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Mark as read"><a href="{!! route('sharedProfileNotes.show', [$sharedProfileNote -> id]) !!}"><i class="fa fa-eye"></i></a></button>
                
                                @if(isset($user_id))
                                
                                  {!! Form::open(['route' => 'sharedProfileNoteLikes.store', 'id' => 'shared_profile_note_like_create', 'style' => 'display: inline-block']) !!}
                                
                                    {!! Form::hidden('status', 'Status:') !!}
                                    {!! Form::hidden('status', 'on', ['class' => 'form-control']) !!}
                                    
                                    {!! Form::hidden('datetime', 'Datetime:') !!}
                                    {!! Form::hidden('datetime', $now, ['class' => 'form-control']) !!}
                                    
                                    {!! Form::hidden('s_p_n_id', 'Shared Profile Note Id:') !!}
                                    {!! Form::hidden('s_p_n_id', $sharedProfileNote -> id, ['class' => 'form-control']) !!}
                                    
                                    {!! Form::hidden('user_id', 'User Id:') !!}
                                    {!! Form::hidden('user_id', $user_id, ['class' => 'form-control']) !!}
                                    
                                    <button type="submit" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Mark as read"><i class="fa fa-thumbs-o-up"></i></button>
                  
                                  {!! Form::close() !!}
                                
                                @endif
                                
                                <button type="button" class="btn btn-box-tool" data-toggle="collapse" data-target="#note_{!! $sharedProfileNote -> id  !!}"><i class="fa fa-minus"></i></button>
              
                              </div>
            
                            </div>
            
                            <div id = "note_{!! $sharedProfileNote -> id !!}" class="box-body">
              
                              <blockquote> {!! $sharedProfileNote -> content !!} </blockquote>
                              
                              <p class="text-muted well well-sm no-shadow" style="margin-top: 10px; margin-bottom: 15px; text-align: justify;"> {!! $sharedProfileNote -> description  !!} </p>
              
                              <span class="pull-right text-muted" style="background: rgba(0,0,0,0.2); color: #fff; margin: 10px; padding: 0 5px;">
                                
                                @if(isset($sharedProfileNoteLikes))
                                
                                  @foreach($sharedProfileNoteLikes as $sharedProfileNoteLikeArray)
                                    
                                    @if(isset($sharedProfileNoteLikeArray[0]))
                                    
                                      @if($sharedProfileNote -> id == $sharedProfileNoteLikeArray[0] -> s_p_n_id)
                                    
                                        {!! sizeof($sharedProfileNoteLikeArray) !!} likes -
                                    
                                      @endif
                                      
                                    @endif
                                  
                                  @endforeach
                                  
                                @endif
                                
                                @if(isset($sharedProfileNoteCommentCounts))
                                
                                  @foreach($sharedProfileNoteCommentCounts as $sharedProfileNoteCommentCountArray)
                
                                    @if(isset($sharedProfileNoteCommentCountArray[0]))
                
                                      @if($sharedProfileNote -> id == $sharedProfileNoteCommentCountArray[0] -> s_p_n_id)
                                    
                                        {!! sizeof($sharedProfileNoteCommentCountArray) !!} comments
                                    
                                      @endif
                                      
                                    @endif
                                  
                                  @endforeach
                                  
                                @endif
                                
                              </span>
            
                              <div class="box-footer box-comments" style="padding-top: 40px;">
              
                                @if(isset($sharedProfileNoteComments))
              
                                  @foreach($sharedProfileNoteComments as $sharedProfileNoteCommentArray)
                                  
                                    @if(isset($sharedProfileNoteCommentArray[0]))
                
                                      @foreach($sharedProfileNoteCommentArray as $sharedProfileNoteComment)
                  
                                        @if($sharedProfileNote -> id == $sharedProfileNoteComment -> s_p_n_id)
                  
                                          <div class="box-comment">
                            
                                            @if(isset($sharedProfileNoteCommentUsers))
                            
                                              @foreach($sharedProfileNoteCommentUsers as $sharedProfileNoteCommentUserArray)
                                              
                                                @if(isset($sharedProfileNoteCommentUserArray[0]))
                                          
                                                  @foreach($sharedProfileNoteCommentUserArray as $sharedProfileNoteCommentUser)
                                          
                                                    @if($sharedProfileNoteComment -> user_id == $sharedProfileNoteCommentUser -> user_id && $sharedProfileNoteComment -> id == $sharedProfileNoteCommentUser -> id)
        
                                                      <img class="img-circle" src="images/users/image_{!! $sharedProfileNoteComment -> user_id !!}.{!! $sharedProfileNoteCommentUser -> image_type !!}" alt="User Image">
                
                                                      <?php break; ?>
                
                                                    @endif
        
                                                  @endforeach
                                                  
                                                @endif
      
                                              @endforeach
                                              
                                            @endif
            
                                            <div class="comment-text" style="text-align:justify; padding-right: 10px;">
                                              
                                              <a href="{!! route('sharedProfileUser.show', [$sharedProfileNoteComment -> user_id]) !!}">
                                  
                                                <span class="username">
                                                  
                                                  @if(isset($sharedProfileNoteCommentUsers))
                                                  
                                                    @foreach($sharedProfileNoteCommentUsers as $sharedProfileNoteCommentUserArray)
                                                    
                                                      @if(isset($sharedProfileNoteCommentUserArray[0]))
                                          
                                                        @foreach($sharedProfileNoteCommentUserArray as $sharedProfileNoteCommentUser)
                                            
                                                          @if($sharedProfileNoteComment -> user_id == $sharedProfileNoteCommentUser -> user_id && $sharedProfileNoteComment -> id == $sharedProfileNoteCommentUser -> id)
                                              
                                                            {!! $sharedProfileNoteCommentUser -> name !!}
                                                  
                                                            <?php break; ?>
                                              
                                                          @endif
                                                          
                                                        @endforeach
                                                        
                                                      @endif
                                        
                                                    @endforeach
                                                    
                                                  @endif
                                      
                                                  <span class="text-muted pull-right" style="background: rgba(0,0,0,0.1); color: #000; padding: 0 5px;">{!! $sharedProfileNoteComment -> datetime !!}</span>
                                    
                                                </span>
                                                
                                              </a>
                              
                                              {!! $sharedProfileNoteComment -> content !!}
                                              
                                            </div>
                                            
                                            @if(isset($sharedProfileNoteCommentResponses))
                                            
                                              @foreach($sharedProfileNoteCommentResponses as $sharedProfileNoteCommentResponseArray)
                                              
                                                @if(isset($sharedProfileNoteCommentResponseArray))
                    
                                                  @foreach($sharedProfileNoteCommentResponseArray as $sharedProfileNoteCommentResponse)
                      
                                                    @if($sharedProfileNoteComment -> id == $sharedProfileNoteCommentResponse -> s_p_n_c_id)
                                                
                                                      <div style="margin-left: 10px;" class="box-comment">
                                                        
                                                        @if(isset($sharedProfileNoteCommentResponseUsers))
                                      
                                                          @foreach($sharedProfileNoteCommentResponseUsers as $sharedProfileNoteCommentResponseUserArray)
                                                          
                                                            @if(isset($sharedProfileNoteCommentResponseUserArray[0]))
                                            
                                                              @foreach($sharedProfileNoteCommentResponseUserArray as $sharedProfileNoteCommentResponseUser)
                                                      
                                                                @if($sharedProfileNoteCommentResponse -> user_id == $sharedProfileNoteCommentResponseUser -> user_id && $sharedProfileNoteCommentResponse -> id == $sharedProfileNoteCommentResponseUser -> id)
            
                                                                  <img class="img-circle" src="images/users/image_{!! $sharedProfileNoteCommentResponse -> user_id !!}.{!! $sharedProfileNoteCommentResponseUser -> image_type !!}" alt="User Image">
                            
                                                                  <?php break; ?>
                                                        
                                                                @endif
                                                                    
                                                              @endforeach
                                                              
                                                            @endif
                                                  
                                                          @endforeach
                                                          
                                                        @endif
                        
                                                        <div class="comment-text" style="text-align:justify; padding-right: 10px;">
                                                          
                                                          <a href="{!! route('sharedProfileUser.show', [$sharedProfileNoteCommentResponse -> user_id]) !!}">
                                              
                                                            <span class="username">
                                                              
                                                              @if(isset($sharedProfileNoteCommentResponseUsers))
                                                              
                                                                @foreach($sharedProfileNoteCommentResponseUsers as $sharedProfileNoteCommentResponseUserArray)
                                                                
                                                                  @if(isset($sharedProfileNoteCommentResponseUserArray[0]))
                                              
                                                                    @foreach($sharedProfileNoteCommentResponseUserArray as $sharedProfileNoteCommentResponseUser)
                                                        
                                                                      @if($sharedProfileNoteCommentResponse -> user_id == $sharedProfileNoteCommentResponseUser -> user_id && $sharedProfileNoteCommentResponse -> id == $sharedProfileNoteCommentResponseUser -> id)
                                                          
                                                                        {!! $sharedProfileNoteCommentResponseUser -> name !!}
                                                              
                                                                        <?php break; ?>
                                                          
                                                                      @endif
                                                                      
                                                                    @endforeach
                                                                    
                                                                  @endif
                                                    
                                                                @endforeach
                                                                
                                                              @endif
                                                  
                                                              <span class="text-muted pull-right" style="background: rgba(0,0,0,0.1); color: #000; padding: 0 5px;">{!! $sharedProfileNoteCommentResponse -> datetime !!}</span>
                                                
                                                            </span>
                                                            
                                                          </a>
                                          
                                                          {!! $sharedProfileNoteCommentResponse -> content !!}
                                                          
                                                        </div>
                                      
                                                      </div>
                                                      
                                                    @endif
                                            
                                                  @endforeach
                                                  
                                                @endif
                                      
                                              @endforeach
                                              
                                            @endif
                          
                                          </div>
                                          
                                          <div class="box-footer">
                                    
                                            @if(isset($user_id))
                                      
                                              <form id='shared_profile_note_comment_response_{!! $sharedProfileNoteComment -> id !!}' action = "{!! URL::to('/store_shared_profile_note_comment_response') !!}" method = "post">
                          
                                                {{ csrf_field() }}
                                
                                                <img class="img-responsive img-circle img-sm" src="images/users/image_{!! $user_id !!}.{!! $user[0] -> image_type !!}" alt="Alt Text">
                                
                                                <div class="img-push">
                                
                                                  <input id="s_p_n_c_id" name="s_p_n_c_id" type="hidden" value="{!! $sharedProfileNoteComment -> id !!}">
                                                  <input id="status" name="status" type="hidden" value="on">
                                                  <input id="datetime" name="datetime" type="hidden" value="{!! $now !!}">
                                                  <input id="user_id" name="user_id" type="hidden" value="{!! $user_id !!}">
                                                  
                                                  <input id="shared_profile_note_comment_response_content_{!! $sharedProfileNoteComment -> id !!}" name="content" type="text" class="form-control input-sm" placeholder="Press enter to post comment">
                                
                                                </div>
                              
                                              </form>
                                              
                                            @endif
                          
                                          </div>
                                        
                                        @endif
                                        
                                      @endforeach
                                      
                                    @endif
                                  
                                  @endforeach
                                  
                                @endif
              
                              </div>
              
                              <div class="box-footer">
                                
                                @if(isset($user_id))
                
                                  <form id='shared_profile_note_comment' action = "{!! URL::to('/store_shared_profile_note_comment') !!}" method = "post">
              
                                    {{ csrf_field() }}
                    
                                    <img class="img-responsive img-circle img-sm" src="images/users/image_{!! $user_id !!}.{!! $user[0] -> image_type !!}" alt="Alt Text">
                    
                                    <div class="img-push">
                    
                                      <input id="s_p_n_id" name="s_p_n_id" type="hidden" value="{!! $sharedProfileNote -> id !!}">
                                      <input id="status" name="status" type="hidden" value="on">
                                      <input id="datetime" name="datetime" type="hidden" value="{!! $now !!}">
                                      <input id="user_id" name="user_id" type="hidden" value="{!! $user_id !!}">
                                      
                                      <input id="shared_profile_note_comment_content" name="content" type="text" class="form-control input-sm" placeholder="Press enter to post comment">
                    
                                    </div>
                  
                                  </form>
                                  
                                @endif
              
                              </div>
            
                            </div>
          
                          </div>
        
                        </div>
                        
                      @endforeach
                      
                      @foreach($sharedProfileImages as $sharedProfileImage)
                        
                        <div class="col-md-12" style="margin-top: 10px;">
          
                          <div class="box box-primary" style="margin-bottom: 10px;">
            
                            <div class="box-header with-border">
              
                              <div class="user-block">
                                
                                @if(isset($sharedProfileImageUsers))
                                
                                  @foreach($sharedProfileImageUsers as $sharedProfileImageUserArray)
                                  
                                    @if(isset($sharedProfileImageUserArray[0]))
                                    
                                      @if($sharedProfileImage -> user_id == $sharedProfileImageUserArray[0] -> id)
                                      
                                        <img class="img-circle" src="images/users/image_{!! $sharedProfileImage -> user_id !!}.{!! $sharedProfileImageUserArray[0] -> image_type !!}" alt="User Image">
                                    
                                        <span class="username"><a href="{!! route('sharedProfileUser.show', [$sharedProfileImage -> user_id]) !!}">{!! $sharedProfileImageUserArray[0] -> name !!}</a></span>
                                        
                                        <?php break; ?>
                                    
                                      @endif
                                      
                                    @endif
                                  
                                  @endforeach
                                  
                                @endif
                                
                                <span class="description">Shared publicly - {!! $sharedProfileImage -> created_at !!} </span>
              
                              </div>
              
                              <div class="box-tools">
                
                                <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Mark as read"><a href="{!! route('sharedProfileImages.show', [$sharedProfileImage -> id]) !!}"><i class="fa fa-eye"></i></a></button>
                
                                @if(isset($user_id))
                
                                  {!! Form::open(['route' => 'sharedProfileImageLikes.store', 'id' => 'shared_profile_image_like_create', 'style' => 'display: inline-block']) !!}
                                
                                    {!! Form::hidden('status', 'Status:') !!}
                                    {!! Form::hidden('status', 'on', ['class' => 'form-control']) !!}
                                    
                                    {!! Form::hidden('datetime', 'Datetime:') !!}
                                    {!! Form::hidden('datetime', $now, ['class' => 'form-control']) !!}
                                    
                                    {!! Form::hidden('s_p_i_id', 'Shared Profile Image Id:') !!}
                                    {!! Form::hidden('s_p_i_id', $sharedProfileImage -> id, ['class' => 'form-control']) !!}
                                    
                                    {!! Form::hidden('user_id', 'User Id:') !!}
                                    {!! Form::hidden('user_id', $user_id, ['class' => 'form-control']) !!}
                                    
                                    <button type="submit" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Mark as read"><i class="fa fa-thumbs-o-up"></i></button>
                  
                                  {!! Form::close() !!}
                                  
                                @endif
                                
                                <button type="button" class="btn btn-box-tool" data-toggle="collapse" data-target="#image_{!! $sharedProfileImage -> id !!}"><i class="fa fa-minus"></i></button>
              
                              </div>
            
                            </div>
            
                            <div id="image_{!! $sharedProfileImage -> id !!}" class="box-body">
              
                              <img src="/images/shared_profile_images/image_{!! $sharedProfileImage -> id !!}.{!! $sharedProfileImage -> file_type !!}" style="width: 100%; margin-bottom: 5px;">
                              
                              <p class="text-muted well well-sm no-shadow" style="margin-top: 10px; margin-bottom: 15px; text-align: justify;"> {!! $sharedProfileImage -> description  !!} </p>
              
                              <span class="pull-right text-muted" style="background: rgba(0,0,0,0.2); color: #fff; margin: 10px; padding: 0 5px;">
                                
                                @if(isset($sharedProfileImageLikes))
                                
                                  @foreach($sharedProfileImageLikes as $sharedProfileImageLikeArray)
                                    
                                    @if(isset($sharedProfileImageLikeArray[0]))
                                    
                                      @if($sharedProfileImage -> id == $sharedProfileImageLikeArray[0] -> s_p_i_id)
                                    
                                        {!! sizeof($sharedProfileImageLikeArray) !!} likes -
                                    
                                      @endif
                                      
                                    @endif
                                  
                                  @endforeach
                                  
                                @endif
                                
                                @if(isset($sharedProfileImageCommentCounts))
                              
                                  @foreach($sharedProfileImageCommentCounts as $sharedProfileImageCommentCountArray)
                
                                    @if(isset($sharedProfileImageCommentCountArray[0]))
                
                                      @if($sharedProfileImage -> id == $sharedProfileImageCommentCountArray[0] -> s_p_i_id)
                                    
                                        {!! sizeof($sharedProfileImageCommentCountArray) !!} comments
                                    
                                      @endif
                                      
                                    @endif
                                  
                                  @endforeach
                                
                                @endif
                                
                              </span>
                              
                              <div class="box-footer box-comments" style="padding-top: 40px;">
              
                                @if(isset($sharedProfileImageComments))
              
                                  @foreach($sharedProfileImageComments as $sharedProfileImageCommentArray)
                
                                    @if(isset($sharedProfileImageCommentArray[0]))
                
                                      @foreach($sharedProfileImageCommentArray as $sharedProfileImageComment)
                  
                                        @if($sharedProfileImage -> id == $sharedProfileImageComment -> s_p_i_id)
                  
                                          <div class="box-comment">
                                            
                                            @if(isset($sharedProfileImageCommentUsers))
                                            
                                              @foreach($sharedProfileImageCommentUsers as $sharedProfileImageCommentUserArray)
                                              
                                                @if(isset($sharedProfileImageCommentUserArray[0]))
                                          
                                                  @foreach($sharedProfileImageCommentUserArray as $sharedProfileImageCommentUser)
                                          
                                                    @if($sharedProfileImageComment -> user_id == $sharedProfileImageCommentUser -> user_id && $sharedProfileImageComment -> id == $sharedProfileImageCommentUser -> id)
        
                                                      <img class="img-circle img-sm" src="images/users/image_{!! $sharedProfileImageComment -> user_id !!}.{!! $sharedProfileImageCommentUser -> image_type !!}" alt="User Image">
                                                      
                                                      <?php break; ?>
                                            
                                                    @endif
                                                        
                                                  @endforeach
                                                  
                                                @endif
                                      
                                              @endforeach
                                              
                                            @endif
            
                                            <div class="comment-text" style="text-align:justify; padding-right: 10px;">
                                  
                                              <a href="{!! route('sharedProfileUser.show', [$sharedProfileImageComment -> user_id]) !!}">
                                  
                                                <span class="username">
                                                
                                                  @if(isset($sharedProfileImageCommentUsers))
                                                  
                                                    @foreach($sharedProfileImageCommentUsers as $sharedProfileImageCommentUserArray)
                                                    
                                                      @if(isset($sharedProfileImageCommentUserArray[0]))
                                          
                                                        @foreach($sharedProfileImageCommentUserArray as $sharedProfileImageCommentUser)
                                            
                                                          @if($sharedProfileImageComment -> user_id == $sharedProfileImageCommentUser -> user_id && $sharedProfileImageComment -> id == $sharedProfileImageCommentUser -> id)
                                              
                                                            {!! $sharedProfileImageCommentUser -> name !!}
                                                  
                                                            <?php break; ?>
                                              
                                                          @endif
                                                          
                                                        @endforeach
                                                        
                                                      @endif
                                        
                                                    @endforeach
                                                    
                                                  @endif
                                      
                                                  <span class="text-muted pull-right" style="background: rgba(0,0,0,0.1); color: #000; padding: 0 5px;">{!! $sharedProfileImageComment -> datetime !!}</span>
                                    
                                                </span>
                                                
                                              </a>
                              
                                              {!! $sharedProfileImageComment -> content !!}
                                              
                                            </div>
                                            
                                            @if(isset($sharedProfileImageCommentResponses))
                                            
                                              @foreach($sharedProfileImageCommentResponses as $sharedProfileImageCommentResponseArray)
                                              
                                                @if(isset($sharedProfileImageCommentResponseArray[0]))
                      
                                                  @foreach($sharedProfileImageCommentResponseArray as $sharedProfileImageCommentResponse)
                      
                                                    @if($sharedProfileImageComment -> id == $sharedProfileImageCommentResponse -> s_p_i_c_id)
                                                
                                                      <div style="margin-left: 10px;" class="box-comment">
                                                        
                                                        @if(isset($sharedProfileImageCommentResponseUsers))
                                      
                                                          @foreach($sharedProfileImageCommentResponseUsers as $sharedProfileImageCommentResponseUserArray)
                                                          
                                                            @if(isset($sharedProfileImageCommentResponseUserArray[0]))
                                            
                                                              @foreach($sharedProfileImageCommentResponseUserArray as $sharedProfileImageCommentResponseUser)
                                                      
                                                                @if($sharedProfileImageCommentResponse -> user_id == $sharedProfileImageCommentResponseUser -> user_id && $sharedProfileImageCommentResponse -> id == $sharedProfileImageCommentResponseUser -> id)
            
                                                                  <img class="img-circle img-sm" src="images/users/image_{!! $sharedProfileImageCommentResponse -> user_id !!}.{!! $sharedProfileImageCommentResponseUser -> image_type !!}" alt="User Image">
                            
                                                                  <?php break; ?>
                                                        
                                                                @endif
                                                                    
                                                              @endforeach
                                                              
                                                            @endif
                                                  
                                                          @endforeach
                                                          
                                                        @endif
                        
                                                        <div class="comment-text" style="text-align:justify; padding-right: 10px;">
                                                          
                                                          <a href="{!! route('sharedProfileUser.show', [$sharedProfileImageCommentResponse -> user_id]) !!}">
                                              
                                                            <span class="username">
                                                              
                                                              @if(isset($sharedProfileImageCommentResponseUsers))
                                                              
                                                                @foreach($sharedProfileImageCommentResponseUsers as $sharedProfileImageCommentResponseUserArray)
                                                                
                                                                  @if(isset($sharedProfileImageCommentResponseUserArray[0]))
                                              
                                                                    @foreach($sharedProfileImageCommentResponseUserArray as $sharedProfileImageCommentResponseUser)
                                                        
                                                                      @if($sharedProfileImageCommentResponse -> user_id == $sharedProfileImageCommentResponseUser -> user_id && $sharedProfileImageCommentResponse -> id == $sharedProfileImageCommentResponseUser -> id)
                                                          
                                                                        {!! $sharedProfileImageCommentResponseUser -> name !!}
                                                              
                                                                        <?php break; ?>
                                                          
                                                                      @endif
                                                                      
                                                                    @endforeach
                                                                    
                                                                  @endif
                                                    
                                                                @endforeach
                                                                
                                                              @endif
                                                  
                                                              <span class="text-muted pull-right" style="background: rgba(0,0,0,0.1); color: #000; padding: 0 5px;">{!! $sharedProfileImageCommentResponse -> datetime !!}</span>
                                                
                                                            </span>

                                                          </a>
                                          
                                                          {!! $sharedProfileImageCommentResponse -> content !!}
                                                          
                                                        </div>
                                      
                                                      </div>
                              
                                                    @endif
                                            
                                                  @endforeach
                                                  
                                                @endif
                                      
                                              @endforeach
                                              
                                            @endif
                          
                                          </div>
                                          
                                          <div class="box-footer">
                                    
                                            @if(isset($user_id))
                                    
                                              <form id='shared_profile_image_comment_response_{!! $sharedProfileImageComment -> id !!}' action = "{!! URL::to('/store_shared_profile_image_comment_response') !!}" method = "post">
                          
                                                {{ csrf_field() }}
                                
                                                <img class="img-responsive img-circle img-sm" src="images/users/image_{!! $user_id !!}.{!! $user[0] -> image_type !!}" alt="Alt Text">
                                
                                                <div class="img-push">
                                
                                                  <input id="s_p_i_c_id" name="s_p_i_c_id" type="hidden" value="{!! $sharedProfileImageComment -> id !!}">
                                                  <input id="status" name="status" type="hidden" value="on">
                                                  <input id="datetime" name="datetime" type="hidden" value="{!! $now !!}">
                                                  <input id="user_id" name="user_id" type="hidden" value="{!! $user_id !!}">
                                                  
                                                  <input id="shared_profile_image_comment_response_content_{!! $sharedProfileImageComment -> id !!}" name="content" type="text" class="form-control input-sm" placeholder="Press enter to post comment">
                                
                                                </div>
                              
                                              </form>
                                              
                                            @endif
                          
                                          </div>
                                        
                                        @endif
                                        
                                      @endforeach
                                      
                                    @endif
                                  
                                  @endforeach
                                  
                                @endif
              
                              </div>
              
                              <div class="box-footer">
                
                                @if(isset($user_id))
                
                                  <form id='shared_profile_image_comment' action = "{!! URL::to('/store_shared_profile_image_comment') !!}" method = "post">
              
                                    {{ csrf_field() }}
                    
                                    <img class="img-responsive img-circle img-sm" src="images/users/image_{!! $user_id !!}.{!! $user[0] -> image_type !!}" alt="Alt Text">
                    
                                    <div class="img-push">
                    
                                      <input id="s_p_i_id" name="s_p_i_id" type="hidden" value="{!! $sharedProfileImage -> id !!}">
                                      <input id="status" name="status" type="hidden" value="on">
                                      <input id="datetime" name="datetime" type="hidden" value="{!! $now !!}">
                                      <input id="user_id" name="user_id" type="hidden" value="{!! $user_id !!}">
                                      
                                      <input id="shared_profile_image_comment_content" name="content" type="text" class="form-control input-sm" placeholder="Press enter to post comment">
                    
                                    </div>
                  
                                  </form>
                                
                                @endif
              
                              </div>
            
                            </div>
          
                          </div>
        
                        </div>
                        
                      @endforeach
                        
                      @foreach($sharedProfileAudios as $sharedProfileAudio)
                        
                        <div class="col-md-12" style="margin-top: 10px;">
          
                          <div class="box box-primary" style="margin-bottom: 10px;">
            
                            <div class="box-header with-border">
              
                              <div class="user-block">
                                
                                @if(isset($sharedProfileAudioUsers))
                                
                                  @foreach($sharedProfileAudioUsers as $sharedProfileAudioUserArray)
                                  
                                    @if(isset($sharedProfileAudioUserArray[0]))
                                    
                                      @if($sharedProfileAudio -> user_id == $sharedProfileAudioUserArray[0] -> id)
                                    
                                        <img class="img-circle" src="images/users/image_{!! $sharedProfileAudio -> user_id !!}.{!! $sharedProfileAudioUserArray[0] -> image_type !!}" alt="User Image">
                                    
                                        <span class="username"><a href="{!! route('sharedProfileUser.show', [$sharedProfileAudio -> user_id]) !!}">{!! $sharedProfileAudioUserArray[0] -> name !!}</a></span>
                                        
                                        <?php break; ?>
                                    
                                      @endif
                                      
                                    @endif
                                  
                                  @endforeach
                                  
                                @endif
                                
                                <span class="description">Shared publicly - {!! $sharedProfileAudio -> created_at !!} </span>
              
                              </div>
              
                              <div class="box-tools">
                  
                                <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Mark as read"><a href="{!! route('sharedProfileAudios.show', [$sharedProfileAudio -> id]) !!}"><i class="fa fa-eye"></i></a></button>
                
                                @if(isset($user_id))
                
                                  {!! Form::open(['route' => 'sharedProfileAudioLikes.store', 'id' => 'shared_profile_audio_like_create', 'style' => 'display: inline-block']) !!}
                                
                                    {!! Form::hidden('status', 'Status:') !!}
                                    {!! Form::hidden('status', 'on', ['class' => 'form-control']) !!}
                                    
                                    {!! Form::hidden('datetime', 'Datetime:') !!}
                                    {!! Form::hidden('datetime', $now, ['class' => 'form-control']) !!}
                                    
                                    {!! Form::hidden('s_p_a_id', 'Shared Profile Audio Id:') !!}
                                    {!! Form::hidden('s_p_a_id', $sharedProfileAudio -> id, ['class' => 'form-control']) !!}
                                    
                                    {!! Form::hidden('user_id', 'User Id:') !!}
                                    {!! Form::hidden('user_id', $user_id, ['class' => 'form-control']) !!}
                                    
                                    <button type="submit" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Mark as read"><i class="fa fa-thumbs-o-up"></i></button>
                  
                                  {!! Form::close() !!}
                                  
                                @endif
                                
                                <button type="button" class="btn btn-box-tool" data-toggle="collapse" data-target="#audio_{!! $sharedProfileAudio -> id  !!}"><i class="fa fa-minus"></i></button>
              
                              </div>
            
                            </div>
            
                            <div id="audio_{!! $sharedProfileAudio -> id !!}" class="box-body">
              
                              <audio style="width: 100%; padding: 5px;" controls>
  
                                <source src="/audios/shared_profile_audios/audio_{!! $sharedProfileAudio -> id !!}.{!! $sharedProfileAudio -> file_type !!}" type="audio/{!! $sharedProfileAudio -> file_type !!}">

                                Your browser does not support the audio element.

                              </audio>
                              
                              <p class="text-muted well well-sm no-shadow" style="margin-top: 10px; margin-bottom: 15px; text-align: justify;"> {!! $sharedProfileAudio -> description  !!} </p>
              
                              <span class="pull-right text-muted" style="background: rgba(0,0,0,0.2); color: #fff; margin: 10px; padding: 0 5px;">
                                
                                @if(isset($sharedProfileAudioLikes))
                                
                                  @foreach($sharedProfileAudioLikes as $sharedProfileAudioLikeArray)
                                    
                                    @if(isset($sharedProfileAudioLikeArray[0]))
                                    
                                      @if($sharedProfileAudio -> id == $sharedProfileAudioLikeArray[0] -> s_p_a_id)
                                    
                                        {!! sizeof($sharedProfileAudioLikeArray) !!} likes -
                                    
                                      @endif
                                      
                                    @endif
                                  
                                  @endforeach
                                  
                                @endif
                                
                                @if(isset($sharedProfileAudioCommentCounts))
                                
                                  @foreach($sharedProfileAudioCommentCounts as $sharedProfileAudioCommentCountArray)
                
                                    @if(isset($sharedProfileAudioCommentCountArray[0]))
                
                                      @if($sharedProfileAudio -> id == $sharedProfileAudioCommentCountArray[0] -> s_p_a_id)
                                    
                                        {!! sizeof($sharedProfileAudioCommentCountArray) !!} comments
                                    
                                      @endif
                                      
                                    @endif
                                  
                                  @endforeach
                                
                                @endif
                                
                              </span>
                              
                              <div class="box-footer box-comments" style="padding-top: 40px;">
                                
                                @if(isset($sharedProfileAudioComments))
              
                                  @foreach($sharedProfileAudioComments as $sharedProfileAudioCommentArray)
                                  
                                    @if(isset($sharedProfileAudioCommentArray[0]))
                
                                      @foreach($sharedProfileAudioCommentArray as $sharedProfileAudioComment)
                  
                                        @if($sharedProfileAudio -> id == $sharedProfileAudioComment -> s_p_a_id)
                  
                                          <div class="box-comment">
                                            
                                            @if(isset($sharedProfileAudioCommentUsers))
                            
                                              @foreach($sharedProfileAudioCommentUsers as $sharedProfileAudioCommentUserArray)
                                              
                                                @if(isset($sharedProfileAudioCommentUserArray[0]))
                                        
                                                  @foreach($sharedProfileAudioCommentUserArray as $sharedProfileAudioCommentUser)
                                          
                                                    @if($sharedProfileAudioComment -> user_id == $sharedProfileAudioCommentUser -> user_id && $sharedProfileAudioComment -> id == $sharedProfileAudioCommentUser -> id)
        
                                                      <img class="img-circle img-sm" src="images/users/image_{!! $sharedProfileAudioComment -> user_id !!}.{!! $sharedProfileAudioCommentUser -> image_type  !!}" alt="User Image">
                
                                                      <?php break; ?>
                
                                                    @endif
                                                    
                                                  @endforeach
                                                  
                                                @endif
                                                
                                              @endforeach
                                              
                                            @endif
            
                                            <div class="comment-text" style="text-align:justify; padding-right: 10px;">
                                              
                                              <a href="{!! route('sharedProfileUser.show', [$sharedProfileAudioComment -> user_id]) !!}">
                                  
                                                <span class="username">
                                                  
                                                  @if(isset($sharedProfileAudioCommentUsers))
                                                  
                                                    @foreach($sharedProfileAudioCommentUsers as $sharedProfileAudioCommentUserArray)
                                                    
                                                      @if(isset($sharedProfileAudioCommentUserArray[0]))
                                          
                                                        @foreach($sharedProfileAudioCommentUserArray as $sharedProfileAudioCommentUser)
                                            
                                                          @if($sharedProfileAudioComment -> user_id == $sharedProfileAudioCommentUser -> user_id && $sharedProfileAudioComment -> id == $sharedProfileAudioCommentUser -> id)
                                              
                                                            {!! $sharedProfileAudioCommentUser -> name !!}
                                                  
                                                            <?php break; ?>
                                              
                                                          @endif
                                                        
                                                        @endforeach
                                        
                                                      @endif
                                        
                                                    @endforeach
                                                    
                                                  @endif
                                      
                                                  <span class="text-muted pull-right" style="background: rgba(0,0,0,0.1); color: #000; padding: 0 5px;">{!! $sharedProfileAudioComment -> datetime !!}</span>
                                    
                                                </span>
                                                
                                              </a>
                              
                                              {!! $sharedProfileAudioComment -> content !!}
                                              
                                            </div>
                                            
                                            @if(isset($sharedProfileAudioCommentResponses))
                                            
                                              @foreach($sharedProfileAudioCommentResponses as $sharedProfileAudioCommentResponseArray)
                                              
                                                @if(isset($sharedProfileAudioCommentResponseArray[0]))
                      
                                                  @foreach($sharedProfileAudioCommentResponseArray as $sharedProfileAudioCommentResponse)
                      
                                                    @if($sharedProfileAudioComment -> id == $sharedProfileAudioCommentResponse -> s_p_a_c_id)
                                                
                                                      <div style="margin-left: 10px;" class="box-comment">
                                                        
                                                        @if(isset($sharedProfileAudioCommentResponseUsers))
                                                        
                                                          @foreach($sharedProfileAudioCommentResponseUsers as $sharedProfileAudioCommentResponseUserArray)
                                                          
                                                            @if(isset($sharedProfileAudioCommentResponseUserArray[0]))
                                            
                                                              @foreach($sharedProfileAudioCommentResponseUserArray as $sharedProfileAudioCommentResponseUser)
                                                      
                                                                @if($sharedProfileAudioCommentResponse -> user_id == $sharedProfileAudioCommentResponseUser -> user_id && $sharedProfileAudioCommentResponse -> id == $sharedProfileAudioCommentResponseUser -> id)
            
                                                                  <img class="img-circle img-sm" src="images/users/image_{!! $sharedProfileAudioCommentResponse -> user_id !!}.{!! $sharedProfileAudioCommentResponseUser -> image_type !!}" alt="User Image">
                            
                                                                  <?php break; ?>
                                                        
                                                                @endif
                                                                    
                                                              @endforeach
                                                              
                                                            @endif
                                                  
                                                          @endforeach
                                                          
                                                        @endif
                        
                                                        <div class="comment-text" style="text-align:justify; padding-right: 10px;">
                                                          
                                                          <a href="{!! route('sharedProfileUser.show', [$sharedProfileAudioCommentResponse -> user_id]) !!}">
                                              
                                                            <span class="username">
                                                              
                                                              @if(isset($sharedProfileAudioCommentResponseUsers))
                                                              
                                                                @foreach($sharedProfileAudioCommentResponseUsers as $sharedProfileAudioCommentResponseUserArray)
                                                                
                                                                  @if(isset($sharedProfileAudioCommentResponseArray[0]))
                                              
                                                                    @foreach($sharedProfileAudioCommentResponseUserArray as $sharedProfileAudioCommentResponseUser)
                                                        
                                                                      @if($sharedProfileAudioCommentResponse -> user_id == $sharedProfileAudioCommentResponseUser -> user_id && $sharedProfileAudioCommentResponse -> id == $sharedProfileAudioCommentResponseUser -> id)
                                                          
                                                                        {!! $sharedProfileAudioCommentResponseUser -> name !!}
                                                              
                                                                        <?php break; ?>
                                                          
                                                                      @endif
                                                                      
                                                                    @endforeach
                                                                    
                                                                  @endif
                                                    
                                                                @endforeach
                                                                
                                                              @endif
                                                  
                                                              <span class="text-muted pull-right" style="background: rgba(0,0,0,0.1); color: #000; padding: 0 5px;">{!! $sharedProfileAudioCommentResponse -> datetime !!}</span>
                                                
                                                            </span>
                                                            
                                                          </a>
                                          
                                                          {!! $sharedProfileAudioCommentResponse -> content !!}
                                                          
                                                        </div>
                                      
                                                      </div>
                                                      
                                                    @endif
                                            
                                                  @endforeach
                                                  
                                                @endif
                                      
                                              @endforeach
                                              
                                            @endif
                          
                                          </div>
                                          
                                          <div class="box-footer">
                                    
                                            @if(isset($user_id))
                                    
                                              <form id='shared_profile_audio_comment_response_{!! $sharedProfileAudioComment -> id !!}' action = "{!! URL::to('/store_shared_profile_audio_comment_response') !!}" method = "post">
                          
                                                {{ csrf_field() }}
                                
                                                <img class="img-responsive img-circle img-sm" src="images/users/image_{!! $user_id !!}.{!! $user[0] -> image_type !!}" alt="Alt Text">
                                
                                                <div class="img-push">
                                
                                                  <input id="s_p_a_c_id" name="s_p_a_c_id" type="hidden" value="{!! $sharedProfileAudioComment -> id !!}">
                                                  <input id="status" name="status" type="hidden" value="on">
                                                  <input id="datetime" name="datetime" type="hidden" value="{!! $now !!}">
                                                  <input id="user_id" name="user_id" type="hidden" value="{!! $user_id !!}">
                                                  
                                                  <input id="shared_profile_audio_comment_response_content_{!! $sharedProfileAudioComment -> id !!}" name="content" type="text" class="form-control input-sm" placeholder="Press enter to post comment">
                                
                                                </div>
                              
                                              </form>
                                              
                                            @endif
                          
                                          </div>
                                        
                                        @endif
                                        
                                      @endforeach
                                      
                                    @endif
                                
                                  @endforeach
                                  
                                @endif
              
                              </div>
              
                              <div class="box-footer">
                                
                                @if(isset($user_id))
                
                                  <form id='shared_profile_audio_comment' action = "{!! URL::to('/store_shared_profile_audio_comment') !!}" method = "post">
              
                                    {{ csrf_field() }}
                    
                                    <img class="img-responsive img-circle img-sm" src="images/users/image_{!! $user_id !!}.{!! $user[0] -> image_type !!}" alt="Alt Text">
                    
                                    <div class="img-push">
                    
                                      <input id="s_p_a_id" name="s_p_a_id" type="hidden" value="{!! $sharedProfileAudio -> id !!}">
                                      <input id="status" name="status" type="hidden" value="on">
                                      <input id="datetime" name="datetime" type="hidden" value="{!! $now !!}">
                                      <input id="user_id" name="user_id" type="hidden" value="{!! $user_id !!}">
                                      
                                      <input id="shared_profile_audio_comment_content" name="content" type="text" class="form-control input-sm" placeholder="Press enter to post comment">
                    
                                    </div>
                  
                                  </form>
                                  
                                @endif
              
                              </div>
            
                            </div>
          
                          </div>
        
                        </div>
                        
                      @endforeach
                      
                      @foreach($sharedProfileVideos as $sharedProfileVideo)
                        
                        <div class="col-md-12" style="margin-top: 10px;">
          
                          <div class="box box-primary" style="margin-bottom: 10px;">
            
                            <div class="box-header with-border">
              
                              <div class="user-block">
                                
                                @if(isset($sharedProfileVideoUsers))
                              
                                  @foreach($sharedProfileVideoUsers as $sharedProfileVideoUserArray)
                                  
                                    @if(isset($sharedProfileVideoUserArray[0]))
                                    
                                      @if($sharedProfileVideo -> user_id == $sharedProfileVideoUserArray[0] -> id)
                                      
                                        <img class="img-circle" src="images/users/image_{!! $sharedProfileVideo -> user_id !!}.{!! $sharedProfileVideoUserArray[0] -> image_type !!}" alt="User Image">
                                    
                                        <span class="username"><a href="{!! route('sharedProfileUser.show', [$sharedProfileVideo -> user_id]) !!}">{!! $sharedProfileVideoUserArray[0] -> name !!}</a></span>
                                        
                                        <?php break; ?>
                                    
                                      @endif
                                      
                                    @endif
                                  
                                  @endforeach
                                  
                                @endif
                                
                                <span class="description">Shared publicly - {!! $sharedProfileVideo -> created_at !!}</span>
              
                              </div>
              
                              <div class="box-tools">
                
                                <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Mark as read"><a href="{!! route('sharedProfileVideos.show', [$sharedProfileVideo -> id]) !!}"><i class="fa fa-eye"></i></a></button>
                
                                @if(isset($user_id))
                
                                  {!! Form::open(['route' => 'sharedProfileVideoLikes.store', 'id' => 'shared_profile_video_like_create', 'style' => 'display: inline-block']) !!}
                                
                                    {!! Form::hidden('status', 'Status:') !!}
                                    {!! Form::hidden('status', 'on', ['class' => 'form-control']) !!}
                                    
                                    {!! Form::hidden('datetime', 'Datetime:') !!}
                                    {!! Form::hidden('datetime', $now, ['class' => 'form-control']) !!}
                                    
                                    {!! Form::hidden('s_p_v_id', 'Shared Profile Video Id:') !!}
                                    {!! Form::hidden('s_p_v_id', $sharedProfileVideo -> id, ['class' => 'form-control']) !!}
                                    
                                    {!! Form::hidden('user_id', 'User Id:') !!}
                                    {!! Form::hidden('user_id', $user_id, ['class' => 'form-control']) !!}
                                    
                                    <button type="submit" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Mark as read"><i class="fa fa-thumbs-o-up"></i></button>
                  
                                  {!! Form::close() !!}
                                  
                                @endif
                                
                                <button type="button" class="btn btn-box-tool" data-toggle="collapse" data-target="#video_{!! $sharedProfileVideo -> id  !!}"><i class="fa fa-minus"></i></button>
              
                              </div>
            
                            </div>
            
                            <div id="video_{!! $sharedProfileVideo -> id  !!}" class="box-body">
              
                              <video width="100%" style="margin-bottom: 5px;" controls>
                    
                                <source src="/videos/shared_profile_videos/video_{!! $sharedProfileVideo -> id !!}.{!! $sharedProfileVideo -> file_type !!}" type="video/mp4">
                  
                              </video>
                              
                              <p class="text-muted well well-sm no-shadow" style="margin-top: 10px; margin-bottom: 15px; text-align: justify;"> {!! $sharedProfileVideo -> description  !!} </p>
              
                              <span class="pull-right text-muted" style="background: rgba(0,0,0,0.2); color: #fff; margin: 10px; padding: 0 5px;">
                                
                                @if(isset($sharedProfileVideoLikes))
                                
                                  @foreach($sharedProfileVideoLikes as $sharedProfileVideoLikeArray)
                                    
                                    @if(isset($sharedProfileVideoLikeArray[0]))
                                    
                                      @if($sharedProfileVideo -> id == $sharedProfileVideoLikeArray[0] -> s_p_v_id)
                                    
                                        {!! sizeof($sharedProfileVideoLikeArray) !!} likes -
                                    
                                      @endif
                                      
                                    @endif
                                  
                                  @endforeach
                                  
                                @endif
                                
                                @if(isset($sharedProfileVideoCommentCounts))
                                
                                  @foreach($sharedProfileVideoCommentCounts as $sharedProfileVideoCommentCountArray)
                
                                    @if(isset($sharedProfileVideoCommentCountArray[0]))
                
                                      @if($sharedProfileVideo -> id == $sharedProfileVideoCommentCountArray[0] -> s_p_v_id)
                                    
                                        {!! sizeof($sharedProfileVideoCommentCountArray) !!} comments
                                    
                                      @endif
                                      
                                    @endif
                                  
                                  @endforeach
                                  
                                @endif
                                
                              </span>
            
                              <div class="box-footer box-comments" style="padding-top: 40px;">
                                
                                @if(isset($sharedProfileVideoComments))
              
                                  @foreach($sharedProfileVideoComments as $sharedProfileVideoCommentArray)
                                  
                                    @if(isset($sharedProfileVideoCommentArray[0]))
                
                                      @foreach($sharedProfileVideoCommentArray as $sharedProfileVideoComment)
                  
                                        @if($sharedProfileVideo -> id == $sharedProfileVideoComment -> s_p_v_id)
                  
                                          <div class="box-comment">
                                            
                                            @if(isset($sharedProfileVideoCommentUsers))
                            
                                              @foreach($sharedProfileVideoCommentUsers as $sharedProfileVideoCommentUserArray)
                                              
                                                @if(isset($sharedProfileVideoCommentUserArray[0]))
                                        
                                                  @foreach($sharedProfileVideoCommentUserArray as $sharedProfileVideoCommentUser)
                                          
                                                    @if($sharedProfileVideoComment -> user_id == $sharedProfileVideoCommentUser -> user_id && $sharedProfileVideoComment -> id == $sharedProfileVideoCommentUser -> id)
        
                                                      <img class="img-circle img-sm" src="images/users/image_{!! $sharedProfileVideoComment -> user_id !!}.{!! $sharedProfileVideoCommentUser -> image_type !!}" alt="User Image">
              
                                                      <?php break; ?>
                                            
                                                    @endif
                                                        
                                                  @endforeach
                                                  
                                                @endif
                                      
                                              @endforeach
                                              
                                            @endif
                
                                            <div class="comment-text" style="text-align:justify; padding-right: 10px;">
                                              
                                              <a href="{!! route('sharedProfileUser.show', [$sharedProfileVideoComment -> user_id]) !!}">
                                  
                                                <span class="username">
                                                  
                                                  @if(isset($sharedProfileVideoCommentUsers))
                                                  
                                                    @foreach($sharedProfileVideoCommentUsers as $sharedProfileVideoCommentUserArray)
                                                    
                                                      @if(isset($sharedProfileVideoCommentUserArray[0]))
                                          
                                                        @foreach($sharedProfileVideoCommentUserArray as $sharedProfileVideoCommentUser)
                                            
                                                          @if($sharedProfileVideoComment -> user_id == $sharedProfileVideoCommentUser -> user_id && $sharedProfileVideoComment -> id == $sharedProfileVideoCommentUser -> id)
                                              
                                                            {!! $sharedProfileVideoCommentUser -> name !!}
                                                  
                                                            <?php break; ?>
                                              
                                                          @endif
                                                          
                                                        @endforeach
                                                      
                                                      @endif
                                        
                                                    @endforeach
                                                    
                                                  @endif
                                      
                                                  <span class="text-muted pull-right" style="background: rgba(0,0,0,0.1); color: #000; padding: 0 5px;">{!! $sharedProfileVideoComment -> datetime !!}</span>
                                    
                                                </span>
                                                
                                              </a>
                              
                                              {!! $sharedProfileVideoComment -> content !!}
                                              
                                            </div>
                  
                                            @if(isset($sharedProfileVideoCommentResponses))
                                            
                                              @foreach($sharedProfileVideoCommentResponses as $sharedProfileVideoCommentResponseArray)
                                              
                                                @if(isset($sharedProfileVideoCommentResponseArray[0]))
                    
                                                  @foreach($sharedProfileVideoCommentResponseArray as $sharedProfileVideoCommentResponse)
                      
                                                    @if($sharedProfileVideoComment -> id == $sharedProfileVideoCommentResponse -> s_p_v_c_id)
                                                
                                                      <div style="margin-left: 10px;" class="box-comment">
                                                        
                                                        @if(isset($sharedProfileVideoCommentResponseUsers))
                                      
                                                          @foreach($sharedProfileVideoCommentResponseUsers as $sharedProfileVideoCommentResponseUserArray)
                                                          
                                                            @if(isset($sharedProfileVideoCommentResponseUserArray[0]))
                                            
                                                              @foreach($sharedProfileVideoCommentResponseUserArray as $sharedProfileVideoCommentResponseUser)
                                                      
                                                                @if($sharedProfileVideoCommentResponse -> user_id == $sharedProfileVideoCommentResponseUser -> user_id && $sharedProfileVideoCommentResponse -> id == $sharedProfileVideoCommentResponseUser -> id)
            
                                                                  <img class="img-circle img-sm" src="images/users/image_{!! $sharedProfileVideoCommentResponse -> user_id !!}.{!! $sharedProfileVideoCommentResponseUser -> image_type !!}" alt="User Image">
                            
                                                                  <?php break; ?>
                                                        
                                                                @endif
                                                                    
                                                              @endforeach
                                                              
                                                            @endif
                                                  
                                                          @endforeach
                                                          
                                                        @endif
                        
                                                        <div class="comment-text" style="text-align:justify; padding-right: 10px;">
                                                          
                                                          <a href="{!! route('sharedProfileUser.show', [$sharedProfileVideoCommentResponse -> user_id]) !!}">
                                              
                                                            <span class="username">
                                                              
                                                              @if(isset($sharedProfileVideoCommentResponseUsers))
                                                              
                                                                @foreach($sharedProfileVideoCommentResponseUsers as $sharedProfileVideoCommentResponseUserArray)
                                                                
                                                                  @if(isset($sharedProfileVideoCommentResponseUserArray[0]))
                                              
                                                                    @foreach($sharedProfileVideoCommentResponseUserArray as $sharedProfileVideoCommentResponseUser)
                                                        
                                                                      @if($sharedProfileVideoCommentResponse -> user_id == $sharedProfileVideoCommentResponseUser -> user_id && $sharedProfileVideoCommentResponse -> id == $sharedProfileVideoCommentResponseUser -> id)
                                                          
                                                                        {!! $sharedProfileVideoCommentResponseUser -> name !!}
                                                              
                                                                        <?php break; ?>
                                                          
                                                                      @endif
                                                                      
                                                                    @endforeach
                                                                    
                                                                  @endif
                                                    
                                                                @endforeach
                                                                
                                                              @endif
                                                  
                                                              <span class="text-muted pull-right" style="background: rgba(0,0,0,0.1); color: #000; padding: 0 5px;">{!! $sharedProfileVideoCommentResponse -> datetime !!}</span>
                                                
                                                            </span>
                                                            
                                                          </a>
                                          
                                                          {!! $sharedProfileVideoCommentResponse -> content !!}
                                                          
                                                        </div>
                                      
                                                      </div>
                              
                                                    @endif
                                            
                                                  @endforeach
                                                  
                                                @endif
                                      
                                              @endforeach
                          
                                            @endif
                          
                                          </div>
                                          
                                          <div class="box-footer">
                                    
                                            @if(isset($user_id))
                                    
                                              <form id='shared_profile_video_comment_response_{!! $sharedProfileVideoComment -> id !!}' action = "{!! URL::to('/store_shared_profile_video_comment_response') !!}" method = "post">
                          
                                                {{ csrf_field() }}
                                
                                                <img class="img-responsive img-circle img-sm" src="images/users/image_{!! $user_id !!}.{!! $user[0] -> image_type !!}" alt="Alt Text">
                                
                                                <div class="img-push">
                                
                                                  <input id="s_p_v_c_id" name="s_p_v_c_id" type="hidden" value="{!! $sharedProfileVideoComment -> id !!}">
                                                  <input id="status" name="status" type="hidden" value="on">
                                                  <input id="datetime" name="datetime" type="hidden" value="{!! $now !!}">
                                                  <input id="user_id" name="user_id" type="hidden" value="{!! $user_id !!}">
                                                  
                                                  <input id="shared_profile_video_comment_response_content_{!! $sharedProfileVideoComment -> id !!}" name="content" type="text" class="form-control input-sm" placeholder="Press enter to post comment">
                                
                                                </div>
                              
                                              </form>
                                              
                                            @endif
                          
                                          </div>
                                        
                                        @endif
                                        
                                      @endforeach
                                      
                                    @endif
                                  
                                  @endforeach
                                  
                                @endif
              
                              </div>
              
                              <div class="box-footer">
                
                                @if(isset($user_id))
                
                                  <form id='shared_profile_video_comment' action = "{!! URL::to('/store_shared_profile_video_comment') !!}" method = "post">
              
                                    {{ csrf_field() }}
                    
                                    <img class="img-responsive img-circle img-sm" src="images/users/image_{!! $user_id !!}.{!! $user[0] -> image_type !!}" alt="Alt Text">
                    
                                    <div class="img-push">
                    
                                      <input id="s_p_v_id" name="s_p_v_id" type="hidden" value="{!! $sharedProfileVideo -> id !!}">
                                      <input id="status" name="status" type="hidden" value="on">
                                      <input id="datetime" name="datetime" type="hidden" value="{!! $now !!}">
                                      <input id="user_id" name="user_id" type="hidden" value="{!! $user_id !!}">
                                      
                                      <input id="shared_profile_video_comment_content" name="content" type="text" class="form-control input-sm" placeholder="Press enter to post comment">
                    
                                    </div>
                  
                                  </form>
                                  
                                @endif
              
                              </div>
            
                            </div>
        
                          </div>
        
                        </div>
                        
                      @endforeach
                        
                    </div>
                    
                  </div>

                </div>
                
                <div class = "tab-pane" id = "shared_profiles_section" style="margin: 10px;">
                  
                  <div class="box box-primary" style="margin-bottom: 10px;">
            
                    <div class="box-body" style="padding-bottom: 0;">
    
                      <div class="row">
     
                        <div class="col-md-12" style="margin-top: 10px; margin-bottom: 20px;">
                          
                          @if(isset($sharedProfiles))
                
                            @foreach($sharedProfiles as $sharedProfile)
                  
                              <div class="col-md-4">
                                
                                <div class="box box-primary" style="margin-bottom: 0;">
                              
                                  <div class="box-header with-border">
                                
                                    <div class="user-block">
                                      
                                      <img class="img-circle" src="images/users/image_{!! $sharedProfile -> user_id !!}.gif" alt="User Image">
                                      
                                      <span class="username"><a href="http://www.desmus.com.mx/sharedProfileUser/{!! $sharedProfile -> id !!}">{!! $sharedProfile -> name !!}</a></span>
                                      <span class="description">Shared prodile - {!! $sharedProfile -> created_at !!}</span>
                                      
                                      <!-- Check datetime -->
                                
                                    </div>
                                
                                    <div class="box-tools">
                                                
                                      <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Mark as read"><a href="http://www.desmus.com.mx/sharedProfileUser/{!! $sharedProfile -> id !!}"><i class="fa fa-eye"></i></a></button>
                                      <button type="button" class="btn btn-box-tool" data-toggle="collapse" data-target="#file_list_{!! $sharedProfile -> id !!}"><i class="fa fa-minus"></i></button>
                                      
                                    </div>
                                  
                                  </div>
                                  
                                  <div id="file_list_{!! $sharedProfile -> id !!}" class="box-body">
                                    
                                    <ul class="nav nav-stacked">
                                      
                                      @if(isset($sharedProfile))
                                      
                                        @foreach($shared_profile_file_lists as $shared_profile_file_list)
                                        
                                          @if(isset($shared_profile_file_list[0]))
                                          
                                            <div id="shared_profile_file_{!! $shared_profile_file_list[0] -> id !!}" class="modal fade" role="dialog">
                                              
                                              <div class="modal-dialog modal-lg">
                                                
                                                <div class="modal-content">
                                                  
                                                  <div class="modal-header">
                                                    
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title"> Files - {!! $sharedProfile -> name !!} </h4>
                                                    
                                                  </div>
                                                  
                                                  <div class="modal-body">
                                                    
                                                    <div class="row">
                  
                                                      <div class="col-md-12" style="padding: 0 10px";>
                                                      
                                                        @foreach($shared_profile_file_list as $shared_profile_files_list)
                                        
                                                          @if(isset($shared_profile_files_list))

                                                          @if($shared_profile_file_list[0] -> user_id == $shared_profile_files_list -> user_id)
                                                        
                                                          <div class="col-md-12" style="margin-top: 10px;">
                                            
                                                            <div class="box box-primary" style="margin-bottom: 10px;">
                                              
                                                              <div class="box-header with-border">
                                                
                                                                <div class="user-block">
                                                  
                                                                  @if(isset($sharedProfileFileListUsers))
                                                  
                                                                    @foreach($sharedProfileFileListUsers as $sharedProfileFileListUserArray)
                                                                    
                                                                      @if(isset($sharedProfileFileListUserArray[0]))
                                                                      
                                                                        @if($shared_profile_files_list -> user_id == $sharedProfileFileListUserArray[0] -> id)
                                                                      
                                                                          <img class="img-circle" src="images/users/image_{!! $shared_profile_files_list -> user_id !!}.{!! $sharedProfileFileListUserArray[0] -> image_type !!}" alt="User Image">
                                                                      
                                                                          <span class="username"><a href="{!! route('sharedProfileUser.show', [$shared_profile_files_list -> user_id]) !!}">{!! $sharedProfileFileListUserArray[0] -> name !!}</a></span>
                                                                          
                                                                          <?php break; ?>
                                                                      
                                                                        @endif
                                                                        
                                                                      @endif
                                                                    
                                                                    @endforeach
                                                                    
                                                                  @endif
                                                                  
                                                                  <span class="description">Shared publicly - {!! $shared_profile_files_list -> created_at !!}</span>
                                                
                                                                </div>
                                                
                                                                <div class="box-tools">
                                                                
                                                                  <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Mark as read"><a href="{!! route('sharedProfileFiles.show', [$shared_profile_files_list -> id]) !!}"><i class="fa fa-eye"></i></a></button>
                                                                
                                                                  @if(isset($user_id))
                                                                
                                                                    {!! Form::open(['route' => 'sharedProfileFileLikes.store', 'id' => 'shared_profile_file_like_create', 'style' => 'display: inline-block']) !!}
                                                                  
                                                                      {!! Form::hidden('status', 'Status:') !!}
                                                                      {!! Form::hidden('status', 'on', ['class' => 'form-control']) !!}
                                                                      
                                                                      {!! Form::hidden('datetime', 'Datetime:') !!}
                                                                      {!! Form::hidden('datetime', $now, ['class' => 'form-control']) !!}
                                                                      
                                                                      {!! Form::hidden('s_p_f_id', 'Shared Profile File Id:') !!}
                                                                      {!! Form::hidden('s_p_f_id', $shared_profile_files_list -> id, ['class' => 'form-control']) !!}
                                                                      
                                                                      {!! Form::hidden('user_id', 'User Id:') !!}
                                                                      {!! Form::hidden('user_id', $user_id, ['class' => 'form-control']) !!}
                                                                      
                                                                      <button type="submit" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Mark as read"><i class="fa fa-thumbs-o-up"></i></button>
                                                    
                                                                    {!! Form::close() !!}
                                                                    
                                                                  @endif
                                                                  
                                                                  <button type="button" class="btn btn-box-tool" data-toggle="collapse" data-target="#user_shared_file_{!! $shared_profile_files_list -> id  !!}"><i class="fa fa-minus"></i></button>
                                                
                                                                </div>
                                              
                                                              </div>
                                              
                                                              <div id="user_shared_file_{!! $shared_profile_files_list -> id  !!}" class="box-body">
                                                                
                                                                <div class="info-box bg-yellow">
                                                                  
                                                                  <a href = "/files/shared_profile_files/file_{!! $shared_profile_files_list -> id !!}.{!! $shared_profile_files_list -> file_type !!}" style = "color: #fff;" download> <span class="info-box-icon glyphicon glyphicon-download-alt"></span> </a>
                                                      
                                                                  <div class="info-box-content">
                                                                    
                                                                    <span class="info-box-text">Size (bytes)</span>
                                                                    <span class="info-box-number"> {!! $shared_profile_files_list -> file_size !!} </span>
                                                      
                                                                    <div class="progress">
                                                                      
                                                                      <div class="progress-bar" style="width: 100%"></div>
                                                                    
                                                                    </div>
                                                                    
                                                                    <span class="progress-description"> {!! $shared_profile_files_list -> name !!} </span>
                                                                  
                                                                  </div>
                                                                
                                                                </div>
                                                                
                                                                <p class="text-muted well well-sm no-shadow" style="margin-top: 10px; margin-bottom: 15px; text-align: justify;"> {!! $shared_profile_files_list -> description  !!} </p>
                                                
                                                                <div class="box-footer">
                                                                  
                                                                  @if(isset($user_id))
                                                                  
                                                                    <form id='shared_profile_file_comment' action = "{!! URL::to('/store_shared_profile_file_comment') !!}" method = "post">
                                                
                                                                      {{ csrf_field() }}
                                                      
                                                                      <img class="img-responsive img-circle img-sm" src="images/users/image_{!! $user_id !!}.{!! $user[0] -> image_type !!}" alt="Alt Text">
                                                      
                                                                      <div class="img-push">
                                                      
                                                                        <input id="s_p_f_id" name="s_p_f_id" type="hidden" value="{!! $shared_profile_files_list -> id !!}">
                                                                        <input id="status" name="status" type="hidden" value="on">
                                                                        <input id="datetime" name="datetime" type="hidden" value="{!! $now !!}">
                                                                        <input id="user_id" name="user_id" type="hidden" value="{!! $user_id !!}">
                                                                        
                                                                        <input id="shared_profile_file_comment_content" name="content" type="text" class="form-control input-sm" placeholder="Press enter to post comment">
                                                      
                                                                      </div>
                                                    
                                                                    </form>
                                                                    
                                                                  @endif
                                                
                                                                </div>
                                              
                                                              </div>
                                            
                                                            </div>
                                          
                                                          </div>
                                                          
                                                          @endif
                                                          
                                                          @endif
                                                          
                                                        @endforeach
                                                          
                                                      </div>
                                                      
                                                    </div>
                                                    
                                                  </div>
                                                  
                                                  <div class="modal-footer">
                                                    
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    
                                                  </div>
                                                  
                                                </div>
                                                
                                              </div>
                                              
                                            </div>
                                        
                                            @if($shared_profile_file_list[0] -> user_id == $sharedProfile -> user_id)
                                            
                                              <li><a href="#" data-toggle="modal" data-target="#shared_profile_file_{!! $shared_profile_file_list[0] -> id !!}"> <i class="fa fa-file-o" style="margin-right: 10px;"></i> Files <span class="pull-right badge bg-blue">{!! sizeof($shared_profile_file_list) !!}</span></a></li>
                                              
                                              @break
                                            
                                            @endif
                                            
                                          @endif
                                        
                                        @endforeach
                                        
                                        @foreach($shared_profile_note_lists as $shared_profile_note_list)
                                        
                                          @if(isset($shared_profile_note_list[0]))
                                          
                                            <div id="shared_profile_note_{!! $shared_profile_note_list[0] -> id !!}" class="modal fade" role="dialog">
                                              
                                              <div class="modal-dialog modal-lg">
                                                
                                                <div class="modal-content">
                                                  
                                                  <div class="modal-header">
                                                    
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title"> Notes - {!! $sharedProfile -> name !!} </h4>
                                                    
                                                  </div>
                                                  
                                                  <div class="modal-body">
                                                    
                                                    <div class="row">
                  
                                                      <div class="col-md-12" style="padding: 0 10px";>
                                                      
                                                        @foreach($shared_profile_note_list as $shared_profile_notes_list)
                                        
                                                          @if(isset($shared_profile_notes_list))

                                                          @if($shared_profile_note_list[0] -> user_id == $shared_profile_notes_list -> user_id)
                                                        
                                                          <div class="col-md-12" style="margin-top: 10px;">
                                            
                                                            <div class="box box-primary" style="margin-bottom: 10px;">
                                              
                                                              <div class="box-header with-border">
                                                
                                                                <div class="user-block">
                                                  
                                                                  @if(isset($sharedProfileNoteListUsers))
                                                  
                                                                    @foreach($sharedProfileNoteListUsers as $sharedProfileNoteListUserArray)
                                                                    
                                                                      @if(isset($sharedProfileNoteListUserArray[0]))
                                                                      
                                                                        @if($shared_profile_notes_list -> user_id == $sharedProfileNoteListUserArray[0] -> id)
                                                                      
                                                                          <img class="img-circle" src="images/users/image_{!! $shared_profile_notes_list -> user_id !!}.{!! $sharedProfileNoteListUserArray[0] -> image_type !!}" alt="User Image">
                                                                      
                                                                          <span class="username"><a href="{!! route('sharedProfileUser.show', [$shared_profile_notes_list -> user_id]) !!}">{!! $sharedProfileNoteListUserArray[0] -> name !!}</a></span>
                                                                          
                                                                          <?php break; ?>
                                                                      
                                                                        @endif
                                                                        
                                                                      @endif
                                                                    
                                                                    @endforeach
                                                                    
                                                                  @endif
                                                                  
                                                                  <span class="description">Shared publicly - {!! $shared_profile_notes_list -> created_at !!}</span>
                                                
                                                                </div>
                                                
                                                                <div class="box-tools">
                                                                
                                                                  <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Mark as read"><a href="{!! route('sharedProfileNotes.show', [$shared_profile_notes_list -> id]) !!}"><i class="fa fa-eye"></i></a></button>
                                                                
                                                                  @if(isset($user_id))
                                                                
                                                                    {!! Form::open(['route' => 'sharedProfileNoteLikes.store', 'id' => 'shared_profile_note_like_create', 'style' => 'display: inline-block']) !!}
                                                                  
                                                                      {!! Form::hidden('status', 'Status:') !!}
                                                                      {!! Form::hidden('status', 'on', ['class' => 'form-control']) !!}
                                                                      
                                                                      {!! Form::hidden('datetime', 'Datetime:') !!}
                                                                      {!! Form::hidden('datetime', $now, ['class' => 'form-control']) !!}
                                                                      
                                                                      {!! Form::hidden('s_p_n_id', 'Shared Profile Note Id:') !!}
                                                                      {!! Form::hidden('s_p_n_id', $shared_profile_notes_list -> id, ['class' => 'form-control']) !!}
                                                                      
                                                                      {!! Form::hidden('user_id', 'User Id:') !!}
                                                                      {!! Form::hidden('user_id', $user_id, ['class' => 'form-control']) !!}
                                                                      
                                                                      <button type="submit" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Mark as read"><i class="fa fa-thumbs-o-up"></i></button>
                                                    
                                                                    {!! Form::close() !!}
                                                                    
                                                                  @endif
                                                                  
                                                                  <button type="button" class="btn btn-box-tool" data-toggle="collapse" data-target="#user_shared_note_{!! $shared_profile_notes_list -> id  !!}"><i class="fa fa-minus"></i></button>
                                                
                                                                </div>
                                              
                                                              </div>
                                              
                                                              <div id="user_shared_note_{!! $shared_profile_notes_list -> id  !!}" class="box-body">
                                                                
                                                                <blockquote> {!! $shared_profile_notes_list -> content !!} </blockquote>
                                                                
                                                                <p class="text-muted well well-sm no-shadow" style="margin-top: 10px; margin-bottom: 15px; text-align: justify;"> {!! $shared_profile_notes_list -> description  !!} </p>
                                                
                                                                <div class="box-footer">
                                                                  
                                                                  @if(isset($user_id))
                                                                  
                                                                    <form id='shared_profile_note_comment' action = "{!! URL::to('/store_shared_profile_note_comment') !!}" method = "post">
                                                
                                                                      {{ csrf_field() }}
                                                      
                                                                      <img class="img-responsive img-circle img-sm" src="images/users/image_{!! $user_id !!}.{!! $user[0] -> image_type !!}" alt="Alt Text">
                                                      
                                                                      <div class="img-push">
                                                      
                                                                        <input id="s_p_n_id" name="s_p_n_id" type="hidden" value="{!! $shared_profile_notes_list -> id !!}">
                                                                        <input id="status" name="status" type="hidden" value="on">
                                                                        <input id="datetime" name="datetime" type="hidden" value="{!! $now !!}">
                                                                        <input id="user_id" name="user_id" type="hidden" value="{!! $user_id !!}">
                                                                        
                                                                        <input id="shared_profile_note_comment_content" name="content" type="text" class="form-control input-sm" placeholder="Press enter to post comment">
                                                      
                                                                      </div>
                                                    
                                                                    </form>
                                                                    
                                                                  @endif
                                                
                                                                </div>
                                              
                                                              </div>
                                            
                                                            </div>
                                          
                                                          </div>
                                                          
                                                          @endif
                                                          
                                                          @endif
                                                          
                                                        @endforeach
                                                          
                                                      </div>
                                                      
                                                    </div>
                                                    
                                                  </div>
                                                  
                                                  <div class="modal-footer">
                                                    
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    
                                                  </div>
                                                  
                                                </div>
                                                
                                              </div>
                                              
                                            </div>
                                        
                                            @if($shared_profile_note_list[0] -> user_id == $sharedProfile -> user_id)
                                            
                                              <li><a href="#" data-toggle="modal" data-target="#shared_profile_note_{!! $shared_profile_note_list[0] -> id !!}"> <i class="fa fa-sticky-note-o" style="margin-right: 10px;"></i> Notes <span class="pull-right badge bg-blue">{!! sizeof($shared_profile_note_list) !!}</span></a></li>
                                              
                                              @break
                                            
                                            @endif
                                            
                                          @endif
                                        
                                        @endforeach
                                        
                                        @foreach($shared_profile_image_lists as $shared_profile_image_list)
                                        
                                          @if(isset($shared_profile_image_list[0]))
                                          
                                            <div id="shared_profile_image_{!! $shared_profile_image_list[0] -> id !!}" class="modal fade" role="dialog">
                                              
                                              <div class="modal-dialog modal-lg">
                                                
                                                <div class="modal-content">
                                                  
                                                  <div class="modal-header">
                                                    
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title"> Images - {!! $sharedProfile -> name !!} </h4>
                                                    
                                                  </div>
                                                  
                                                  <div class="modal-body">
                                                    
                                                    <div class="row">
                  
                                                      <div class="col-md-12" style="padding: 0 10px";>
                                                      
                                                        @foreach($shared_profile_image_list as $shared_profile_images_list)
                                        
                                                          @if(isset($shared_profile_images_list))

                                                          @if($shared_profile_image_list[0] -> user_id == $shared_profile_images_list -> user_id)
                                                        
                                                          <div class="col-md-12" style="margin-top: 10px;">
                                            
                                                            <div class="box box-primary" style="margin-bottom: 10px;">
                                              
                                                              <div class="box-header with-border">
                                                
                                                                <div class="user-block">
                                                  
                                                                  @if(isset($sharedProfileImageListUsers))
                                                  
                                                                    @foreach($sharedProfileImageListUsers as $sharedProfileImageListUserArray)
                                                                    
                                                                      @if(isset($sharedProfileImageListUserArray[0]))
                                                                      
                                                                        @if($shared_profile_images_list -> user_id == $sharedProfileImageListUserArray[0] -> id)
                                                                      
                                                                          <img class="img-circle" src="images/users/image_{!! $shared_profile_images_list -> user_id !!}.{!! $sharedProfileImageListUserArray[0] -> image_type !!}" alt="User Image">
                                                                      
                                                                          <span class="username"><a href="{!! route('sharedProfileUser.show', [$shared_profile_images_list -> user_id]) !!}">{!! $sharedProfileImageListUserArray[0] -> name !!}</a></span>
                                                                          
                                                                          <?php break; ?>
                                                                      
                                                                        @endif
                                                                        
                                                                      @endif
                                                                    
                                                                    @endforeach
                                                                    
                                                                  @endif
                                                                  
                                                                  <span class="description">Shared publicly - {!! $shared_profile_images_list -> created_at !!}</span>
                                                
                                                                </div>
                                                
                                                                <div class="box-tools">
                                                                
                                                                  <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Mark as read"><a href="{!! route('sharedProfileImages.show', [$shared_profile_images_list -> id]) !!}"><i class="fa fa-eye"></i></a></button>
                                                                
                                                                  @if(isset($user_id))
                                                                
                                                                    {!! Form::open(['route' => 'sharedProfileImageLikes.store', 'id' => 'shared_profile_image_like_create', 'style' => 'display: inline-block']) !!}
                                                                  
                                                                      {!! Form::hidden('status', 'Status:') !!}
                                                                      {!! Form::hidden('status', 'on', ['class' => 'form-control']) !!}
                                                                      
                                                                      {!! Form::hidden('datetime', 'Datetime:') !!}
                                                                      {!! Form::hidden('datetime', $now, ['class' => 'form-control']) !!}
                                                                      
                                                                      {!! Form::hidden('s_p_i_id', 'Shared Profile Image Id:') !!}
                                                                      {!! Form::hidden('s_p_i_id', $shared_profile_images_list -> id, ['class' => 'form-control']) !!}
                                                                      
                                                                      {!! Form::hidden('user_id', 'User Id:') !!}
                                                                      {!! Form::hidden('user_id', $user_id, ['class' => 'form-control']) !!}
                                                                      
                                                                      <button type="submit" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Mark as read"><i class="fa fa-thumbs-o-up"></i></button>
                                                    
                                                                    {!! Form::close() !!}
                                                                    
                                                                  @endif
                                                                  
                                                                  <button type="button" class="btn btn-box-tool" data-toggle="collapse" data-target="#user_shared_image_{!! $shared_profile_images_list -> id  !!}"><i class="fa fa-minus"></i></button>
                                                
                                                                </div>
                                              
                                                              </div>
                                              
                                                              <div id="user_shared_image_{!! $shared_profile_images_list -> id  !!}" class="box-body">
                                                                
                                                                <img src="/images/shared_profile_images/image_{!! $shared_profile_images_list -> id !!}.{!! $shared_profile_images_list -> file_type !!}" style="width: 100%; margin-bottom: 5px;">
                                                                
                                                                <p class="text-muted well well-sm no-shadow" style="margin-top: 10px; margin-bottom: 15px; text-align: justify;"> {!! $shared_profile_images_list -> description  !!} </p>
                                                
                                                                <div class="box-footer">
                                                                  
                                                                  @if(isset($user_id))
                                                                  
                                                                    <form id='shared_profile_image_comment' action = "{!! URL::to('/store_shared_profile_image_comment') !!}" method = "post">
                                                
                                                                      {{ csrf_field() }}
                                                      
                                                                      <img class="img-responsive img-circle img-sm" src="images/users/image_{!! $user_id !!}.{!! $user[0] -> image_type !!}" alt="Alt Text">
                                                      
                                                                      <div class="img-push">
                                                      
                                                                        <input id="s_p_i_id" name="s_p_i_id" type="hidden" value="{!! $shared_profile_images_list -> id !!}">
                                                                        <input id="status" name="status" type="hidden" value="on">
                                                                        <input id="datetime" name="datetime" type="hidden" value="{!! $now !!}">
                                                                        <input id="user_id" name="user_id" type="hidden" value="{!! $user_id !!}">
                                                                        
                                                                        <input id="shared_profile_image_comment_content" name="content" type="text" class="form-control input-sm" placeholder="Press enter to post comment">
                                                      
                                                                      </div>
                                                    
                                                                    </form>
                                                                    
                                                                  @endif
                                                
                                                                </div>
                                              
                                                              </div>
                                            
                                                            </div>
                                          
                                                          </div>
                                                          
                                                          @endif
                                                          
                                                          @endif
                                                          
                                                        @endforeach
                                                          
                                                      </div>
                                                      
                                                    </div>
                                                    
                                                  </div>
                                                  
                                                  <div class="modal-footer">
                                                    
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    
                                                  </div>
                                                  
                                                </div>
                                                
                                              </div>
                                              
                                            </div>
                                        
                                            @if($shared_profile_image_list[0] -> user_id == $sharedProfile -> user_id)
                                            
                                              <li><a href="#" data-toggle="modal" data-target="#shared_profile_image_{!! $shared_profile_image_list[0] -> id !!}"> <i class="fa fa-file-image-o" style="margin-right: 10px;"></i> Images <span class="pull-right badge bg-blue">{!! sizeof($shared_profile_image_list) !!}</span></a></li>
                                              
                                              @break
                                            
                                            @endif
                                            
                                          @endif
                                        
                                        @endforeach
                                        
                                        @foreach($shared_profile_audio_lists as $shared_profile_audio_list)
                                        
                                          @if(isset($shared_profile_audio_list[0]))
                                          
                                            <div id="shared_profile_audio_{!! $shared_profile_audio_list[0] -> id !!}" class="modal fade" role="dialog">
                                              
                                              <div class="modal-dialog modal-lg">
                                                
                                                <div class="modal-content">
                                                  
                                                  <div class="modal-header">
                                                    
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title"> Audios - {!! $sharedProfile -> name !!} </h4>
                                                    
                                                  </div>
                                                  
                                                  <div class="modal-body">
                                                    
                                                    <div class="row">
                  
                                                      <div class="col-md-12" style="padding: 0 10px";>
                                                      
                                                        @foreach($shared_profile_audio_list as $shared_profile_audios_list)
                                        
                                                          @if(isset($shared_profile_audios_list))

                                                          @if($shared_profile_audio_list[0] -> user_id == $shared_profile_audios_list -> user_id)
                                                        
                                                          <div class="col-md-12" style="margin-top: 10px;">
                                            
                                                            <div class="box box-primary" style="margin-bottom: 10px;">
                                              
                                                              <div class="box-header with-border">
                                                
                                                                <div class="user-block">
                                                  
                                                                  @if(isset($sharedProfileAudioListUsers))
                                                  
                                                                    @foreach($sharedProfileAudioListUsers as $sharedProfileAudioListUserArray)
                                                                    
                                                                      @if(isset($sharedProfileAudioListUserArray[0]))
                                                                      
                                                                        @if($shared_profile_audios_list -> user_id == $sharedProfileAudioListUserArray[0] -> id)
                                                                      
                                                                          <img class="img-circle" src="images/users/image_{!! $shared_profile_audios_list -> user_id !!}.{!! $sharedProfileAudioListUserArray[0] -> image_type !!}" alt="User Image">
                                                                      
                                                                          <span class="username"><a href="{!! route('sharedProfileUser.show', [$shared_profile_audios_list -> user_id]) !!}">{!! $sharedProfileAudioListUserArray[0] -> name !!}</a></span>
                                                                          
                                                                          <?php break; ?>
                                                                      
                                                                        @endif
                                                                        
                                                                      @endif
                                                                    
                                                                    @endforeach
                                                                    
                                                                  @endif
                                                                  
                                                                  <span class="description">Shared publicly - {!! $shared_profile_audios_list -> created_at !!}</span>
                                                
                                                                </div>
                                                
                                                                <div class="box-tools">
                                                                
                                                                  <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Mark as read"><a href="{!! route('sharedProfileAudios.show', [$shared_profile_audios_list -> id]) !!}"><i class="fa fa-eye"></i></a></button>
                                                                
                                                                  @if(isset($user_id))
                                                                
                                                                    {!! Form::open(['route' => 'sharedProfileAudioLikes.store', 'id' => 'shared_profile_audio_like_create', 'style' => 'display: inline-block']) !!}
                                                                  
                                                                      {!! Form::hidden('status', 'Status:') !!}
                                                                      {!! Form::hidden('status', 'on', ['class' => 'form-control']) !!}
                                                                      
                                                                      {!! Form::hidden('datetime', 'Datetime:') !!}
                                                                      {!! Form::hidden('datetime', $now, ['class' => 'form-control']) !!}
                                                                      
                                                                      {!! Form::hidden('s_p_a_id', 'Shared Profile Audio Id:') !!}
                                                                      {!! Form::hidden('s_p_a_id', $shared_profile_audios_list -> id, ['class' => 'form-control']) !!}
                                                                      
                                                                      {!! Form::hidden('user_id', 'User Id:') !!}
                                                                      {!! Form::hidden('user_id', $user_id, ['class' => 'form-control']) !!}
                                                                      
                                                                      <button type="submit" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Mark as read"><i class="fa fa-thumbs-o-up"></i></button>
                                                    
                                                                    {!! Form::close() !!}
                                                                    
                                                                  @endif
                                                                  
                                                                  <button type="button" class="btn btn-box-tool" data-toggle="collapse" data-target="#user_shared_audio_{!! $shared_profile_audios_list -> id  !!}"><i class="fa fa-minus"></i></button>
                                                
                                                                </div>
                                              
                                                              </div>
                                              
                                                              <div id="user_shared_audio_{!! $shared_profile_audios_list -> id  !!}" class="box-body">
                                                                
                                                                <audio style="width: 100%; padding: 5px;" controls>
                
                                                                  <source src="/audios/shared_profile_audios/audio_{!! $shared_profile_audios_list -> id !!}.{!! $shared_profile_audios_list -> file_type !!}" type="audio/{!! $shared_profile_audios_list -> file_type !!}">
                                  
                                                                  Your browser does not support the audio element.
                                  
                                                                </audio>
                                                              
                                                                <p class="text-muted well well-sm no-shadow" style="margin-top: 10px; margin-bottom: 15px; text-align: justify;"> {!! $shared_profile_audios_list -> description  !!} </p>
                                                
                                                                <div class="box-footer">
                                                                  
                                                                  @if(isset($user_id))
                                                                  
                                                                    <form id='shared_profile_audio_comment' action = "{!! URL::to('/store_shared_profile_audio_comment') !!}" method = "post">
                                                
                                                                      {{ csrf_field() }}
                                                      
                                                                      <img class="img-responsive img-circle img-sm" src="images/users/image_{!! $user_id !!}.{!! $user[0] -> image_type !!}" alt="Alt Text">
                                                      
                                                                      <div class="img-push">
                                                      
                                                                        <input id="s_p_a_id" name="s_p_a_id" type="hidden" value="{!! $shared_profile_audios_list -> id !!}">
                                                                        <input id="status" name="status" type="hidden" value="on">
                                                                        <input id="datetime" name="datetime" type="hidden" value="{!! $now !!}">
                                                                        <input id="user_id" name="user_id" type="hidden" value="{!! $user_id !!}">
                                                                        
                                                                        <input id="shared_profile_audio_comment_content" name="content" type="text" class="form-control input-sm" placeholder="Press enter to post comment">
                                                      
                                                                      </div>
                                                    
                                                                    </form>
                                                                    
                                                                  @endif
                                                
                                                                </div>
                                              
                                                              </div>
                                            
                                                            </div>
                                          
                                                          </div>
                                                          
                                                          @endif
                                                          
                                                          @endif
                                                          
                                                        @endforeach
                                                          
                                                      </div>
                                                      
                                                    </div>
                                                    
                                                  </div>
                                                  
                                                  <div class="modal-footer">
                                                    
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    
                                                  </div>
                                                  
                                                </div>
                                                
                                              </div>
                                              
                                            </div>
                                        
                                            @if($shared_profile_audio_list[0] -> user_id == $sharedProfile -> user_id)
                                            
                                              <li><a href="#" data-toggle="modal" data-target="#shared_profile_audio_{!! $shared_profile_audio_list[0] -> id !!}"> <i class="fa fa-file-audio-o" style="margin-right: 10px;"></i> Audios <span class="pull-right badge bg-blue">{!! sizeof($shared_profile_audio_list) !!}</span></a></li>
                                              
                                              @break
                                            
                                            @endif
                                            
                                          @endif
                                        
                                        @endforeach
                                        
                                        @foreach($shared_profile_video_lists as $shared_profile_video_list)
                                        
                                          @if(isset($shared_profile_video_list[0]))
                                          
                                            <div id="shared_profile_video_{!! $shared_profile_video_list[0] -> id !!}" class="modal fade" role="dialog">
                                              
                                              <div class="modal-dialog modal-lg">
                                                
                                                <div class="modal-content">
                                                  
                                                  <div class="modal-header">
                                                    
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title"> Videos - {!! $sharedProfile -> name !!} </h4>
                                                    
                                                  </div>
                                                  
                                                  <div class="modal-body">
                                                    
                                                    <div class="row">
                  
                                                      <div class="col-md-12" style="padding: 0 10px";>
                                                      
                                                        @foreach($shared_profile_video_list as $shared_profile_videos_list)
                                        
                                                          @if(isset($shared_profile_videos_list))

                                                          @if($shared_profile_video_list[0] -> user_id == $shared_profile_videos_list -> user_id)
                                                        
                                                          <div class="col-md-12" style="margin-top: 10px;">
                                            
                                                            <div class="box box-primary" style="margin-bottom: 10px;">
                                              
                                                              <div class="box-header with-border">
                                                
                                                                <div class="user-block">
                                                  
                                                                  @if(isset($sharedProfileVideoListUsers))
                                                  
                                                                    @foreach($sharedProfileVideoListUsers as $sharedProfileVideoListUserArray)
                                                                    
                                                                      @if(isset($sharedProfileVideoListUserArray[0]))
                                                                      
                                                                        @if($shared_profile_videos_list -> user_id == $sharedProfileVideoListUserArray[0] -> id)
                                                                      
                                                                          <img class="img-circle" src="images/users/image_{!! $shared_profile_videos_list -> user_id !!}.{!! $sharedProfileVideoListUserArray[0] -> image_type !!}" alt="User Video">
                                                                      
                                                                          <span class="username"><a href="{!! route('sharedProfileUser.show', [$shared_profile_videos_list -> user_id]) !!}">{!! $sharedProfileVideoListUserArray[0] -> name !!}</a></span>
                                                                          
                                                                          <?php break; ?>
                                                                      
                                                                        @endif
                                                                        
                                                                      @endif
                                                                    
                                                                    @endforeach
                                                                    
                                                                  @endif
                                                                  
                                                                  <span class="description">Shared publicly - {!! $shared_profile_videos_list -> created_at !!}</span>
                                                
                                                                </div>
                                                
                                                                <div class="box-tools">
                                                                
                                                                  <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Mark as read"><a href="{!! route('sharedProfileVideos.show', [$shared_profile_videos_list -> id]) !!}"><i class="fa fa-eye"></i></a></button>
                                                                
                                                                  @if(isset($user_id))
                                                                
                                                                    {!! Form::open(['route' => 'sharedProfileVideoLikes.store', 'id' => 'shared_profile_video_like_create', 'style' => 'display: inline-block']) !!}
                                                                  
                                                                      {!! Form::hidden('status', 'Status:') !!}
                                                                      {!! Form::hidden('status', 'on', ['class' => 'form-control']) !!}
                                                                      
                                                                      {!! Form::hidden('datetime', 'Datetime:') !!}
                                                                      {!! Form::hidden('datetime', $now, ['class' => 'form-control']) !!}
                                                                      
                                                                      {!! Form::hidden('s_p_v_id', 'Shared Profile Video Id:') !!}
                                                                      {!! Form::hidden('s_p_v_id', $shared_profile_videos_list -> id, ['class' => 'form-control']) !!}
                                                                      
                                                                      {!! Form::hidden('user_id', 'User Id:') !!}
                                                                      {!! Form::hidden('user_id', $user_id, ['class' => 'form-control']) !!}
                                                                      
                                                                      <button type="submit" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Mark as read"><i class="fa fa-thumbs-o-up"></i></button>
                                                    
                                                                    {!! Form::close() !!}
                                                                    
                                                                  @endif
                                                                  
                                                                  <button type="button" class="btn btn-box-tool" data-toggle="collapse" data-target="#user_shared_video_{!! $shared_profile_videos_list -> id  !!}"><i class="fa fa-minus"></i></button>
                                                
                                                                </div>
                                              
                                                              </div>
                                              
                                                              <div id="user_shared_video_{!! $shared_profile_videos_list -> id  !!}" class="box-body">
                                                                
                                                                <video width="100%" style="margin-bottom: 5px;" controls>
                    
                                                                  <source src="/videos/shared_profile_videos/video_{!! $shared_profile_videos_list -> id !!}.{!! $shared_profile_videos_list -> file_type !!}" type="video/mp4">
                                                    
                                                                </video>
                                                              
                                                                <p class="text-muted well well-sm no-shadow" style="margin-top: 10px; margin-bottom: 15px; text-align: justify;"> {!! $shared_profile_videos_list -> description  !!} </p>
                                                
                                                                <div class="box-footer">
                                                                  
                                                                  @if(isset($user_id))
                                                                  
                                                                    <form id='shared_profile_video_comment' action = "{!! URL::to('/store_shared_profile_video_comment') !!}" method = "post">
                                                
                                                                      {{ csrf_field() }}
                                                      
                                                                      <img class="img-responsive img-circle img-sm" src="images/users/image_{!! $user_id !!}.{!! $user[0] -> image_type !!}" alt="Alt Text">
                                                      
                                                                      <div class="img-push">
                                                      
                                                                        <input id="s_p_v_id" name="s_p_v_id" type="hidden" value="{!! $shared_profile_videos_list -> id !!}">
                                                                        <input id="status" name="status" type="hidden" value="on">
                                                                        <input id="datetime" name="datetime" type="hidden" value="{!! $now !!}">
                                                                        <input id="user_id" name="user_id" type="hidden" value="{!! $user_id !!}">
                                                                        
                                                                        <input id="shared_profile_video_comment_content" name="content" type="text" class="form-control input-sm" placeholder="Press enter to post comment">
                                                      
                                                                      </div>
                                                    
                                                                    </form>
                                                                    
                                                                  @endif
                                                
                                                                </div>
                                              
                                                              </div>
                                            
                                                            </div>
                                          
                                                          </div>
                                                          
                                                          @endif
                                                          
                                                          @endif
                                                          
                                                        @endforeach
                                                          
                                                      </div>
                                                      
                                                    </div>
                                                    
                                                  </div>
                                                  
                                                  <div class="modal-footer">
                                                    
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    
                                                  </div>
                                                  
                                                </div>
                                                
                                              </div>
                                              
                                            </div>
                                        
                                            @if($shared_profile_video_list[0] -> user_id == $sharedProfile -> user_id)
                                            
                                              <li><a href="#" data-toggle="modal" data-target="#shared_profile_video_{!! $shared_profile_video_list[0] -> id !!}"> <i class="fa fa-file-video-o" style="margin-right: 10px;"></i> Videos <span class="pull-right badge bg-blue">{!! sizeof($shared_profile_video_list) !!}</span></a></li>
                                              
                                              @break
                                            
                                            @endif
                                            
                                          @endif
                                        
                                        @endforeach
                                        
                                      @endif
                                      
                                    </ul>
                                    
                                  </div>
                                  
                                </div>
                                
                              </div>
                            
                            @endforeach
                            
                          @endif
                          
                        </div>
                        
                      </div>
                      
                    </div>
                    
                  </div>
                  
                </div>
                
                <div class = "tab-pane" id = "shared_profile_files" style="margin: 10px;">
                  
                  <div class="box box-primary" style="margin-bottom: 10px;">
            
                    <div class="box-body" style="padding-bottom: 0;">
    
                      <div class="row">
     
                        <div class="col-md-12">
              
                          <div class="nav-tabs-custom" style="margin-bottom: 10px;">
                
                            <ul class="nav nav-tabs">
    
                              <li class="active"><a href="#shared_profile_files_list" data-toggle="tab" aria-expanded="false"> Shared Profile Files </a></li>
                              
                              @if(isset($user_id))
                              
                                <li><a href="#upload_files" data-toggle="tab" aria-expanded="false"> Upload Files </a></li>
                                <li><a href="#shared_profile_file_comments" data-toggle="tab" aria-expanded="false"> Shared Profile File Comments </a></li>
                                <li><a href="#shared_profile_file_comment_responses" data-toggle="tab" aria-expanded="false"> Shared Profile File Comment Responses </a></li>
                                <li><a href="#shared_profile_file_likes" data-toggle="tab" aria-expanded="false"> Shared Profile File Likes </a></li>
                    
                              @endif
                    
                            </ul>
              
                            <div class="tab-content clearfix" style="padding: 10;">
              
                              <div class="tab-pane active" id="shared_profile_files_list">
                                
                                <div class="row">
                  
                                  <div class="col-md-12" style="padding: 0;">
                                      
                                    @foreach($sharedProfileFilesList as $sharedProfileFileList)
                                    
                                      <div class="col-md-12" style="margin-top: 10px;">
                        
                                        <div class="box box-primary" style="margin-bottom: 0;">
                          
                                          <div class="box-header with-border">
                            
                                            <div class="user-block">
                              
                                              @if(isset($sharedProfileFileUsersList))
                              
                                                @foreach($sharedProfileFileUsersList as $sharedProfileFileUserListArray)
                                                
                                                  @if(isset($sharedProfileFileUserListArray[0]))
                                                  
                                                    @if($sharedProfileFileList -> user_id == $sharedProfileFileUserListArray[0] -> id)
                                                  
                                                      <img class="img-circle" src="images/users/image_{!! $sharedProfileFileList -> user_id !!}.{!! $sharedProfileFileUserListArray[0] -> image_type !!}" alt="User Image">
                                                  
                                                      <span class="username"><a href="{!! route('sharedProfileUser.show', [$sharedProfileFileList -> user_id]) !!}">{!! $sharedProfileFileUserListArray[0] -> name !!}</a></span>
                                                      
                                                      <?php break; ?>
                                                  
                                                    @endif
                                                    
                                                  @endif
                                                
                                                @endforeach
                                                
                                              @endif
                                              
                                              <span class="description">Shared publicly - {!! $sharedProfileFileList -> created_at !!}</span>
                            
                                            </div>
                            
                                            <div class="box-tools">
                                            
                                              <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Mark as read"><a href="{!! route('sharedProfileFiles.show', [$sharedProfileFileList -> id]) !!}"><i class="fa fa-eye"></i></a></button>
                                            
                                              @if(isset($user_id))
                                            
                                                {!! Form::open(['route' => 'sharedProfileFileLikes.store', 'id' => 'shared_profile_file_like_create', 'style' => 'display: inline-block']) !!}
                                              
                                                  {!! Form::hidden('status', 'Status:') !!}
                                                  {!! Form::hidden('status', 'on', ['class' => 'form-control']) !!}
                                                  
                                                  {!! Form::hidden('datetime', 'Datetime:') !!}
                                                  {!! Form::hidden('datetime', $now, ['class' => 'form-control']) !!}
                                                  
                                                  {!! Form::hidden('s_p_f_id', 'Shared Profile File Id:') !!}
                                                  {!! Form::hidden('s_p_f_id', $sharedProfileFileList -> id, ['class' => 'form-control']) !!}
                                                  
                                                  {!! Form::hidden('user_id', 'User Id:') !!}
                                                  {!! Form::hidden('user_id', $user_id, ['class' => 'form-control']) !!}
                                                  
                                                  <button type="submit" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Mark as read"><i class="fa fa-thumbs-o-up"></i></button>
                                
                                                {!! Form::close() !!}
                                                
                                              @endif
                                              
                                              <button type="button" class="btn btn-box-tool" data-toggle="collapse" data-target="#file_list_{!! $sharedProfileFileList -> id  !!}"><i class="fa fa-minus"></i></button>
                            
                                            </div>
                          
                                          </div>
                          
                                          <div id="file_list_{!! $sharedProfileFileList -> id  !!}" class="box-body">
                                            
                                            <div class="info-box bg-yellow">
                                              
                                              <a href = "/files/shared_profile_files/file_{!! $sharedProfileFileList -> id !!}.{!! $sharedProfileFileList -> file_type !!}" style = "color: #fff;" download> <span class="info-box-icon glyphicon glyphicon-download-alt"></span> </a>
                                  
                                              <div class="info-box-content">
                                                
                                                <span class="info-box-text">Size (bytes)</span>
                                                <span class="info-box-number"> {!! $sharedProfileFileList -> file_size !!} </span>
                                  
                                                <div class="progress">
                                                  
                                                  <div class="progress-bar" style="width: 100%"></div>
                                                
                                                </div>
                                                
                                                <span class="progress-description"> {!! $sharedProfileFileList -> name !!} </span>
                                              
                                              </div>
                                            
                                            </div>
                                            
                                            <p class="text-muted well well-sm no-shadow" style="margin-top: 10px; margin-bottom: 15px; text-align: justify;"> {!! $sharedProfileFileList -> description  !!} </p>
                                            
                                            <div class="box-footer">
                                              
                                              @if(isset($user_id))
                                              
                                                <form id='shared_profile_file_comment_r' action = "{!! URL::to('/store_shared_profile_file_comment') !!}" method = "post">
                            
                                                  {{ csrf_field() }}
                                  
                                                  <img class="img-responsive img-circle img-sm" src="images/users/image_{!! $user_id !!}.{!! $user[0] -> image_type !!}" alt="Alt Text">
                                  
                                                  <div class="img-push">
                                  
                                                    <input id="s_p_f_id" name="s_p_f_id" type="hidden" value="{!! $sharedProfileFileList -> id !!}">
                                                    <input id="status" name="status" type="hidden" value="on">
                                                    <input id="datetime" name="datetime" type="hidden" value="{!! $now !!}">
                                                    <input id="user_id" name="user_id" type="hidden" value="{!! $user_id !!}">
                                                    
                                                    <input id="shared_profile_file_comment_r_content" name="content" type="text" class="form-control input-sm" placeholder="Press enter to post comment">
                                  
                                                  </div>
                                
                                                </form>
                                                
                                              @endif
                            
                                            </div>
                          
                                          </div>
                        
                                        </div>
                      
                                      </div>
                                    
                                    @endforeach
                                    
                                  </div>
                                  
                                </div>
                                
                              </div>
                              
                              @if(isset($user_id))
                              
                                <div class="tab-pane" id="upload_files">
                                  
                                  <table class="table table-hover table-bordered table-striped dataTable" style="margin-bottom: 0;">
                  
                                    <thead>
                                          
                                      <tr>
                                              
                                        <th>Name</th>
                                        <th colspan="3">Action</th>
                                          
                                      </tr>
                                      
                                    </thead>
                                      
                                    <tbody>
                                      
                                      @if(isset($files))
                                      
                                        @foreach($files as $file)
                                        
                                          <tr>
                                                  
                                            <td> <a href="{!! route('sharedProfileFiles.show', [$file->id]) !!}"> {!! $file -> name !!} </a> </td>
                                                  
                                            <td>
                                                      
                                              {!! Form::open(['route' => ['sharedProfileFiles.destroy', $file->id], 'method' => 'delete']) !!}
                                                      
                                                <div class="btn-group">
                                                          
                                                  <a href="{!! route('sharedProfileFiles.show', [$file->id]) !!}" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-eye-open"></i></a>
                                                  <a href="{!! route('sharedProfileFiles.edit', [$file->id]) !!}" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
                                                  {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                                                      
                                                </div>
                                                      
                                              {!! Form::close() !!}
                                                  
                                            </td>
                                              
                                          </tr>
                                        
                                        @endforeach
                                        
                                      @endif
                                      
                                    </tbody>
                                  
                                  </table>
                                  
                                </div>
                                
                                <div class="tab-pane" id="shared_profile_file_comments">
                                  
                                  <span class="pull-right text-muted" style="background: rgba(0,0,0,0.2); color: #fff; margin: 10px; padding: 0 5px;">
                                    
                                    {!! $sharedProfileFileCommentsListCount !!} comments
                                  
                                  </span>
                                  
                                  <div class="box-footer box-comments" style="padding-top: 40px;">
                                    
                                    @foreach($sharedProfileFileCommentsList as $sharedProfileFileCommentList)
                                    
                                      <div class="box-comment">
                                        
                                        <i class="menu-icon fa fa-comment-o bg-light-blue" style="font-size: 15px; border-radius: 50%; padding: 10px;"></i>
                                        
                                        <div class="comment-text" style="text-align:justify; padding-right: 10px;">
                                          
                                          <a href="{!! route('sharedProfileFiles.show', [$sharedProfileFileCommentList -> id]) !!}">
                                            
                                            <span class="username">
                                              
                                              {!! $sharedProfileFileCommentList -> name !!}
                                              
                                              <span class="text-muted pull-right" style="background: rgba(0,0,0,0.1); color: #000; padding: 0 5px;">{!! $sharedProfileFileCommentList -> created_at !!}</span>
                                              
                                            </span>
                                            
                                          </a>
                                          
                                          {!! $sharedProfileFileCommentList -> content !!}
                                          
                                        </div>
                                        
                                      </div>
                                    
                                    @endforeach
                                    
                                  </div>
                                  
                                </div>
                                
                                <div class="tab-pane" id="shared_profile_file_comment_responses">
                                  
                                  <span class="pull-right text-muted" style="background: rgba(0,0,0,0.2); color: #fff; margin: 10px; padding: 0 5px;">
                                    
                                    {!! $sharedProfileFileCommentResponsesListCount !!} comments
                                  
                                  </span>
                                  
                                  <div class="box-footer box-comments" style="padding-top: 40px;">
                                    
                                    @foreach($sharedProfileFileCommentResponsesList as $sharedProfileFileCommentResponseList)
                                    
                                      <div class="box-comment">
                                        
                                        <i class="menu-icon fa fa-comments-o bg-light-blue" style="font-size: 15px; border-radius: 50%; padding: 10px;"></i>
                                        
                                        <div class="comment-text" style="text-align:justify; padding-right: 10px;">
                                          
                                          <a href="{!! route('sharedProfileFiles.show', [$sharedProfileFileCommentResponseList -> id]) !!}">
                                            
                                            <span class="username">
                                              
                                              {!! $sharedProfileFileCommentResponseList -> name !!}
                                              
                                              <span class="text-muted pull-right" style="background: rgba(0,0,0,0.1); color: #000; padding: 0 5px;">{!! $sharedProfileFileCommentResponseList -> created_at !!}</span>
                                              
                                            </span>
                                            
                                          </a>
                                          
                                          {!! $sharedProfileFileCommentResponseList -> content !!}
                                          
                                        </div>
                                        
                                      </div>
                                    
                                    @endforeach
                                    
                                  </div>
                                  
                                </div>
                                
                                <div class="tab-pane" id="shared_profile_file_likes">
                                  
                                  <div class="box box-primary" style="margin-bottom: 0;">
  
                                    <div class="box-body">
                                    
                                      <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                      
                                        <div class="row">
                      
                                          <div class="col-sm-12">
                                            
                                            <div class="small-box bg-green">
                                    
                                              <div class="inner">
                                    
                                                <h3><sup style="font-size: 20px">{!! $sharedProfileFileLikesListCount !!}</sup></h3>
                      
                                                <p>Likes Quantity</p>
                                  
                                              </div>
                                  
                                              <div class="icon">
                                    
                                                <i class="ion ion-stats-bars"></i>
                                  
                                              </div>
                                    
                                            </div>
                      
                                            <div class="table-responsive">
                      
                                              <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info" style="margin-bottom: 0;">
                                        
                                                <thead>
                                        
                                                  <tr role="row">
                        
                                                    <th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 224px;" aria-sort="descending"> File Name </th>
                                                    
                                                    <th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 224px;" aria-sort="descending"> Datetime </th>
                                                    
                                                  </tr>
                                        
                                                </thead>
                                        
                                                <tbody>
                                          
                                                  @foreach($sharedProfileFileLikesListC as $sharedProfileFileLikeList)
                        
                                                    <tr role="row" class="odd">
                                                    
                                                      <td class=""> <a href="{!! route('sharedProfileFiles.show', [$sharedProfileFileLikeList -> id]) !!}"> {!! $sharedProfileFileLikeList->name !!} </a> </td>
                                                      
                                                      <td class=""> {!! $sharedProfileFileLikeList->created_at !!} </td>
                                        
                                                    </tr>
                            
                                                  @endforeach
                        
                                                </tbody>
                                      
                                              </table>
                                              
                                            </div>
                      
                                          </div>
                      
                                        </div>
                      
                                      </div>
                                  
                                    </div>
                      
                                  </div>
                                
                                </div>
                                
                              @endif
                              
                            </div>
                            
                          </div>
                          
                        </div>
                        
                      </div>
                      
                    </div>
                    
                  </div>
                  
                  @if(isset($user_id))
                  
                    <a href="{!! route('sharedProfileFiles.create') !!}" class="btn btn-default">Add File</a>
                  
                  @endif
                  
                </div>
                
                <div class = "tab-pane" id = "shared_profile_notes" style="margin: 10px;">
                  
                  <div class="box box-primary" style="margin-bottom: 10px;">
            
                    <div class="box-body" style="padding-bottom: 0;">
    
                      <div class="row">
     
                        <div class="col-md-12">
              
                          <div class="nav-tabs-custom" style="margin-bottom: 10px;">
                
                            <ul class="nav nav-tabs">
    
                              <li class="active"><a href="#shared_profile_notes_list" data-toggle="tab" aria-expanded="false"> Shared Profile Notes </a></li>
                              
                              @if(isset($user_id))
                              
                                <li><a href="#upload_notes" data-toggle="tab" aria-expanded="false"> Upload Notes </a></li>
                                <li><a href="#shared_profile_note_comments" data-toggle="tab" aria-expanded="false"> Shared Profile Note Comments </a></li>
                                <li><a href="#shared_profile_note_comment_responses" data-toggle="tab" aria-expanded="false"> Shared Profile Note Comment Responses </a></li>
                                <li><a href="#shared_profile_note_likes" data-toggle="tab" aria-expanded="false"> Shared Profile Note Likes </a></li>
                    
                              @endif
                    
                            </ul>
              
                            <div class="tab-content clearfix" style="padding: 10;">
              
                              <div class="tab-pane active" id="shared_profile_notes_list">
                                
                                <div class="row">
                  
                                  <div class="col-md-12" style="padding: 0;">
                                      
                                    @foreach($sharedProfileNotesList as $sharedProfileNoteList)
                        
                                      <div class="col-md-12" style="margin-top: 10px;">
                        
                                        <div class="box box-primary" style="margin-bottom: 0;">
                          
                                          <div class="box-header with-border">
                            
                                            <div class="user-block">
                                              
                                              @if(isset($sharedProfileNoteUsersList))
                                              
                                                @foreach($sharedProfileNoteUsersList as $sharedProfileNoteUserListArray)
                                                
                                                  @if(isset($sharedProfileNoteUserListArray[0]))
                                                  
                                                    @if($sharedProfileNoteList -> user_id == $sharedProfileNoteUserListArray[0] -> id)
                                                    
                                                      <img class="img-circle" src="images/users/image_{!! $sharedProfileNoteList -> user_id !!}.{!! $sharedProfileNoteUserListArray[0] -> image_type !!}" alt="User Image">
                                                  
                                                      <span class="username"><a href="{!! route('sharedProfileUser.show', [$sharedProfileNoteList -> user_id]) !!}">{!! $sharedProfileNoteUserListArray[0] -> name !!}</a></span>
                                                      
                                                      <?php break; ?>
                                                  
                                                    @endif
                                                    
                                                  @endif
                                                
                                                @endforeach
                                                
                                              @endif
                                              
                                              <span class="description">Shared publicly - {!! $sharedProfileNoteList -> created_at !!} </span>
                            
                                            </div>
                            
                                            <div class="box-tools">
                              
                                              <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Mark as read"><a href="{!! route('sharedProfileNotes.show', [$sharedProfileNoteList -> id]) !!}"><i class="fa fa-eye"></i></a></button>
                              
                                              @if(isset($user_id))
                                              
                                                {!! Form::open(['route' => 'sharedProfileNoteLikes.store', 'id' => 'shared_profile_note_like_create', 'style' => 'display: inline-block']) !!}
                                              
                                                  {!! Form::hidden('status', 'Status:') !!}
                                                  {!! Form::hidden('status', 'on', ['class' => 'form-control']) !!}
                                                  
                                                  {!! Form::hidden('datetime', 'Datetime:') !!}
                                                  {!! Form::hidden('datetime', $now, ['class' => 'form-control']) !!}
                                                  
                                                  {!! Form::hidden('s_p_n_id', 'Shared Profile Note Id:') !!}
                                                  {!! Form::hidden('s_p_n_id', $sharedProfileNoteList -> id, ['class' => 'form-control']) !!}
                                                  
                                                  {!! Form::hidden('user_id', 'User Id:') !!}
                                                  {!! Form::hidden('user_id', $user_id, ['class' => 'form-control']) !!}
                                                  
                                                  <button type="submit" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Mark as read"><i class="fa fa-thumbs-o-up"></i></button>
                                
                                                {!! Form::close() !!}
                                              
                                              @endif
                                              
                                              <button type="button" class="btn btn-box-tool" data-toggle="collapse" data-target="#note_list_{!! $sharedProfileNoteList -> id  !!}"><i class="fa fa-minus"></i></button>
                            
                                            </div>
                          
                                          </div>
                          
                                          <div id = "note_list_{!! $sharedProfileNoteList -> id !!}" class="box-body">
                            
                                            <blockquote> {!! $sharedProfileNoteList -> content !!} </blockquote>
                                            
                                            <p class="text-muted well well-sm no-shadow" style="margin-top: 10px; margin-bottom: 15px; text-align: justify;"> {!! $sharedProfileNoteList -> description  !!} </p>
                            
                                            <div class="box-footer">
                                              
                                              @if(isset($user_id))
                              
                                                <form id='shared_profile_note_comment_r' action = "{!! URL::to('/store_shared_profile_note_comment') !!}" method = "post">
                            
                                                  {{ csrf_field() }}
                                  
                                                  <img class="img-responsive img-circle img-sm" src="images/users/image_{!! $user_id !!}.{!! $user[0] -> image_type !!}" alt="Alt Text">
                                  
                                                  <div class="img-push">
                                  
                                                    <input id="s_p_n_id" name="s_p_n_id" type="hidden" value="{!! $sharedProfileNoteList -> id !!}">
                                                    <input id="status" name="status" type="hidden" value="on">
                                                    <input id="datetime" name="datetime" type="hidden" value="{!! $now !!}">
                                                    <input id="user_id" name="user_id" type="hidden" value="{!! $user_id !!}">
                                                    
                                                    <input id="shared_profile_note_comment_r_content" name="content" type="text" class="form-control input-sm" placeholder="Press enter to post comment">
                                  
                                                  </div>
                                
                                                </form>
                                                
                                              @endif
                            
                                            </div>
                          
                                          </div>
                        
                                        </div>
                      
                                      </div>
                                      
                                    @endforeach
                                    
                                  </div>
                                  
                                </div>
                                
                              </div>
                              
                              @if(isset($user_id))
                              
                                <div class="tab-pane" id="upload_notes">
                                  
                                  <div class="table-responsive">
                                  
                                      <table class="table table-hover table-bordered table-striped dataTable" style="margin-bottom: 0;">
        
                                        <thead>
                            
                                          <tr>
                                
                                            <th>Name</th>
                                            <th colspan="3">Action</th>
                            
                                          </tr>
                        
                                        </thead>
                        
                                        <tbody>
                          
                                          @if(isset($notes))
                          
                                            @foreach($notes as $note)
                            
                                              <tr>
                                    
                                                <td> <a href="{!! route('sharedProfileNotes.show', [$note->id]) !!}"> {!! $note -> name !!} </a> </td>
                                                    
                                                <td>
                                                        
                                                  {!! Form::open(['route' => ['sharedProfileNotes.destroy', $note->id], 'method' => 'delete']) !!}
                                                  
                                                    <div class="btn-group">
                                                            
                                                      <a href="{!! route('sharedProfileNotes.show', [$note->id]) !!}" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-eye-open"></i></a>
                                                      <a href="{!! route('sharedProfileNotes.edit', [$note->id]) !!}" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
                                                      {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                                                        
                                                    </div>
                                                        
                                                  {!! Form::close() !!}
                                                    
                                                </td>
                                                
                                              </tr>
                                          
                                            @endforeach
                                        
                                          @endif
                                        
                                        </tbody>
                                    
                                      </table>
                                    
                                  </div>
                                  
                                </div>
                                
                                <div class="tab-pane" id="shared_profile_note_comments">
                                  
                                  <span class="pull-right text-muted" style="background: rgba(0,0,0,0.2); color: #fff; margin: 10px; padding: 0 5px;">
                                    
                                    {!! $sharedProfileNoteCommentsListCount !!} comments
                                  
                                  </span>
                                  
                                  <div class="box-footer box-comments" style="padding-top: 40px;">
                                    
                                    @foreach($sharedProfileNoteCommentsList as $sharedProfileNoteCommentList)
                                    
                                      <div class="box-comment">
                                        
                                        <i class="menu-icon fa fa-comment-o bg-light-blue" style="font-size: 15px; border-radius: 50%; padding: 10px;"></i>
                                        
                                        <div class="comment-text" style="text-align:justify; padding-right: 10px;">
                                          
                                          <a href="{!! route('sharedProfileNotes.show', [$sharedProfileNoteCommentList -> id]) !!}">
                                            
                                            <span class="username">
                                              
                                              {!! $sharedProfileNoteCommentList -> name !!}
                                              
                                              <span class="text-muted pull-right" style="background: rgba(0,0,0,0.1); color: #000; padding: 0 5px;">{!! $sharedProfileNoteCommentList -> created_at !!}</span>
                                              
                                            </span>
                                            
                                          </a>
                                          
                                          {!! $sharedProfileNoteCommentList -> content !!}
                                          
                                        </div>
                                        
                                      </div>
                                    
                                    @endforeach
                                    
                                  </div>
                                  
                                </div>
                                
                                <div class="tab-pane" id="shared_profile_note_comment_responses">
                                  
                                  <span class="pull-right text-muted" style="background: rgba(0,0,0,0.2); color: #fff; margin: 10px; padding: 0 5px;">
                                    
                                    {!! $sharedProfileNoteCommentResponsesListCount !!} comments
                                  
                                  </span>
                                  
                                  <div class="box-footer box-comments" style="padding-top: 40px;">
                                    
                                    @foreach($sharedProfileNoteCommentResponsesList as $sharedProfileNoteCommentResponseList)
                                    
                                      <div class="box-comment">
                                        
                                        <i class="menu-icon fa fa-comments-o bg-light-blue" style="font-size: 15px; border-radius: 50%; padding: 10px;"></i>
                                        
                                        <div class="comment-text" style="text-align:justify; padding-right: 10px;">
                                          
                                          <a href="{!! route('sharedProfileNotes.show', [$sharedProfileNoteCommentResponseList -> id]) !!}">
                                            
                                            <span class="username">
                                              
                                              {!! $sharedProfileNoteCommentResponseList -> name !!}
                                              
                                              <span class="text-muted pull-right" style="background: rgba(0,0,0,0.1); color: #000; padding: 0 5px;">{!! $sharedProfileNoteCommentResponseList -> created_at !!}</span>
                                              
                                            </span>
                                            
                                          </a>
                                          
                                          {!! $sharedProfileNoteCommentResponseList -> content !!}
                                          
                                        </div>
                                        
                                      </div>
                                    
                                    @endforeach
                                    
                                  </div>
                                  
                                </div>
                                
                                <div class="tab-pane" id="shared_profile_note_likes">
                                  
                                  <div class="box box-primary" style="margin-bottom: 0;">
  
                                    <div class="box-body">
                                    
                                      <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                      
                                        <div class="row">
                      
                                          <div class="col-sm-12">
                                            
                                            <div class="small-box bg-green">
                                    
                                              <div class="inner">
                                    
                                                <h3><sup style="font-size: 20px">{!! $sharedProfileNoteLikesListCount !!}</sup></h3>
                      
                                                <p>Likes Quantity</p>
                                  
                                              </div>
                                  
                                              <div class="icon">
                                    
                                                <i class="ion ion-stats-bars"></i>
                                  
                                              </div>
                                    
                                            </div>
                      
                                            <div class="table-responsive">
                      
                                              <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info" style="margin-bottom: 0;">
                                        
                                                <thead>
                                        
                                                  <tr role="row">
                        
                                                    <th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 224px;" aria-sort="descending"> Note Name </th>
                                                    
                                                    <th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 224px;" aria-sort="descending"> Datetime </th>
                                                    
                                                  </tr>
                                        
                                                </thead>
                                        
                                                <tbody>
                                          
                                                  @foreach($sharedProfileNoteLikesListC as $sharedProfileNoteLikeList)
                        
                                                    <tr role="row" class="odd">
                                                    
                                                      <td class=""> <a href="{!! route('sharedProfileNotes.show', [$sharedProfileNoteLikeList -> id]) !!}"> {!! $sharedProfileNoteLikeList->name !!} </a> </td>
                                                      
                                                      <td class=""> {!! $sharedProfileNoteLikeList->created_at !!} </td>
                                        
                                                    </tr>
                            
                                                  @endforeach
                        
                                                </tbody>
                                      
                                              </table>
                                              
                                            </div>
                      
                                          </div>
                      
                                        </div>
                      
                                      </div>
                                  
                                    </div>
                      
                                  </div>
                                
                                </div>
                              
                              @endif
                              
                            </div>
                            
                          </div>
                          
                        </div>
                        
                      </div>
                      
                    </div>
                    
                  </div>
                  
                  @if(isset($user_id))
                  
                    <a href="{!! route('sharedProfileNotes.create') !!}" class="btn btn-default">Add Note</a>
                
                  @endif
                
                </div>
                
                <div class = "tab-pane" id = "shared_profile_images" style="margin: 10px;">
                  
                  <div class="box box-primary" style="margin-bottom: 10px;">
            
                    <div class="box-body" style="padding-bottom: 0;">
    
                      <div class="row">
     
                        <div class="col-md-12">
              
                          <div class="nav-tabs-custom" style="margin-bottom: 10px;">
                
                            <ul class="nav nav-tabs">
    
                              <li class="active"><a href="#shared_profile_images_list" data-toggle="tab" aria-expanded="false"> Shared Profile Images </a></li>
                              
                              @if(isset($user_id))
                              
                                <li><a href="#upload_images" data-toggle="tab" aria-expanded="false"> Upload Images </a></li>
                                <li><a href="#shared_profile_image_comments" data-toggle="tab" aria-expanded="false"> Shared Profile Image Comments </a></li>
                                <li><a href="#shared_profile_image_comment_responses" data-toggle="tab" aria-expanded="false"> Shared Profile Image Comment Responses </a></li>
                                <li><a href="#shared_profile_image_likes" data-toggle="tab" aria-expanded="false"> Shared Profile Image Likes </a></li>
                    
                              @endif
                    
                            </ul>
              
                            <div class="tab-content clearfix" style="padding: 10;">
              
                              <div class="tab-pane active" id="shared_profile_images_list">
                                
                                <div class="row">
                  
                                  <div class="col-md-12" style="padding: 0;">
                                      
                                    @foreach($sharedProfileImagesList as $sharedProfileImageList)
                        
                                      <div class="col-md-12" style="margin-top: 10px;">
                        
                                        <div class="box box-primary" style="margin-bottom: 0;">
                          
                                          <div class="box-header with-border">
                            
                                            <div class="user-block">
                                              
                                              @if(isset($sharedProfileImageUsersList))
                                              
                                                @foreach($sharedProfileImageUsersList as $sharedProfileImageUserListArray)
                                                
                                                  @if(isset($sharedProfileImageUserListArray[0]))
                                                  
                                                    @if($sharedProfileImageList -> user_id == $sharedProfileImageUserListArray[0] -> id)
                                                    
                                                      <img class="img-circle" src="images/users/image_{!! $sharedProfileImageList -> user_id !!}.{!! $sharedProfileImageUserListArray[0] -> image_type !!}" alt="User Image">
                                                  
                                                      <span class="username"><a href="{!! route('sharedProfileUser.show', [$sharedProfileImageList -> user_id]) !!}">{!! $sharedProfileImageUserListArray[0] -> name !!}</a></span>
                                                      
                                                      <?php break; ?>
                                                  
                                                    @endif
                                                    
                                                  @endif
                                                
                                                @endforeach
                                                
                                              @endif
                                              
                                              <span class="description">Shared publicly - {!! $sharedProfileImageList -> created_at !!} </span>
                            
                                            </div>
                            
                                            <div class="box-tools">
                              
                                              <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Mark as read"><a href="{!! route('sharedProfileImages.show', [$sharedProfileImageList -> id]) !!}"><i class="fa fa-eye"></i></a></button>
                              
                                              @if(isset($user_id))
                              
                                                {!! Form::open(['route' => 'sharedProfileImageLikes.store', 'id' => 'shared_profile_image_like_create', 'style' => 'display: inline-block']) !!}
                                              
                                                  {!! Form::hidden('status', 'Status:') !!}
                                                  {!! Form::hidden('status', 'on', ['class' => 'form-control']) !!}
                                                  
                                                  {!! Form::hidden('datetime', 'Datetime:') !!}
                                                  {!! Form::hidden('datetime', $now, ['class' => 'form-control']) !!}
                                                  
                                                  {!! Form::hidden('s_p_i_id', 'Shared Profile Image Id:') !!}
                                                  {!! Form::hidden('s_p_i_id', $sharedProfileImageList -> id, ['class' => 'form-control']) !!}
                                                  
                                                  {!! Form::hidden('user_id', 'User Id:') !!}
                                                  {!! Form::hidden('user_id', $user_id, ['class' => 'form-control']) !!}
                                                  
                                                  <button type="submit" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Mark as read"><i class="fa fa-thumbs-o-up"></i></button>
                                
                                                {!! Form::close() !!}
                                                
                                              @endif
                                              
                                              <button type="button" class="btn btn-box-tool" data-toggle="collapse" data-target="#image_list_{!! $sharedProfileImageList -> id  !!}"><i class="fa fa-minus"></i></button>
                            
                                            </div>
                          
                                          </div>
                          
                                          <div id="image_list_{!! $sharedProfileImageList -> id !!}" class="box-body">
                            
                                            <img src="/images/shared_profile_images/image_{!! $sharedProfileImageList -> id !!}.{!! $sharedProfileImageList -> file_type !!}" style="width: 100%; margin-bottom: 5px;">
                                            
                                            <p class="text-muted well well-sm no-shadow" style="margin-top: 10px; margin-bottom: 15px; text-align: justify;"> {!! $sharedProfileImageList -> description  !!} </p>
                            
                                            <div class="box-footer">
                              
                                              @if(isset($user_id))
                              
                                                <form id='shared_profile_image_comment_r' action = "{!! URL::to('/store_shared_profile_image_comment') !!}" method = "post">
                            
                                                  {{ csrf_field() }}
                                  
                                                  <img class="img-responsive img-circle img-sm" src="images/users/image_{!! $user_id !!}.{!! $user[0] -> image_type !!}" alt="Alt Text">
                                  
                                                  <div class="img-push">
                                  
                                                    <input id="s_p_i_id" name="s_p_i_id" type="hidden" value="{!! $sharedProfileImageList -> id !!}">
                                                    <input id="status" name="status" type="hidden" value="on">
                                                    <input id="datetime" name="datetime" type="hidden" value="{!! $now !!}">
                                                    <input id="user_id" name="user_id" type="hidden" value="{!! $user_id !!}">
                                                    
                                                    <input id="shared_profile_image_comment_r_content" name="content" type="text" class="form-control input-sm" placeholder="Press enter to post comment">
                                  
                                                  </div>
                                
                                                </form>
                                              
                                              @endif
                            
                                            </div>
                          
                                          </div>
                        
                                        </div>
                      
                                      </div>
                                      
                                    @endforeach
                                    
                                  </div>
                                  
                                </div>
                                
                              </div>
                              
                              @if(isset($user_id))
                              
                                <div class="tab-pane" id="upload_images">
                                  
                                  <div class="widget-container" style="margin-bottom: 0; padding: 10px;">
          
                                    <div class="widget row image-tile">
                    
                                      @if(isset($images))
                    
                                        @foreach($images as $image)
                        
                                          <a href="{!! route('sharedProfileImages.show', [$image->id]) !!}">
                                                
                                            <div class="tile col-xs-4" style="background: url('/images/shared_profile_images/image_{!! $image -> id !!}.{!! $image -> file_type !!}') no-repeat center top; background-size: cover;">
                                              <p style="margin-bottom: 0;"> </p>
                                            </div>
                                        
                                          </a>
                                        
                                        @endforeach
                                        
                                      @endif
                                      
                                    </div>
                        
                                  </div>
                                  
                                </div>
                                
                                <div class="tab-pane" id="shared_profile_image_comments">
                                  
                                  <span class="pull-right text-muted" style="background: rgba(0,0,0,0.2); color: #fff; margin: 10px; padding: 0 5px;">
                                    
                                    {!! $sharedProfileImageCommentsListCount !!} comments
                                  
                                  </span>
                                  
                                  <div class="box-footer box-comments" style="padding-top: 40px;">
                                    
                                    @foreach($sharedProfileImageCommentsList as $sharedProfileImageCommentList)
                                    
                                      <div class="box-comment">
                                        
                                        <i class="menu-icon fa fa-comment-o bg-light-blue" style="font-size: 15px; border-radius: 50%; padding: 10px;"></i>
                                        
                                        <div class="comment-text" style="text-align:justify; padding-right: 10px;">
                                          
                                          <a href="{!! route('sharedProfileImages.show', [$sharedProfileImageCommentList -> id]) !!}">
                                            
                                            <span class="username">
                                              
                                              {!! $sharedProfileImageCommentList -> name !!}
                                              
                                              <span class="text-muted pull-right" style="background: rgba(0,0,0,0.1); color: #000; padding: 0 5px;">{!! $sharedProfileImageCommentList -> created_at !!}</span>
                                              
                                            </span>
                                            
                                          </a>
                                          
                                          {!! $sharedProfileImageCommentList -> content !!}
                                          
                                        </div>
                                        
                                      </div>
                                    
                                    @endforeach
                                    
                                  </div>
                                  
                                </div>
                                
                                <div class="tab-pane" id="shared_profile_image_comment_responses">
                                  
                                  <span class="pull-right text-muted" style="background: rgba(0,0,0,0.2); color: #fff; margin: 10px; padding: 0 5px;">
                                    
                                    {!! $sharedProfileImageCommentResponsesListCount !!} comments
                                  
                                  </span>
                                  
                                  <div class="box-footer box-comments" style="padding-top: 40px;">
                                    
                                    @foreach($sharedProfileImageCommentResponsesList as $sharedProfileImageCommentResponseList)
                                    
                                      <div class="box-comment">
                                        
                                        <i class="menu-icon fa fa-comments-o bg-light-blue" style="font-size: 15px; border-radius: 50%; padding: 10px;"></i>
                                        
                                        <div class="comment-text" style="text-align:justify; padding-right: 10px;">
                                          
                                          <a href="{!! route('sharedProfileImages.show', [$sharedProfileImageCommentResponseList -> id]) !!}">
                                            
                                            <span class="username">
                                              
                                              {!! $sharedProfileImageCommentResponseList -> name !!}
                                              
                                              <span class="text-muted pull-right" style="background: rgba(0,0,0,0.1); color: #000; padding: 0 5px;">{!! $sharedProfileImageCommentResponseList -> created_at !!}</span>
                                              
                                            </span>
                                            
                                          </a>
                                          
                                          {!! $sharedProfileImageCommentResponseList -> content !!}
                                          
                                        </div>
                                        
                                      </div>
                                    
                                    @endforeach
                                    
                                  </div>
                                  
                                </div>
                                
                                <div class="tab-pane" id="shared_profile_image_likes">
                                  
                                  <div class="box box-primary" style="margin-bottom: 0;">
  
                                    <div class="box-body">
                                    
                                      <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                      
                                        <div class="row">
                      
                                          <div class="col-sm-12">
                                            
                                            <div class="small-box bg-green">
                                    
                                              <div class="inner">
                                    
                                                <h3><sup style="font-size: 20px">{!! $sharedProfileImageLikesListCount !!}</sup></h3>
                      
                                                <p>Likes Quantity</p>
                                  
                                              </div>
                                  
                                              <div class="icon">
                                    
                                                <i class="ion ion-stats-bars"></i>
                                  
                                              </div>
                                    
                                            </div>
                      
                                            <div class="table-responsive">
                      
                                              <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info" style="margin-bottom: 0;">
                                        
                                                <thead>
                                        
                                                  <tr role="row">
                        
                                                    <th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 224px;" aria-sort="descending"> Image Name </th>
                                                    
                                                    <th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 224px;" aria-sort="descending"> Datetime </th>
                                                    
                                                  </tr>
                                        
                                                </thead>
                                        
                                                <tbody>
                                          
                                                  @foreach($sharedProfileImageLikesListC as $sharedProfileImageLikeList)
                        
                                                    <tr role="row" class="odd">
                                                    
                                                      <td class=""> <a href="{!! route('sharedProfileImages.show', [$sharedProfileImageLikeList -> id]) !!}"> {!! $sharedProfileImageLikeList->name !!} </a> </td>
                                                      
                                                      <td class=""> {!! $sharedProfileImageLikeList->created_at !!} </td>
                                        
                                                    </tr>
                            
                                                  @endforeach
                        
                                                </tbody>
                                      
                                              </table>
                                              
                                            </div>
                      
                                          </div>
                      
                                        </div>
                      
                                      </div>
                                  
                                    </div>
                      
                                  </div>
                                
                                </div>
                              
                              @endif
                              
                            </div>
                            
                          </div>
                          
                        </div>
                        
                      </div>
                      
                    </div>
                    
                  </div>
                  
                  @if(isset($user_id))
                  
                    <a href="{!! route('sharedProfileImages.create') !!}" class="btn btn-default">Add Image</a>
  
                  @endif
                
                </div>
                
                <div class = "tab-pane" id = "shared_profile_audios" style="margin: 10px;">
                  
                  <div class="box box-primary" style="margin-bottom: 10px;">
            
                    <div class="box-body" style="padding-bottom: 0;">
    
                      <div class="row">
     
                        <div class="col-md-12">
              
                          <div class="nav-tabs-custom" style="margin-bottom: 10px;">
                
                            <ul class="nav nav-tabs">
    
                              <li class="active"><a href="#shared_profile_audios_list" data-toggle="tab" aria-expanded="false"> Shared Profile Audios </a></li>
                              
                              @if(isset($user_id))
                              
                                <li><a href="#upload_audios" data-toggle="tab" aria-expanded="false"> Upload Audios </a></li>
                                <li><a href="#shared_profile_audio_comments" data-toggle="tab" aria-expanded="false"> Shared Profile Audio Comments </a></li>
                                <li><a href="#shared_profile_audio_comment_responses" data-toggle="tab" aria-expanded="false"> Shared Profile Audio Comment Responses </a></li>
                                <li><a href="#shared_profile_audio_likes" data-toggle="tab" aria-expanded="false"> Shared Profile Audio Likes </a></li>
                    
                              @endif
                    
                            </ul>
              
                            <div class="tab-content clearfix" style="padding: 10;">
              
                              <div class="tab-pane active" id="shared_profile_audios_list">
                                
                                <div class="row">
                  
                                  <div class="col-md-12" style="padding: 0;">
                                      
                                    @foreach($sharedProfileAudiosList as $sharedProfileAudioList)
                        
                                      <div class="col-md-12" style="margin-top: 10px;">
                        
                                        <div class="box box-primary" style="margin-bottom: 0;">
                          
                                          <div class="box-header with-border">
                            
                                            <div class="user-block">
                                              
                                              @if(isset($sharedProfileAudioUsersList))
                                              
                                                @foreach($sharedProfileAudioUsersList as $sharedProfileAudioUserListArray)
                                                
                                                  @if(isset($sharedProfileAudioUserListArray[0]))
                                                  
                                                    @if($sharedProfileAudioList -> user_id == $sharedProfileAudioUserListArray[0] -> id)
                                                  
                                                      <img class="img-circle" src="images/users/image_{!! $sharedProfileAudioList -> user_id !!}.{!! $sharedProfileAudioUserListArray[0] -> image_type !!}" alt="User Image">
                                                  
                                                      <span class="username"><a href="{!! route('sharedProfileUser.show', [$sharedProfileAudioList -> user_id]) !!}">{!! $sharedProfileAudioUserListArray[0] -> name !!}</a></span>
                                                      
                                                      <?php break; ?>
                                                  
                                                    @endif
                                                    
                                                  @endif
                                                
                                                @endforeach
                                                
                                              @endif
                                              
                                              <span class="description">Shared publicly - {!! $sharedProfileAudioList -> created_at !!} </span>
                            
                                            </div>
                            
                                            <div class="box-tools">
                                
                                              <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Mark as read"><a href="{!! route('sharedProfileAudios.show', [$sharedProfileAudioList -> id]) !!}"><i class="fa fa-eye"></i></a></button>
                              
                                              @if(isset($user_id))
                              
                                                {!! Form::open(['route' => 'sharedProfileAudioLikes.store', 'id' => 'shared_profile_audio_like_create', 'style' => 'display: inline-block']) !!}
                                              
                                                  {!! Form::hidden('status', 'Status:') !!}
                                                  {!! Form::hidden('status', 'on', ['class' => 'form-control']) !!}
                                                  
                                                  {!! Form::hidden('datetime', 'Datetime:') !!}
                                                  {!! Form::hidden('datetime', $now, ['class' => 'form-control']) !!}
                                                  
                                                  {!! Form::hidden('s_p_a_id', 'Shared Profile Audio Id:') !!}
                                                  {!! Form::hidden('s_p_a_id', $sharedProfileAudioList -> id, ['class' => 'form-control']) !!}
                                                  
                                                  {!! Form::hidden('user_id', 'User Id:') !!}
                                                  {!! Form::hidden('user_id', $user_id, ['class' => 'form-control']) !!}
                                                  
                                                  <button type="submit" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Mark as read"><i class="fa fa-thumbs-o-up"></i></button>
                                
                                                {!! Form::close() !!}
                                                
                                              @endif
                                              
                                              <button type="button" class="btn btn-box-tool" data-toggle="collapse" data-target="#audio_list_{!! $sharedProfileAudioList -> id  !!}"><i class="fa fa-minus"></i></button>
                            
                                            </div>
                          
                                          </div>
                          
                                          <div id="audio_list_{!! $sharedProfileAudioList -> id !!}" class="box-body">
                            
                                            <audio style="width: 100%; padding: 5px;" controls>
                
                                              <source src="/audios/shared_profile_audios/audio_{!! $sharedProfileAudioList -> id !!}.{!! $sharedProfileAudio -> file_type !!}" type="audio/{!! $sharedProfileAudioList -> file_type !!}">
              
                                              Your browser does not support the audio element.
              
                                            </audio>
                                            
                                            <p class="text-muted well well-sm no-shadow" style="margin-top: 10px; margin-bottom: 15px; text-align: justify;"> {!! $sharedProfileAudioList -> description  !!} </p>
                            
                                            <div class="box-footer">
                                              
                                              @if(isset($user_id))
                              
                                                <form id='shared_profile_audio_comment_r' action = "{!! URL::to('/store_shared_profile_audio_comment') !!}" method = "post">
                            
                                                  {{ csrf_field() }}
                                  
                                                  <img class="img-responsive img-circle img-sm" src="images/users/image_{!! $user_id !!}.{!! $user[0] -> image_type !!}" alt="Alt Text">
                                  
                                                  <div class="img-push">
                                  
                                                    <input id="s_p_a_id" name="s_p_a_id" type="hidden" value="{!! $sharedProfileAudioList -> id !!}">
                                                    <input id="status" name="status" type="hidden" value="on">
                                                    <input id="datetime" name="datetime" type="hidden" value="{!! $now !!}">
                                                    <input id="user_id" name="user_id" type="hidden" value="{!! $user_id !!}">
                                                    
                                                    <input id="shared_profile_audio_comment_r_content" name="content" type="text" class="form-control input-sm" placeholder="Press enter to post comment">
                                  
                                                  </div>
                                
                                                </form>
                                                
                                              @endif
                            
                                            </div>
                          
                                          </div>
                        
                                        </div>
                      
                                      </div>
                                      
                                    @endforeach
                                    
                                  </div>
                                  
                                </div>
                                
                              </div>
                              
                              @if(isset($user_id))
                              
                                <div class="tab-pane" id="upload_audios">
                                  
                                  <table class="table table-hover table-bordered table-striped dataTable" id="collegeTSGaleries-filtered_table" style="margin-bottom: 0;">
    
                                    <thead>
                                          
                                      <tr>
                                              
                                        <th>Name</th>
                                        <th colspan="3">Action</th>
                                          
                                      </tr>
                                      
                                    </thead>
                                      
                                    <tbody>
                                      
                                      @if(isset($audios))
                                      
                                        @foreach($audios as $audio)
                                        
                                          <tr>
                                                  
                                            <td> <a href="{!! route('sharedProfileAudios.show', [$audio->id]) !!}"> {!! $audio -> name !!} </a> </td>
                                                  
                                            <td>
                                                      
                                              {!! Form::open(['route' => ['sharedProfileAudios.destroy', $audio->id], 'method' => 'delete']) !!}
                                              
                                                <div class="btn-group">
                                                        
                                                  <a href="{!! route('sharedProfileAudios.show', [$audio->id]) !!}" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-eye-open"></i></a>
                                                  <a href="{!! route('sharedProfileAudios.edit', [$audio->id]) !!}" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
                                                  {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                                                    
                                                </div>
                                                    
                                              {!! Form::close() !!}
                                                  
                                            </td>
                                              
                                          </tr>
                                          
                                        @endforeach
                                        
                                      @endif
                                      
                                    </tbody>
                                  
                                  </table>
                                  
                                </div>
                                
                                <div class="tab-pane" id="shared_profile_audio_comments">
                                  
                                  <span class="pull-right text-muted" style="background: rgba(0,0,0,0.2); color: #fff; margin: 10px; padding: 0 5px;">
                                    
                                    {!! $sharedProfileAudioCommentsListCount !!} comments
                                  
                                  </span>
                                  
                                  <div class="box-footer box-comments" style="padding-top: 40px;">
                                    
                                    @foreach($sharedProfileAudioCommentsList as $sharedProfileAudioCommentList)
                                    
                                      <div class="box-comment">
                                        
                                        <i class="menu-icon fa fa-comment-o bg-light-blue" style="font-size: 15px; border-radius: 50%; padding: 10px;"></i>
                                        
                                        <div class="comment-text" style="text-align:justify; padding-right: 10px;">
                                          
                                          <a href="{!! route('sharedProfileAudios.show', [$sharedProfileAudioCommentList -> id]) !!}">
                                            
                                            <span class="username">
                                              
                                              {!! $sharedProfileAudioCommentList -> name !!}
                                              
                                              <span class="text-muted pull-right" style="background: rgba(0,0,0,0.1); color: #000; padding: 0 5px;">{!! $sharedProfileAudioCommentList -> created_at !!}</span>
                                              
                                            </span>
                                            
                                          </a>
                                          
                                          {!! $sharedProfileAudioCommentList -> content !!}
                                          
                                        </div>
                                        
                                      </div>
                                    
                                    @endforeach
                                    
                                  </div>
                                  
                                </div>
                                
                                <div class="tab-pane" id="shared_profile_audio_comment_responses">
                                  
                                  <span class="pull-right text-muted" style="background: rgba(0,0,0,0.2); color: #fff; margin: 10px; padding: 0 5px;">
                                    
                                    {!! $sharedProfileAudioCommentResponsesListCount !!} comments
                                  
                                  </span>
                                  
                                  <div class="box-footer box-comments" style="padding-top: 40px;">
                                    
                                    @foreach($sharedProfileAudioCommentResponsesList as $sharedProfileAudioCommentResponseList)
                                    
                                      <div class="box-comment">
                                        
                                        <i class="menu-icon fa fa-comments-o bg-light-blue" style="font-size: 15px; border-radius: 50%; padding: 10px;"></i>
                                        
                                        <div class="comment-text" style="text-align:justify; padding-right: 10px;">
                                          
                                          <a href="{!! route('sharedProfileAudios.show', [$sharedProfileAudioCommentResponseList -> id]) !!}">
                                            
                                            <span class="username">
                                              
                                              {!! $sharedProfileAudioCommentResponseList -> name !!}
                                              
                                              <span class="text-muted pull-right" style="background: rgba(0,0,0,0.1); color: #000; padding: 0 5px;">{!! $sharedProfileAudioCommentResponseList -> created_at !!}</span>
                                              
                                            </span>
                                            
                                          </a>
                                          
                                          {!! $sharedProfileAudioCommentResponseList -> content !!}
                                          
                                        </div>
                                        
                                      </div>
                                    
                                    @endforeach
                                    
                                  </div>
                                  
                                </div>
                                
                                <div class="tab-pane" id="shared_profile_audio_likes">
                                  
                                  <div class="box box-primary" style="margin-bottom: 0;">
  
                                    <div class="box-body">
                                    
                                      <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                      
                                        <div class="row">
                      
                                          <div class="col-sm-12">
                                            
                                            <div class="small-box bg-green">
                                    
                                              <div class="inner">
                                    
                                                <h3><sup style="font-size: 20px">{!! $sharedProfileAudioLikesListCount !!}</sup></h3>
                      
                                                <p>Likes Quantity</p>
                                  
                                              </div>
                                  
                                              <div class="icon">
                                    
                                                <i class="ion ion-stats-bars"></i>
                                  
                                              </div>
                                    
                                            </div>
                      
                                            <div class="table-responsive">
                      
                                              <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info" style="margin-bottom: 0;">
                                        
                                                <thead>
                                        
                                                  <tr role="row">
                        
                                                    <th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 224px;" aria-sort="descending"> Audio Name </th>
                                                    
                                                    <th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 224px;" aria-sort="descending"> Datetime </th>
                                                    
                                                  </tr>
                                        
                                                </thead>
                                        
                                                <tbody>
                                          
                                                  @foreach($sharedProfileAudioLikesListC as $sharedProfileAudioLikeList)
                        
                                                    <tr role="row" class="odd">
                                                    
                                                      <td class=""> <a href="{!! route('sharedProfileAudios.show', [$sharedProfileAudioLikeList -> id]) !!}"> {!! $sharedProfileAudioLikeList->name !!} </a> </td>
                                                      
                                                      <td class=""> {!! $sharedProfileAudioLikeList->created_at !!} </td>
                                        
                                                    </tr>
                            
                                                  @endforeach
                        
                                                </tbody>
                                      
                                              </table>
                                              
                                            </div>
                      
                                          </div>
                      
                                        </div>
                      
                                      </div>
                                  
                                    </div>
                    
                                  </div>
                                  
                                </div>
                                
                              @endif
                              
                            </div>
                            
                          </div>
                          
                        </div>
                        
                      </div>
                      
                    </div>
                    
                  </div>
                  
                  @if(isset($user_id))
                  
                    <a href="{!! route('sharedProfileAudios.create') !!}" class="btn btn-default">Add Audio</a>
                    
                  @endif
                  
                </div>
                
                <div class = "tab-pane" id = "shared_profile_videos" style="margin: 10px;">
                  
                  <div class="box box-primary" style="margin-bottom: 10px;">
            
                    <div class="box-body" style="padding-bottom: 0;">
    
                      <div class="row">
     
                        <div class="col-md-12">
              
                          <div class="nav-tabs-custom" style="margin-bottom: 10px;">
                
                            <ul class="nav nav-tabs">
    
                              <li class="active"><a href="#shared_profile_videos_list" data-toggle="tab" aria-expanded="false"> Shared Profile Videos </a></li>
                              
                              @if(isset($user_id))
                              
                                <li><a href="#upload_videos" data-toggle="tab" aria-expanded="false"> Upload Videos </a></li>
                                <li><a href="#shared_profile_video_comments" data-toggle="tab" aria-expanded="false"> Shared Profile Video Comments </a></li>
                                <li><a href="#shared_profile_video_comment_responses" data-toggle="tab" aria-expanded="false"> Shared Profile Video Comment Responses </a></li>
                                <li><a href="#shared_profile_video_likes" data-toggle="tab" aria-expanded="false"> Shared Profile Video Likes </a></li>
                    
                              @endif
                    
                            </ul>
              
                            <div class="tab-content clearfix" style="padding: 10;">
              
                              <div class="tab-pane active" id="shared_profile_videos_list">
                                
                                <div class="row">
                  
                                  <div class="col-md-12" style="padding: 0;">
                                      
                                    @foreach($sharedProfileVideosList as $sharedProfileVideoList)
                        
                                      <div class="col-md-12" style="margin-top: 10px;">
                        
                                        <div class="box box-primary" style="margin-bottom: 0;">
                          
                                          <div class="box-header with-border">
                            
                                            <div class="user-block">
                                              
                                              @if(isset($sharedProfileVideoUsersList))
                                            
                                                @foreach($sharedProfileVideoUsersList as $sharedProfileVideoUserListArray)
                                                
                                                  @if(isset($sharedProfileVideoUserListArray[0]))
                                                  
                                                    @if($sharedProfileVideoList -> user_id == $sharedProfileVideoUserListArray[0] -> id)
                                                    
                                                      <img class="img-circle" src="images/users/image_{!! $sharedProfileVideoList -> user_id !!}.{!! $sharedProfileVideoUserListArray[0] -> image_type !!}" alt="User Image">
                                                  
                                                      <span class="username"><a href="{!! route('sharedProfileUser.show', [$sharedProfileVideoList -> user_id]) !!}">{!! $sharedProfileVideoUserListArray[0] -> name !!}</a></span>
                                                      
                                                      <?php break; ?>
                                                  
                                                    @endif
                                                    
                                                  @endif
                                                
                                                @endforeach
                                                
                                              @endif
                                              
                                              <span class="description">Shared publicly - {!! $sharedProfileVideoList -> created_at !!}</span>
                            
                                            </div>
                            
                                            <div class="box-tools">
                              
                                              <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Mark as read"><a href="{!! route('sharedProfileVideos.show', [$sharedProfileVideoList -> id]) !!}"><i class="fa fa-eye"></i></a></button>
                              
                                              @if(isset($user_id))
                              
                                                {!! Form::open(['route' => 'sharedProfileVideoLikes.store', 'id' => 'shared_profile_video_like_create', 'style' => 'display: inline-block']) !!}
                                              
                                                  {!! Form::hidden('status', 'Status:') !!}
                                                  {!! Form::hidden('status', 'on', ['class' => 'form-control']) !!}
                                                  
                                                  {!! Form::hidden('datetime', 'Datetime:') !!}
                                                  {!! Form::hidden('datetime', $now, ['class' => 'form-control']) !!}
                                                  
                                                  {!! Form::hidden('s_p_v_id', 'Shared Profile Video Id:') !!}
                                                  {!! Form::hidden('s_p_v_id', $sharedProfileVideoList -> id, ['class' => 'form-control']) !!}
                                                  
                                                  {!! Form::hidden('user_id', 'User Id:') !!}
                                                  {!! Form::hidden('user_id', $user_id, ['class' => 'form-control']) !!}
                                                  
                                                  <button type="submit" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Mark as read"><i class="fa fa-thumbs-o-up"></i></button>
                                
                                                {!! Form::close() !!}
                                                
                                              @endif
                                              
                                              <button type="button" class="btn btn-box-tool" data-toggle="collapse" data-target="#video_list_{!! $sharedProfileVideoList -> id  !!}"><i class="fa fa-minus"></i></button>
                            
                                            </div>
                          
                                          </div>
                          
                                          <div id="video_list_{!! $sharedProfileVideoList -> id  !!}" class="box-body">
                            
                                            <video width="100%" style="margin-bottom: 5px;" controls>
                                  
                                              <source src="/videos/shared_profile_videos/video_{!! $sharedProfileVideo -> id !!}.{!! $sharedProfileVideo -> file_type !!}" type="video/mp4">
                                
                                            </video>
                                            
                                            <p class="text-muted well well-sm no-shadow" style="margin-top: 10px; margin-bottom: 15px; text-align: justify;"> {!! $sharedProfileVideoList -> description  !!} </p>
                            
                                            <div class="box-footer">
                              
                                              @if(isset($user_id))
                              
                                                <form id='shared_profile_video_comment_r' action = "{!! URL::to('/store_shared_profile_video_comment') !!}" method = "post">
                            
                                                  {{ csrf_field() }}
                                  
                                                  <img class="img-responsive img-circle img-sm" src="images/users/image_{!! $user_id !!}.{!! $user[0] -> image_type !!}" alt="Alt Text">
                                  
                                                  <div class="img-push">
                                  
                                                    <input id="s_p_v_id" name="s_p_v_id" type="hidden" value="{!! $sharedProfileVideoList -> id !!}">
                                                    <input id="status" name="status" type="hidden" value="on">
                                                    <input id="datetime" name="datetime" type="hidden" value="{!! $now !!}">
                                                    <input id="user_id" name="user_id" type="hidden" value="{!! $user_id !!}">
                                                    
                                                    <input id="shared_profile_video_comment_r_content" name="content" type="text" class="form-control input-sm" placeholder="Press enter to post comment">
                                  
                                                  </div>
                                
                                                </form>
                                                
                                              @endif
                            
                                            </div>
                          
                                          </div>
                      
                                        </div>
                      
                                      </div>
                                      
                                    @endforeach
                                    
                                  </div>
                                  
                                </div>
                                
                              </div>
                              
                              @if(isset($user_id))
                              
                                <div class="tab-pane" id="upload_videos">
                                  
                                  <table class="table table-hover table-bordered table-striped dataTable" id="collegeTSGaleries-filtered_table" style="margin-bottom: 0;">
    
                                    <thead>
                                          
                                      <tr>
                                              
                                        <th>Name</th>
                                        <th colspan="3">Action</th>
                                          
                                      </tr>
                                      
                                    </thead>
                                      
                                    <tbody>
                                      
                                      @if(isset($videos))
                                      
                                        @foreach($videos as $video)
                                        
                                          <tr>
                                                  
                                            <td> <a href="{!! route('sharedProfileVideos.show', [$video->id]) !!}"> {!! $video -> name !!} </a> </td>
                                                  
                                            <td>
                                                      
                                              {!! Form::open(['route' => ['sharedProfileVideos.destroy', $video->id], 'method' => 'delete']) !!}
                                              
                                                <div class="btn-group">
                                                        
                                                  <a href="{!! route('sharedProfileVideos.show', [$video->id]) !!}" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-eye-open"></i></a>
                                                  <a href="{!! route('sharedProfileVideos.edit', [$video->id]) !!}" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
                                                  {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                                                    
                                                </div>
                                                    
                                              {!! Form::close() !!}
                                                  
                                            </td>
                                              
                                          </tr>
                                        
                                        @endforeach
                                        
                                      @endif
                                      
                                    </tbody>
                                  
                                  </table>
                                  
                                </div>
                                
                                <div class="tab-pane" id="shared_profile_video_comments">
                                  
                                  <span class="pull-right text-muted" style="background: rgba(0,0,0,0.2); color: #fff; margin: 10px; padding: 0 5px;">
                                    
                                    {!! $sharedProfileVideoCommentsListCount !!} comments
                                  
                                  </span>
                                  
                                  <div class="box-footer box-comments" style="padding-top: 40px;">
                                    
                                    @foreach($sharedProfileVideoCommentsList as $sharedProfileVideoCommentList)
                                    
                                      <div class="box-comment">
                                        
                                        <i class="menu-icon fa fa-comment-o bg-light-blue" style="font-size: 15px; border-radius: 50%; padding: 10px;"></i>
                                        
                                        <div class="comment-text" style="text-align:justify; padding-right: 10px;">
                                          
                                          <a href="{!! route('sharedProfileVideos.show', [$sharedProfileVideoCommentList -> id]) !!}">
                                            
                                            <span class="username">
                                              
                                              {!! $sharedProfileVideoCommentList -> name !!}
                                              
                                              <span class="text-muted pull-right" style="background: rgba(0,0,0,0.1); color: #000; padding: 0 5px;">{!! $sharedProfileVideoCommentList -> created_at !!}</span>
                                              
                                            </span>
                                            
                                          </a>
                                          
                                          {!! $sharedProfileVideoCommentList -> content !!}
                                          
                                        </div>
                                        
                                      </div>
                                    
                                    @endforeach
                                    
                                  </div>
                                  
                                </div>
                                
                                <div class="tab-pane" id="shared_profile_video_comment_responses">
                                  
                                  <span class="pull-right text-muted" style="background: rgba(0,0,0,0.2); color: #fff; margin: 10px; padding: 0 5px;">
                                    
                                    {!! $sharedProfileVideoCommentResponsesListCount !!} comments
                                  
                                  </span>
                                  
                                  <div class="box-footer box-comments" style="padding-top: 40px;">
                                    
                                    @foreach($sharedProfileVideoCommentResponsesList as $sharedProfileVideoCommentResponseList)
                                    
                                      <div class="box-comment">
                                        
                                        <i class="menu-icon fa fa-comments-o bg-light-blue" style="font-size: 15px; border-radius: 50%; padding: 10px;"></i>
                                        
                                        <div class="comment-text" style="text-align:justify; padding-right: 10px;">
                                          
                                          <a href="{!! route('sharedProfileVideos.show', [$sharedProfileVideoCommentResponseList -> id]) !!}">
                                            
                                            <span class="username">
                                              
                                              {!! $sharedProfileVideoCommentResponseList -> name !!}
                                              
                                              <span class="text-muted pull-right" style="background: rgba(0,0,0,0.1); color: #000; padding: 0 5px;">{!! $sharedProfileVideoCommentResponseList -> created_at !!}</span>
                                              
                                            </span>
                                            
                                          </a>
                                          
                                          {!! $sharedProfileVideoCommentResponseList -> content !!}
                                          
                                        </div>
                                        
                                      </div>
                                    
                                    @endforeach
                                    
                                  </div>
                                  
                                </div>
                                
                                <div class="tab-pane" id="shared_profile_video_likes">
                                  
                                  <div class="box box-primary" style="margin-bottom: 0;">
  
                                    <div class="box-body">
                                    
                                      <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                      
                                        <div class="row">
                      
                                          <div class="col-sm-12">
                                            
                                            <div class="small-box bg-green">
                                    
                                              <div class="inner">
                                    
                                                <h3><sup style="font-size: 20px">{!! $sharedProfileVideoLikesListCount !!}</sup></h3>
                      
                                                <p>Likes Quantity</p>
                                  
                                              </div>
                                  
                                              <div class="icon">
                                    
                                                <i class="ion ion-stats-bars"></i>
                                  
                                              </div>
                                    
                                            </div>
                      
                                            <div class="table-responsive">
                      
                                              <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info" style="margin-bottom: 0;">
                                        
                                                <thead>
                                        
                                                  <tr role="row">
                        
                                                    <th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 224px;" aria-sort="descending"> Video Name </th>
                                                    
                                                    <th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 224px;" aria-sort="descending"> Datetime </th>
                                                    
                                                  </tr>
                                        
                                                </thead>
                                        
                                                <tbody>
                                          
                                                  @foreach($sharedProfileVideoLikesListC as $sharedProfileVideoLikeList)
                        
                                                    <tr role="row" class="odd">
                                                    
                                                      <td class=""> <a href="{!! route('sharedProfileVideos.show', [$sharedProfileVideoLikeList -> id]) !!}"> {!! $sharedProfileVideoLikeList->name !!} </a> </td>
                                                      
                                                      <td class=""> {!! $sharedProfileVideoLikeList->created_at !!} </td>
                                        
                                                    </tr>
                            
                                                  @endforeach
                        
                                                </tbody>
                                      
                                              </table>
                                              
                                            </div>
                      
                                          </div>
                      
                                        </div>
                      
                                      </div>
                                  
                                    </div>
                      
                                  </div>
                                  
                                </div>
                                
                              @endif
                              
                            </div>
                            
                          </div>
                          
                        </div>
                        
                      </div>
                      
                    </div>
                    
                  </div>
                  
                  @if(isset($user_id))
                  
                    <a href="{!! route('sharedProfileVideos.create') !!}" class="btn btn-default">Add Video</a>
                    
                  @endif
                  
                </div>
                
              </div>

            </div>
              
          </div>
            
        </div>

      </div>
      
    </div>

    <div class="text-center">
        
    </div>

  </div>
  
  @if(isset($user_id))
  
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
      
      </ul>
      
      <div class="tab-content" style="padding: 20px;">
      
        <div class="tab-pane active" id="public-file">
          
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
        
        <div id="public-note" class="tab-pane">
          
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
  
        <div class="tab-pane" id="public-image">
      
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
        
        <div class="tab-pane" id="public-audio">
      
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
        
        <div class="tab-pane" id="public-video">
      
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
    
  @endif

@endsection