<section class="content">

  <script src="//platform-api.sharethis.com/js/sharethis.js#property=5c4b656080b4ba001b1eeb04&product=inline-share-buttons"></script>
  
  <div class="sharethis-inline-share-buttons"></div>

  <div class="row">
 
    <div class="col-md-12">
          
      <div class="nav-tabs-custom" style="margin-bottom: 0;">
            
        <ul class="nav nav-tabs">

          <li><a href="#shared_profile_audio_info" data-toggle="tab"> Audio Information </a></li>
          <li class = "active"><a href="#shared_profile_audio_preview" data-toggle="tab"> Audio Preview </a></li>
          <li><a href="#shared_profile_audio_comments" data-toggle="tab"> Comments </a></li>
          <li><a href="#shared_profile_audio_likes" data-toggle="tab"> Likes </a></li>
          <li><a href="#shared_profile_audio_views_history" data-toggle="tab"> Views History </a></li>
          
          @if(isset($user_id))
          
            <li><a href ="{!! route('sharedProfileAudios.edit', [$sharedProfileAudio->id]) !!}"> Update Audio </a></li>
          
          @endif
          
          <li><a href="/audios/shared_profile_audios/audio_{!! $sharedProfileAudio -> id !!}.{!! $sharedProfileAudio -> file_type !!}" download> Download Audio </a></li>
          
        </ul>
        
        <div class="tab-content clearfix">
          
          <div class = "tab-pane active" id = "shared_profile_audio_preview">
            
            <div class = "col-md-12">
              
              <div id = "mp3_player">
                
                <div id = "audio_box"> </div>
                
                <canvas id = "analyser"> </canvas>
                
                <input type = "hidden" id = "audio_type" value = "shared_profile_audio">
                <input type = "hidden" id = "audio_name" value = "{!! $sharedProfileAudio -> id !!}">
                
              </div>
              
            </div>
            
          </div>
          
          <div class = "tab-pane" id = "shared_profile_audio_info">
            
            <div class="form-group">
                {!! Form::label('name', 'Name:') !!}
                <p>{!! $sharedProfileAudio->name !!}</p>
            </div>
            
            <div class="form-group">
                {!! Form::label('description', 'Description:') !!}
                <p>{!! $sharedProfileAudio->description !!}</p>
            </div>
            
            <div class="form-group">
                {!! Form::label('file_type', 'File Type:') !!}
                <p>{!! $sharedProfileAudio->file_type !!}</p>
            </div>
            
            <div class="form-group">
              {!! Form::label('user_name', 'User Name:') !!}
              <p>{!! $user[0]->name !!}</p>
            </div>
            
            <div class="form-group">
              {!! Form::label('user_name', 'User Email:') !!}
              <p>{!! $user[0]->email !!}</p>
            </div>
            
            <div class="form-group">
                {!! Form::label('created_at', 'Created At:') !!}
                <p>{!! $sharedProfileAudio->created_at !!}</p>
            </div>
            
            <div class="form-group">
                {!! Form::label('updated_at', 'Updated At:') !!}
                <p>{!! $sharedProfileAudio->updated_at !!}</p>
            </div>

          </div>
          
          <div class = "tab-pane" id = "shared_profile_audio_comments">
            
            <span class="pull-right text-muted" style="background: rgba(0,0,0,0.2); color: #fff; margin: 10px; padding: 0 5px;">
                                
              {!! $sharedProfileAudioCommentCounts !!} comments
                                
            </span>

            <div class="box-footer box-comments" style="padding-top: 40px;">
              
              @foreach($sharedProfileAudioComments as $sharedProfileAudioComment)
              
                @if($sharedProfileAudio -> id == $sharedProfileAudioComment -> s_p_a_id)
              
                    <div class="box-comment">
                        
                      @foreach($sharedProfileAudioCommentUsers as $sharedProfileAudioCommentUser)
                                  
                        @if($sharedProfileAudioComment -> user_id == $sharedProfileAudioCommentUser -> user_id && $sharedProfileAudioComment -> id == $sharedProfileAudioCommentUser -> id)

                          <img class="img-circle" src="/images/users/image_{!! $sharedProfileAudioComment -> user_id !!}.{!! $sharedProfileAudioCommentUser -> image_type !!}" alt="User Audio">
      
                        @endif

                      @endforeach
        
                      <div class="comment-text" style="text-align:justify; padding-right: 10px;">
                        
                        <a href="{!! route('sharedProfileUser.show', [$sharedProfileAudioComment -> user_id]) !!}">
                        
                          <span class="username">
                                              
                            @foreach($sharedProfileAudioCommentUsers as $sharedProfileAudioCommentUser)
                                    
                              @if($sharedProfileAudioComment -> user_id == $sharedProfileAudioCommentUser -> user_id && $sharedProfileAudioComment -> id == $sharedProfileAudioCommentUser -> id)
                                      
                                {!! $sharedProfileAudioCommentUser -> name !!}
                                          
                                <?php break; ?>
                                      
                              @endif
                                  
                            @endforeach
                                  
                            <span class="text-muted pull-right" style="background: rgba(0,0,0,0.1); color: #000; padding: 0 5px;">{!! $sharedProfileAudioComment -> datetime !!}</span>
                                
                          </span>
                          
                        </a>
                          
                        {!! $sharedProfileAudioComment -> content !!}
                                          
                      </div>
                                        
                      @foreach($sharedProfileAudioCommentResponses as $sharedProfileAudioCommentResponseArray)
              
                        @foreach($sharedProfileAudioCommentResponseArray as $sharedProfileAudioCommentResponse)
              
                          @if($sharedProfileAudioComment -> id == $sharedProfileAudioCommentResponse -> s_p_a_c_id)
                                        
                            <div style="margin-left: 30px;" class="box-comment">
                              
                              @foreach($sharedProfileAudioCommentResponseUsers as $sharedProfileAudioCommentResponseUserArray)
                                  
                                @foreach($sharedProfileAudioCommentResponseUserArray as $sharedProfileAudioCommentResponseUser)
                                          
                                  @if($sharedProfileAudioCommentResponse -> user_id == $sharedProfileAudioCommentResponseUser -> user_id && $sharedProfileAudioCommentResponse -> id == $sharedProfileAudioCommentResponseUser -> id)

                                    <img class="img-circle" src="/images/users/image_{!! $sharedProfileAudioCommentResponse -> user_id !!}.{!! $sharedProfileAudioCommentResponseUser -> image_type !!}" alt="User Audio">
      
                                  @endif
                                  
                                @endforeach
                                
                              @endforeach
                                                
                              <div class="comment-text" style="text-align:justify; padding-right: 10px;">
                                
                                <a href="{!! route('sharedProfileUser.show', [$sharedProfileAudioCommentResponse -> user_id]) !!}">
                                      
                                  <span class="username">
                                                      
                                    @foreach($sharedProfileAudioCommentResponseUsers as $sharedProfileAudioCommentResponseUserArray)
                                    
                                      @foreach($sharedProfileAudioCommentResponseUserArray as $sharedProfileAudioCommentResponseUser)
                                            
                                        @if($sharedProfileAudioCommentResponse -> user_id == $sharedProfileAudioCommentResponseUser -> user_id && $sharedProfileAudioCommentResponse -> id == $sharedProfileAudioCommentResponseUser -> id)
                                              
                                          {!! $sharedProfileAudioCommentResponseUser -> name !!}
                                                  
                                          <?php break; ?>
                                              
                                        @endif
                                                          
                                      @endforeach
                                          
                                    @endforeach
                                          
                                    <span class="text-muted pull-right" style="background: rgba(0,0,0,0.1); color: #000; padding: 0 5px;">{!! $sharedProfileAudioCommentResponse -> datetime !!}</span>
                                        
                                  </span>
                                  
                                </a>
                                  
                                {!! $sharedProfileAudioCommentResponse -> content !!}
                                                  
                              </div>
                              
                            </div>
                                        
                          @endif
                                    
                        @endforeach
                                
                      @endforeach
                      
                    </div>
                                      
                    <div class="box-footer">
                      
                      @if(isset($user_id))
                            
                        <form id = "shared_profile_audio_comment_response_{!! $sharedProfileAudioComment -> id!!}" action = "{!! URL::to('/store_shared_profile_audio_comment_response') !!}" method = "post">
                      
                          {{ csrf_field() }}
                            
                          <img class="img-responsive img-circle img-sm" src="/images/users/image_{!! $user_id !!}.{!! $actualUser[0] -> image_type !!}" alt="Alt Text">
                            
                          <div class="img-push">
                            
                            <input id="s_p_a_c_id" name="s_p_a_c_id" type="hidden" value="{!! $sharedProfileAudioComment -> id !!}">
                            <input id="status" name="status" type="hidden" value="on">
                            <input id="datetime" name="datetime" type="hidden" value="{!! $now !!}">
                            <input id="user_id" name="user_id" type="hidden" value="{!! $user_id !!}">
                                              
                            <input id="shared_profile_audio_comment_response_content_{!! $sharedProfileAudioComment -> id!!}" name="content" type="text" class="form-control input-sm" placeholder="Press enter to post comment">
                            
                          </div>
                          
                        </form>
                        
                      @endif
                      
                    </div>
                                    
                @endif
                                
              @endforeach
              
            </div>
            
            <div class="box-footer">
              
              @if(isset($user_id))
                 
                <form id = "shared_profile_audio_comment" action = "{!! URL::to('/store_shared_profile_audio_comment') !!}" method = "post">
              
                  {{ csrf_field() }}
                    
                  <img class="img-responsive img-circle img-sm" src="/images/users/image_{!! $user_id !!}.{!! $actualUser[0] -> image_type !!}" alt="Alt Text">
                    
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
          
          <div class = "tab-pane" id = "shared_profile_audio_likes">

            <div class="box box-primary" style="margin-bottom: 0;">

              <div class="box-body">
              
                <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">

                  <div class="row">

                    <div class="col-sm-12">
                      
                      <div class="small-box bg-green">
              
                        <div class="inner">
              
                          <h3><sup style="font-size: 20px">{!! $sharedProfileAudioLikeCounts !!}</sup></h3>

                          <p>Likes Quantity</p>
            
                        </div>
            
                        <div class="icon">
              
                          <i class="ion ion-stats-bars"></i>
            
                        </div>
              
                      </div>

                      <div class="table-responsive" style="margin-bottom: 0;">

                        <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info" style="margin-bottom: 0;">
                  
                          <thead>
                  
                            <tr role="row">
  
                              <th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 224px;" aria-sort="descending"> Username </th>
                              
                              @if(isset($user_id))
                              
                                <th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 224px;" aria-sort="descending"> Email </th>
                              
                              @endif
                              
                              <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending" style="width: 182px;"> Datetime </th>
                              
                            </tr>
                  
                          </thead>
                  
                          <tbody>
                    
                            @foreach($sharedProfileAudioLikes as $sharedProfileAudioLike)
  
                              <tr role="row" class="odd">
                              
                                <td class=""> {!! $sharedProfileAudioLike->name !!} </td>
                                
                                @if(isset($user_id))

                                  <td class=""> {!! $sharedProfileAudioLike->email !!} </td>
  
                                @endif
  
                                <td class=""> {!! $sharedProfileAudioLike->datetime !!} </td>
                  
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
          
          <div class = "tab-pane" id = "shared_profile_audio_views_history">

            <div class="box box-primary" style="margin-bottom: 0;">

              <div class="box-body">
              
                <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">

                  <div class="row">

                    <div class="col-sm-12">
          
                      <div class="small-box bg-green">
              
                        <div class="inner">
              
                          <h3><sup style="font-size: 20px">{!! $sharedProfileAudio -> views_quantity !!}</sup></h3>

                          <p>Views Quantity</p>
            
                        </div>
            
                        <div class="icon">
              
                          <i class="ion ion-stats-bars"></i>
            
                        </div>
        
                      </div>

                      <div class="table-responsive" style="margin-bottom: 0;">

                        <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info" style="margin-bottom: 0;">
                  
                          <thead>
                  
                            <tr role="row">
  
                              <th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 224px;" aria-sort="descending"> Username </th>
                              
                              @if(isset($user_id))
                              
                                <th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 224px;" aria-sort="descending"> Email </th>
                              
                              @endif
                              
                              <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending" style="width: 182px;"> Datetime </th>
                              
                            </tr>
                  
                          </thead>
                  
                          <tbody>
                    
                            @foreach($sharedProfileAudioViews as $sharedProfileAudioView)
  
                              <tr role="row" class="odd">
                              
                                <td class=""> {!! $sharedProfileAudioView->name !!} </td>
                                
                                @if(isset($user_id))
                                
                                  <td class=""> {!! $sharedProfileAudioView->email !!} </td>
                                
                                @endif
                                
                                <td class=""> {!! $sharedProfileAudioView->datetime !!} </td>
                  
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

        </div>

      </div>
              
    </div>

  </div>

</section>