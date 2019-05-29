<section class="content">

  <script src="//platform-api.sharethis.com/js/sharethis.js#property=5c4b656080b4ba001b1eeb04&product=inline-share-buttons"></script>
  
  <div class="sharethis-inline-share-buttons"></div>

  <div class="row">
 
    <div class="col-md-12">
          
      <div class="nav-tabs-custom" style="margin-bottom: 0;">
            
        <ul class="nav nav-tabs">

          <li><a href="#public_audio_info" data-toggle="tab"> Audio Information </a></li>
          <li class = "active"><a href="#public_audio_preview" data-toggle="tab"> Audio Preview </a></li>
          <li><a href="#public_audio_comments" data-toggle="tab"> Comments </a></li>
          <li><a href="#public_audio_likes" data-toggle="tab"> Likes </a></li>
          <li><a href="#public_audio_views_history" data-toggle="tab"> Views History </a></li>
          
          @if(isset($user_id))
          
            <li><a href ="{!! route('publicAudios.edit', [$publicAudio->id]) !!}"> Update Audio </a></li>
          
          @endif
          
          <li><a href="/audios/public_audios/audio_{!! $publicAudio -> id !!}.{!! $publicAudio -> file_type !!}" download> Download Audio </a></li>
          
        </ul>
        
        <div class="tab-content clearfix">
          
          <div class = "tab-pane active" id = "public_audio_preview">
            
            <div class = "col-md-12">
              
              <div id = "mp3_player">
                
                <div id = "audio_box"> </div>
                
                <canvas id = "analyser"> </canvas>
                
                <input type = "hidden" id = "audio_type" value = "public_audio">
                <input type = "hidden" id = "audio_name" value = "{!! $publicAudio -> id !!}">
                
              </div>
              
            </div>
            
          </div>
          
          <div class = "tab-pane" id = "public_audio_info">
            
            <div class="form-group">
                {!! Form::label('name', 'Name:') !!}
                <p>{!! $publicAudio->name !!}</p>
            </div>
            
            <div class="form-group">
                {!! Form::label('description', 'Description:') !!}
                <p>{!! $publicAudio->description !!}</p>
            </div>
            
            <div class="form-group">
                {!! Form::label('file_type', 'File Type:') !!}
                <p>{!! $publicAudio->file_type !!}</p>
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
                <p>{!! $publicAudio->created_at !!}</p>
            </div>
            
            <div class="form-group">
                {!! Form::label('updated_at', 'Updated At:') !!}
                <p>{!! $publicAudio->updated_at !!}</p>
            </div>

          </div>
          
          <div class = "tab-pane" id = "public_audio_comments">
            
            <span class="pull-right text-muted" style="background: rgba(0,0,0,0.2); color: #fff; margin: 10px; padding: 0 5px;">
                                
              {!! $publicAudioCommentCounts !!} comments
                                
            </span>

            <div class="box-footer box-comments" style="padding-top: 40px;">
              
              @foreach($publicAudioComments as $publicAudioComment)
              
                @if($publicAudio -> id == $publicAudioComment -> public_audio_id)
              
                    <div class="box-comment">
                        
                      @foreach($publicAudioCommentUsers as $publicAudioCommentUser)
                                  
                        @if($publicAudioComment -> user_id == $publicAudioCommentUser -> user_id && $publicAudioComment -> id == $publicAudioCommentUser -> id)

                          <img class="img-circle" src="/images/users/image_{!! $publicAudioComment -> user_id !!}.{!! $publicAudioCommentUser -> image_type !!}" alt="User Audio">
      
                        @endif

                      @endforeach
        
                      <div class="comment-text" style="text-align:justify; padding-right: 10px;">
                        
                        <a href="{!! route('publicUser.show', [$publicAudioComment -> user_id]) !!}">
                        
                          <span class="username">
                                              
                            @foreach($publicAudioCommentUsers as $publicAudioCommentUser)
                                    
                              @if($publicAudioComment -> user_id == $publicAudioCommentUser -> user_id && $publicAudioComment -> id == $publicAudioCommentUser -> id)
                                      
                                {!! $publicAudioCommentUser -> name !!}
                                          
                                <?php break; ?>
                                      
                              @endif
                                  
                            @endforeach
                                  
                            <span class="text-muted pull-right" style="background: rgba(0,0,0,0.1); color: #000; padding: 0 5px;">{!! $publicAudioComment -> datetime !!}</span>
                                
                          </span>
                          
                        </a>
                          
                        {!! $publicAudioComment -> content !!}
                                          
                      </div>
                                        
                      @foreach($publicAudioCommentResponses as $publicAudioCommentResponseArray)
              
                        @foreach($publicAudioCommentResponseArray as $publicAudioCommentResponse)
              
                          @if($publicAudioComment -> id == $publicAudioCommentResponse -> public_audio_comment_id)
                                        
                            <div style="margin-left: 30px;" class="box-comment">
                              
                              @foreach($publicAudioCommentResponseUsers as $publicAudioCommentResponseUserArray)
                                  
                                @foreach($publicAudioCommentResponseUserArray as $publicAudioCommentResponseUser)
                                          
                                  @if($publicAudioCommentResponse -> user_id == $publicAudioCommentResponseUser -> user_id && $publicAudioCommentResponse -> id == $publicAudioCommentResponseUser -> id)

                                    <img class="img-circle" src="/images/users/image_{!! $publicAudioCommentResponse -> user_id !!}.{!! $publicAudioCommentResponseUser -> image_type !!}" alt="User Audio">
      
                                  @endif
                                  
                                @endforeach
                                
                              @endforeach
                                                
                              <div class="comment-text" style="text-align:justify; padding-right: 10px;">
                                
                                <a href="{!! route('publicUser.show', [$publicAudioCommentResponse -> user_id]) !!}">
                                      
                                  <span class="username">
                                                      
                                    @foreach($publicAudioCommentResponseUsers as $publicAudioCommentResponseUserArray)
                                    
                                      @foreach($publicAudioCommentResponseUserArray as $publicAudioCommentResponseUser)
                                            
                                        @if($publicAudioCommentResponse -> user_id == $publicAudioCommentResponseUser -> user_id && $publicAudioCommentResponse -> id == $publicAudioCommentResponseUser -> id)
                                              
                                          {!! $publicAudioCommentResponseUser -> name !!}
                                                  
                                          <?php break; ?>
                                              
                                        @endif
                                                          
                                      @endforeach
                                          
                                    @endforeach
                                          
                                    <span class="text-muted pull-right" style="background: rgba(0,0,0,0.1); color: #000; padding: 0 5px;">{!! $publicAudioCommentResponse -> datetime !!}</span>
                                        
                                  </span>
                                  
                                </a>
                                  
                                {!! $publicAudioCommentResponse -> content !!}
                                                  
                              </div>
                              
                            </div>
                                        
                          @endif
                                    
                        @endforeach
                                
                      @endforeach
                      
                    </div>
                                      
                    <div class="box-footer">
                      
                      @if(isset($user_id))
                            
                        <form id = "public_audio_comment_response_{!! $publicAudioComment -> id!!}" action = "{!! URL::to('/store_public_audio_comment_response') !!}" method = "post">
                      
                          {{ csrf_field() }}
                            
                          <img class="img-responsive img-circle img-sm" src="/images/users/image_{!! $user_id !!}.{!! $actualUser[0] -> image_type !!}" alt="Alt Text">
                            
                          <div class="img-push">
                            
                            <input id="public_audio_comment_id" name="public_audio_comment_id" type="hidden" value="{!! $publicAudioComment -> id !!}">
                            <input id="status" name="status" type="hidden" value="on">
                            <input id="datetime" name="datetime" type="hidden" value="{!! $now !!}">
                            <input id="user_id" name="user_id" type="hidden" value="{!! $user_id !!}">
                                              
                            <input id="public_audio_comment_response_content_{!! $publicAudioComment -> id!!}" name="content" type="text" class="form-control input-sm" placeholder="Press enter to post comment">
                            
                          </div>
                          
                        </form>
                        
                      @endif
                      
                    </div>
                                    
                @endif
                                
              @endforeach
              
            </div>
            
            <div class="box-footer">
              
              @if(isset($user_id))
                 
                <form id = "public_audio_comment" action = "{!! URL::to('/store_public_audio_comment') !!}" method = "post">
              
                  {{ csrf_field() }}
                    
                  <img class="img-responsive img-circle img-sm" src="/images/users/image_{!! $user_id !!}.{!! $actualUser[0] -> image_type !!}" alt="Alt Text">
                    
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
          
          <div class = "tab-pane" id = "public_audio_likes">

            <div class="box box-primary" style="margin-bottom: 0;">

              <div class="box-body">
              
                <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">

                  <div class="row">

                    <div class="col-sm-12">
                      
                      <div class="small-box bg-green">
              
                        <div class="inner">
              
                          <h3><sup style="font-size: 20px">{!! $publicAudioLikeCounts !!}</sup></h3>

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
                    
                            @foreach($publicAudioLikes as $publicAudioLike)
  
                              <tr role="row" class="odd">
                              
                                <td class=""> {!! $publicAudioLike->name !!} </td>
                                
                                @if(isset($user_id))

                                  <td class=""> {!! $publicAudioLike->email !!} </td>
  
                                @endif
  
                                <td class=""> {!! $publicAudioLike->datetime !!} </td>
                  
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
          
          <div class = "tab-pane" id = "public_audio_views_history">

            <div class="box box-primary" style="margin-bottom: 0;">

              <div class="box-body">
              
                <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">

                  <div class="row">

                    <div class="col-sm-12">
          
                      <div class="small-box bg-green">
              
                        <div class="inner">
              
                          <h3><sup style="font-size: 20px">{!! $publicAudio -> views_quantity !!}</sup></h3>

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
                    
                            @foreach($publicAudioViews as $publicAudioView)
  
                              <tr role="row" class="odd">
                              
                                <td class=""> {!! $publicAudioView->name !!} </td>
                                
                                @if(isset($user_id))
                                
                                  <td class=""> {!! $publicAudioView->email !!} </td>
                                
                                @endif
                                
                                <td class=""> {!! $publicAudioView->datetime !!} </td>
                  
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