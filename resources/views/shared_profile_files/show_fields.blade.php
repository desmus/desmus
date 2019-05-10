<section class="content">
  
  <script src="//platform-api.sharethis.com/js/sharethis.js#property=5c4b656080b4ba001b1eeb04&product=inline-share-buttons"></script>
  
  <div class="sharethis-inline-share-buttons"></div>

  <div class="row">
 
    <div class="col-md-12">
          
      <div class="nav-tabs-custom" style="margin-bottom: 0;">
            
        <ul class="nav nav-tabs">

          <li class = "active"><a href="#shared_profile_file_info" data-toggle="tab"> File Information </a></li>
          <li><a href="#shared_profile_file_comments" data-toggle="tab"> Comments </a></li>
          <li><a href="#shared_profile_file_likes" data-toggle="tab"> Likes </a></li>
          <li><a href="#shared_profile_file_views_history" data-toggle="tab"> Views History </a></li>
          <li><a href="/files/shared_profile_files/file_{!! $sharedProfileFile -> id !!}.{!! $sharedProfileFile -> file_type !!}" download> Download </a></li>

        </ul>

        <div class="tab-content clearfix">
          
          <div class = "tab-pane active" id = "shared_profile_file_info">

            <div class="form-group">
              {!! Form::label('name', 'Name:') !!}
              <p>{!! $sharedProfileFile->name !!}</p>
            </div>
            
            <div class="form-group">
              {!! Form::label('description', 'Description:') !!}
              <p>{!! $sharedProfileFile->description !!}</p>
            </div>
            
            <div class="form-group">
              {!! Form::label('file_type', 'File Type:') !!}
              <p>{!! $sharedProfileFile->file_type !!}</p>
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
              <p>{!! $sharedProfileFile->created_at !!}</p>
            </div>
            
            <div class="form-group">
              {!! Form::label('updated_at', 'Updated At:') !!}
              <p>{!! $sharedProfileFile->updated_at !!}</p>
            </div>
            
          </div>
          
          <div class = "tab-pane" id = "shared_profile_file_comments">

            <span class="pull-right text-muted" style="background: rgba(0,0,0,0.2); color: #fff; margin: 10px; padding: 0 5px;">
                                
              {!! $sharedProfileFileCommentCounts !!} comments
                                
            </span>

            <div class="box-footer box-comments" style="padding-top: 40px;">
              
              @foreach($sharedProfileFileComments as $sharedProfileFileComment)
              
                @if($sharedProfileFile -> id == $sharedProfileFileComment -> s_p_f_id)
              
                    <div class="box-comment">
                      
                      @foreach($sharedProfileFileCommentUsers as $sharedProfileFileCommentUser)
                                  
                        @if($sharedProfileFileComment -> user_id == $sharedProfileFileCommentUser -> user_id && $sharedProfileFileComment -> id == $sharedProfileFileCommentUser -> id)

                          <img class="img-circle" src="/images/users/image_{!! $sharedProfileFileComment -> user_id !!}.{!! $sharedProfileFileCommentUser -> image_type !!}" alt="User Image">
        
                        @endif
                        
                      @endforeach
        
                      <div class="comment-text" style="text-align:justify; padding-right: 10px;">
                        
                        <a href="{!! route('sharedProfileUser.show', [$sharedProfileFileComment -> user_id]) !!}">
                              
                          <span class="username">
                                              
                            @foreach($sharedProfileFileCommentUsers as $sharedProfileFileCommentUser)
                                    
                              @if($sharedProfileFileComment -> user_id == $sharedProfileFileCommentUser -> user_id && $sharedProfileFileComment -> id == $sharedProfileFileCommentUser -> id)
                                      
                                {!! $sharedProfileFileCommentUser -> name !!}
                                          
                                <?php break; ?>
                                      
                              @endif
                                  
                            @endforeach
                                  
                            <span class="text-muted pull-right" style="background: rgba(0,0,0,0.1); color: #000; padding: 0 5px;">{!! $sharedProfileFileComment -> datetime !!}</span>
                                
                          </span>
                          
                        </a>
                          
                        {!! $sharedProfileFileComment -> content !!}
                                          
                      </div>
                                        
                      @foreach($sharedProfileFileCommentResponses as $sharedProfileFileCommentResponseArray)
              
                        @foreach($sharedProfileFileCommentResponseArray as $sharedProfileFileCommentResponse)
              
                          @if($sharedProfileFileComment -> id == $sharedProfileFileCommentResponse -> s_p_f_c_id)
                                        
                            <div style="margin-left: 30px;" class="box-comment">
                              
                              @foreach($sharedProfileFileCommentResponseUsers as $sharedProfileFileCommentResponseUserArray)
                                  
                                @foreach($sharedProfileFileCommentResponseUserArray as $sharedProfileFileCommentResponseUser)
                                          
                                  @if($sharedProfileFileCommentResponse -> user_id == $sharedProfileFileCommentResponseUser -> user_id && $sharedProfileFileCommentResponse -> id == $sharedProfileFileCommentResponseUser -> id)

                                    <img class="img-circle" src="/images/users/image_{!! $sharedProfileFileCommentResponse -> user_id !!}.{!! $sharedProfileFileCommentResponseUser -> image_type!!}" alt="User Image">
                                    
                                  @endif
                                  
                                @endforeach
                                
                              @endforeach
                                                
                              <div class="comment-text" style="text-align:justify; padding-right: 10px;">
                                
                                <a href="{!! route('sharedProfileUser.show', [$sharedProfileFileCommentResponse -> user_id]) !!}">
                                  
                                  <span class="username">
                                                      
                                    @foreach($sharedProfileFileCommentResponseUsers as $sharedProfileFileCommentResponseUserArray)
                                    
                                      @foreach($sharedProfileFileCommentResponseUserArray as $sharedProfileFileCommentResponseUser)
                                            
                                        @if($sharedProfileFileCommentResponse -> user_id == $sharedProfileFileCommentResponseUser -> user_id && $sharedProfileFileCommentResponse -> id == $sharedProfileFileCommentResponseUser -> id)
                                              
                                          {!! $sharedProfileFileCommentResponseUser -> name !!}
                                                  
                                          <?php break; ?>
                                              
                                        @endif
                                                          
                                      @endforeach
                                          
                                    @endforeach
                                          
                                    <span class="text-muted pull-right" style="background: rgba(0,0,0,0.1); color: #000; padding: 0 5px;">{!! $sharedProfileFileCommentResponse -> datetime !!}</span>
                                        
                                  </span>
                                  
                                </a>
                                  
                                {!! $sharedProfileFileCommentResponse -> content !!}
                                                  
                              </div>
                              
                            </div>
                                        
                          @endif
                                    
                        @endforeach
                                
                      @endforeach
                      
                    </div>
                                      
                    <div class="box-footer">
                                
                      @if(isset($user_id))
                      
                        <form id = "shared_profile_file_comment_response_{!! $sharedProfileFileComment -> id !!}" action = "{!! URL::to('/store_shared_profile_file_comment_response') !!}" method = "post">
                      
                          {{ csrf_field() }}
                            
                          <img class="img-responsive img-circle img-sm" src="/images/users/image_{!! $user_id !!}.{!! $actualUser[0] -> image_type !!}" alt="Alt Text">
                            
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
              
            </div>
            
            <div class="box-footer">
                           
              @if(isset($user_id))
                                
                <form id = "shared_profile_file_comment" action = "{!! URL::to('/store_shared_profile_file_comment') !!}" method = "post">
              
                  {{ csrf_field() }}
                    
                  <img class="img-responsive img-circle img-sm" src="/images/users/image_{!! $user_id !!}.{!! $actualUser[0] -> image_type !!}" alt="Alt Text">
                    
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
          
          <div class = "tab-pane" id = "shared_profile_file_likes">

            <div class="box box-primary" style="margin-bottom: 0;">

              <div class="box-body">
              
                <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">

                  <div class="row">

                    <div class="col-sm-12">
                      
                      <div class="small-box bg-green">
              
                        <div class="inner">
              
                          <h3><sup style="font-size: 20px">{!! $sharedProfileFileLikeCounts !!}</sup></h3>

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
                    
                            @foreach($sharedProfileFileLikes as $sharedProfileFileLike)
  
                              <tr role="row" class="odd">
                              
                                <td class=""> {!! $sharedProfileFileLike->name !!} </td>
                                
                                @if(isset($user_id))
                                
                                  <td class=""> {!! $sharedProfileFileLike->email !!} </td>
                                
                                @endif
                                
                                <td class=""> {!! $sharedProfileFileLike->datetime !!} </td>
                  
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
          
          <div class = "tab-pane" id = "shared_profile_file_views_history">

            <div class="box box-primary" style="margin-bottom: 0;">

              <div class="box-body">
              
                <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">

                  <div class="row">

                    <div class="col-sm-12">

                      <div class="small-box bg-green">
              
                        <div class="inner">
              
                          <h3><sup style="font-size: 20px">{!! $sharedProfileFile -> views_quantity !!}</sup></h3>

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
                    
                            @foreach($sharedProfileFileViews as $sharedProfileFileView)
  
                              <tr role="row" class="odd">
                              
                                <td class=""> {!! $sharedProfileFileView->name !!} </td>
                                
                                @if(isset($user_id))
                                
                                  <td class=""> {!! $sharedProfileFileView->email !!} </td>
                                
                                @endif
                                
                                <td class=""> {!! $sharedProfileFileView->datetime !!} </td>
                  
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