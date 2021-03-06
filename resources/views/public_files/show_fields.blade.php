<section class="content">
  
  <script src="//platform-api.sharethis.com/js/sharethis.js#property=5c4b656080b4ba001b1eeb04&product=inline-share-buttons"></script>
  
  <div class="sharethis-inline-share-buttons"></div>

  <div class="row">
 
    <div class="col-md-12">
          
      <div class="nav-tabs-custom" style="margin-bottom: 0;">
            
        <ul class="nav nav-tabs">

          <li class = "active"><a href="#public_file_info" data-toggle="tab"> File Information </a></li>
          <li><a href="#public_file_comments" data-toggle="tab"> Comments </a></li>
          <li><a href="#public_file_likes" data-toggle="tab"> Likes </a></li>
          <li><a href="#public_file_views_history" data-toggle="tab"> Views History </a></li>
          <li><a href="/files/public_files/file_{!! $publicFile -> id !!}.{!! $publicFile -> file_type !!}" download> Download </a></li>

        </ul>

        <div class="tab-content clearfix">
          
          <div class = "tab-pane active" id = "public_file_info">

            <div class="form-group">
              {!! Form::label('name', 'Name:') !!}
              <p>{!! $publicFile->name !!}</p>
            </div>
            
            <div class="form-group">
              {!! Form::label('description', 'Description:') !!}
              <p>{!! $publicFile->description !!}</p>
            </div>
            
            <div class="form-group">
              {!! Form::label('file_type', 'File Type:') !!}
              <p>{!! $publicFile->file_type !!}</p>
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
              <p>{!! $publicFile->created_at !!}</p>
            </div>
            
            <div class="form-group">
              {!! Form::label('updated_at', 'Updated At:') !!}
              <p>{!! $publicFile->updated_at !!}</p>
            </div>
            
          </div>
          
          <div class = "tab-pane" id = "public_file_comments">

            <span class="pull-right text-muted" style="background: rgba(0,0,0,0.2); color: #fff; margin: 10px; padding: 0 5px;">
                                
              {!! $publicFileCommentCounts !!} comments
                                
            </span>

            <div class="box-footer box-comments" style="padding-top: 40px;">
              
              @foreach($publicFileComments as $publicFileComment)
              
                @if($publicFile -> id == $publicFileComment -> public_file_id)
              
                    <div class="box-comment">
                      
                      @foreach($publicFileCommentUsers as $publicFileCommentUser)
                                  
                        @if($publicFileComment -> user_id == $publicFileCommentUser -> user_id && $publicFileComment -> id == $publicFileCommentUser -> id)

                          <img class="img-circle" src="/images/users/image_{!! $publicFileComment -> user_id !!}.{!! $publicFileCommentUser -> image_type !!}" alt="User Image">
        
                        @endif
                        
                      @endforeach
        
                      <div class="comment-text" style="text-align:justify; padding-right: 10px;">
                        
                        <a href="{!! route('publicUser.show', [$publicFileComment -> user_id]) !!}">
                              
                          <span class="username">
                                              
                            @foreach($publicFileCommentUsers as $publicFileCommentUser)
                                    
                              @if($publicFileComment -> user_id == $publicFileCommentUser -> user_id && $publicFileComment -> id == $publicFileCommentUser -> id)
                                      
                                {!! $publicFileCommentUser -> name !!}
                                          
                                <?php break; ?>
                                      
                              @endif
                                  
                            @endforeach
                                  
                            <span class="text-muted pull-right" style="background: rgba(0,0,0,0.1); color: #000; padding: 0 5px;">{!! $publicFileComment -> datetime !!}</span>
                                
                          </span>
                          
                        </a>
                          
                        {!! $publicFileComment -> content !!}
                                          
                      </div>
                                        
                      @foreach($publicFileCommentResponses as $publicFileCommentResponseArray)
              
                        @foreach($publicFileCommentResponseArray as $publicFileCommentResponse)
              
                          @if($publicFileComment -> id == $publicFileCommentResponse -> public_file_comment_id)
                                        
                            <div style="margin-left: 30px;" class="box-comment">
                              
                              @foreach($publicFileCommentResponseUsers as $publicFileCommentResponseUserArray)
                                  
                                @foreach($publicFileCommentResponseUserArray as $publicFileCommentResponseUser)
                                          
                                  @if($publicFileCommentResponse -> user_id == $publicFileCommentResponseUser -> user_id && $publicFileCommentResponse -> id == $publicFileCommentResponseUser -> id)

                                    <img class="img-circle" src="/images/users/image_{!! $publicFileCommentResponse -> user_id !!}.{!! $publicFileCommentResponseUser -> image_type!!}" alt="User Image">
                                    
                                  @endif
                                  
                                @endforeach
                                
                              @endforeach
                                                
                              <div class="comment-text" style="text-align:justify; padding-right: 10px;">
                                
                                <a href="{!! route('publicUser.show', [$publicFileCommentResponse -> user_id]) !!}">
                                  
                                  <span class="username">
                                                      
                                    @foreach($publicFileCommentResponseUsers as $publicFileCommentResponseUserArray)
                                    
                                      @foreach($publicFileCommentResponseUserArray as $publicFileCommentResponseUser)
                                            
                                        @if($publicFileCommentResponse -> user_id == $publicFileCommentResponseUser -> user_id && $publicFileCommentResponse -> id == $publicFileCommentResponseUser -> id)
                                              
                                          {!! $publicFileCommentResponseUser -> name !!}
                                                  
                                          <?php break; ?>
                                              
                                        @endif
                                                          
                                      @endforeach
                                          
                                    @endforeach
                                          
                                    <span class="text-muted pull-right" style="background: rgba(0,0,0,0.1); color: #000; padding: 0 5px;">{!! $publicFileCommentResponse -> datetime !!}</span>
                                        
                                  </span>
                                  
                                </a>
                                  
                                {!! $publicFileCommentResponse -> content !!}
                                                  
                              </div>
                              
                            </div>
                                        
                          @endif
                                    
                        @endforeach
                                
                      @endforeach
                      
                    </div>
                                      
                    <div class="box-footer">
                                
                      @if(isset($user_id))
                      
                        <form id = "public_file_comment_response_{!! $publicFileComment -> id !!}" action = "{!! URL::to('/store_public_file_comment_response') !!}" method = "post">
                      
                          {{ csrf_field() }}
                            
                          <img class="img-responsive img-circle img-sm" src="/images/users/image_{!! $user_id !!}.{!! $actualUser[0] -> image_type !!}" alt="Alt Text">
                            
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
              
            </div>
            
            <div class="box-footer">
                           
              @if(isset($user_id))
                                
                <form id = "public_file_comment" action = "{!! URL::to('/store_public_file_comment') !!}" method = "post">
              
                  {{ csrf_field() }}
                    
                  <img class="img-responsive img-circle img-sm" src="/images/users/image_{!! $user_id !!}.{!! $actualUser[0] -> image_type !!}" alt="Alt Text">
                    
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
          
          <div class = "tab-pane" id = "public_file_likes">

            <div class="box box-primary" style="margin-bottom: 0;">

              <div class="box-body">
              
                <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">

                  <div class="row">

                    <div class="col-sm-12">
                      
                      <div class="small-box bg-green">
              
                        <div class="inner">
              
                          <h3><sup style="font-size: 20px">{!! $publicFileLikeCounts !!}</sup></h3>

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
                    
                            @foreach($publicFileLikes as $publicFileLike)
  
                              <tr role="row" class="odd">
                              
                                <td class=""> {!! $publicFileLike->name !!} </td>
                                
                                @if(isset($user_id))
                                
                                  <td class=""> {!! $publicFileLike->email !!} </td>
                                
                                @endif
                                
                                <td class=""> {!! $publicFileLike->datetime !!} </td>
                  
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
          
          <div class = "tab-pane" id = "public_file_views_history">

            <div class="box box-primary" style="margin-bottom: 0;">

              <div class="box-body">
              
                <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">

                  <div class="row">

                    <div class="col-sm-12">

                      <div class="small-box bg-green">
              
                        <div class="inner">
              
                          <h3><sup style="font-size: 20px">{!! $publicFile -> views_quantity !!}</sup></h3>

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
                    
                            @foreach($publicFileViews as $publicFileView)
  
                              <tr role="row" class="odd">
                              
                                <td class=""> {!! $publicFileView->name !!} </td>
                                
                                @if(isset($user_id))
                                
                                  <td class=""> {!! $publicFileView->email !!} </td>
                                
                                @endif
                                
                                <td class=""> {!! $publicFileView->datetime !!} </td>
                  
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