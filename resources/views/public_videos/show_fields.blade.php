<section class="content">

  <script src="//platform-api.sharethis.com/js/sharethis.js#property=5c4b656080b4ba001b1eeb04&product=inline-share-buttons"></script>
  
  <div class="sharethis-inline-share-buttons"></div>

  <div class="row">
 
    <div class="col-md-12">
          
      <div class="nav-tabs-custom" style="margin-bottom: 0;">
            
        <ul class="nav nav-tabs">

          <li><a href="#public_video_info" data-toggle="tab"> Video Information </a></li>
          <li class = "active"><a href="#public_video_preview" data-toggle="tab"> Video Preview </a></li>
          <li><a href="#public_video_comments" data-toggle="tab"> Comments </a></li>
          <li><a href="#public_video_likes" data-toggle="tab"> Likes </a></li>
          <li><a href="#public_video_views_history" data-toggle="tab"> Views History </a></li>
          
          @if(isset($user_id))
          
            <li><a href ="{!! route('publicVideos.edit', [$publicVideo->id]) !!}"> Update Video </a></li>
          
          @endif
          
          <li><a href="/videos/public_videos/video_{!! $publicVideo -> id !!}.{!! $publicVideo -> file_type !!}" download> Download Video </a></li>
          
        </ul>
        
        <div class="tab-content clearfix">
          
          <div class = "tab-pane active" id = "public_video_preview">
            
            <div class = "col-md-12">
              
              <div id = "mp3_player">
                
                <div id = "video_box"> </div>
                
                <video width="100%" controls>
                    
                  <source src="/videos/public_videos/video_{!! $publicVideo -> id !!}.{!! $publicVideo -> file_type !!}" type="video/mp4">
                  
                </video>
                
              </div>
              
            </div>
            
          </div>
          
          <div class = "tab-pane" id = "public_video_info">
            
            <div class="form-group">
                {!! Form::label('name', 'Name:') !!}
                <p>{!! $publicVideo->name !!}</p>
            </div>
            
            <div class="form-group">
                {!! Form::label('description', 'Description:') !!}
                <p>{!! $publicVideo->description !!}</p>
            </div>
            
            <div class="form-group">
                {!! Form::label('file_type', 'File Type:') !!}
                <p>{!! $publicVideo->file_type !!}</p>
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
                <p>{!! $publicVideo->created_at !!}</p>
            </div>
            
            <div class="form-group">
                {!! Form::label('updated_at', 'Updated At:') !!}
                <p>{!! $publicVideo->updated_at !!}</p>
            </div>

          </div>
          
          <div class = "tab-pane" id = "public_video_comments">
            
            <span class="pull-right text-muted" style="background: rgba(0,0,0,0.2); color: #fff; margin: 10px; padding: 0 5px;">
                                
              {!! $publicVideoCommentCounts !!} comments
                                
            </span>

            <div class="box-footer box-comments" style="padding-top: 40px;">
              
              @foreach($publicVideoComments as $publicVideoComment)
              
                @if($publicVideo -> id == $publicVideoComment -> public_video_id)
              
                    <div class="box-comment">
                        
                      @foreach($publicVideoCommentUsers as $publicVideoCommentUser)
                                  
                        @if($publicVideoComment -> user_id == $publicVideoCommentUser -> user_id && $publicVideoComment -> id == $publicVideoCommentUser -> id)

                          <img class="img-circle" src="/images/users/image_{!! $publicVideoComment -> user_id !!}.{!! $publicVideoCommentUser -> image_type !!}" alt="User Video">
        
                        @endif
                        
                      @endforeach
        
                      <div class="comment-text" style="text-align:justify; padding-right: 10px;">
                        
                        <a href="{!! route('publicUser.show', [$publicVideoComment -> user_id]) !!}">
                              
                          <span class="username">
                                              
                            @foreach($publicVideoCommentUsers as $publicVideoCommentUser)
                                    
                              @if($publicVideoComment -> user_id == $publicVideoCommentUser -> user_id && $publicVideoComment -> id == $publicVideoCommentUser -> id)
                                      
                                {!! $publicVideoCommentUser -> name !!}
                                          
                                <?php break; ?>
                                      
                              @endif
                                  
                            @endforeach
                                  
                            <span class="text-muted pull-right" style="background: rgba(0,0,0,0.1); color: #000; padding: 0 5px;">{!! $publicVideoComment -> datetime !!}</span>
                                
                          </span>
                          
                        </a>
                          
                        {!! $publicVideoComment -> content !!}
                                          
                      </div>
                                        
                      @foreach($publicVideoCommentResponses as $publicVideoCommentResponseArray)
              
                        @foreach($publicVideoCommentResponseArray as $publicVideoCommentResponse)
              
                          @if($publicVideoComment -> id == $publicVideoCommentResponse -> public_video_comment_id)
                                        
                            <div style="margin-left: 30px;" class="box-comment">
                              
                              @foreach($publicVideoCommentResponseUsers as $publicVideoCommentResponseUserArray)
                                  
                                @foreach($publicVideoCommentResponseUserArray as $publicVideoCommentResponseUser)
                                          
                                  @if($publicVideoCommentResponse -> user_id == $publicVideoCommentResponseUser -> user_id && $publicVideoCommentResponse -> id == $publicVideoCommentResponseUser -> id)

                                    <img class="img-circle" src="/images/users/image_{!! $publicVideoCommentResponse -> user_id !!}.{!! $publicVideoCommentResponseUser -> image_type !!}" alt="User Video">
      
                                  @endif
                                  
                                @endforeach
                                
                              @endforeach
                                                
                              <div class="comment-text" style="text-align:justify; padding-right: 10px;">
                                
                                <a href="{!! route('publicUser.show', [$publicVideoCommentResponse -> user_id]) !!}">
                                      
                                  <span class="username">
                                                      
                                    @foreach($publicVideoCommentResponseUsers as $publicVideoCommentResponseUserArray)
                                    
                                      @foreach($publicVideoCommentResponseUserArray as $publicVideoCommentResponseUser)
                                            
                                        @if($publicVideoCommentResponse -> user_id == $publicVideoCommentResponseUser -> user_id && $publicVideoCommentResponse -> id == $publicVideoCommentResponseUser -> id)
                                              
                                          {!! $publicVideoCommentResponseUser -> name !!}
                                                  
                                          <?php break; ?>
                                              
                                        @endif
                                                          
                                      @endforeach
                                          
                                    @endforeach
                                          
                                    <span class="text-muted pull-right" style="background: rgba(0,0,0,0.1); color: #000; padding: 0 5px;">{!! $publicVideoCommentResponse -> datetime !!}</span>
                                        
                                  </span>
                                  
                                </a>
                                  
                                {!! $publicVideoCommentResponse -> content !!}
                                                  
                              </div>
                              
                            </div>
                                        
                          @endif
                                    
                        @endforeach
                                
                      @endforeach
                      
                    </div>
                                      
                    <div class="box-footer">
                             
                      @if(isset($user_id))
                        
                        <form id = "public_video_comment_response_{!! $publicVideoComment -> id !!}" action = "{!! URL::to('/store_public_video_comment_response') !!}" method = "post">
                      
                          {{ csrf_field() }}
                            
                          <img class="img-responsive img-circle img-sm" src="/images/users/image_{!! $user_id !!}.{!! $actualUser[0] -> image_type !!}" alt="Alt Text">
                            
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
              
            </div>
            
            <div class="box-footer">
              
              @if(isset($user_id))
              
                <form id = "public_video_comment" action = "{!! URL::to('/store_public_video_comment') !!}" method = "post">
              
                  {{ csrf_field() }}
                    
                    <img class="img-responsive img-circle img-sm" src="/images/users/image_{!! $user_id !!}.{!! $actualUser[0] -> image_type !!}" alt="Alt Text">
                    
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
          
          <div class = "tab-pane" id = "public_video_likes">

            <div class="box box-primary" style="margin-bottom: 0;">

              <div class="box-body">
              
                <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">

                  <div class="row">

                    <div class="col-sm-12">
                      
                      <div class="small-box bg-green">
              
                        <div class="inner">
              
                          <h3><sup style="font-size: 20px">{!! $publicVideoLikeCounts !!}</sup></h3>

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
                    
                            @foreach($publicVideoLikes as $publicVideoLike)
  
                              <tr role="row" class="odd">
                              
                                <td class=""> {!! $publicVideoLike->name !!} </td>
                                
                                @if(isset($user_id))
                                
                                  <td class=""> {!! $publicVideoLike->email !!} </td>
                                
                                @endif
                                
                                <td class=""> {!! $publicVideoLike->datetime !!} </td>
                  
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
          
          <div class = "tab-pane" id = "public_video_views_history">

            <div class="box box-primary" style="margin-bottom: 0;">

              <div class="box-body">
              
                <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">

                  <div class="row">

                    <div class="col-sm-12">
          
                      <div class="small-box bg-green">
              
                        <div class="inner">
              
                          <h3><sup style="font-size: 20px">{!! $publicVideo -> views_quantity !!}</sup></h3>

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
                    
                            @foreach($publicVideoViews as $publicVideoView)
  
                              <tr role="row" class="odd">
                              
                                <td class=""> {!! $publicVideoView->name !!} </td>
                                
                                @if(isset($user_id))
                                
                                  <td class=""> {!! $publicVideoView->email !!} </td>
                                
                                @endif
                                
                                <td class=""> {!! $publicVideoView->datetime !!} </td>
                  
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