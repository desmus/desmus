<section class="content">

  <script src="//platform-api.sharethis.com/js/sharethis.js#property=5c4b656080b4ba001b1eeb04&product=inline-share-buttons"></script>
  
  <div class="sharethis-inline-share-buttons"></div>

  <div class="row">
 
    <div class="col-md-12">
          
      <div class="nav-tabs-custom" style="margin-bottom: 0;">
            
        <ul class="nav nav-tabs">

          <li><a href="#shared_profile_video_info" data-toggle="tab"> Video Information </a></li>
          <li class = "active"><a href="#shared_profile_video_preview" data-toggle="tab"> Video Preview </a></li>
          <li><a href="#shared_profile_video_comments" data-toggle="tab"> Comments </a></li>
          <li><a href="#shared_profile_video_likes" data-toggle="tab"> Likes </a></li>
          <li><a href="#shared_profile_video_views_history" data-toggle="tab"> Views History </a></li>
          
          @if(isset($user_id))
          
            <li><a href ="{!! route('sharedProfileVideos.edit', [$sharedProfileVideo->id]) !!}"> Update Video </a></li>
          
          @endif
          
          <li><a href="/videos/shared_profile_videos/video_{!! $sharedProfileVideo -> id !!}.{!! $sharedProfileVideo -> file_type !!}" download> Download Video </a></li>
          
        </ul>
        
        <div class="tab-content clearfix">
          
          <div class = "tab-pane active" id = "shared_profile_video_preview">
            
            <div class = "col-md-12">
              
              <div id = "mp3_player">
                
                <div id = "video_box"> </div>
                
                <video width="100%" controls>
                    
                  <source src="/videos/shared_profile_videos/video_{!! $sharedProfileVideo -> id !!}.{!! $sharedProfileVideo -> file_type !!}" type="video/mp4">
                  
                </video>
                
              </div>
              
            </div>
            
          </div>
          
          <div class = "tab-pane" id = "shared_profile_video_info">
            
            <div class="form-group">
                {!! Form::label('name', 'Name:') !!}
                <p>{!! $sharedProfileVideo->name !!}</p>
            </div>
            
            <div class="form-group">
                {!! Form::label('description', 'Description:') !!}
                <p>{!! $sharedProfileVideo->description !!}</p>
            </div>
            
            <div class="form-group">
                {!! Form::label('file_type', 'File Type:') !!}
                <p>{!! $sharedProfileVideo->file_type !!}</p>
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
                <p>{!! $sharedProfileVideo->created_at !!}</p>
            </div>
            
            <div class="form-group">
                {!! Form::label('updated_at', 'Updated At:') !!}
                <p>{!! $sharedProfileVideo->updated_at !!}</p>
            </div>

          </div>
          
          <div class = "tab-pane" id = "shared_profile_video_comments">
            
            <span class="pull-right text-muted" style="background: rgba(0,0,0,0.2); color: #fff; margin: 10px; padding: 0 5px;">
                                
              {!! $sharedProfileVideoCommentCounts !!} comments
                                
            </span>

            <div class="box-footer box-comments" style="padding-top: 40px;">
              
              @foreach($sharedProfileVideoComments as $sharedProfileVideoComment)
              
                @if($sharedProfileVideo -> id == $sharedProfileVideoComment -> s_p_v_id)
              
                    <div class="box-comment">
                        
                      @foreach($sharedProfileVideoCommentUsers as $sharedProfileVideoCommentUser)
                                  
                        @if($sharedProfileVideoComment -> user_id == $sharedProfileVideoCommentUser -> user_id && $sharedProfileVideoComment -> id == $sharedProfileVideoCommentUser -> id)

                          <img class="img-circle" src="/images/users/image_{!! $sharedProfileVideoComment -> user_id !!}.{!! $sharedProfileVideoCommentUser -> image_type !!}" alt="User Video">
        
                        @endif
                        
                      @endforeach
        
                      <div class="comment-text" style="text-align:justify; padding-right: 10px;">
                        
                        <a href="{!! route('sharedProfileUser.show', [$sharedProfileVideoComment -> user_id]) !!}">
                              
                          <span class="username">
                                              
                            @foreach($sharedProfileVideoCommentUsers as $sharedProfileVideoCommentUser)
                                    
                              @if($sharedProfileVideoComment -> user_id == $sharedProfileVideoCommentUser -> user_id && $sharedProfileVideoComment -> id == $sharedProfileVideoCommentUser -> id)
                                      
                                {!! $sharedProfileVideoCommentUser -> name !!}
                                          
                                <?php break; ?>
                                      
                              @endif
                                  
                            @endforeach
                                  
                            <span class="text-muted pull-right" style="background: rgba(0,0,0,0.1); color: #000; padding: 0 5px;">{!! $sharedProfileVideoComment -> datetime !!}</span>
                                
                          </span>
                          
                        </a>
                          
                        {!! $sharedProfileVideoComment -> content !!}
                                          
                      </div>
                                        
                      @foreach($sharedProfileVideoCommentResponses as $sharedProfileVideoCommentResponseArray)
              
                        @foreach($sharedProfileVideoCommentResponseArray as $sharedProfileVideoCommentResponse)
              
                          @if($sharedProfileVideoComment -> id == $sharedProfileVideoCommentResponse -> s_p_v_c_id)
                                        
                            <div style="margin-left: 30px;" class="box-comment">
                              
                              @foreach($sharedProfileVideoCommentResponseUsers as $sharedProfileVideoCommentResponseUserArray)
                                  
                                @foreach($sharedProfileVideoCommentResponseUserArray as $sharedProfileVideoCommentResponseUser)
                                          
                                  @if($sharedProfileVideoCommentResponse -> user_id == $sharedProfileVideoCommentResponseUser -> user_id && $sharedProfileVideoCommentResponse -> id == $sharedProfileVideoCommentResponseUser -> id)

                                    <img class="img-circle" src="/images/users/image_{!! $sharedProfileVideoCommentResponse -> user_id !!}.{!! $sharedProfileVideoCommentResponseUser -> image_type !!}" alt="User Video">
      
                                  @endif
                                  
                                @endforeach
                                
                              @endforeach
                                                
                              <div class="comment-text" style="text-align:justify; padding-right: 10px;">
                                
                                <a href="{!! route('sharedProfileUser.show', [$sharedProfileVideoCommentResponse -> user_id]) !!}">
                                      
                                  <span class="username">
                                                      
                                    @foreach($sharedProfileVideoCommentResponseUsers as $sharedProfileVideoCommentResponseUserArray)
                                    
                                      @foreach($sharedProfileVideoCommentResponseUserArray as $sharedProfileVideoCommentResponseUser)
                                            
                                        @if($sharedProfileVideoCommentResponse -> user_id == $sharedProfileVideoCommentResponseUser -> user_id && $sharedProfileVideoCommentResponse -> id == $sharedProfileVideoCommentResponseUser -> id)
                                              
                                          {!! $sharedProfileVideoCommentResponseUser -> name !!}
                                                  
                                          <?php break; ?>
                                              
                                        @endif
                                                          
                                      @endforeach
                                          
                                    @endforeach
                                          
                                    <span class="text-muted pull-right" style="background: rgba(0,0,0,0.1); color: #000; padding: 0 5px;">{!! $sharedProfileVideoCommentResponse -> datetime !!}</span>
                                        
                                  </span>
                                  
                                </a>
                                  
                                {!! $sharedProfileVideoCommentResponse -> content !!}
                                                  
                              </div>
                              
                            </div>
                                        
                          @endif
                                    
                        @endforeach
                                
                      @endforeach
                      
                    </div>
                                      
                    <div class="box-footer">
                             
                      @if(isset($user_id))
                        
                        <form id = "shared_profile_video_comment_response_{!! $sharedProfileVideoComment -> id !!}" action = "{!! URL::to('/store_shared_profile_video_comment_response') !!}" method = "post">
                      
                          {{ csrf_field() }}
                            
                          <img class="img-responsive img-circle img-sm" src="/images/users/image_{!! $user_id !!}.{!! $actualUser[0] -> image_type !!}" alt="Alt Text">
                            
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
              
            </div>
            
            <div class="box-footer">
              
              @if(isset($user_id))
              
                <form id = "shared_profile_video_comment" action = "{!! URL::to('/store_shared_profile_video_comment') !!}" method = "post">
              
                  {{ csrf_field() }}
                    
                    <img class="img-responsive img-circle img-sm" src="/images/users/image_{!! $user_id !!}.{!! $actualUser[0] -> image_type !!}" alt="Alt Text">
                    
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
          
          <div class = "tab-pane" id = "shared_profile_video_likes">

            <div class="box box-primary" style="margin-bottom: 0;">

              <div class="box-body">
              
                <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">

                  <div class="row">

                    <div class="col-sm-12">
                      
                      <div class="small-box bg-green">
              
                        <div class="inner">
              
                          <h3><sup style="font-size: 20px">{!! $sharedProfileVideoLikeCounts !!}</sup></h3>

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
                    
                            @foreach($sharedProfileVideoLikes as $sharedProfileVideoLike)
  
                              <tr role="row" class="odd">
                              
                                <td class=""> {!! $sharedProfileVideoLike->name !!} </td>
                                
                                @if(isset($user_id))
                                
                                  <td class=""> {!! $sharedProfileVideoLike->email !!} </td>
                                
                                @endif
                                
                                <td class=""> {!! $sharedProfileVideoLike->datetime !!} </td>
                  
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
          
          <div class = "tab-pane" id = "shared_profile_video_views_history">

            <div class="box box-primary" style="margin-bottom: 0;">

              <div class="box-body">
              
                <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">

                  <div class="row">

                    <div class="col-sm-12">
          
                      <div class="small-box bg-green">
              
                        <div class="inner">
              
                          <h3><sup style="font-size: 20px">{!! $sharedProfileVideo -> views_quantity !!}</sup></h3>

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
                    
                            @foreach($sharedProfileVideoViews as $sharedProfileVideoView)
  
                              <tr role="row" class="odd">
                              
                                <td class=""> {!! $sharedProfileVideoView->name !!} </td>
                                
                                @if(isset($user_id))
                                
                                  <td class=""> {!! $sharedProfileVideoView->email !!} </td>
                                
                                @endif
                                
                                <td class=""> {!! $sharedProfileVideoView->datetime !!} </td>
                  
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