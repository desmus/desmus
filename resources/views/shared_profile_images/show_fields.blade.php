<section class="content">

  <script src="//platform-api.sharethis.com/js/sharethis.js#property=5c4b656080b4ba001b1eeb04&product=inline-share-buttons"></script>
  
  <div class="sharethis-inline-share-buttons"></div>

  <div class="row">
 
    <div class="col-md-12">
          
      <div class="nav-tabs-custom" style="margin-bottom: 0;">
            
        <ul class="nav nav-tabs">

          <li><a href="#shared_profile_image_info" data-toggle="tab"> Image Information </a></li>
          <li class = "active"><a href="#shared_profile_image_preview" data-toggle="tab"> Image Preview </a></li>
          <li><a href="#shared_profile_image_comments" data-toggle="tab"> Comments </a></li>
          <li><a href="#shared_profile_image_likes" data-toggle="tab"> Likes </a></li>
          <li><a href="#shared_profile_image_views_history" data-toggle="tab"> Views History </a></li>
          
          @if(isset($user_id))
          
            <li><a href ="{!! route('sharedProfileImages.edit', [$sharedProfileImage->id]) !!}"> Update Image </a></li>
            <li><a href ="{!! route('sharedProfileImages.destroy', [$sharedProfileImage->id]) !!}" onclick = "return confirm('Are you sure?')"> Delete Image </a></li>
          
          @endif
          
          <li><a href="/images/shared_profile_images/image_{!! $sharedProfileImage -> id !!}.{!! $sharedProfileImage -> file_type !!}" download> Download Image </a></li>

        </ul>

        <div class="tab-content clearfix">

          <div class = "tab-pane active" id = "shared_profile_image_preview">

            <div class="col-md-12" style="padding: 0;">
    
              <div class="widget-container" style="margin-bottom: 0;">
        
                <div class="widget row image-tile">
          
                  <img src = "/images/shared_profile_images/image_{!! $sharedProfileImage -> id !!}.{!! $sharedProfileImage -> file_type !!}" width = "100%">
          
                </div>
    
              </div>

            </div>

          </div>

          <div class = "tab-pane" id = "shared_profile_image_info">

            <div class="form-group">
                {!! Form::label('name', 'Name:') !!}
                <p>{!! $sharedProfileImage->name !!}</p>
            </div>
            
            <div class="form-group">
                {!! Form::label('description', 'Description:') !!}
                <p>{!! $sharedProfileImage->description !!}</p>
            </div>
            
            <div class="form-group">
                {!! Form::label('file_type', 'File Type:') !!}
                <p>{!! $sharedProfileImage->file_type !!}</p>
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
                <p>{!! $sharedProfileImage->created_at !!}</p>
            </div>
            
            <div class="form-group">
                {!! Form::label('updated_at', 'Updated At:') !!}
                <p>{!! $sharedProfileImage->updated_at !!}</p>
            </div>

          </div>
          
          <div class = "tab-pane" id = "shared_profile_image_comments">
            
            <span class="pull-right text-muted" style="background: rgba(0,0,0,0.2); color: #fff; margin: 10px; padding: 0 5px;">
                                
              {!! $sharedProfileImageCommentCounts !!} comments
                                
            </span>

            <div class="box-footer box-comments" style="padding-top: 40px;">
              
              @foreach($sharedProfileImageComments as $sharedProfileImageComment)
              
                @if($sharedProfileImage -> id == $sharedProfileImageComment -> s_p_i_id)
              
                    <div class="box-comment">
                        
                      @foreach($sharedProfileImageCommentUsers as $sharedProfileImageCommentUser)
                                  
                        @if($sharedProfileImageComment -> user_id == $sharedProfileImageCommentUser -> user_id && $sharedProfileImageComment -> id == $sharedProfileImageCommentUser -> id)

                          <img class="img-circle" src="/images/users/image_{!! $sharedProfileImageComment -> user_id !!}.{!! $sharedProfileImageCommentUser -> image_type !!}" alt="User Image">
        
                        @endif
                        
                      @endforeach
        
                      <div class="comment-text" style="text-align:justify; padding-right: 10px;">
                        
                        <a href="{!! route('sharedProfileUser.show', [$sharedProfileImageComment -> user_id]) !!}">
                              
                          <span class="username">
                                              
                            @foreach($sharedProfileImageCommentUsers as $sharedProfileImageCommentUser)
                                    
                              @if($sharedProfileImageComment -> user_id == $sharedProfileImageCommentUser -> user_id && $sharedProfileImageComment -> id == $sharedProfileImageCommentUser -> id)
                                      
                                {!! $sharedProfileImageCommentUser -> name !!}
                                          
                                <?php break; ?>
                                      
                              @endif
                                  
                            @endforeach
                                  
                            <span class="text-muted pull-right" style="background: rgba(0,0,0,0.1); color: #000; padding: 0 5px;">{!! $sharedProfileImageComment -> datetime !!}</span>
                                
                          </span>
                          
                        </a>
                          
                        {!! $sharedProfileImageComment -> content !!}
                                          
                      </div>
                                        
                      @foreach($sharedProfileImageCommentResponses as $sharedProfileImageCommentResponseArray)
              
                        @foreach($sharedProfileImageCommentResponseArray as $sharedProfileImageCommentResponse)
              
                          @if($sharedProfileImageComment -> id == $sharedProfileImageCommentResponse -> s_p_i_c_id)
                                        
                            <div style="margin-left: 30px;" class="box-comment">
                              
                              @foreach($sharedProfileImageCommentResponseUsers as $sharedProfileImageCommentResponseUserArray)
                                  
                                @foreach($sharedProfileImageCommentResponseUserArray as $sharedProfileImageCommentResponseUser)
                                          
                                  @if($sharedProfileImageCommentResponse -> user_id == $sharedProfileImageCommentResponseUser -> user_id && $sharedProfileImageCommentResponse -> id == $sharedProfileImageCommentResponseUser -> id)
                              
                                    <img class="img-circle" src="/images/users/image_{!! $sharedProfileImageCommentResponse -> user_id !!}.{!! $sharedProfileImageCommentResponseUser -> image_type !!}" alt="User Image">
                                
                                  @endif
                                  
                                @endforeach
                                
                              @endforeach
                                                
                              <div class="comment-text" style="text-align:justify; padding-right: 10px;">
                                
                                <a href="{!! route('sharedProfileUser.show', [$sharedProfileImageCommentResponse -> user_id]) !!}">
                                      
                                  <span class="username">
                                                      
                                    @foreach($sharedProfileImageCommentResponseUsers as $sharedProfileImageCommentResponseUserArray)
                                    
                                      @foreach($sharedProfileImageCommentResponseUserArray as $sharedProfileImageCommentResponseUser)
                                            
                                        @if($sharedProfileImageCommentResponse -> user_id == $sharedProfileImageCommentResponseUser -> user_id && $sharedProfileImageCommentResponse -> id == $sharedProfileImageCommentResponseUser -> id)
                                              
                                          {!! $sharedProfileImageCommentResponseUser -> name !!}
                                                  
                                          <?php break; ?>
                                              
                                        @endif
                                                          
                                      @endforeach
                                          
                                    @endforeach
                                          
                                    <span class="text-muted pull-right" style="background: rgba(0,0,0,0.1); color: #000; padding: 0 5px;">{!! $sharedProfileImageCommentResponse -> datetime !!}</span>
                                        
                                  </span>
                                  
                                </a>
                                  
                                {!! $sharedProfileImageCommentResponse -> content !!}
                                                  
                              </div>
                              
                            </div>
                                        
                          @endif
                                    
                        @endforeach
                                
                      @endforeach
                      
                    </div>
                                      
                    <div class="box-footer">
                             
                      @if(isset($user_id))
                                
                        <form id = "shared_profile_image_comment_response_{!! $sharedProfileImageComment -> id !!}" action = "{!! URL::to('/store_shared_profile_image_comment_response') !!}" method = "post">
                      
                          {{ csrf_field() }}
                            
                          <img class="img-responsive img-circle img-sm" src="/images/users/image_{!! $user_id !!}.{!! $actualUser[0] -> image_type !!}" alt="Alt Text">
                            
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
              
            </div>
            
            <div class="box-footer">
              
              @if(isset($user_id))
                              
                <form id = "shared_profile_image_comment" action = "{!! URL::to('/store_shared_profile_image_comment') !!}" method = "post">
              
                  {{ csrf_field() }}
                    
                  <img class="img-responsive img-circle img-sm" src="/images/users/image_{!! $user_id !!}.{!! $actualUser[0] -> image_type !!}" alt="Alt Text">
                    
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
          
          <div class = "tab-pane" id = "shared_profile_image_likes">

            <div class="box box-primary" style="margin-bottom: 0;">

              <div class="box-body">
              
                <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">

                  <div class="row">

                    <div class="col-sm-12">
                      
                      <div class="small-box bg-green">
              
                        <div class="inner">
              
                          <h3><sup style="font-size: 20px">{!! $sharedProfileImageLikeCounts !!}</sup></h3>

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
                    
                            @foreach($sharedProfileImageLikes as $sharedProfileImageLike)
  
                              <tr role="row" class="odd">
                              
                                <td class=""> {!! $sharedProfileImageLike->name !!} </td>
                                
                                @if(isset($user_id))
                                
                                  <td class=""> {!! $sharedProfileImageLike->email !!} </td>
                                
                                @endif
                                
                                <td class=""> {!! $sharedProfileImageLike->datetime !!} </td>
                  
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
          
          <div class = "tab-pane" id = "shared_profile_image_views_history">

            <div class="box box-primary" style="margin-bottom: 0;">

              <div class="box-body">
              
                <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">

                  <div class="row">

                    <div class="col-sm-12">
          
                      <div class="small-box bg-green">
              
                        <div class="inner">
              
                          <h3><sup style="font-size: 20px">{!! $sharedProfileImage -> views_quantity !!}</sup></h3>

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
                    
                            @foreach($sharedProfileImageViews as $sharedProfileImageView)
  
                              <tr role="row" class="odd">
                              
                                <td class=""> {!! $sharedProfileImageView->name !!} </td>
                                
                                @if(isset($user_id))
                                
                                  <td class=""> {!! $sharedProfileImageView->email !!} </td>
                                
                                @endif
                                
                                <td class=""> {!! $sharedProfileImageView->datetime !!} </td>
                  
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