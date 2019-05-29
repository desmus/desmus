@extends('layouts.app')

@section('scripts')

  <script>
    
    $('#public_file_comment').on('submit', function() {
      
      console.log('file_comment');
      
      var public_file_comment = document.getElementById("public_file_comment_content").value;
      
      if(public_file_comment.length >= 1000)
      {
        alert("Invalid character number for the file comment.");
        return false;
      }
      
      if(public_file_comment == '')
      {
        alert("You need to complete the field to post a comment.");
        return false;
      }
      
      if(public_file_comment != '')
      {
        return true;
      }
      
      return false;
      
    });
    
    $('#public_file_comment_r').on('submit', function() {
      
      console.log('file_comment_r');
      
      var public_file_comment = document.getElementById("public_file_comment_r_content").value;
      
      if(public_file_comment.length >= 1000)
      {
        alert("Invalid character number for the file comment.");
        return false;
      }
      
      if(public_file_comment == '')
      {
        alert("You need to complete the field to post a comment.");
        return false;
      }
      
      if(public_file_comment != '')
      {
        return true;
      }
      
      return false;
      
    });
    
    $('#public_note_comment').on('submit', function() {
      
      console.log('note_comment');
      
      var public_note_comment = document.getElementById("public_note_comment_content").value;
      
      if(public_note_comment.length >= 1000)
      {
        alert("Invalid character number for the note comment.");
        return false;
      }
      
      if(public_note_comment == '')
      {
        alert("You need to complete the field to post a comment.");
        return false;
      }
      
      if(public_note_comment != '')
      {
        return true;
      }
      
      return false;
      
    });
    
    $('#public_note_comment_response').on('submit', function() {
      
      console.log('note_comment_response');
      
      var public_note_comment_response = document.getElementById("public_note_comment_response_content").value;
      
      if(public_note_comment_response.length >= 1000)
      {
        alert("Invalid character number for the note comment response.");
        return false;
      }
      
      if(public_note_comment_response == '')
      {
        alert("You need to complete the field to post a comment response.");
        return false;
      }
      
      if(public_note_comment_response != '')
      {
        return true;
      }
      
      return false;
      
    });
    
    $('#public_note_comment_r').on('submit', function() {
      
      console.log('note_comment_r');
      
      var public_note_comment = document.getElementById("public_note_comment_r_content").value;
      
      if(public_note_comment.length >= 1000)
      {
        alert("Invalid character number for the note comment.");
        return false;
      }
      
      if(public_note_comment == '')
      {
        alert("You need to complete the field to post a comment.");
        return false;
      }
      
      if(public_note_comment != '')
      {
        return true;
      }
      
      return false;
      
    });
    
    $('#public_image_comment').on('submit', function() {
      
      console.log('image_comment');
      
      var public_image_comment = document.getElementById("public_image_comment_content").value;
      
      if(public_image_comment.length >= 1000)
      {
        alert("Invalid character number for the image comment.");
        return false;
      }
      
      if(public_image_comment == '')
      {
        alert("You need to complete the field to post a comment.");
        return false;
      }
      
      if(public_image_comment != '')
      {
        return true;
      }
      
      return false;
      
    });
    
    $('#public_image_comment_response').on('submit', function() {
      
      console.log('image_comment_response');
      
      var public_image_comment_response = document.getElementById("public_image_comment_response_content").value;
      
      if(public_image_comment_response.length >= 1000)
      {
        alert("Invalid character number for the image comment response.");
        return false;
      }
      
      if(public_image_comment_response == '')
      {
        alert("You need to complete the field to post a comment response.");
        return false;
      }
      
      if(public_image_comment_response != '')
      {
        return true;
      }
      
      return false;
      
    });
    
    $('#public_image_comment_r').on('submit', function() {
      
      console.log('image_comment_r');
      
      var public_image_comment = document.getElementById("public_image_comment_r_content").value;
      
      if(public_image_comment.length >= 1000)
      {
        alert("Invalid character number for the image comment.");
        return false;
      }
      
      if(public_image_comment == '')
      {
        alert("You need to complete the field to post a comment.");
        return false;
      }
      
      if(public_image_comment != '')
      {
        return true;
      }
      
      return false;
      
    });
    
    $('#public_audio_comment').on('submit', function() {
      
      console.log('audio_comment');
      
      var public_audio_comment = document.getElementById("public_audio_comment_content").value;
      
      if(public_audio_comment.length >= 1000)
      {
        alert("Invalid character number for the audio comment.");
        return false;
      }
      
      if(public_audio_comment == '')
      {
        alert("You need to complete the field to post a comment.");
        return false;
      }
      
      if(public_audio_comment != '')
      {
        return true;
      }
      
      return false;
      
    });
    
    $('#public_audio_comment_response').on('submit', function() {
      
      console.log('audio_comment_response');
      
      var public_audio_comment_response = document.getElementById("public_audio_comment_response_content").value;
      
      if(public_audio_comment_response.length >= 1000)
      {
        alert("Invalid character number for the audio comment response.");
        return false;
      }
      
      if(public_audio_comment_response == '')
      {
        alert("You need to complete the field to post a comment response.");
        return false;
      }
      
      if(public_audio_comment_response != '')
      {
        return true;
      }
      
      return false;
      
    });
    
    $('#public_audio_comment_r').on('submit', function() {
      
      console.log('naudio_comment_r');
      
      var public_audio_comment = document.getElementById("public_audio_comment_r_content").value;
      
      if(public_audio_comment.length >= 1000)
      {
        alert("Invalid character number for the audio comment.");
        return false;
      }
      
      if(public_audio_comment == '')
      {
        alert("You need to complete the field to post a comment.");
        return false;
      }
      
      if(public_audio_comment != '')
      {
        return true;
      }
      
      return false;
      
    });
    
    $('#public_video_comment').on('submit', function() {
      
      console.log('video_comment');
      
      var public_video_comment = document.getElementById("public_video_comment_content").value;
      
      if(public_video_comment.length >= 1000)
      {
        alert("Invalid character number for the video comment.");
        return false;
      }
      
      if(public_video_comment == '')
      {
        alert("You need to complete the field to post a comment.");
        return false;
      }
      
      if(public_video_comment != '')
      {
        return true;
      }
      
      return false;
      
    });
    
    $('#public_video_comment_response').on('submit', function() {
      
      console.log('video_comment_response');
      
      var public_video_comment_response = document.getElementById("public_video_comment_response_content").value;
      
      if(public_video_comment_response.length >= 1000)
      {
        alert("Invalid character number for the video comment response.");
        return false;
      }
      
      if(public_video_comment_response == '')
      {
        alert("You need to complete the field to post a comment response.");
        return false;
      }
      
      if(public_video_comment_response != '')
      {
        return true;
      }
      
      return false;
      
    });
    
    $('#public_video_comment_r').on('submit', function() {
      
      console.log('video_comment_r');
      
      var public_video_comment = document.getElementById("public_video_comment_r_content").value;
      
      if(public_video_comment.length >= 1000)
      {
        alert("Invalid character number for the video comment.");
        return false;
      }
      
      if(public_video_comment == '')
      {
        alert("You need to complete the field to post a comment.");
        return false;
      }
      
      if(public_video_comment != '')
      {
        return true;
      }
      
      return false;
      
    });
    
    $('#public_advertisement_comment').on('submit', function() {
      
      console.log('advertisement_comment');
      
      var public_advertisement_comment = document.getElementById("public_advertisement_comment_content").value;
      
      if(public_advertisement_comment.length >= 1000)
      {
        alert("Invalid character number for the advertisement comment.");
        return false;
      }
      
      if(public_advertisement_comment == '')
      {
        alert("You need to complete the field to post a comment.");
        return false;
      }
      
      if(public_advertisement_comment != '')
      {
        return true;
      }
      
      return false;
      
    });
    
    $('#public_advertisement_comment_response').on('submit', function() {
      
      console.log('advertisement_comment_response');
      
      var public_advertisement_comment_response = document.getElementById("public_advertisement_comment_response_content").value;
      
      if(public_advertisement_comment_response.length >= 1000)
      {
        alert("Invalid character number for the advertisement comment response.");
        return false;
      }
      
      if(public_advertisement_comment_response == '')
      {
        alert("You need to complete the field to post a comment response.");
        return false;
      }
      
      if(public_advertisement_comment_response != '')
      {
        return true;
      }
      
      return false;
      
    });
    
    $('#public_advertisement_comment_r').on('submit', function() {
      
      console.log('advertisement_comment_r');
      
      var public_advertisement_comment = document.getElementById("public_advertisement_comment_r_content").value;
      
      if(public_advertisement_comment.length >= 1000)
      {
        alert("Invalid character number for the advertisement comment.");
        return false;
      }
      
      if(public_advertisement_comment == '')
      {
        alert("You need to complete the field to post a comment.");
        return false;
      }
      
      if(public_advertisement_comment != '')
      {
        return true;
      }
      
      return false;
      
    });
    
  </script>
  
  @if(isset($publicFileComments))
              
    @foreach($publicFileComments as $publicFileCommentArray)
                                  
      @if(isset($publicFileCommentArray[0]))
                
        @foreach($publicFileCommentArray as $publicFileComment)
        
          <script>
                                              
            $('#public_file_comment_response_{!! $publicFileComment -> id !!}').on('submit', function() {
                                                  
              var public_file_comment_response = document.getElementById("public_file_comment_response_content_{!! $publicFileComment -> id !!}").value;
                                                  
              if(public_file_comment_response.length >= 1000)
              {
                  alert("Invalid character number for the file comment response.");
                  return false;
              }
                                                  
              if(public_file_comment_response == '')
              {
                alert("You need to complete the field to post a comment response.");
                return false;
              }
                                                  
              if(public_file_comment_response != '')
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
  
  @if(isset($publicNoteComments))
              
    @foreach($publicNoteComments as $publicNoteCommentArray)
                                  
      @if(isset($publicNoteCommentArray[0]))
                
        @foreach($publicNoteCommentArray as $publicNoteComment)
        
          <script>
                                              
            $('#public_note_comment_response_{!! $publicNoteComment -> id !!}').on('submit', function() {
                                                  
              var public_note_comment_response = document.getElementById("public_note_comment_response_content_{!! $publicNoteComment -> id !!}").value;
                                                  
              if(public_note_comment_response.length >= 1000)
              {
                  alert("Invalid character number for the note comment response.");
                  return false;
              }
                                                  
              if(public_note_comment_response == '')
              {
                alert("You need to complete the field to post a comment response.");
                return false;
              }
                                                  
              if(public_note_comment_response != '')
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
  
  @if(isset($publicImageComments))
              
    @foreach($publicImageComments as $publicImageCommentArray)
                                  
      @if(isset($publicImageCommentArray[0]))
                
        @foreach($publicImageCommentArray as $publicImageComment)
        
          <script>
                                              
            $('#public_image_comment_response_{!! $publicImageComment -> id !!}').on('submit', function() {
                                                  
              var public_image_comment_response = document.getElementById("public_image_comment_response_content_{!! $publicImageComment -> id !!}").value;
                                                  
              if(public_image_comment_response.length >= 1000)
              {
                  alert("Invalid character number for the image comment response.");
                  return false;
              }
                                                  
              if(public_image_comment_response == '')
              {
                alert("You need to complete the field to post a comment response.");
                return false;
              }
                                                  
              if(public_image_comment_response != '')
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
  
  @if(isset($publicAudioComments))
              
    @foreach($publicAudioComments as $publicAudioCommentArray)
                                  
      @if(isset($publicAudioCommentArray[0]))
                
        @foreach($publicAudioCommentArray as $publicAudioComment)
        
          <script>
                                              
            $('#public_audio_comment_response_{!! $publicAudioComment -> id !!}').on('submit', function() {
                                                  
              var public_audio_comment_response = document.getElementById("public_audio_comment_response_content_{!! $publicAudioComment -> id !!}").value;
                                                  
              if(public_audio_comment_response.length >= 1000)
              {
                  alert("Invalid character number for the audio comment response.");
                  return false;
              }
                                                  
              if(public_audio_comment_response == '')
              {
                alert("You need to complete the field to post a comment response.");
                return false;
              }
                                                  
              if(public_audio_comment_response != '')
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
  
  @if(isset($publicVideoComments))
              
    @foreach($publicVideoComments as $publicVideoCommentArray)
                                  
      @if(isset($publicVideoCommentArray[0]))
                
        @foreach($publicVideoCommentArray as $publicVideoComment)
        
          <script>
                                              
            $('#public_video_comment_response_{!! $publicVideoComment -> id !!}').on('submit', function() {
                                                  
              var public_video_comment_response = document.getElementById("public_video_comment_response_content_{!! $publicVideoComment -> id !!}").value;
                                                  
              if(public_video_comment_response.length >= 1000)
              {
                  alert("Invalid character number for the video comment response.");
                  return false;
              }
                                                  
              if(public_video_comment_response == '')
              {
                alert("You need to complete the field to post a comment response.");
                return false;
              }
                                                  
              if(public_video_comment_response != '')
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
  
  @if(isset($publicAdvertisementComments))
              
    @foreach($publicAdvertisementComments as $publicAdvertisementCommentArray)
                                  
      @if(isset($publicAdvertisementCommentArray[0]))
                
        @foreach($publicAdvertisementCommentArray as $publicAdvertisementComment)
        
          <script>
                                              
            $('#public_advertisement_comment_response_{!! $publicAdvertisementComment -> id !!}').on('submit', function() {
                                                  
              var public_advertisement_comment_response = document.getElementById("public_advertisement_comment_response_content_{!! $publicAdvertisementComment -> id !!}").value;
                                                  
              if(public_advertisement_comment_response.length >= 1000)
              {
                  alert("Invalid character number for the advertisement comment response.");
                  return false;
              }
                                                  
              if(public_advertisement_comment_response == '')
              {
                alert("You need to complete the field to post a comment response.");
                return false;
              }
                                                  
              if(public_advertisement_comment_response != '')
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
  
  <div id="share_advertisement" class="modal fade" role="dialog">
      
    <div class="modal-dialog modal-lg">
        
      <div class="modal-content">
          
        <div class="modal-header">
            
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              
            <span aria-hidden="true">×</span>
            
          </button>
            
          <h4 class="modal-title"> Advertisement Name </h4>
            
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
        
    <h1 class="pull-left"> Public Profile User </h1>
    
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

                <li class="active"><a href="#public_files" data-toggle="tab"> Files </a></li>
                <li><a href="#public_notes" data-toggle="tab"> Notes  </a></li>
                <li><a href="#public_images" data-toggle="tab"> Images </a></li>
                <li><a href="#public_audios" data-toggle="tab"> Audios </a></li>
                <li><a href="#public_videos" data-toggle="tab"> Videos </a></li>
                <li><a href="#public_advertising" data-toggle="tab"> Advertising </a></li>

              </ul>
          
              <div id = "tab-content" class="tab-content clearfix" style = "padding: 0;">
          
                <div class = "tab-pane" id = "public_section">

                  <div class="row">
                  
                    <div class="col-md-12" style="padding: 0 10px";>
                        
                      @foreach($publicFiles as $publicFile)
                      
                        <div class="col-md-12" style="margin-top: 10px;">
          
                          <div class="box box-primary">
            
                            <div class="box-header with-border">
              
                              <div class="user-block">
                
                                @if(isset($publicFileUsers))
                
                                  @foreach($publicFileUsers as $publicFileUserArray)
                                  
                                    @if(isset($publicFileUserArray[0]))
                                    
                                      @if($publicFile -> user_id == $publicFileUserArray[0] -> id)
                                    
                                        <img class="img-circle" src="/images/users/image_{!! $publicFile -> user_id !!}.{!! $publicFileUserArray[0] -> image_type !!}" alt="User Image">
                                    
                                        <span class="username"><a href="{!! route('publicUser.show', [$publicFile -> user_id]) !!}">{!! $publicFileUserArray[0] -> name !!}</a></span>
                                        
                                        <?php break; ?>
                                    
                                      @endif
                                      
                                    @endif
                                  
                                  @endforeach
                                  
                                @endif
                                
                                <span class="description">Shared publicly - {!! $publicFile -> created_at !!}</span>
              
                              </div>
              
                              <div class="box-tools">
                              
                                <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Mark as read"><a href="{!! route('publicFiles.show', [$publicFile -> id]) !!}"><i class="fa fa-eye"></i></a></button>
                              
                                @if(isset($user_id))
                              
                                  {!! Form::open(['route' => 'publicFileLikes.store', 'id' => 'public_file_like_create', 'style' => 'display: inline-block']) !!}
                                
                                    {!! Form::hidden('status', 'Status:') !!}
                                    {!! Form::hidden('status', 'on', ['class' => 'form-control']) !!}
                                    
                                    {!! Form::hidden('datetime', 'Datetime:') !!}
                                    {!! Form::hidden('datetime', $now, ['class' => 'form-control']) !!}
                                    
                                    {!! Form::hidden('public_file_id', 'Public File Id:') !!}
                                    {!! Form::hidden('public_file_id', $publicFile -> id, ['class' => 'form-control']) !!}
                                    
                                    {!! Form::hidden('user_id', 'User Id:') !!}
                                    {!! Form::hidden('user_id', $user_id, ['class' => 'form-control']) !!}
                                    
                                    <button type="submit" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Mark as read"><i class="fa fa-thumbs-o-up"></i></button>
                  
                                  {!! Form::close() !!}
                                  
                                @endif
                                
                                <button type="button" class="btn btn-box-tool" data-toggle="collapse" data-target="#file_{!! $publicFile -> id  !!}"><i class="fa fa-minus"></i></button>
              
                              </div>
            
                            </div>
            
                            <div id="file_{!! $publicFile -> id  !!}" class="box-body">
                              
                              <div class="info-box bg-yellow">
                                
                                <a href = "/files/public_files/file_{!! $publicFile -> id !!}.{!! $publicFile -> file_type !!}" style = "color: #fff;" download> <span class="info-box-icon glyphicon glyphicon-download-alt"></span> </a>
                    
                                <div class="info-box-content">
                                  
                                  <span class="info-box-text">Size (bytes)</span>
                                  <span class="info-box-number"> {!! $publicFile -> file_size !!} </span>
                    
                                  <div class="progress">
                                    
                                    <div class="progress-bar" style="width: 100%"></div>
                                  
                                  </div>
                                  
                                  <span class="progress-description"> {!! $publicFile -> name !!} </span>
                                
                                </div>
                              
                              </div>
                              
                              <p class="text-muted well well-sm no-shadow" style="margin-top: 10px; text-align: justify;"> {!! $publicFile -> description  !!} </p>

                              <span class="pull-right text-muted" style="background: rgba(0,0,0,0.2); color: #fff; margin: 10px; padding: 0 5px;">
                                
                                @if(isset($publicFileLikes))
                                
                                  @foreach($publicFileLikes as $publicFileLikeArray)
                                    
                                    @if(isset($publicFileLikeArray[0]))
                                    
                                      @if($publicFile -> id == $publicFileLikeArray[0] -> public_file_id)
                                    
                                        {!! sizeof($publicFileLikeArray) !!} likes -
                                    
                                      @endif
                                      
                                    @endif
                                  
                                  @endforeach
                                  
                                @endif
                                
                                @if(isset($publicFileCommentCounts))
                                
                                  @foreach($publicFileCommentCounts as $publicFileCommentCountArray)
                
                                    @if(isset($publicFileCommentCountArray[0]))
                
                                      @if($publicFile -> id == $publicFileCommentCountArray[0] -> public_file_id)
                                    
                                        {!! sizeof($publicFileCommentCountArray) !!} comments
                                    
                                      @endif
                                      
                                    @endif
                                  
                                  @endforeach
                                  
                                @endif
                                
                              </span>
            
                              <div class="box-footer box-comments" style="padding-top: 40px;">
              
                                @if(isset($publicFileComments))
              
                                  @foreach($publicFileComments as $publicFileCommentArray)
                                  
                                    @if(isset($publicFileCommentArray[0]))
                
                                      @foreach($publicFileCommentArray as $publicFileComment)
                  
                                        @if($publicFile -> id == $publicFileComment -> public_file_id)
                  
                                          <div class="box-comment">
                                            
                                            @if(isset($publicFileCommentUsers))
                            
                                              @foreach($publicFileCommentUsers as $publicFileCommentUserArray)
                                              
                                                @if(isset($publicFileCommentUserArray[0]))
                                        
                                                  @foreach($publicFileCommentUserArray as $publicFileCommentUser)
                                          
                                                    @if($publicFileComment -> user_id == $publicFileCommentUser -> user_id && $publicFileComment -> id == $publicFileCommentUser -> id)
        
                                                      <img class="img-circle" src="/images/users/image_{!! $publicFileComment -> user_id !!}.{!! $publicFileCommentUser -> image_type !!}" alt="User Image">
                
                                                      <?php break; ?>
                                            
                                                    @endif
                                                        
                                                  @endforeach
                                                  
                                                @endif
                                      
                                              @endforeach
                                              
                                            @endif
            
                                            <div class="comment-text" style="text-align:justify; padding-right: 10px;">
                                  
                                              <span class="username">
                                                
                                                @if(isset($publicFileCommentUsers))
                                                
                                                  @foreach($publicFileCommentUsers as $publicFileCommentUserArray)
                                                  
                                                    @if(isset($publicFileCommentUserArray[0]))
                                        
                                                      @foreach($publicFileCommentUserArray as $publicFileCommentUser)
                                          
                                                        @if($publicFileComment -> user_id == $publicFileCommentUser -> user_id && $publicFileComment -> id == $publicFileCommentUser -> id)
                                            
                                                          {!! $publicFileCommentUser -> name !!}
                                                
                                                          <?php break; ?>
                                            
                                                        @endif
                                                        
                                                      @endforeach
                                                      
                                                    @endif
                                      
                                                  @endforeach
                                                  
                                                @endif
                                    
                                                <span class="text-muted pull-right" style="background: rgba(0,0,0,0.1); color: #000; padding: 0 5px;">{!! $publicFileComment -> datetime !!}</span>
                                  
                                              </span>
                              
                                              {!! $publicFileComment -> content !!}
                                              
                                            </div>
                                            
                                            @if(isset($publicFileCommentResponses))
                                            
                                              @foreach($publicFileCommentResponses as $publicFileCommentResponseArray)
                                              
                                                @if(isset($publicFileCommentResponseArray[0]))
                    
                                                  @foreach($publicFileCommentResponseArray as $publicFileCommentResponse)
                      
                                                    @if($publicFileComment -> id == $publicFileCommentResponse -> public_file_comment_id)
                                                
                                                      <div style="margin-left: 10px;" class="box-comment">
                                      
                                                        @if(isset($publicFileCommentResponseUsers))
                                      
                                                          @foreach($publicFileCommentResponseUsers as $publicFileCommentResponseUserArray)
                                                          
                                                            @if(isset($publicFileCommentUserArray[0]))
                                            
                                                              @foreach($publicFileCommentResponseUserArray as $publicFileCommentResponseUser)
                                                      
                                                                @if($publicFileCommentResponse -> user_id == $publicFileCommentResponseUser -> user_id && $publicFileCommentResponse -> id == $publicFileCommentResponseUser -> id)
            
                                                                  <img class="img-circle" src="/images/users/image_{!! $publicFileCommentResponse -> user_id !!}.{!! $publicFileCommentResponseUser -> image_type !!}" alt="User Image">
                                                            
                                                                  <?php break; ?>
                                                            
                                                                @endif
                                                                    
                                                              @endforeach
                                                              
                                                            @endif
                                                  
                                                          @endforeach
                                                          
                                                        @endif
                                                        
                                                        <div class="comment-text" style="text-align:justify; padding-right: 10px;">
                                              
                                                          <span class="username">
                                                            
                                                            @if(isset($publicFileCommentResponseUsers))
                                                              
                                                              @foreach($publicFileCommentResponseUsers as $publicFileCommentResponseUserArray)
                                                              
                                                                @if(isset($publicFileCommentResponseUsers))
                                            
                                                                  @foreach($publicFileCommentResponseUserArray as $publicFileCommentResponseUser)
                                                      
                                                                    @if($publicFileCommentResponse -> user_id == $publicFileCommentResponseUser -> user_id && $publicFileCommentResponse -> id == $publicFileCommentResponseUser -> id)
                                                        
                                                                      {!! $publicFileCommentResponseUser -> name !!}
                                                            
                                                                      <?php break; ?>
                                                        
                                                                    @endif
                                                                    
                                                                  @endforeach
                                                                  
                                                                @endif
                                                  
                                                              @endforeach
                                                              
                                                            @endif
                                                
                                                            <span class="text-muted pull-right" style="background: rgba(0,0,0,0.1); color: #000; padding: 0 5px;">{!! $publicFileCommentResponse -> datetime !!}</span>
                                              
                                                          </span>
                                          
                                                          {!! $publicFileCommentResponse -> content !!}
                                                          
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
                                              
                                              <form id='public_file_comment_response_{!! $publicFileComment -> id !!}' action = "{!! URL::to('/store_public_file_comment_response') !!}" method = "post">
                          
                                                {{ csrf_field() }}
                                
                                                <img class="img-responsive img-circle img-sm" src="/images/users/image_{!! $user_id !!}.{!! $user[0] -> image_type !!}" alt="Alt Text">
                                
                                                <div class="img-push">
                                
                                                  <input id="public_file_comment_id" name="public_file_comment_id" type="hidden" value="{!! $publicFileComment -> id !!}">
                                                  <input id="status" name="status" type="hidden" value="on">
                                                  <input id="datetime" name="datetime" type="hidden" value="{!! $now !!}">
                                                  <input id="user_id" name="user_id" type="hidden" value="{!! $user_id !!}">
                                                  
                                                  <input id="public_file_comment_response_content_{!! $publicFileComment -> id !!}" name="content" type="text" class="form-control input-sm" placeholder="Press enter to post comment">
                                
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
                                
                                  <form id='public_file_comment' action = "{!! URL::to('/store_public_file_comment') !!}" method = "post">
              
                                    {{ csrf_field() }}
                    
                                    <img class="img-responsive img-circle img-sm" src="/images/users/image_{!! $user_id !!}.{!! $user[0] -> image_type !!}" alt="Alt Text">
                    
                                    <div class="img-push">
                    
                                      <input id="public_file_id" name="public_file_id" type="hidden" value="{!! $publicFile -> id !!}">
                                      <input id="status" name="status" type="hidden" value="on">
                                      <input id="datetime" name="datetime" type="hidden" value="{!! $now !!}">
                                      <input id="user_id" name="user_id" type="hidden" value="{!! $user_id !!}">
                                      
                                      <input id="public_file_comment_content" name="content" type="text" class="form-control input-sm" placeholder="Press enter to post comment">
                    
                                    </div>
                  
                                  </form>
                                  
                                @endif
              
                              </div>
            
                            </div>
          
                          </div>
        
                        </div>
                      
                      @endforeach
                      
                      @foreach($publicNotes as $publicNote)
                        
                        <div class="col-md-12" style="margin-bottom: 10px; margin-top: 10px;">
          
                          <div class="box box-primary">
            
                            <div class="box-header with-border">
              
                              <div class="user-block">
                                
                                @if(isset($publicNoteUsers))
                                
                                  @foreach($publicNoteUsers as $publicNoteUserArray)
                                  
                                    @if(isset($publicNoteUserArray[0]))
                                    
                                      @if($publicNote -> user_id == $publicNoteUserArray[0] -> id)
                                      
                                        <img class="img-circle" src="/images/users/image_{!! $publicNote -> user_id !!}.{!! $publicNoteUserArray[0] -> image_type !!}" alt="User Image">
                                    
                                        <span class="username"><a href="{!! route('publicUser.show', [$publicNote -> user_id]) !!}">{!! $publicNoteUserArray[0] -> name !!}</a></span>
                                        
                                        <?php break; ?>
                                    
                                      @endif
                                      
                                    @endif
                                  
                                  @endforeach
                                  
                                @endif
                                
                                <span class="description">Shared publicly - {!! $publicNote -> created_at !!} </span>
              
                              </div>
              
                              <div class="box-tools">
                
                                <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Mark as read"><a href="{!! route('publicNotes.show', [$publicNote -> id]) !!}"><i class="fa fa-eye"></i></a></button>
                
                                @if(isset($user_id))
                                
                                  {!! Form::open(['route' => 'publicNoteLikes.store', 'id' => 'public_note_like_create', 'style' => 'display: inline-block']) !!}
                                
                                    {!! Form::hidden('status', 'Status:') !!}
                                    {!! Form::hidden('status', 'on', ['class' => 'form-control']) !!}
                                    
                                    {!! Form::hidden('datetime', 'Datetime:') !!}
                                    {!! Form::hidden('datetime', $now, ['class' => 'form-control']) !!}
                                    
                                    {!! Form::hidden('public_note_id', 'Public Note Id:') !!}
                                    {!! Form::hidden('public_note_id', $publicNote -> id, ['class' => 'form-control']) !!}
                                    
                                    {!! Form::hidden('user_id', 'User Id:') !!}
                                    {!! Form::hidden('user_id', $user_id, ['class' => 'form-control']) !!}
                                    
                                    <button type="submit" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Mark as read"><i class="fa fa-thumbs-o-up"></i></button>
                  
                                  {!! Form::close() !!}
                                
                                @endif
                                
                                <button type="button" class="btn btn-box-tool" data-toggle="collapse" data-target="#note_{!! $publicNote -> id  !!}"><i class="fa fa-minus"></i></button>
              
                              </div>
            
                            </div>
            
                            <div id = "note_{!! $publicNote -> id !!}" class="box-body">
              
                              <blockquote> {!! $publicNote -> content !!} </blockquote>
                              
                              <p class="text-muted well well-sm no-shadow" style="margin-top: 10px; text-align: justify;"> {!! $publicNote -> description  !!} </p>
              
                              <span class="pull-right text-muted" style="background: rgba(0,0,0,0.2); color: #fff; margin: 10px; padding: 0 5px;">
                                
                                @if(isset($publicNoteLikes))
                                
                                  @foreach($publicNoteLikes as $publicNoteLikeArray)
                                    
                                    @if(isset($publicNoteLikeArray[0]))
                                    
                                      @if($publicNote -> id == $publicNoteLikeArray[0] -> public_note_id)
                                    
                                        {!! sizeof($publicNoteLikeArray) !!} likes -
                                    
                                      @endif
                                      
                                    @endif
                                  
                                  @endforeach
                                  
                                @endif
                                
                                @if(isset($publicNoteCommentCounts))
                                
                                  @foreach($publicNoteCommentCounts as $publicNoteCommentCountArray)
                
                                    @if(isset($publicNoteCommentCountArray[0]))
                
                                      @if($publicNote -> id == $publicNoteCommentCountArray[0] -> public_note_id)
                                    
                                        {!! sizeof($publicNoteCommentCountArray) !!} comments
                                    
                                      @endif
                                      
                                    @endif
                                  
                                  @endforeach
                                  
                                @endif
                                
                              </span>
            
                              <div class="box-footer box-comments" style="padding-top: 40px;">
              
                                @if(isset($publicNoteComments))
              
                                  @foreach($publicNoteComments as $publicNoteCommentArray)
                                  
                                    @if(isset($publicNoteCommentArray[0]))
                
                                      @foreach($publicNoteCommentArray as $publicNoteComment)
                  
                                        @if($publicNote -> id == $publicNoteComment -> public_note_id)
                  
                                          <div class="box-comment">
                            
                                            @if(isset($publicNoteCommentUsers))
                            
                                              @foreach($publicNoteCommentUsers as $publicNoteCommentUserArray)
                                              
                                                @if(isset($publicNoteCommentUserArray[0]))
                                          
                                                  @foreach($publicNoteCommentUserArray as $publicNoteCommentUser)
                                          
                                                    @if($publicNoteComment -> user_id == $publicNoteCommentUser -> user_id && $publicNoteComment -> id == $publicNoteCommentUser -> id)
        
                                                      <img class="img-circle" src="/images/users/image_{!! $publicNoteComment -> user_id !!}.{!! $publicNoteCommentUser -> image_type !!}" alt="User Image">
                
                                                      <?php break; ?>
                
                                                    @endif
        
                                                  @endforeach
                                                  
                                                @endif
      
                                              @endforeach
                                              
                                            @endif
            
                                            <div class="comment-text" style="text-align:justify; padding-right: 10px;">
                                  
                                              <span class="username">
                                                
                                                @if(isset($publicNoteCommentUsers))
                                                
                                                  @foreach($publicNoteCommentUsers as $publicNoteCommentUserArray)
                                                  
                                                    @if(isset($publicNoteCommentUserArray[0]))
                                        
                                                      @foreach($publicNoteCommentUserArray as $publicNoteCommentUser)
                                          
                                                        @if($publicNoteComment -> user_id == $publicNoteCommentUser -> user_id && $publicNoteComment -> id == $publicNoteCommentUser -> id)
                                            
                                                          {!! $publicNoteCommentUser -> name !!}
                                                
                                                          <?php break; ?>
                                            
                                                        @endif
                                                        
                                                      @endforeach
                                                      
                                                    @endif
                                      
                                                  @endforeach
                                                  
                                                @endif
                                    
                                                <span class="text-muted pull-right" style="background: rgba(0,0,0,0.1); color: #000; padding: 0 5px;">{!! $publicNoteComment -> datetime !!}</span>
                                  
                                              </span>
                              
                                              {!! $publicNoteComment -> content !!}
                                              
                                            </div>
                                            
                                            @if(isset($publicNoteCommentResponses))
                                            
                                              @foreach($publicNoteCommentResponses as $publicNoteCommentResponseArray)
                                              
                                                @if(isset($publicNoteCommentResponseArray))
                    
                                                  @foreach($publicNoteCommentResponseArray as $publicNoteCommentResponse)
                      
                                                    @if($publicNoteComment -> id == $publicNoteCommentResponse -> public_note_comment_id)
                                                
                                                      <div style="margin-left: 10px;" class="box-comment">
                                                        
                                                        @if(isset($publicNoteCommentResponseUsers))
                                      
                                                          @foreach($publicNoteCommentResponseUsers as $publicNoteCommentResponseUserArray)
                                                          
                                                            @if(isset($publicNoteCommentResponseUserArray[0]))
                                            
                                                              @foreach($publicNoteCommentResponseUserArray as $publicNoteCommentResponseUser)
                                                      
                                                                @if($publicNoteCommentResponse -> user_id == $publicNoteCommentResponseUser -> user_id && $publicNoteCommentResponse -> id == $publicNoteCommentResponseUser -> id)
            
                                                                  <img class="img-circle" src="/images/users/image_{!! $publicNoteCommentResponse -> user_id !!}.{!! $publicNoteCommentResponseUser -> image_type !!}" alt="User Image">
                            
                                                                  <?php break; ?>
                                                        
                                                                @endif
                                                                    
                                                              @endforeach
                                                              
                                                            @endif
                                                  
                                                          @endforeach
                                                          
                                                        @endif
                        
                                                        <div class="comment-text" style="text-align:justify; padding-right: 10px;">
                                              
                                                          <span class="username">
                                                            
                                                            @if(isset($publicNoteCommentResponseUsers))
                                                            
                                                              @foreach($publicNoteCommentResponseUsers as $publicNoteCommentResponseUserArray)
                                                              
                                                                @if(isset($publicNoteCommentResponseUserArray[0]))
                                            
                                                                  @foreach($publicNoteCommentResponseUserArray as $publicNoteCommentResponseUser)
                                                      
                                                                    @if($publicNoteCommentResponse -> user_id == $publicNoteCommentResponseUser -> user_id && $publicNoteCommentResponse -> id == $publicNoteCommentResponseUser -> id)
                                                        
                                                                      {!! $publicNoteCommentResponseUser -> name !!}
                                                            
                                                                      <?php break; ?>
                                                        
                                                                    @endif
                                                                    
                                                                  @endforeach
                                                                  
                                                                @endif
                                                  
                                                              @endforeach
                                                              
                                                            @endif
                                                
                                                            <span class="text-muted pull-right" style="background: rgba(0,0,0,0.1); color: #000; padding: 0 5px;">{!! $publicNoteCommentResponse -> datetime !!}</span>
                                              
                                                          </span>
                                          
                                                          {!! $publicNoteCommentResponse -> content !!}
                                                          
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
                                      
                                              <form id='public_note_comment_response_{!! $publicNoteComment -> id !!}' action = "{!! URL::to('/store_public_note_comment_response') !!}" method = "post">
                          
                                                {{ csrf_field() }}
                                
                                                <img class="img-responsive img-circle img-sm" src="/images/users/image_{!! $user_id !!}.{!! $user[0] -> image_type !!}" alt="Alt Text">
                                
                                                <div class="img-push">
                                
                                                  <input id="public_note_comment_id" name="public_note_comment_id" type="hidden" value="{!! $publicNoteComment -> id !!}">
                                                  <input id="status" name="status" type="hidden" value="on">
                                                  <input id="datetime" name="datetime" type="hidden" value="{!! $now !!}">
                                                  <input id="user_id" name="user_id" type="hidden" value="{!! $user_id !!}">
                                                  
                                                  <input id="public_note_comment_response_content_{!! $publicNoteComment -> id !!}" name="content" type="text" class="form-control input-sm" placeholder="Press enter to post comment">
                                
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
                
                                  <form id='public_note_comment' action = "{!! URL::to('/store_public_note_comment') !!}" method = "post">
              
                                    {{ csrf_field() }}
                    
                                    <img class="img-responsive img-circle img-sm" src="/images/users/image_{!! $user_id !!}.{!! $user[0] -> image_type !!}" alt="Alt Text">
                    
                                    <div class="img-push">
                    
                                      <input id="public_note_id" name="public_note_id" type="hidden" value="{!! $publicNote -> id !!}">
                                      <input id="status" name="status" type="hidden" value="on">
                                      <input id="datetime" name="datetime" type="hidden" value="{!! $now !!}">
                                      <input id="user_id" name="user_id" type="hidden" value="{!! $user_id !!}">
                                      
                                      <input id="public_note_comment_content" name="content" type="text" class="form-control input-sm" placeholder="Press enter to post comment">
                    
                                    </div>
                  
                                  </form>
                                  
                                @endif
              
                              </div>
            
                            </div>
          
                          </div>
        
                        </div>
                        
                      @endforeach
                      
                      @foreach($publicImages as $publicImage)
                        
                        <div class="col-md-12" style="margin-bottom: 10px; margin-top: 10px;">
          
                          <div class="box box-primary">
            
                            <div class="box-header with-border">
              
                              <div class="user-block">
                                
                                @if(isset($publicImageUsers))
                                
                                  @foreach($publicImageUsers as $publicImageUserArray)
                                  
                                    @if(isset($publicImageUserArray[0]))
                                    
                                      @if($publicImage -> user_id == $publicImageUserArray[0] -> id)
                                      
                                        <img class="img-circle" src="/images/users/image_{!! $publicImage -> user_id !!}.{!! $publicImageUserArray[0] -> image_type !!}" alt="User Image">
                                    
                                        <span class="username"><a href="{!! route('publicUser.show', [$publicImage -> user_id]) !!}">{!! $publicImageUserArray[0] -> name !!}</a></span>
                                        
                                        <?php break; ?>
                                    
                                      @endif
                                      
                                    @endif
                                  
                                  @endforeach
                                  
                                @endif
                                
                                <span class="description">Shared publicly - {!! $publicImage -> created_at !!} </span>
              
                              </div>
              
                              <div class="box-tools">
                
                                <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Mark as read"><a href="{!! route('publicImages.show', [$publicImage -> id]) !!}"><i class="fa fa-eye"></i></a></button>
                
                                @if(isset($user_id))
                
                                  {!! Form::open(['route' => 'publicImageLikes.store', 'id' => 'public_image_like_create', 'style' => 'display: inline-block']) !!}
                                
                                    {!! Form::hidden('status', 'Status:') !!}
                                    {!! Form::hidden('status', 'on', ['class' => 'form-control']) !!}
                                    
                                    {!! Form::hidden('datetime', 'Datetime:') !!}
                                    {!! Form::hidden('datetime', $now, ['class' => 'form-control']) !!}
                                    
                                    {!! Form::hidden('public_image_id', 'Public Image Id:') !!}
                                    {!! Form::hidden('public_image_id', $publicImage -> id, ['class' => 'form-control']) !!}
                                    
                                    {!! Form::hidden('user_id', 'User Id:') !!}
                                    {!! Form::hidden('user_id', $user_id, ['class' => 'form-control']) !!}
                                    
                                    <button type="submit" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Mark as read"><i class="fa fa-thumbs-o-up"></i></button>
                  
                                  {!! Form::close() !!}
                                  
                                @endif
                                
                                <button type="button" class="btn btn-box-tool" data-toggle="collapse" data-target="#image_{!! $publicImage -> id  !!}"><i class="fa fa-minus"></i></button>
              
                              </div>
            
                            </div>
            
                            <div id="image_{!! $publicImage -> id !!}" class="box-body">
              
                              <img src="/images/public_images/image_{!! $publicImage -> id !!}.{!! $publicImage -> file_type !!}" style="width: 100%; margin-bottom: 5px;">
                              
                              <p class="text-muted well well-sm no-shadow" style="margin-top: 10px; text-align: justify;"> {!! $publicImage -> description  !!} </p>
              
                              <span class="pull-right text-muted" style="background: rgba(0,0,0,0.2); color: #fff; margin: 10px; padding: 0 5px;">
                                
                                @if(isset($publicImageLikes))
                                
                                  @foreach($publicImageLikes as $publicImageLikeArray)
                                    
                                    @if(isset($publicImageLikeArray[0]))
                                    
                                      @if($publicImage -> id == $publicImageLikeArray[0] -> public_image_id)
                                    
                                        {!! sizeof($publicImageLikeArray) !!} likes -
                                    
                                      @endif
                                      
                                    @endif
                                  
                                  @endforeach
                                  
                                @endif
                                
                                @if(isset($publicImageCommentCounts))
                              
                                  @foreach($publicImageCommentCounts as $publicImageCommentCountArray)
                
                                    @if(isset($publicImageCommentCountArray[0]))
                
                                      @if($publicImage -> id == $publicImageCommentCountArray[0] -> public_image_id)
                                    
                                        {!! sizeof($publicImageCommentCountArray) !!} comments
                                    
                                      @endif
                                      
                                    @endif
                                  
                                  @endforeach
                                
                                @endif
                                
                              </span>
                              
                              <div class="box-footer box-comments" style="padding-top: 40px;">
              
                                @if(isset($publicImageComments))
              
                                  @foreach($publicImageComments as $publicImageCommentArray)
                
                                    @if(isset($publicImageCommentArray[0]))
                
                                      @foreach($publicImageCommentArray as $publicImageComment)
                  
                                        @if($publicImage -> id == $publicImageComment -> public_image_id)
                  
                                          <div class="box-comment">
                                            
                                            @if(isset($publicImageCommentUsers))
                                            
                                              @foreach($publicImageCommentUsers as $publicImageCommentUserArray)
                                              
                                                @if(isset($publicImageCommentUserArray[0]))
                                          
                                                  @foreach($publicImageCommentUserArray as $publicImageCommentUser)
                                          
                                                    @if($publicImageComment -> user_id == $publicImageCommentUser -> user_id && $publicImageComment -> id == $publicImageCommentUser -> id)
        
                                                      <img class="img-circle img-sm" src="/images/users/image_{!! $publicImageComment -> user_id !!}.{!! $publicImageCommentUser -> image_type !!}" alt="User Image">
                                                      
                                                      <?php break; ?>
                                            
                                                    @endif
                                                        
                                                  @endforeach
                                                  
                                                @endif
                                      
                                              @endforeach
                                              
                                            @endif
            
                                            <div class="comment-text" style="text-align:justify; padding-right: 10px;">
                                  
                                              <span class="username">
                                                
                                                @if(isset($publicImageCommentUsers))
                                                
                                                  @foreach($publicImageCommentUsers as $publicImageCommentUserArray)
                                                  
                                                    @if(isset($publicImageCommentUserArray[0]))
                                        
                                                      @foreach($publicImageCommentUserArray as $publicImageCommentUser)
                                          
                                                        @if($publicImageComment -> user_id == $publicImageCommentUser -> user_id && $publicImageComment -> id == $publicImageCommentUser -> id)
                                            
                                                          {!! $publicImageCommentUser -> name !!}
                                                
                                                          <?php break; ?>
                                            
                                                        @endif
                                                        
                                                      @endforeach
                                                      
                                                    @endif
                                      
                                                  @endforeach
                                                  
                                                @endif
                                    
                                                <span class="text-muted pull-right" style="background: rgba(0,0,0,0.1); color: #000; padding: 0 5px;">{!! $publicImageComment -> datetime !!}</span>
                                  
                                              </span>
                              
                                              {!! $publicImageComment -> content !!}
                                              
                                            </div>
                                            
                                            @if(isset($publicImageCommentResponses))
                                            
                                              @foreach($publicImageCommentResponses as $publicImageCommentResponseArray)
                                              
                                                @if(isset($publicImageCommentResponseArray[0]))
                      
                                                  @foreach($publicImageCommentResponseArray as $publicImageCommentResponse)
                      
                                                    @if($publicImageComment -> id == $publicImageCommentResponse -> public_image_comment_id)
                                                
                                                      <div style="margin-left: 10px;" class="box-comment">
                                                        
                                                        @if(isset($publicImageCommentResponseUsers))
                                      
                                                          @foreach($publicImageCommentResponseUsers as $publicImageCommentResponseUserArray)
                                                          
                                                            @if(isset($publicImageCommentResponseUserArray[0]))
                                            
                                                              @foreach($publicImageCommentResponseUserArray as $publicImageCommentResponseUser)
                                                      
                                                                @if($publicImageCommentResponse -> user_id == $publicImageCommentResponseUser -> user_id && $publicImageCommentResponse -> id == $publicImageCommentResponseUser -> id)
            
                                                                  <img class="img-circle img-sm" src="/images/users/image_{!! $publicImageCommentResponse -> user_id !!}.{!! $publicImageCommentResponseUser -> image_type !!}" alt="User Image">
                            
                                                                  <?php break; ?>
                                                        
                                                                @endif
                                                                    
                                                              @endforeach
                                                              
                                                            @endif
                                                  
                                                          @endforeach
                                                          
                                                        @endif
                        
                                                        <div class="comment-text" style="text-align:justify; padding-right: 10px;">
                                              
                                                          <span class="username">
                                                            
                                                            @if(isset($publicImageCommentResponseUsers))
                                                            
                                                              @foreach($publicImageCommentResponseUsers as $publicImageCommentResponseUserArray)
                                                              
                                                                @if(isset($publicImageCommentResponseUserArray[0]))
                                            
                                                                  @foreach($publicImageCommentResponseUserArray as $publicImageCommentResponseUser)
                                                      
                                                                    @if($publicImageCommentResponse -> user_id == $publicImageCommentResponseUser -> user_id && $publicImageCommentResponse -> id == $publicImageCommentResponseUser -> id)
                                                        
                                                                      {!! $publicImageCommentResponseUser -> name !!}
                                                            
                                                                      <?php break; ?>
                                                        
                                                                    @endif
                                                                    
                                                                  @endforeach
                                                                  
                                                                @endif
                                                  
                                                              @endforeach
                                                              
                                                            @endif
                                                
                                                            <span class="text-muted pull-right" style="background: rgba(0,0,0,0.1); color: #000; padding: 0 5px;">{!! $publicImageCommentResponse -> datetime !!}</span>
                                              
                                                          </span>
                                          
                                                          {!! $publicImageCommentResponse -> content !!}
                                                          
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
                                    
                                              <form id='public_image_comment_response_{!! $publicImageComment -> id !!}' action = "{!! URL::to('/store_public_image_comment_response') !!}" method = "post">
                          
                                                {{ csrf_field() }}
                                
                                                <img class="img-responsive img-circle img-sm" src="/images/users/image_{!! $user_id !!}.{!! $user[0] -> image_type !!}" alt="Alt Text">
                                
                                                <div class="img-push">
                                
                                                  <input id="public_image_comment_id" name="public_image_comment_id" type="hidden" value="{!! $publicImageComment -> id !!}">
                                                  <input id="status" name="status" type="hidden" value="on">
                                                  <input id="datetime" name="datetime" type="hidden" value="{!! $now !!}">
                                                  <input id="user_id" name="user_id" type="hidden" value="{!! $user_id !!}">
                                                  
                                                  <input id="public_image_comment_response_content_{!! $publicImageComment -> id !!}" name="content" type="text" class="form-control input-sm" placeholder="Press enter to post comment">
                                
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
                
                                  <form id='public_image_comment' action = "{!! URL::to('/store_public_image_comment') !!}" method = "post">
              
                                    {{ csrf_field() }}
                    
                                    <img class="img-responsive img-circle img-sm" src="/images/users/image_{!! $user_id !!}.{!! $user[0] -> image_type !!}" alt="Alt Text">
                    
                                    <div class="img-push">
                    
                                      <input id="public_image_id" name="public_image_id" type="hidden" value="{!! $publicImage -> id !!}">
                                      <input id="status" name="status" type="hidden" value="on">
                                      <input id="datetime" name="datetime" type="hidden" value="{!! $now !!}">
                                      <input id="user_id" name="user_id" type="hidden" value="{!! $user_id !!}">
                                      
                                      <input id="public_image_comment_content" name="content" type="text" class="form-control input-sm" placeholder="Press enter to post comment">
                    
                                    </div>
                  
                                  </form>
                                
                                @endif
              
                              </div>
            
                            </div>
          
                          </div>
        
                        </div>
                        
                      @endforeach
                        
                      @foreach($publicAudios as $publicAudio)
                        
                        <div class="col-md-12" style="margin-bottom: 10px; margin-top: 10px;">
          
                          <div class="box box-primary">
            
                            <div class="box-header with-border">
              
                              <div class="user-block">
                                
                                @if(isset($publicAudioUsers))
                                
                                  @foreach($publicAudioUsers as $publicAudioUserArray)
                                  
                                    @if(isset($publicAudioUserArray[0]))
                                    
                                      @if($publicAudio -> user_id == $publicAudioUserArray[0] -> id)
                                    
                                        <img class="img-circle" src="/images/users/image_{!! $publicAudio -> user_id !!}.{!! $publicAudioUserArray[0] -> image_type !!}" alt="User Image">
                                    
                                        <span class="username"><a href="{!! route('publicUser.show', [$publicAudio -> user_id]) !!}">{!! $publicAudioUserArray[0] -> name !!}</a></span>
                                        
                                        <?php break; ?>
                                    
                                      @endif
                                      
                                    @endif
                                  
                                  @endforeach
                                  
                                @endif
                                
                                <span class="description">Shared publicly - {!! $publicAudio -> created_at !!} </span>
              
                              </div>
              
                              <div class="box-tools">
                  
                                <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Mark as read"><a href="{!! route('publicAudios.show', [$publicAudio -> id]) !!}"><i class="fa fa-eye"></i></a></button>
                
                                @if(isset($user_id))
                
                                  {!! Form::open(['route' => 'publicAudioLikes.store', 'id' => 'public_audio_like_create', 'style' => 'display: inline-block']) !!}
                                
                                    {!! Form::hidden('status', 'Status:') !!}
                                    {!! Form::hidden('status', 'on', ['class' => 'form-control']) !!}
                                    
                                    {!! Form::hidden('datetime', 'Datetime:') !!}
                                    {!! Form::hidden('datetime', $now, ['class' => 'form-control']) !!}
                                    
                                    {!! Form::hidden('public_audio_id', 'Public Audio Id:') !!}
                                    {!! Form::hidden('public_audio_id', $publicAudio -> id, ['class' => 'form-control']) !!}
                                    
                                    {!! Form::hidden('user_id', 'User Id:') !!}
                                    {!! Form::hidden('user_id', $user_id, ['class' => 'form-control']) !!}
                                    
                                    <button type="submit" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Mark as read"><i class="fa fa-thumbs-o-up"></i></button>
                  
                                  {!! Form::close() !!}
                                  
                                @endif
                                
                                <button type="button" class="btn btn-box-tool" data-toggle="collapse" data-target="#audio_{!! $publicAudio -> id  !!}"><i class="fa fa-minus"></i></button>
              
                              </div>
            
                            </div>
            
                            <div id="audio_{!! $publicAudio -> id !!}" class="box-body">
              
                              <audio style="width: 100%; padding: 5px;" controls>
  
                                <source src="/audios/public_audios/audio_{!! $publicAudio -> id !!}.{!! $publicAudio -> file_type !!}" type="audio/{!! $publicAudio -> file_type !!}">

                                Your browser does not support the audio element.

                              </audio>
                              
                              <p class="text-muted well well-sm no-shadow" style="margin-top: 10px; text-align: justify;"> {!! $publicAudio -> description  !!} </p>
              
                              <span class="pull-right text-muted" style="background: rgba(0,0,0,0.2); color: #fff; margin: 10px; padding: 0 5px;">
                                
                                @if(isset($publicAudioLikes))
                                
                                  @foreach($publicAudioLikes as $publicAudioLikeArray)
                                    
                                    @if(isset($publicAudioLikeArray[0]))
                                    
                                      @if($publicAudio -> id == $publicAudioLikeArray[0] -> public_audio_id)
                                    
                                        {!! sizeof($publicAudioLikeArray) !!} likes -
                                    
                                      @endif
                                      
                                    @endif
                                  
                                  @endforeach
                                  
                                @endif
                                
                                @if(isset($publicAudioCommentCounts))
                                
                                  @foreach($publicAudioCommentCounts as $publicAudioCommentCountArray)
                
                                    @if(isset($publicAudioCommentCountArray[0]))
                
                                      @if($publicAudio -> id == $publicAudioCommentCountArray[0] -> public_audio_id)
                                    
                                        {!! sizeof($publicAudioCommentCountArray) !!} comments
                                    
                                      @endif
                                      
                                    @endif
                                  
                                  @endforeach
                                
                                @endif
                                
                              </span>
                              
                              <div class="box-footer box-comments" style="padding-top: 40px;">
                                
                                @if(isset($publicAudioComments))
              
                                  @foreach($publicAudioComments as $publicAudioCommentArray)
                                  
                                    @if(isset($publicAudioCommentArray[0]))
                
                                      @foreach($publicAudioCommentArray as $publicAudioComment)
                  
                                        @if($publicAudio -> id == $publicAudioComment -> public_audio_id)
                  
                                          <div class="box-comment">
                                            
                                            @if(isset($publicAudioCommentUsers))
                            
                                              @foreach($publicAudioCommentUsers as $publicAudioCommentUserArray)
                                              
                                                @if(isset($publicAudioCommentUserArray[0]))
                                        
                                                  @foreach($publicAudioCommentUserArray as $publicAudioCommentUser)
                                          
                                                    @if($publicAudioComment -> user_id == $publicAudioCommentUser -> user_id && $publicAudioComment -> id == $publicAudioCommentUser -> id)
        
                                                      <img class="img-circle img-sm" src="/images/users/image_{!! $publicAudioComment -> user_id !!}.{!! $publicAudioCommentUser -> image_type  !!}" alt="User Image">
                
                                                      <?php break; ?>
                
                                                    @endif
                                                    
                                                  @endforeach
                                                  
                                                @endif
                                                
                                              @endforeach
                                              
                                            @endif
            
                                            <div class="comment-text" style="text-align:justify; padding-right: 10px;">
                                  
                                              <span class="username">
                                                
                                                @if(isset($publicAudioCommentUsers))
                                                
                                                  @foreach($publicAudioCommentUsers as $publicAudioCommentUserArray)
                                                  
                                                    @if(isset($publicAudioCommentUserArray[0]))
                                        
                                                      @foreach($publicAudioCommentUserArray as $publicAudioCommentUser)
                                          
                                                        @if($publicAudioComment -> user_id == $publicAudioCommentUser -> user_id && $publicAudioComment -> id == $publicAudioCommentUser -> id)
                                            
                                                          {!! $publicAudioCommentUser -> name !!}
                                                
                                                          <?php break; ?>
                                            
                                                        @endif
                                                      
                                                      @endforeach
                                      
                                                    @endif
                                      
                                                  @endforeach
                                                  
                                                @endif
                                    
                                                <span class="text-muted pull-right" style="background: rgba(0,0,0,0.1); color: #000; padding: 0 5px;">{!! $publicAudioComment -> datetime !!}</span>
                                  
                                              </span>
                              
                                              {!! $publicAudioComment -> content !!}
                                              
                                            </div>
                                            
                                            @if(isset($publicAudioCommentResponses))
                                            
                                              @foreach($publicAudioCommentResponses as $publicAudioCommentResponseArray)
                                              
                                                @if(isset($publicAudioCommentResponseArray[0]))
                      
                                                  @foreach($publicAudioCommentResponseArray as $publicAudioCommentResponse)
                      
                                                    @if($publicAudioComment -> id == $publicAudioCommentResponse -> public_audio_comment_id)
                                                
                                                      <div style="margin-left: 10px;" class="box-comment">
                                                        
                                                        @if(isset($publicAudioCommentResponseUsers))
                                                        
                                                          @foreach($publicAudioCommentResponseUsers as $publicAudioCommentResponseUserArray)
                                                          
                                                            @if(isset($publicAudioCommentResponseUserArray[0]))
                                            
                                                              @foreach($publicAudioCommentResponseUserArray as $publicAudioCommentResponseUser)
                                                      
                                                                @if($publicAudioCommentResponse -> user_id == $publicAudioCommentResponseUser -> user_id && $publicAudioCommentResponse -> id == $publicAudioCommentResponseUser -> id)
            
                                                                  <img class="img-circle img-sm" src="/images/users/image_{!! $publicAudioCommentResponse -> user_id !!}.{!! $publicAudioCommentResponseUser -> image_type !!}" alt="User Image">
                            
                                                                  <?php break; ?>
                                                        
                                                                @endif
                                                                    
                                                              @endforeach
                                                              
                                                            @endif
                                                  
                                                          @endforeach
                                                          
                                                        @endif
                        
                                                        <div class="comment-text" style="text-align:justify; padding-right: 10px;">
                                              
                                                          <span class="username">
                                                            
                                                            @if(isset($publicAudioCommentResponseUsers))
                                                            
                                                              @foreach($publicAudioCommentResponseUsers as $publicAudioCommentResponseUserArray)
                                                              
                                                                @if(isset($publicAudioCommentResponseArray[0]))
                                            
                                                                  @foreach($publicAudioCommentResponseUserArray as $publicAudioCommentResponseUser)
                                                      
                                                                    @if($publicAudioCommentResponse -> user_id == $publicAudioCommentResponseUser -> user_id && $publicAudioCommentResponse -> id == $publicAudioCommentResponseUser -> id)
                                                        
                                                                      {!! $publicAudioCommentResponseUser -> name !!}
                                                            
                                                                      <?php break; ?>
                                                        
                                                                    @endif
                                                                    
                                                                  @endforeach
                                                                  
                                                                @endif
                                                  
                                                              @endforeach
                                                              
                                                            @endif
                                                
                                                            <span class="text-muted pull-right" style="background: rgba(0,0,0,0.1); color: #000; padding: 0 5px;">{!! $publicAudioCommentResponse -> datetime !!}</span>
                                              
                                                          </span>
                                          
                                                          {!! $publicAudioCommentResponse -> content !!}
                                                          
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
                                    
                                              <form id='public_audio_comment_response_{!! $publicAudioComment -> id !!}' action = "{!! URL::to('/store_public_audio_comment_response') !!}" method = "post">
                          
                                                {{ csrf_field() }}
                                
                                                <img class="img-responsive img-circle img-sm" src="/images/users/image_{!! $user_id !!}.{!! $user[0] -> image_type !!}" alt="Alt Text">
                                
                                                <div class="img-push">
                                
                                                  <input id="public_audio_comment_id" name="public_audio_comment_id" type="hidden" value="{!! $publicAudioComment -> id !!}">
                                                  <input id="status" name="status" type="hidden" value="on">
                                                  <input id="datetime" name="datetime" type="hidden" value="{!! $now !!}">
                                                  <input id="user_id" name="user_id" type="hidden" value="{!! $user_id !!}">
                                                  
                                                  <input id="public_audio_comment_response_content_{!! $publicAudioComment -> id !!}" name="content" type="text" class="form-control input-sm" placeholder="Press enter to post comment">
                                
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
                
                                  <form id='public_audio_comment' action = "{!! URL::to('/store_public_audio_comment') !!}" method = "post">
              
                                    {{ csrf_field() }}
                    
                                    <img class="img-responsive img-circle img-sm" src="/images/users/image_{!! $user_id !!}.{!! $user[0] -> image_type !!}" alt="Alt Text">
                    
                                    <div class="img-push">
                    
                                      <input id="public_audio_id" name="public_audio_id" type="hidden" value="{!! $publicAudio -> id !!}">
                                      <input id="status" name="status" type="hidden" value="on">
                                      <input id="datetime" name="datetime" type="hidden" value="{!! $now !!}">
                                      <input id="user_id" name="user_id" type="hidden" value="{!! $user_id !!}">
                                      
                                      <input id="public_audio_comment_content" name="content" type="text" class="form-control input-sm" placeholder="Press enter to post comment">
                    
                                    </div>
                  
                                  </form>
                                  
                                @endif
              
                              </div>
            
                            </div>
          
                          </div>
        
                        </div>
                        
                      @endforeach
                      
                      @foreach($publicVideos as $publicVideo)
                        
                        <div class="col-md-12" style="margin-bottom: 10px; margin-top: 10px;">
          
                          <div class="box box-primary">
            
                            <div class="box-header with-border">
              
                              <div class="user-block">
                                
                                @if(isset($publicVideoUsers))
                              
                                  @foreach($publicVideoUsers as $publicVideoUserArray)
                                  
                                    @if(isset($publicVideoUserArray[0]))
                                    
                                      @if($publicVideo -> user_id == $publicVideoUserArray[0] -> id)
                                      
                                        <img class="img-circle" src="/images/users/image_{!! $publicVideo -> user_id !!}.{!! $publicVideoUserArray[0] -> image_type !!}" alt="User Image">
                                    
                                        <span class="username"><a href="{!! route('publicUser.show', [$publicVideo -> user_id]) !!}">{!! $publicVideoUserArray[0] -> name !!}</a></span>
                                        
                                        <?php break; ?>
                                    
                                      @endif
                                      
                                    @endif
                                  
                                  @endforeach
                                  
                                @endif
                                
                                <span class="description">Shared publicly - {!! $publicVideo -> created_at !!}</span>
              
                              </div>
              
                              <div class="box-tools">
                
                                <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Mark as read"><a href="{!! route('publicVideos.show', [$publicVideo -> id]) !!}"><i class="fa fa-eye"></i></a></button>
                
                                @if(isset($user_id))
                
                                  {!! Form::open(['route' => 'publicVideoLikes.store', 'id' => 'public_video_like_create', 'style' => 'display: inline-block']) !!}
                                
                                    {!! Form::hidden('status', 'Status:') !!}
                                    {!! Form::hidden('status', 'on', ['class' => 'form-control']) !!}
                                    
                                    {!! Form::hidden('datetime', 'Datetime:') !!}
                                    {!! Form::hidden('datetime', $now, ['class' => 'form-control']) !!}
                                    
                                    {!! Form::hidden('public_video_id', 'Public Video Id:') !!}
                                    {!! Form::hidden('public_video_id', $publicVideo -> id, ['class' => 'form-control']) !!}
                                    
                                    {!! Form::hidden('user_id', 'User Id:') !!}
                                    {!! Form::hidden('user_id', $user_id, ['class' => 'form-control']) !!}
                                    
                                    <button type="submit" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Mark as read"><i class="fa fa-thumbs-o-up"></i></button>
                  
                                  {!! Form::close() !!}
                                  
                                @endif
                                
                                <button type="button" class="btn btn-box-tool" data-toggle="collapse" data-target="#video_{!! $publicVideo -> id  !!}"><i class="fa fa-minus"></i></button>
              
                              </div>
            
                            </div>
            
                            <div id="video_{!! $publicVideo -> id  !!}" class="box-body">
              
                              <video width="100%" style="margin-bottom: 5px;" controls>
                    
                                <source src="/videos/public_videos/video_{!! $publicVideo -> id !!}.{!! $publicVideo -> file_type !!}" type="video/mp4">
                  
                              </video>
                              
                              <p class="text-muted well well-sm no-shadow" style="margin-top: 10px; text-align: justify;"> {!! $publicVideo -> description  !!} </p>
              
                              <span class="pull-right text-muted" style="background: rgba(0,0,0,0.2); color: #fff; margin: 10px; padding: 0 5px;">
                                
                                @if(isset($publicVideoLikes))
                                
                                  @foreach($publicVideoLikes as $publicVideoLikeArray)
                                    
                                    @if(isset($publicVideoLikeArray[0]))
                                    
                                      @if($publicVideo -> id == $publicVideoLikeArray[0] -> public_video_id)
                                    
                                        {!! sizeof($publicVideoLikeArray) !!} likes -
                                    
                                      @endif
                                      
                                    @endif
                                  
                                  @endforeach
                                  
                                @endif
                                
                                @if(isset($publicVideoCommentCounts))
                                
                                  @foreach($publicVideoCommentCounts as $publicVideoCommentCountArray)
                
                                    @if(isset($publicVideoCommentCountArray[0]))
                
                                      @if($publicVideo -> id == $publicVideoCommentCountArray[0] -> public_video_id)
                                    
                                        {!! sizeof($publicVideoCommentCountArray) !!} comments
                                    
                                      @endif
                                      
                                    @endif
                                  
                                  @endforeach
                                  
                                @endif
                                
                              </span>
            
                              <div class="box-footer box-comments" style="padding-top: 40px;">
                                
                                @if(isset($publicVideoComments))
              
                                  @foreach($publicVideoComments as $publicVideoCommentArray)
                                  
                                    @if(isset($publicVideoCommentArray[0]))
                
                                      @foreach($publicVideoCommentArray as $publicVideoComment)
                  
                                        @if($publicVideo -> id == $publicVideoComment -> public_video_id)
                  
                                          <div class="box-comment">
                                            
                                            @if(isset($publicVideoCommentUsers))
                            
                                              @foreach($publicVideoCommentUsers as $publicVideoCommentUserArray)
                                              
                                                @if(isset($publicVideoCommentUserArray[0]))
                                        
                                                  @foreach($publicVideoCommentUserArray as $publicVideoCommentUser)
                                          
                                                    @if($publicVideoComment -> user_id == $publicVideoCommentUser -> user_id && $publicVideoComment -> id == $publicVideoCommentUser -> id)
        
                                                      <img class="img-circle img-sm" src="/images/users/image_{!! $publicVideoComment -> user_id !!}.{!! $publicVideoCommentUser -> image_type !!}" alt="User Image">
              
                                                      <?php break; ?>
                                            
                                                    @endif
                                                        
                                                  @endforeach
                                                  
                                                @endif
                                      
                                              @endforeach
                                              
                                            @endif
                
                                            <div class="comment-text" style="text-align:justify; padding-right: 10px;">
                                  
                                              <span class="username">
                                                
                                                @if(isset($publicVideoCommentUsers))
                                                
                                                  @foreach($publicVideoCommentUsers as $publicVideoCommentUserArray)
                                                  
                                                    @if(isset($publicVideoCommentUserArray[0]))
                                        
                                                      @foreach($publicVideoCommentUserArray as $publicVideoCommentUser)
                                          
                                                        @if($publicVideoComment -> user_id == $publicVideoCommentUser -> user_id && $publicVideoComment -> id == $publicVideoCommentUser -> id)
                                            
                                                          {!! $publicVideoCommentUser -> name !!}
                                                
                                                          <?php break; ?>
                                            
                                                        @endif
                                                        
                                                      @endforeach
                                                    
                                                    @endif
                                      
                                                  @endforeach
                                                  
                                                @endif
                                    
                                                <span class="text-muted pull-right" style="background: rgba(0,0,0,0.1); color: #000; padding: 0 5px;">{!! $publicVideoComment -> datetime !!}</span>
                                  
                                              </span>
                              
                                              {!! $publicVideoComment -> content !!}
                                              
                                            </div>
                  
                                            @if(isset($publicVideoCommentResponses))
                                            
                                              @foreach($publicVideoCommentResponses as $publicVideoCommentResponseArray)
                                              
                                                @if(isset($publicVideoCommentResponseArray[0]))
                    
                                                  @foreach($publicVideoCommentResponseArray as $publicVideoCommentResponse)
                      
                                                    @if($publicVideoComment -> id == $publicVideoCommentResponse -> public_video_comment_id)
                                                
                                                      <div style="margin-left: 10px;" class="box-comment">
                                                        
                                                        @if(isset($publicVideoCommentResponseUsers))
                                      
                                                          @foreach($publicVideoCommentResponseUsers as $publicVideoCommentResponseUserArray)
                                                          
                                                            @if(isset($publicVideoCommentResponseUserArray[0]))
                                            
                                                              @foreach($publicVideoCommentResponseUserArray as $publicVideoCommentResponseUser)
                                                      
                                                                @if($publicVideoCommentResponse -> user_id == $publicVideoCommentResponseUser -> user_id && $publicVideoCommentResponse -> id == $publicVideoCommentResponseUser -> id)
            
                                                                  <img class="img-circle img-sm" src="/images/users/image_{!! $publicVideoCommentResponse -> user_id !!}.{!! $publicVideoCommentResponseUser -> image_type !!}" alt="User Image">
                            
                                                                  <?php break; ?>
                                                        
                                                                @endif
                                                                    
                                                              @endforeach
                                                              
                                                            @endif
                                                  
                                                          @endforeach
                                                          
                                                        @endif
                        
                                                        <div class="comment-text" style="text-align:justify; padding-right: 10px;">
                                              
                                                          <span class="username">
                                                            
                                                            @if(isset($publicVideoCommentResponseUsers))
                                                            
                                                              @foreach($publicVideoCommentResponseUsers as $publicVideoCommentResponseUserArray)
                                                              
                                                                @if(isset($publicVideoCommentResponseUserArray[0]))
                                            
                                                                  @foreach($publicVideoCommentResponseUserArray as $publicVideoCommentResponseUser)
                                                      
                                                                    @if($publicVideoCommentResponse -> user_id == $publicVideoCommentResponseUser -> user_id && $publicVideoCommentResponse -> id == $publicVideoCommentResponseUser -> id)
                                                        
                                                                      {!! $publicVideoCommentResponseUser -> name !!}
                                                            
                                                                      <?php break; ?>
                                                        
                                                                    @endif
                                                                    
                                                                  @endforeach
                                                                  
                                                                @endif
                                                  
                                                              @endforeach
                                                              
                                                            @endif
                                                
                                                            <span class="text-muted pull-right" style="background: rgba(0,0,0,0.1); color: #000; padding: 0 5px;">{!! $publicVideoCommentResponse -> datetime !!}</span>
                                              
                                                          </span>
                                          
                                                          {!! $publicVideoCommentResponse -> content !!}
                                                          
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
                                    
                                              <form id='public_video_comment_response_{!! $publicVideoComment -> id !!}' action = "{!! URL::to('/store_public_video_comment_response') !!}" method = "post">
                          
                                                {{ csrf_field() }}
                                
                                                <img class="img-responsive img-circle img-sm" src="/images/users/image_{!! $user_id !!}.{!! $user[0] -> image_type !!}" alt="Alt Text">
                                
                                                <div class="img-push">
                                
                                                  <input id="public_video_comment_id" name="public_video_comment_id" type="hidden" value="{!! $publicVideoComment -> id !!}">
                                                  <input id="status" name="status" type="hidden" value="on">
                                                  <input id="datetime" name="datetime" type="hidden" value="{!! $now !!}">
                                                  <input id="user_id" name="user_id" type="hidden" value="{!! $user_id !!}">
                                                  
                                                  <input id="public_video_comment_response_content_{!! $publicVideoComment -> id !!}" name="content" type="text" class="form-control input-sm" placeholder="Press enter to post comment">
                                
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
                
                                  <form id='public_video_comment' action = "{!! URL::to('/store_public_video_comment') !!}" method = "post">
              
                                    {{ csrf_field() }}
                    
                                    <img class="img-responsive img-circle img-sm" src="/images/users/image_{!! $user_id !!}.{!! $user[0] -> image_type !!}" alt="Alt Text">
                    
                                    <div class="img-push">
                    
                                      <input id="public_video_id" name="public_video_id" type="hidden" value="{!! $publicVideo -> id !!}">
                                      <input id="status" name="status" type="hidden" value="on">
                                      <input id="datetime" name="datetime" type="hidden" value="{!! $now !!}">
                                      <input id="user_id" name="user_id" type="hidden" value="{!! $user_id !!}">
                                      
                                      <input id="public_video_comment_content" name="content" type="text" class="form-control input-sm" placeholder="Press enter to post comment">
                    
                                    </div>
                  
                                  </form>
                                  
                                @endif
              
                              </div>
            
                            </div>
        
                          </div>
        
                        </div>
                        
                      @endforeach
                        
                      @foreach($publicAdvertisements as $publicAdvertisement)
                        
                        <div class="col-md-12" style="margin-top: 10px;">
          
                          <div class="box box-primary">
                            
                            <div class="box-header with-border" style = "padding-bottom: 25px;">
              
                              <div class="box-tools">
                
                                <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Mark as read"><a href="{!! route('publicAdvertisements.show', [$publicAdvertisement -> id]) !!}"><i class="fa fa-eye"></i></a></button>
                
                                @if(isset($user_id))
                
                                  {!! Form::open(['route' => 'publicAdvertisementLikes.store', 'id' => 'public_advertisement_like_create', 'style' => 'display: inline-block']) !!}
                                
                                    {!! Form::hidden('status', 'Status:') !!}
                                    {!! Form::hidden('status', 'on', ['class' => 'form-control']) !!}
                                    
                                    {!! Form::hidden('datetime', 'Datetime:') !!}
                                    {!! Form::hidden('datetime', $now, ['class' => 'form-control']) !!}
                                    
                                    {!! Form::hidden('public_advertisement_id', 'Public Advertisement Id:') !!}
                                    {!! Form::hidden('public_advertisement_id', $publicAdvertisement -> id, ['class' => 'form-control']) !!}
                                    
                                    {!! Form::hidden('user_id', 'User Id:') !!}
                                    {!! Form::hidden('user_id', $user_id, ['class' => 'form-control']) !!}
                                    
                                    <button type="submit" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Mark as read"><i class="fa fa-thumbs-o-up"></i></button>
                  
                                  {!! Form::close() !!}
                                  
                                @endif
                                
                                <button type="button" class="btn btn-box-tool" data-toggle="collapse" data-target="#advertisement_{!! $publicAdvertisement -> id  !!}"><i class="fa fa-minus"></i></button>
              
                              </div>
            
                            </div>
            
                            <div class="box-body" style="padding-left: 0; padding-right: 0;">
                              
                              <div class="col-md-12" style="padding-left: 10px; padding-right: 10px;">
          
                                <div class="box box-widget widget-user">
                                  
                                  <div class="widget-user-header bg-aqua-active" style="background-image: url('http://www.desmus.com.mx/images/public_advertisement_images/image_{!! $publicAdvertisement -> id !!}.{!! $publicAdvertisement -> image_type !!}'); background-position: center; background-repeat: no-repeat; background-size: cover;">
                                    
                                    @if(isset($publicAdvertisementUsers))
                                    
                                      @foreach($publicAdvertisementUsers as $publicAdvertisementUserArray)
                                  
                                        @if(isset($publicAdvertisementUserArray[0]))
                                        
                                          @if($publicAdvertisement -> user_id == $publicAdvertisementUserArray[0] -> id)
                                        
                                            <a href = "{!! route('publicUser.show', [$publicAdvertisement -> user_id]) !!}" style="color: #fff;"> <h3 class="widget-user-username">{!! $publicAdvertisementUserArray[0] -> name !!}</h3> </a>
                                            
                                            <?php break; ?>
                                        
                                          @endif
                                          
                                        @endif
                                      
                                      @endforeach
                                      
                                    @endif
                                    
                                    <h5 class="widget-user-desc"> {!! $publicAdvertisement -> created_at !!} </h5>
                                  
                                  </div>
                                  
                                  <div class="widget-user-image">
                                    
                                    @if(isset($publicAdvertisementUsers))
                                    
                                      @foreach($publicAdvertisementUsers as $publicAdvertisementUserArray)
                                  
                                        @if(isset($publicAdvertisementUserArray[0]))
                                        
                                          @if($publicAdvertisement -> user_id == $publicAdvertisementUserArray[0] -> id)
                                      
                                            <img class="img-circle" src="/images/users/image_{!! $publicAdvertisement -> user_id !!}.{!! $publicAdvertisementUserArray[0] -> image_type !!}" alt="User Avatar">
                                    
                                            <?php break; ?>
                                        
                                          @endif
                                          
                                        @endif
                                      
                                      @endforeach
                                      
                                    @endif
                                  
                                  </div>
                                  
                                  <div class="box-footer">
                                    
                                    <div class="row">
                                      
                                      <div class="col-sm-4 border-right">
                                      
                                        <div class="description-block">
                                      
                                          <h5 class="description-header" style = "margin-bottom: 10px;">Web Site</h5>
                                          <span class="description-text" style="font-size: 10px;"> <a href = ""> {!! $publicAdvertisement -> link !!} </a> </span>
                                        
                                        </div>
                                      
                                      </div>
                                      
                                      <div class="col-sm-4 border-right">
                                        
                                        <div class="description-block">
                                          
                                          <h5 class="description-header" style = "margin-bottom: 10px;">Email</h5>
                                          <span class="description-text" style="font-size: 10px;"> <a href = ""> {!! $publicAdvertisement -> email !!} </a> </span>
                                        
                                        </div>
                                        
                                      </div>
                                      
                                      <div class="col-sm-4">
                                        
                                        <div class="description-block">
                                          
                                          <h5 class="description-header" style = "margin-bottom: 10px;">Telephone</h5>
                                          <span class="description-text"> {!! $publicAdvertisement -> telephone !!} </span>
                                        
                                        </div>
                                        
                                      </div>
                                      
                                    </div>
                                    
                                  </div>
                                
                                </div>
                                
                                <div id="advertisement_{!! $publicAdvertisement -> id  !!}" class = "col-md-12" style="padding-left: 0; padding-right: 0">
                                
                                  <video width="100%" controls>
                      
                                    <source src="/videos/public_advertisement_videos/video_{!! $publicAdvertisement -> id !!}.{!! $publicAdvertisement -> video_type !!}" type="video/mp4">
                    
                                  </video>
                                  
                                  <p class="text-muted well well-sm no-shadow" style="margin-top: 10px; text-align: justify;"> {!! $publicAdvertisement -> description  !!} </p>
                  
                                  <span class="pull-right text-muted" style="background: rgba(0,0,0,0.2); color: #fff; margin: 10px; padding: 0 5px;">
                                
                                    @if(isset($publicAdvertisementLikes))
                                
                                      @foreach($publicAdvertisementLikes as $publicAdvertisementLikeArray)
                                    
                                        @if(isset($publicAdvertisementLikeArray[0]))
                                        
                                          @if($publicAdvertisement -> id == $publicAdvertisementLikeArray[0] -> public_advertisement_id)
                                        
                                            {!! sizeof($publicAdvertisementLikeArray) !!} likes -
                                        
                                          @endif
                                          
                                        @endif
                                      
                                      @endforeach

                                    @endif
                                    
                                    @if(isset($publicAdvertisementCommentCounts))
                                    
                                      @foreach($publicAdvertisementCommentCounts as $publicAdvertisementCommentCountArray)
                    
                                        @if(isset($publicAdvertisementCommentCountArray[0]))
                    
                                          @if($publicAdvertisement -> id == $publicAdvertisementCommentCountArray[0] -> public_advertisement_id)
                                        
                                            {!! sizeof($publicAdvertisementCommentCountArray) !!} comments
                                        
                                          @endif
                                          
                                        @endif
                                      
                                      @endforeach
                                      
                                    @endif
                                    
                                  </span>
                                  
                                  <div class="box-footer box-comments" style="padding-top: 40px;">
                                    
                                    @if(isset($publicAdvertisementComments))
                  
                                      @foreach($publicAdvertisementComments as $publicAdvertisementCommentArray)
                
                                        @if(isset($publicAdvertisementCommentArray[0]))
                
                                          @foreach($publicAdvertisementCommentArray as $publicAdvertisementComment)
                      
                                            @if($publicAdvertisement -> id == $publicAdvertisementComment -> public_advertisement_id)
                      
                                              <div class="box-comment">
                                                
                                                @if(isset($publicAdvertisementCommentUsers))
                                
                                                  @foreach($publicAdvertisementCommentUsers as $publicAdvertisementCommentUserArray)
                                                  
                                                    @if(isset($publicAdvertisementCommentUserArray[0]))
                                        
                                                      @foreach($publicAdvertisementCommentUserArray as $publicAdvertisementCommentUser)
                                              
                                                        @if($publicAdvertisementComment -> user_id == $publicAdvertisementCommentUser -> user_id && $publicAdvertisementComment -> id == $publicAdvertisementCommentUser -> id)
        
                                                          <img class="img-circle img-sm" src="/images/users/image_{!! $publicAdvertisementComment -> user_id !!}.{!! $publicAdvertisementCommentUser -> image_type !!}" alt="User Image">
                    
                                                          <?php break; ?>
                                                
                                                        @endif
                                                            
                                                      @endforeach
                                                      
                                                    @endif
                                          
                                                  @endforeach
                                                  
                                                @endif
                
                                                <div class="comment-text" style="text-align:justify; padding-right: 10px;">
                                      
                                                  <span class="username">
                                                    
                                                    @if(isset($publicAdvertisementCommentUsers))
                                                    
                                                      @foreach($publicAdvertisementCommentUsers as $publicAdvertisementCommentUserArray)
                                                      
                                                        @if(isset($publicAdvertisementCommentUserArray[0]))
                                        
                                                          @foreach($publicAdvertisementCommentUserArray as $publicAdvertisementCommentUser)
                                              
                                                            @if($publicAdvertisementComment -> user_id == $publicAdvertisementCommentUser -> user_id && $publicAdvertisementComment -> id == $publicAdvertisementCommentUser -> id)
                                                
                                                              {!! $publicAdvertisementCommentUser -> name !!}
                                                    
                                                              <?php break; ?>
                                                
                                                            @endif
                                                            
                                                          @endforeach
                                                          
                                                        @endif
                                          
                                                      @endforeach
                                                      
                                                    @endif
                                        
                                                    <span class="text-muted pull-right" style="background: rgba(0,0,0,0.1); color: #000; padding: 0 5px;">{!! $publicAdvertisementComment -> datetime !!}</span>
                                      
                                                  </span>
                                  
                                                  {!! $publicAdvertisementComment -> content !!}
                                                  
                                                </div>
                                                
                                                @if(isset($publicAdvertisementCResponses))
                                                
                                                  @foreach($publicAdvertisementCResponses as $publicAdvertisementCResponseArray)
                                                  
                                                    @if(isset($publicAdvertisementCResponseArray[0]))
                    
                                                      @foreach($publicAdvertisementCResponseArray as $publicAdvertisementCResponse)
                          
                                                        @if($publicAdvertisementComment -> id == $publicAdvertisementCResponse -> public_a_c_id)
                                                    
                                                          <div style="margin-left: 10px;" class="box-comment">
                                                            
                                                            @if(isset($publicAdvertisementCResponseUsers))
                                          
                                                              @foreach($publicAdvertisementCResponseUsers as $publicAdvertisementCResponseUserArray)
                                                              
                                                                @if(isset($publicAdvertisementCResponseUserArray[0]))
                                            
                                                                  @foreach($publicAdvertisementCResponseUserArray as $publicAdvertisementCResponseUser)
                                                          
                                                                    @if($publicAdvertisementCResponse -> user_id == $publicAdvertisementCResponseUser -> user_id && $publicAdvertisementCResponse -> id == $publicAdvertisementCResponseUser -> id)
                                                                    
                                                                      <img class="img-circle img-sm" src="/images/users/image_{!! $publicAdvertisementCResponse -> user_id !!}.{!! $publicAdvertisementCResponseUser -> image_type !!}" alt="User Image">
                                
                                                                      <?php break; ?>
                                                            
                                                                    @endif
                                                                        
                                                                  @endforeach
                                                                  
                                                                @endif
                                                      
                                                              @endforeach
                                                              
                                                            @endif
                            
                                                            <div class="comment-text" style="text-align:justify; padding-right: 10px;">
                                                  
                                                              <span class="username">
                                                                
                                                                @if(isset($publicAdvertisementCResponseUsers))
                                                                
                                                                  @foreach($publicAdvertisementCResponseUsers as $publicAdvertisementCResponseUserArray)
                                                                  
                                                                    @if(isset($publicAdvertisementCResponseArray[0]))
                                            
                                                                      @foreach($publicAdvertisementCResponseUserArray as $publicAdvertisementCResponseUser)
                                                          
                                                                        @if($publicAdvertisementCResponse -> user_id == $publicAdvertisementCResponseUser -> user_id && $publicAdvertisementCResponse -> id == $publicAdvertisementCResponseUser -> id)
                                                            
                                                                          {!! $publicAdvertisementCResponseUser -> name !!}
                                                                
                                                                          <?php break; ?>
                                                            
                                                                        @endif
                                                                        
                                                                      @endforeach
                                                                      
                                                                    @endif
                                                      
                                                                  @endforeach
                                                                  
                                                                @endif
                                                    
                                                                <span class="text-muted pull-right" style="background: rgba(0,0,0,0.1); color: #000; padding: 0 5px;">{!! $publicAdvertisementCResponse -> datetime !!}</span>
                                                  
                                                              </span>
                                              
                                                              {!! $publicAdvertisementCResponse -> content !!}
                                                              
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
                                        
                                                  <form id='public_advertisement_comment_response_{!! $publicAdvertisementComment -> id !!}' action = "{!! URL::to('/store_public_advertisement_c_response') !!}" method = "post">
                              
                                                    {{ csrf_field() }}
                                    
                                                    <img class="img-responsive img-circle img-sm" src="/images/users/image_{!! $user_id !!}.{!! $user[0] -> image_type !!}" alt="Alt Text">
                                    
                                                    <div class="img-push">
                                    
                                                      <input id="public_a_c_id" name="public_a_c_id" type="hidden" value="{!! $publicAdvertisementComment -> id !!}">
                                                      <input id="status" name="status" type="hidden" value="on">
                                                      <input id="datetime" name="datetime" type="hidden" value="{!! $now !!}">
                                                      <input id="user_id" name="user_id" type="hidden" value="{!! $user_id !!}">
                                                      
                                                      <input id="public_advertisement_comment_response_content_{!! $publicAdvertisementComment -> id !!}" name="content" type="text" class="form-control input-sm" placeholder="Press enter to post comment">
                                    
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
                    
                                      <form id='public_advertisement_comment' action = "{!! URL::to('/store_public_advertisement_comment') !!}" method = "post">
              
                                        {{ csrf_field() }}
                        
                                        <img class="img-responsive img-circle img-sm" src="/images/users/image_{!! $user_id !!}.{!! $user[0] -> image_type !!}" alt="Alt Text">
                        
                                        <div class="img-push">
                        
                                          <input id="public_advertisement_id" name="public_advertisement_id" type="hidden" value="{!! $publicAdvertisement -> id !!}">
                                          <input id="status" name="status" type="hidden" value="on">
                                          <input id="datetime" name="datetime" type="hidden" value="{!! $now !!}">
                                          <input id="user_id" name="user_id" type="hidden" value="{!! $user_id !!}">
                                          
                                          <input id="public_advertisement_comment_content" name="content" type="text" class="form-control input-sm" placeholder="Press enter to post comment">
                        
                                        </div>
                      
                                      </form>
                                      
                                    @endif
                  
                                  </div>
                                  
                                </div>
                                  
                              </div>
            
                            </div>
        
                          </div>
        
                        </div>
                        
                      @endforeach
                        
                    </div>
                    
                  </div>

                </div>
                
                <div class = "tab-pane active" id = "public_files" style="margin: 10px;">
                  
                  <div class="box box-primary">
            
                    <div class="box-body" style="padding-bottom: 0;">
    
                      <div class="row">
     
                        <div class="col-md-12">
              
                          <div class="nav-tabs-custom" style="margin-bottom: 10px;">
                
                            <ul class="nav nav-tabs">
    
                              <li class="active"><a href="#public_files_list" data-toggle="tab" aria-expanded="false"> Public Files </a></li>
                              
                              @if(isset($user_id))
                              
                                <li><a href="#upload_files" data-toggle="tab" aria-expanded="false"> Upload Files </a></li>
                    
                              @endif
                    
                            </ul>
              
                            <div class="tab-content clearfix" style="padding: 10;">
              
                              <div class="tab-pane active" id="public_files_list">
                                
                                <div class="row">
                  
                                  <div class="col-md-12" style="padding: 0;">
                                      
                                    @foreach($publicFilesList as $publicFileList)
                                    
                                      <div class="col-md-12" style="margin-top: 10px;">
                        
                                        <div class="box box-primary" style="margin-bottom: 0;">
                          
                                          <div class="box-header with-border">
                            
                                            <div class="user-block">
                              
                                              @if(isset($publicFileUsersList))
                              
                                                @foreach($publicFileUsersList as $publicFileUserListArray)
                                                
                                                  @if(isset($publicFileUserListArray[0]))
                                                  
                                                    @if($publicFileList -> user_id == $publicFileUserListArray[0] -> id)
                                                  
                                                      <img class="img-circle" src="/images/users/image_{!! $publicFileList -> user_id !!}.{!! $publicFileUserListArray[0] -> image_type !!}" alt="User Image">
                                                  
                                                      <span class="username"><a href="{!! route('publicUser.show', [$publicFileList -> user_id]) !!}">{!! $publicFileUserListArray[0] -> name !!}</a></span>
                                                      
                                                      <?php break; ?>
                                                  
                                                    @endif
                                                    
                                                  @endif
                                                
                                                @endforeach
                                                
                                              @endif
                                              
                                              <span class="description">Shared publicly - {!! $publicFileList -> created_at !!}</span>
                            
                                            </div>
                            
                                            <div class="box-tools">
                                            
                                              <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Mark as read"><a href="{!! route('publicFiles.show', [$publicFileList -> id]) !!}"><i class="fa fa-eye"></i></a></button>
                                            
                                              @if(isset($user_id))
                                            
                                                {!! Form::open(['route' => 'publicFileLikes.store', 'id' => 'public_file_like_create', 'style' => 'display: inline-block']) !!}
                                              
                                                  {!! Form::hidden('status', 'Status:') !!}
                                                  {!! Form::hidden('status', 'on', ['class' => 'form-control']) !!}
                                                  
                                                  {!! Form::hidden('datetime', 'Datetime:') !!}
                                                  {!! Form::hidden('datetime', $now, ['class' => 'form-control']) !!}
                                                  
                                                  {!! Form::hidden('public_file_id', 'Public File Id:') !!}
                                                  {!! Form::hidden('public_file_id', $publicFileList -> id, ['class' => 'form-control']) !!}
                                                  
                                                  {!! Form::hidden('user_id', 'User Id:') !!}
                                                  {!! Form::hidden('user_id', $user_id, ['class' => 'form-control']) !!}
                                                  
                                                  <button type="submit" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Mark as read"><i class="fa fa-thumbs-o-up"></i></button>
                                
                                                {!! Form::close() !!}
                                                
                                              @endif
                                              
                                              <button type="button" class="btn btn-box-tool" data-toggle="collapse" data-target="#file_list_{!! $publicFileList -> id  !!}"><i class="fa fa-minus"></i></button>
                            
                                            </div>
                          
                                          </div>
                          
                                          <div id="file_list_{!! $publicFileList -> id  !!}" class="box-body">
                                            
                                            <div class="info-box bg-yellow">
                                              
                                              <a href = "/files/public_files/file_{!! $publicFileList -> id !!}.{!! $publicFileList -> file_type !!}" style = "color: #fff;" download> <span class="info-box-icon glyphicon glyphicon-download-alt"></span> </a>
                                  
                                              <div class="info-box-content">
                                                
                                                <span class="info-box-text">Size (bytes)</span>
                                                <span class="info-box-number"> {!! $publicFileList -> file_size !!} </span>
                                  
                                                <div class="progress">
                                                  
                                                  <div class="progress-bar" style="width: 100%"></div>
                                                
                                                </div>
                                                
                                                <span class="progress-description"> {!! $publicFileList -> name !!} </span>
                                              
                                              </div>
                                            
                                            </div>
                                            
                                            <p class="text-muted well well-sm no-shadow" style="margin-top: 10px; text-align: justify;"> {!! $publicFileList -> description  !!} </p>
                                            
                                            <div class="box-footer">
                                              
                                              @if(isset($user_id))
                                              
                                                <form id='public_file_comment_r' action = "{!! URL::to('/store_public_file_comment') !!}" method = "post">
                            
                                                  {{ csrf_field() }}
                                  
                                                  <img class="img-responsive img-circle img-sm" src="/images/users/image_{!! $user_id !!}.{!! $user[0] -> image_type !!}" alt="Alt Text">
                                  
                                                  <div class="img-push">
                                  
                                                    <input id="public_file_id" name="public_file_id" type="hidden" value="{!! $publicFileList -> id !!}">
                                                    <input id="status" name="status" type="hidden" value="on">
                                                    <input id="datetime" name="datetime" type="hidden" value="{!! $now !!}">
                                                    <input id="user_id" name="user_id" type="hidden" value="{!! $user_id !!}">
                                                    
                                                    <input id="public_file_comment_r_content" name="content" type="text" class="form-control input-sm" placeholder="Press enter to post comment">
                                  
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
                                                
                                          <td> <a href="{!! route('publicFiles.show', [$file->id]) !!}"> {!! $file -> name !!} </a> </td>
                                                
                                          <td>
                                                    
                                            {!! Form::open(['route' => ['publicFiles.destroy', $file->id], 'method' => 'delete']) !!}
                                                    
                                              <div class="btn-group">
                                                        
                                                <a href="{!! route('publicFiles.show', [$file->id]) !!}" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-eye-open"></i></a>
                                                <a href="{!! route('publicFiles.edit', [$file->id]) !!}" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
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
                            
                          </div>
                          
                        </div>
                        
                      </div>
                      
                    </div>
                    
                  </div>
                  
                  @if(isset($user_id))
                  
                    <a href="{!! route('publicFiles.create') !!}" class="btn btn-default">Add File</a>
                  
                  @endif
                  
                </div>
                
                <div class = "tab-pane" id = "public_notes" style="margin: 10px;">
                  
                  <div class="box box-primary">
            
                    <div class="box-body" style="padding-bottom: 0;">
    
                      <div class="row">
     
                        <div class="col-md-12">
              
                          <div class="nav-tabs-custom" style="margin-bottom: 10px;">
                
                            <ul class="nav nav-tabs">
    
                              <li class="active"><a href="#public_notes_list" data-toggle="tab" aria-expanded="false"> Public Notes </a></li>
                              
                              @if(isset($user_id))
                              
                                <li><a href="#upload_notes" data-toggle="tab" aria-expanded="false"> Upload Notes </a></li>
                    
                              @endif
                    
                            </ul>
              
                            <div class="tab-content clearfix" style="padding: 10;">
              
                              <div class="tab-pane active" id="public_notes_list">
                                
                                <div class="row">
                  
                                  <div class="col-md-12" style="padding: 0;">
                                      
                                    @foreach($publicNotesList as $publicNoteList)
                        
                                      <div class="col-md-12" style="margin-bottom: 0; margin-top: 10px;">
                        
                                        <div class="box box-primary" style="margin-bottom: 0;">
                          
                                          <div class="box-header with-border">
                            
                                            <div class="user-block">
                                              
                                              @if(isset($publicNoteUsersList))
                                              
                                                @foreach($publicNoteUsersList as $publicNoteUserListArray)
                                                
                                                  @if(isset($publicNoteUserListArray[0]))
                                                  
                                                    @if($publicNoteList -> user_id == $publicNoteUserListArray[0] -> id)
                                                    
                                                      <img class="img-circle" src="/images/users/image_{!! $publicNoteList -> user_id !!}.{!! $publicNoteUserListArray[0] -> image_type !!}" alt="User Image">
                                                  
                                                      <span class="username"><a href="{!! route('publicUser.show', [$publicNoteList -> user_id]) !!}">{!! $publicNoteUserListArray[0] -> name !!}</a></span>
                                                      
                                                      <?php break; ?>
                                                  
                                                    @endif
                                                    
                                                  @endif
                                                
                                                @endforeach
                                                
                                              @endif
                                              
                                              <span class="description">Shared publicly - {!! $publicNoteList -> created_at !!} </span>
                            
                                            </div>
                            
                                            <div class="box-tools">
                              
                                              <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Mark as read"><a href="{!! route('publicNotes.show', [$publicNoteList -> id]) !!}"><i class="fa fa-eye"></i></a></button>
                              
                                              @if(isset($user_id))
                                              
                                                {!! Form::open(['route' => 'publicNoteLikes.store', 'id' => 'public_note_like_create', 'style' => 'display: inline-block']) !!}
                                              
                                                  {!! Form::hidden('status', 'Status:') !!}
                                                  {!! Form::hidden('status', 'on', ['class' => 'form-control']) !!}
                                                  
                                                  {!! Form::hidden('datetime', 'Datetime:') !!}
                                                  {!! Form::hidden('datetime', $now, ['class' => 'form-control']) !!}
                                                  
                                                  {!! Form::hidden('public_note_id', 'Public Note Id:') !!}
                                                  {!! Form::hidden('public_note_id', $publicNoteList -> id, ['class' => 'form-control']) !!}
                                                  
                                                  {!! Form::hidden('user_id', 'User Id:') !!}
                                                  {!! Form::hidden('user_id', $user_id, ['class' => 'form-control']) !!}
                                                  
                                                  <button type="submit" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Mark as read"><i class="fa fa-thumbs-o-up"></i></button>
                                
                                                {!! Form::close() !!}
                                              
                                              @endif
                                              
                                              <button type="button" class="btn btn-box-tool" data-toggle="collapse" data-target="#note_list_{!! $publicNoteList -> id  !!}"><i class="fa fa-minus"></i></button>
                            
                                            </div>
                          
                                          </div>
                          
                                          <div id = "note_list_{!! $publicNoteList -> id !!}" class="box-body">
                            
                                            <blockquote> {!! $publicNoteList -> content !!} </blockquote>
                                            
                                            <p class="text-muted well well-sm no-shadow" style="margin-top: 10px; text-align: justify;"> {!! $publicNoteList -> description  !!} </p>
                            
                                            <div class="box-footer">
                                              
                                              @if(isset($user_id))
                              
                                                <form id='public_note_comment_r' action = "{!! URL::to('/store_public_note_comment') !!}" method = "post">
                            
                                                  {{ csrf_field() }}
                                  
                                                  <img class="img-responsive img-circle img-sm" src="/images/users/image_{!! $user_id !!}.{!! $user[0] -> image_type !!}" alt="Alt Text">
                                  
                                                  <div class="img-push">
                                  
                                                    <input id="public_note_id" name="public_note_id" type="hidden" value="{!! $publicNoteList -> id !!}">
                                                    <input id="status" name="status" type="hidden" value="on">
                                                    <input id="datetime" name="datetime" type="hidden" value="{!! $now !!}">
                                                    <input id="user_id" name="user_id" type="hidden" value="{!! $user_id !!}">
                                                    
                                                    <input id="public_note_comment_r_content" name="content" type="text" class="form-control input-sm" placeholder="Press enter to post comment">
                                  
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
                                  
                                              <td> <a href="{!! route('publicNotes.show', [$note->id]) !!}"> {!! $note -> name !!} </a> </td>
                                                  
                                              <td>
                                                      
                                                {!! Form::open(['route' => ['publicNotes.destroy', $note->id], 'method' => 'delete']) !!}
                                                
                                                  <div class="btn-group">
                                                          
                                                    <a href="{!! route('publicNotes.show', [$note->id]) !!}" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-eye-open"></i></a>
                                                    <a href="{!! route('publicNotes.edit', [$note->id]) !!}" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
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
                              
                            </div>
                            
                          </div>
                          
                        </div>
                        
                      </div>
                      
                    </div>
                    
                  </div>
                  
                  @if(isset($user_id))
                  
                    <a href="{!! route('publicNotes.create') !!}" class="btn btn-default">Add Note</a>
                    
                  @endif
                
                </div>
                
                <div class = "tab-pane" id = "public_images" style="margin: 10px;">
                  
                  <div class="box box-primary">
            
                    <div class="box-body" style="padding-bottom: 0;">
    
                      <div class="row">
     
                        <div class="col-md-12">
              
                          <div class="nav-tabs-custom" style="margin-bottom: 10px;">
                
                            <ul class="nav nav-tabs">
    
                              <li class="active"><a href="#public_images_list" data-toggle="tab" aria-expanded="false"> Public Images </a></li>
                              
                              @if(isset($user_id))
                              
                                <li><a href="#upload_images" data-toggle="tab" aria-expanded="false"> Upload Images </a></li>
                    
                              @endif
                    
                            </ul>
              
                            <div class="tab-content clearfix" style="padding: 10;">
              
                              <div class="tab-pane active" id="public_images_list">
                                
                                <div class="row">
                  
                                  <div class="col-md-12" style="padding: 0;">
                                      
                                    @foreach($publicImagesList as $publicImageList)
                        
                                      <div class="col-md-12" style="margin-bottom: 0; margin-top: 10px;">
                        
                                        <div class="box box-primary" style="margin-bottom: 0;">
                          
                                          <div class="box-header with-border">
                            
                                            <div class="user-block">
                                              
                                              @if(isset($publicImageUsersList))
                                              
                                                @foreach($publicImageUsersList as $publicImageUserListArray)
                                                
                                                  @if(isset($publicImageUserListArray[0]))
                                                  
                                                    @if($publicImageList -> user_id == $publicImageUserListArray[0] -> id)
                                                    
                                                      <img class="img-circle" src="/images/users/image_{!! $publicImageList -> user_id !!}.{!! $publicImageUserListArray[0] -> image_type !!}" alt="User Image">
                                                  
                                                      <span class="username"><a href="{!! route('publicUser.show', [$publicImageList -> user_id]) !!}">{!! $publicImageUserListArray[0] -> name !!}</a></span>
                                                      
                                                      <?php break; ?>
                                                  
                                                    @endif
                                                    
                                                  @endif
                                                
                                                @endforeach
                                                
                                              @endif
                                              
                                              <span class="description">Shared publicly - {!! $publicImageList -> created_at !!} </span>
                            
                                            </div>
                            
                                            <div class="box-tools">
                              
                                              <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Mark as read"><a href="{!! route('publicImages.show', [$publicImageList -> id]) !!}"><i class="fa fa-eye"></i></a></button>
                              
                                              @if(isset($user_id))
                              
                                                {!! Form::open(['route' => 'publicImageLikes.store', 'id' => 'public_image_like_create', 'style' => 'display: inline-block']) !!}
                                              
                                                  {!! Form::hidden('status', 'Status:') !!}
                                                  {!! Form::hidden('status', 'on', ['class' => 'form-control']) !!}
                                                  
                                                  {!! Form::hidden('datetime', 'Datetime:') !!}
                                                  {!! Form::hidden('datetime', $now, ['class' => 'form-control']) !!}
                                                  
                                                  {!! Form::hidden('public_image_id', 'Public Image Id:') !!}
                                                  {!! Form::hidden('public_image_id', $publicImageList -> id, ['class' => 'form-control']) !!}
                                                  
                                                  {!! Form::hidden('user_id', 'User Id:') !!}
                                                  {!! Form::hidden('user_id', $user_id, ['class' => 'form-control']) !!}
                                                  
                                                  <button type="submit" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Mark as read"><i class="fa fa-thumbs-o-up"></i></button>
                                
                                                {!! Form::close() !!}
                                                
                                              @endif
                                              
                                              <button type="button" class="btn btn-box-tool" data-toggle="collapse" data-target="#image_list_{!! $publicImageList -> id  !!}"><i class="fa fa-minus"></i></button>
                            
                                            </div>
                          
                                          </div>
                          
                                          <div id="image_list_{!! $publicImageList -> id !!}" class="box-body">
                            
                                            <img src="/images/public_images/image_{!! $publicImageList -> id !!}.{!! $publicImageList -> file_type !!}" style="width: 100%; margin-bottom: 5px;">
                                            
                                            <p class="text-muted well well-sm no-shadow" style="margin-top: 10px; text-align: justify;"> {!! $publicImageList -> description  !!} </p>
                            
                                            <div class="box-footer">
                              
                                              @if(isset($user_id))
                              
                                                <form id='public_image_comment_r' action = "{!! URL::to('/store_public_image_comment') !!}" method = "post">
                            
                                                  {{ csrf_field() }}
                                  
                                                  <img class="img-responsive img-circle img-sm" src="/images/users/image_{!! $user_id !!}.{!! $user[0] -> image_type !!}" alt="Alt Text">
                                  
                                                  <div class="img-push">
                                  
                                                    <input id="public_image_id" name="public_image_id" type="hidden" value="{!! $publicImageList -> id !!}">
                                                    <input id="status" name="status" type="hidden" value="on">
                                                    <input id="datetime" name="datetime" type="hidden" value="{!! $now !!}">
                                                    <input id="user_id" name="user_id" type="hidden" value="{!! $user_id !!}">
                                                    
                                                    <input id="public_image_comment_r_content" name="content" type="text" class="form-control input-sm" placeholder="Press enter to post comment">
                                  
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
                              
                              <div class="tab-pane" id="upload_images">
                                
                                <div class="widget-container" style="margin-bottom: 0;">
        
                                  <div class="widget row image-tile" style="padding: 10px;">
                  
                                    @if(isset($images))
                  
                                      @foreach($images as $image)
                      
                                        <a href="{!! route('publicImages.show', [$image->id]) !!}">
                                              
                                          <div class="tile col-xs-4" style="background: url('/images/public_images/image_{!! $image -> id !!}.{!! $image -> file_type !!}') no-repeat center top; background-size: cover;">
                                            <p> </p>
                                          </div>
                                      
                                        </a>
                                      
                                      @endforeach
                                      
                                    @endif
                                    
                                  </div>
                      
                                </div>
                                
                              </div>
                              
                            </div>
                            
                          </div>
                          
                        </div>
                        
                      </div>
                      
                    </div>
                    
                  </div>
                  
                  @if(isset($user_id))
                  
                    <a href="{!! route('publicImages.create') !!}" class="btn btn-default">Add Image</a>
                    
                  @endif
                  
                </div>
                
                <div class = "tab-pane" id = "public_audios" style="margin: 10px;">
                  
                  <div class="box box-primary">
            
                    <div class="box-body" style="padding-bottom: 0;">
    
                      <div class="row">
     
                        <div class="col-md-12">
              
                          <div class="nav-tabs-custom" style="margin-bottom: 10px;">
                
                            <ul class="nav nav-tabs">
    
                              <li class="active"><a href="#public_audios_list" data-toggle="tab" aria-expanded="false"> Public Audios </a></li>
                              
                              @if(isset($user_id))
                              
                                <li><a href="#upload_audios" data-toggle="tab" aria-expanded="false"> Upload Audios </a></li>
                    
                              @endif
                    
                            </ul>
              
                            <div class="tab-content clearfix" style="padding: 10;">
              
                              <div class="tab-pane active" id="public_audios_list">
                                
                                <div class="row">
                  
                                  <div class="col-md-12" style="padding: 0;">
                                      
                                    @foreach($publicAudiosList as $publicAudioList)
                        
                                      <div class="col-md-12" style="margin-bottom: 0; margin-top: 10px;">
                        
                                        <div class="box box-primary" style="margin-bottom: 0;">
                          
                                          <div class="box-header with-border">
                            
                                            <div class="user-block">
                                              
                                              @if(isset($publicAudioUsersList))
                                              
                                                @foreach($publicAudioUsersList as $publicAudioUserListArray)
                                                
                                                  @if(isset($publicAudioUserListArray[0]))
                                                  
                                                    @if($publicAudioList -> user_id == $publicAudioUserListArray[0] -> id)
                                                  
                                                      <img class="img-circle" src="/images/users/image_{!! $publicAudioList -> user_id !!}.{!! $publicAudioUserListArray[0] -> image_type !!}" alt="User Image">
                                                  
                                                      <span class="username"><a href="{!! route('publicUser.show', [$publicAudioList -> user_id]) !!}">{!! $publicAudioUserListArray[0] -> name !!}</a></span>
                                                      
                                                      <?php break; ?>
                                                  
                                                    @endif
                                                    
                                                  @endif
                                                
                                                @endforeach
                                                
                                              @endif
                                              
                                              <span class="description">Shared publicly - {!! $publicAudioList -> created_at !!} </span>
                            
                                            </div>
                            
                                            <div class="box-tools">
                                
                                              <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Mark as read"><a href="{!! route('publicAudios.show', [$publicAudioList -> id]) !!}"><i class="fa fa-eye"></i></a></button>
                              
                                              @if(isset($user_id))
                              
                                                {!! Form::open(['route' => 'publicAudioLikes.store', 'id' => 'public_audio_like_create', 'style' => 'display: inline-block']) !!}
                                              
                                                  {!! Form::hidden('status', 'Status:') !!}
                                                  {!! Form::hidden('status', 'on', ['class' => 'form-control']) !!}
                                                  
                                                  {!! Form::hidden('datetime', 'Datetime:') !!}
                                                  {!! Form::hidden('datetime', $now, ['class' => 'form-control']) !!}
                                                  
                                                  {!! Form::hidden('public_audio_id', 'Public Audio Id:') !!}
                                                  {!! Form::hidden('public_audio_id', $publicAudioList -> id, ['class' => 'form-control']) !!}
                                                  
                                                  {!! Form::hidden('user_id', 'User Id:') !!}
                                                  {!! Form::hidden('user_id', $user_id, ['class' => 'form-control']) !!}
                                                  
                                                  <button type="submit" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Mark as read"><i class="fa fa-thumbs-o-up"></i></button>
                                
                                                {!! Form::close() !!}
                                                
                                              @endif
                                              
                                              <button type="button" class="btn btn-box-tool" data-toggle="collapse" data-target="#audio_list_{!! $publicAudioList -> id  !!}"><i class="fa fa-minus"></i></button>
                            
                                            </div>
                          
                                          </div>
                          
                                          <div id="audio_list_{!! $publicAudioList -> id !!}" class="box-body">
                            
                                            <audio style="width: 100%; padding: 5px;" controls>
                
                                              <source src="/audios/public_audios/audio_{!! $publicAudioList -> id !!}.{!! $publicAudio -> file_type !!}" type="audio/{!! $publicAudioList -> file_type !!}">
              
                                              Your browser does not support the audio element.
              
                                            </audio>
                                            
                                            <p class="text-muted well well-sm no-shadow" style="margin-top: 10px; text-align: justify;"> {!! $publicAudioList -> description  !!} </p>
                            
                                            <div class="box-footer">
                                              
                                              @if(isset($user_id))
                              
                                                <form id='public_audio_comment_r' action = "{!! URL::to('/store_public_audio_comment') !!}" method = "post">
                            
                                                  {{ csrf_field() }}
                                  
                                                  <img class="img-responsive img-circle img-sm" src="/images/users/image_{!! $user_id !!}.{!! $user[0] -> image_type !!}" alt="Alt Text">
                                  
                                                  <div class="img-push">
                                  
                                                    <input id="public_audio_id" name="public_audio_id" type="hidden" value="{!! $publicAudioList -> id !!}">
                                                    <input id="status" name="status" type="hidden" value="on">
                                                    <input id="datetime" name="datetime" type="hidden" value="{!! $now !!}">
                                                    <input id="user_id" name="user_id" type="hidden" value="{!! $user_id !!}">
                                                    
                                                    <input id="public_audio_comment_r_content" name="content" type="text" class="form-control input-sm" placeholder="Press enter to post comment">
                                  
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
                                                
                                          <td> <a href="{!! route('publicAudios.show', [$audio->id]) !!}"> {!! $audio -> name !!} </a> </td>
                                                
                                          <td>
                                                    
                                            {!! Form::open(['route' => ['publicAudios.destroy', $audio->id], 'method' => 'delete']) !!}
                                            
                                              <div class="btn-group">
                                                      
                                                <a href="{!! route('publicAudios.show', [$audio->id]) !!}" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-eye-open"></i></a>
                                                <a href="{!! route('publicAudios.edit', [$audio->id]) !!}" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
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
                            
                          </div>
                          
                        </div>
                        
                      </div>
                      
                    </div>
                    
                  </div>
                  
                  @if(isset($user_id))
                  
                    <a href="{!! route('publicAudios.create') !!}" class="btn btn-default">Add Audio</a>
                  
                  @endif
                  
                </div>
                
                <div class = "tab-pane" id = "public_videos" style="margin: 10px;">
                  
                  <div class="box box-primary">
            
                    <div class="box-body" style="padding-bottom: 0;">
    
                      <div class="row">
     
                        <div class="col-md-12">
              
                          <div class="nav-tabs-custom" style="margin-bottom: 10px;">
                
                            <ul class="nav nav-tabs">
    
                              <li class="active"><a href="#public_videos_list" data-toggle="tab" aria-expanded="false"> Public Videos </a></li>
                              
                              @if(isset($user_id))
                              
                                <li><a href="#upload_videos" data-toggle="tab" aria-expanded="false"> Upload Videos </a></li>
                    
                              @endif
                    
                            </ul>
              
                            <div class="tab-content clearfix" style="padding: 10;">
              
                              <div class="tab-pane active" id="public_videos_list">
                                
                                <div class="row">
                  
                                  <div class="col-md-12" style="padding: 0;">
                                      
                                    @foreach($publicVideosList as $publicVideoList)
                        
                                      <div class="col-md-12" style="margin-bottom: 0; margin-top: 10px;">
                        
                                        <div class="box box-primary" style="margin-bottom: 0;">
                          
                                          <div class="box-header with-border">
                            
                                            <div class="user-block">
                                              
                                              @if(isset($publicVideoUsersList))
                                            
                                                @foreach($publicVideoUsersList as $publicVideoUserListArray)
                                                
                                                  @if(isset($publicVideoUserListArray[0]))
                                                  
                                                    @if($publicVideoList -> user_id == $publicVideoUserListArray[0] -> id)
                                                    
                                                      <img class="img-circle" src="/images/users/image_{!! $publicVideoList -> user_id !!}.{!! $publicVideoUserListArray[0] -> image_type !!}" alt="User Image">
                                                  
                                                      <span class="username"><a href="{!! route('publicUser.show', [$publicVideoList -> user_id]) !!}">{!! $publicVideoUserListArray[0] -> name !!}</a></span>
                                                      
                                                      <?php break; ?>
                                                  
                                                    @endif
                                                    
                                                  @endif
                                                
                                                @endforeach
                                                
                                              @endif
                                              
                                              <span class="description">Shared publicly - {!! $publicVideoList -> created_at !!}</span>
                            
                                            </div>
                            
                                            <div class="box-tools">
                              
                                              <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Mark as read"><a href="{!! route('publicVideos.show', [$publicVideoList -> id]) !!}"><i class="fa fa-eye"></i></a></button>
                              
                                              @if(isset($user_id))
                              
                                                {!! Form::open(['route' => 'publicVideoLikes.store', 'id' => 'public_video_like_create', 'style' => 'display: inline-block']) !!}
                                              
                                                  {!! Form::hidden('status', 'Status:') !!}
                                                  {!! Form::hidden('status', 'on', ['class' => 'form-control']) !!}
                                                  
                                                  {!! Form::hidden('datetime', 'Datetime:') !!}
                                                  {!! Form::hidden('datetime', $now, ['class' => 'form-control']) !!}
                                                  
                                                  {!! Form::hidden('public_video_id', 'Public Video Id:') !!}
                                                  {!! Form::hidden('public_video_id', $publicVideoList -> id, ['class' => 'form-control']) !!}
                                                  
                                                  {!! Form::hidden('user_id', 'User Id:') !!}
                                                  {!! Form::hidden('user_id', $user_id, ['class' => 'form-control']) !!}
                                                  
                                                  <button type="submit" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Mark as read"><i class="fa fa-thumbs-o-up"></i></button>
                                
                                                {!! Form::close() !!}
                                                
                                              @endif
                                              
                                              <button type="button" class="btn btn-box-tool" data-toggle="collapse" data-target="#video_list_{!! $publicVideoList -> id  !!}"><i class="fa fa-minus"></i></button>
                            
                                            </div>
                          
                                          </div>
                          
                                          <div id="video_list_{!! $publicVideoList -> id  !!}" class="box-body">
                            
                                            <video width="100%" style="margin-bottom: 5px;" controls>
                                  
                                              <source src="/videos/public_videos/video_{!! $publicVideo -> id !!}.{!! $publicVideo -> file_type !!}" type="video/mp4">
                                
                                            </video>
                                            
                                            <p class="text-muted well well-sm no-shadow" style="margin-top: 10px; text-align: justify;"> {!! $publicVideoList -> description  !!} </p>
                            
                                            <div class="box-footer">
                              
                                              @if(isset($user_id))
                              
                                                <form id='public_video_comment_r' action = "{!! URL::to('/store_public_video_comment') !!}" method = "post">
                            
                                                  {{ csrf_field() }}
                                  
                                                  <img class="img-responsive img-circle img-sm" src="/images/users/image_{!! $user_id !!}.{!! $user[0] -> image_type !!}" alt="Alt Text">
                                  
                                                  <div class="img-push">
                                  
                                                    <input id="public_video_id" name="public_video_id" type="hidden" value="{!! $publicVideoList -> id !!}">
                                                    <input id="status" name="status" type="hidden" value="on">
                                                    <input id="datetime" name="datetime" type="hidden" value="{!! $now !!}">
                                                    <input id="user_id" name="user_id" type="hidden" value="{!! $user_id !!}">
                                                    
                                                    <input id="public_video_comment_r_content" name="content" type="text" class="form-control input-sm" placeholder="Press enter to post comment">
                                  
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
                                                
                                          <td> <a href="{!! route('publicVideos.show', [$video->id]) !!}"> {!! $video -> name !!} </a> </td>
                                                
                                          <td>
                                                    
                                            {!! Form::open(['route' => ['publicVideos.destroy', $video->id], 'method' => 'delete']) !!}
                                            
                                              <div class="btn-group">
                                                      
                                                <a href="{!! route('publicVideos.show', [$video->id]) !!}" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-eye-open"></i></a>
                                                <a href="{!! route('publicVideos.edit', [$video->id]) !!}" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
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
                            
                          </div>
                          
                        </div>
                        
                      </div>
                      
                    </div>
                    
                  </div>
                  
                  @if(isset($user_id))
                  
                    <a href="{!! route('publicVideos.create') !!}" class="btn btn-default">Add Video</a>
                    
                  @endif
                  
                </div>
                
                <div class = "tab-pane" id = "public_advertising" style="margin: 10px;">
                  
                  <div class="box box-primary">
            
                    <div class="box-body" style="padding-bottom: 0;">
    
                      <div class="row">
     
                        <div class="col-md-12">
              
                          <div class="nav-tabs-custom" style="margin-bottom: 10px;">
                
                            <ul class="nav nav-tabs">
    
                              <li class="active"><a href="#public_advertisements_list" data-toggle="tab" aria-expanded="false"> Public Advertisements </a></li>
                              
                              @if(isset($user_id))
                              
                                <li><a href="#upload_advertisements" data-toggle="tab" aria-expanded="false"> Upload Advertisements </a></li>
                    
                              @endif
                    
                            </ul>
              
                            <div class="tab-content clearfix" style="padding: 10px;">
              
                              <div class="tab-pane active" id="public_advertisements_list">
                                
                                <div class="row">
                  
                                  <div class="col-md-12" style="padding: 0;">
                                      
                                    @foreach($publicAdvertisementsList as $publicAdvertisementList)
                        
                                      <div class="col-md-12" style="margin-top: 10px;">
                        
                                        <div class="box box-primary" style="margin-bottom: 0;">
                                          
                                          <div class="box-header with-border" style = "padding-bottom: 25px;">
                            
                                            <div class="box-tools">
                              
                                              <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Mark as read"><a href="{!! route('publicAdvertisements.show', [$publicAdvertisementList -> id]) !!}"><i class="fa fa-eye"></i></a></button>
                              
                                              @if(isset($user_id))
                              
                                                {!! Form::open(['route' => 'publicAdvertisementLikes.store', 'id' => 'public_advertisement_like_create', 'style' => 'display: inline-block']) !!}
                                              
                                                  {!! Form::hidden('status', 'Status:') !!}
                                                  {!! Form::hidden('status', 'on', ['class' => 'form-control']) !!}
                                                  
                                                  {!! Form::hidden('datetime', 'Datetime:') !!}
                                                  {!! Form::hidden('datetime', $now, ['class' => 'form-control']) !!}
                                                  
                                                  {!! Form::hidden('public_advertisement_id', 'Public Advertisement Id:') !!}
                                                  {!! Form::hidden('public_advertisement_id', $publicAdvertisementList -> id, ['class' => 'form-control']) !!}
                                                  
                                                  {!! Form::hidden('user_id', 'User Id:') !!}
                                                  {!! Form::hidden('user_id', $user_id, ['class' => 'form-control']) !!}
                                                  
                                                  <button type="submit" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Mark as read"><i class="fa fa-thumbs-o-up"></i></button>
                                
                                                {!! Form::close() !!}
                                                
                                              @endif
                                              
                                              <button type="button" class="btn btn-box-tool" data-toggle="collapse" data-target="#advertisement_list_{!! $publicAdvertisementList -> id  !!}"><i class="fa fa-minus"></i></button>
                            
                                            </div>
                          
                                          </div>
                          
                                          <div class="box-body" style="padding-left: 0; padding-right: 0;">
                                            
                                            <div class="col-md-12" style="padding-left: 10px; padding-right: 10px;">
                        
                                              <div class="box box-widget widget-user">
                                                
                                                <div class="widget-user-header bg-aqua-active" style="background-image: url('http://www.desmus.com.mx/images/public_advertisement_images/image_{!! $publicAdvertisementList -> id !!}.{!! $publicAdvertisementList -> image_type !!}'); background-position: center; background-repeat: no-repeat; background-size: cover;">
                                                  
                                                  @if(isset($publicAdvertisementUsersList))
                                                  
                                                    @foreach($publicAdvertisementUsersList as $publicAdvertisementUserListArray)
                                                
                                                      @if(isset($publicAdvertisementUserListArray[0]))
                                                      
                                                        @if($publicAdvertisementList -> user_id == $publicAdvertisementUserListArray[0] -> id)
                                                      
                                                          <a href="{!! route('publicUser.show', [$publicAdvertisementList -> user_id]) !!}" style="color: #fff;"> <h3 class="widget-user-username">{!! $publicAdvertisementUserListArray[0] -> name !!}</h3> </a>
                                                          
                                                          <?php break; ?>
                                                      
                                                        @endif
                                                        
                                                      @endif
                                                    
                                                    @endforeach
                                                    
                                                  @endif
                                                  
                                                  <h5 class="widget-user-desc"> {!! $publicAdvertisementList -> created_at !!} </h5>
                                                
                                                </div>
                                                
                                                <div class="widget-user-image">
                                                  
                                                  @if(isset($publicAdvertisementUsersList))
                                                  
                                                    @foreach($publicAdvertisementUsersList as $publicAdvertisementUserListArray)
                                                
                                                      @if(isset($publicAdvertisementUserListArray[0]))
                                                      
                                                        @if($publicAdvertisementList -> user_id == $publicAdvertisementUserListArray[0] -> id)
                                                    
                                                          <img class="img-circle" src="/images/users/image_{!! $publicAdvertisementList -> user_id !!}.{!! $publicAdvertisementUserListArray[0] -> image_type !!}" alt="User Avatar">
                                                  
                                                          <?php break; ?>
                                                      
                                                        @endif
                                                        
                                                      @endif
                                                    
                                                    @endforeach
                                                    
                                                  @endif
                                                
                                                </div>
                                                
                                                <div class="box-footer">
                                                  
                                                  <div class="row">
                                                    
                                                    <div class="col-sm-4 border-right">
                                                    
                                                      <div class="description-block">
                                                    
                                                        <h5 class="description-header" style = "margin-bottom: 10px;">Web Site</h5>
                                                        <span class="description-text" style="font-size: 10px;"> <a href = ""> {!! $publicAdvertisementList -> link !!} </a> </span>
                                                      
                                                      </div>
                                                    
                                                    </div>
                                                    
                                                    <div class="col-sm-4 border-right">
                                                      
                                                      <div class="description-block">
                                                        
                                                        <h5 class="description-header" style = "margin-bottom: 10px;">Email</h5>
                                                        <span class="description-text" style="font-size: 10px;"> <a href = ""> {!! $publicAdvertisementList -> email !!} </a> </span>
                                                      
                                                      </div>
                                                      
                                                    </div>
                                                    
                                                    <div class="col-sm-4">
                                                      
                                                      <div class="description-block">
                                                        
                                                        <h5 class="description-header" style = "margin-bottom: 10px;">Telephone</h5>
                                                        <span class="description-text"> {!! $publicAdvertisementList -> telephone !!} </span>
                                                      
                                                      </div>
                                                      
                                                    </div>
                                                    
                                                  </div>
                                                  
                                                </div>
                                              
                                              </div>
                                              
                                              <div id="advertisement_list_{!! $publicAdvertisementList -> id  !!}" class = "col-md-12" style="padding-left: 0; padding-right: 0">
                                              
                                                <video width="100%" controls>
                                    
                                                  <source src="/videos/public_advertisement_videos/video_{!! $publicAdvertisementList -> id !!}.{!! $publicAdvertisementList -> video_type !!}" type="video/mp4">
                                  
                                                </video>
                                                
                                                <p class="text-muted well well-sm no-shadow" style="margin-top: 10px; text-align: justify;"> {!! $publicAdvertisementList -> description  !!} </p>
                                
                                                <div class="box-footer">
                                  
                                                  @if(isset($user_id))
                                  
                                                    <form id='public_advertisement_comment_r' action = "{!! URL::to('/store_public_advertisement_comment') !!}" method = "post">
                            
                                                      {{ csrf_field() }}
                                      
                                                      <img class="img-responsive img-circle img-sm" src="/images/users/image_{!! $user_id !!}.{!! $user[0] -> image_type !!}" alt="Alt Text">
                                      
                                                      <div class="img-push">
                                      
                                                        <input id="public_advertisement_id" name="public_advertisement_id" type="hidden" value="{!! $publicAdvertisementList -> id !!}">
                                                        <input id="status" name="status" type="hidden" value="on">
                                                        <input id="datetime" name="datetime" type="hidden" value="{!! $now !!}">
                                                        <input id="user_id" name="user_id" type="hidden" value="{!! $user_id !!}">
                                                        
                                                        <input id="public_advertisement_comment_r_content" name="content" type="text" class="form-control input-sm" placeholder="Press enter to post comment">
                                      
                                                      </div>
                                    
                                                    </form>
                                                    
                                                  @endif
                                
                                                </div>
                                                
                                              </div>
                                                
                                            </div>
                          
                                          </div>
                      
                                        </div>
                      
                                      </div>
                                      
                                    @endforeach
                                    
                                  </div>
                                  
                                </div>
                                
                              </div>
                              
                              <div class="tab-pane" id="upload_advertisements">
                                
                                <table class="table table-hover table-bordered table-striped dataTable" id="collegeTSGaleries-filtered_table" style="margin-bottom: 0;">
  
                                  <thead>
                                        
                                    <tr>
                                            
                                      <th>Name</th>
                                      <th colspan="3">Action</th>
                                        
                                    </tr>
                                    
                                  </thead>
                                    
                                  <tbody>
                                    
                                    @if(isset($advertisements))
                                    
                                      @foreach($advertisements as $advertisement)
                                      
                                        <tr>
                                                
                                          <td> <a href="{!! route('publicAdvertisements.show', [$advertisement->id]) !!}"> {!! $advertisement -> name !!} </a> </td>
                                                
                                          <td>
                                                    
                                            {!! Form::open(['route' => ['publicAdvertisements.destroy', $advertisement->id], 'method' => 'delete']) !!}
                                            
                                              <div class="btn-group">
                                                      
                                                <a href="{!! route('publicAdvertisements.show', [$advertisement->id]) !!}" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-eye-open"></i></a>
                                                <a href="{!! route('publicAdvertisements.edit', [$advertisement->id]) !!}" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
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
                            
                          </div>
                          
                        </div>
                        
                      </div>
                      
                    </div>
                    
                  </div>
                  
                  @if(isset($user_id))
                  
                    <a href="{!! route('publicAdvertisements.create') !!}" class="btn btn-default">Add Advertisement</a>
                    
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