<section class="content">

  <script src="//platform-api.sharethis.com/js/sharethis.js#property=5c4b656080b4ba001b1eeb04&product=inline-share-buttons"></script>
  
  <div class="sharethis-inline-share-buttons"></div>

  <div class="row">
 
    <div class="col-md-12">
          
      <div class="nav-tabs-custom" style="margin-bottom: 0;">
            
        <ul class="nav nav-tabs">

          <li><a href="#public_advertisement_info" data-toggle="tab"> Advertisement Information </a></li>
          <li class = "active"><a href="#public_advertisement_image_preview" data-toggle="tab"> Advertisement Image </a></li>
          <li><a href="#public_advertisement_advertisement_preview" data-toggle="tab"> Advertisement Video </a></li>
          <li><a href="#public_advertisement_comments" data-toggle="tab"> Comments </a></li>
          <li><a href="#public_advertisement_likes" data-toggle="tab"> Likes </a></li>
          <li><a href="#public_advertisement_views_history" data-toggle="tab"> Views History </a></li>
          
          @if(isset($user_id))
          
            <li><a href ="{!! route('publicAdvertisements.edit', [$publicAdvertisement->id]) !!}"> Update Advertisement </a></li>
          
          @endif
          
        </ul>

        <div class="tab-content clearfix">

          <div class = "tab-pane" id = "public_advertisement_info">

            <div class="form-group">
                {!! Form::label('name', 'Name:') !!}
                <p>{!! $publicAdvertisement->name !!}</p>
            </div>
            
            <div class="form-group">
                {!! Form::label('description', 'Description:') !!}
                <p>{!! $publicAdvertisement->description !!}</p>
            </div>
            
            <div class="form-group">
                {!! Form::label('image_type', 'Image Type:') !!}
                <p>{!! $publicAdvertisement->image_type !!}</p>
            </div>
            
            <div class="form-group">
                {!! Form::label('advertisement_type', 'Advertisement Type:') !!}
                <p>{!! $publicAdvertisement->advertisement_type !!}</p>
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
                <p>{!! $publicAdvertisement->created_at !!}</p>
            </div>
            
            <div class="form-group">
                {!! Form::label('updated_at', 'Updated At:') !!}
                <p>{!! $publicAdvertisement->updated_at !!}</p>
            </div>

          </div>
          
          <div class = "tab-pane active" id = "public_advertisement_image_preview">

            <div class="col-md-12" style="padding: 0;">
    
              <div class="widget-container" style="margin-bottom: 0;">
        
                <div class="widget row image-tile">
          
                  <img src = "/images/public_advertisement_images/image_{!! $publicAdvertisement -> id !!}.{!! $publicAdvertisement -> image_type !!}" width = "100%">
          
                </div>
    
              </div>

            </div>

          </div>
          
          <div class = "tab-pane" id = "public_advertisement_advertisement_preview">

            <div class="col-md-12" style="padding: 0;">
    
              <div class="widget-container" style="padding: 10px; margin-bottom: 0;">
        
                <div class="widget row image-tile">
          
                  <video width="100%" controls>
                    
                    <source src="/videos/public_advertisement_videos/video_{!! $publicAdvertisement -> id !!}.{!! $publicAdvertisement -> video_type !!}" type="video/mp4">
                    
                  </video>
                  
                </div>
    
              </div>

            </div>

          </div>
          
          <div class = "tab-pane" id = "public_advertisement_comments">
            
            <span class="pull-right text-muted" style="background: rgba(0,0,0,0.2); color: #fff; margin: 10px; padding: 0 5px;">
                                
              {!! $publicAdvertisementCommentCounts !!} comments
                                
            </span>

            <div class="box-footer box-comments" style="padding-top: 40px;">
              
              @foreach($publicAdvertisementComments as $publicAdvertisementComment)
              
                @if($publicAdvertisement -> id == $publicAdvertisementComment -> public_advertisement_id)
              
                    <div class="box-comment">
                        
                      @foreach($publicAdvertisementCommentUsers as $publicAdvertisementCommentUser)
                                  
                        @if($publicAdvertisementComment -> user_id == $publicAdvertisementCommentUser -> user_id && $publicAdvertisementComment -> id == $publicAdvertisementCommentUser -> id)

                          <img class="img-circle" src="/images/users/image_{!! $publicAdvertisementComment -> user_id !!}.{!! $publicAdvertisementCommentUser -> image_type !!}" alt="User Advertisement">
        
                        @endif
                        
                      @endforeach
        
                      <div class="comment-text" style="text-align:justify; padding-right: 10px;">
                        
                        <a href="{!! route('publicUser.show', [$publicAdvertisementComment -> user_id]) !!}">
                              
                          <span class="username">
                                              
                            @foreach($publicAdvertisementCommentUsers as $publicAdvertisementCommentUser)
                                    
                              @if($publicAdvertisementComment -> user_id == $publicAdvertisementCommentUser -> user_id && $publicAdvertisementComment -> id == $publicAdvertisementCommentUser -> id)
                                      
                                {!! $publicAdvertisementCommentUser -> name !!}
                                          
                                <?php break; ?>
                                      
                              @endif
                                  
                            @endforeach
                                  
                            <span class="text-muted pull-right" style="background: rgba(0,0,0,0.1); color: #000; padding: 0 5px;">{!! $publicAdvertisementComment -> datetime !!}</span>
                                
                          </span>
                          
                        </a>
                          
                        {!! $publicAdvertisementComment -> content !!}
                                          
                      </div>
                                        
                      @foreach($publicAdvertisementCResponses as $publicAdvertisementCommentResponseArray)
              
                        @foreach($publicAdvertisementCommentResponseArray as $publicAdvertisementCommentResponse)
              
                          @if($publicAdvertisementComment -> id == $publicAdvertisementCommentResponse -> public_a_c_id)
                                        
                            <div style="margin-left: 30px;" class="box-comment">
                              
                              @foreach($publicAdvertisementCResponseUsers as $publicAdvertisementCommentResponseUserArray)
                                  
                                @foreach($publicAdvertisementCommentResponseUserArray as $publicAdvertisementCommentResponseUser)
                                          
                                  @if($publicAdvertisementCommentResponse -> user_id == $publicAdvertisementCommentResponseUser -> user_id && $publicAdvertisementCommentResponse -> id == $publicAdvertisementCommentResponseUser -> id)

                                    <img class="img-circle" src="/images/users/image_{!! $publicAdvertisementCommentResponse -> user_id !!}.{!! $publicAdvertisementCommentResponseUser -> image_type !!}" alt="User Advertisement">
                                    
                                  @endif
                                  
                                @endforeach
                                
                              @endforeach
                                                
                              <div class="comment-text" style="text-align:justify; padding-right: 10px;">
                                
                                <a href="{!! route('publicUser.show', [$publicAdvertisementCommentResponse -> user_id]) !!}">
                                      
                                  <span class="username">
                                                      
                                    @foreach($publicAdvertisementCResponseUsers as $publicAdvertisementCommentResponseUserArray)
                                    
                                      @foreach($publicAdvertisementCommentResponseUserArray as $publicAdvertisementCommentResponseUser)
                                            
                                        @if($publicAdvertisementCommentResponse -> user_id == $publicAdvertisementCommentResponseUser -> user_id && $publicAdvertisementCommentResponse -> id == $publicAdvertisementCommentResponseUser -> id)
                                              
                                          {!! $publicAdvertisementCommentResponseUser -> name !!}
                                                  
                                          <?php break; ?>
                                              
                                        @endif
                                                          
                                      @endforeach
                                          
                                    @endforeach
                                          
                                    <span class="text-muted pull-right" style="background: rgba(0,0,0,0.1); color: #000; padding: 0 5px;">{!! $publicAdvertisementCommentResponse -> datetime !!}</span>
                                        
                                  </span>
                                  
                                </a>
                                  
                                {!! $publicAdvertisementCommentResponse -> content !!}
                                                  
                              </div>
                              
                            </div>
                                        
                          @endif
                                    
                        @endforeach
                                
                      @endforeach
                      
                    </div>
                                      
                    <div class="box-footer">
                    
                      @if(isset($user_id))  
                        
                        <form id = "public_advertisement_comment_response_{!! $publicAdvertisementComment -> id !!}" action = "{!! URL::to('/store_public_advertisement_c_response') !!}" method = "post">
                      
                          {{ csrf_field() }}
                            
                          <img class="img-responsive img-circle img-sm" src="/images/users/image_{!! $user_id !!}.{!! $actualUser[0] -> image_type !!}" alt="Alt Text">
                            
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
              
            </div>
            
            <div class="box-footer">
              
              @if(isset($user_id))
              
                <form id = "public_advertisement_comment" action = "{!! URL::to('/store_public_advertisement_comment') !!}" method = "post">
              
                  {{ csrf_field() }}
                    
                    <img class="img-responsive img-circle img-sm" src="/images/users/image_{!! $user_id !!}.{!! $actualUser[0] -> image_type !!}" alt="Alt Text">
                    
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
          
          <div class = "tab-pane" id = "public_advertisement_likes">

            <div class="box box-primary" style="margin-bottom: 0;">

              <div class="box-body">
              
                <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">

                  <div class="row">

                    <div class="col-sm-12">
                      
                      <div class="small-box bg-green">
              
                        <div class="inner">
              
                          <h3><sup style="font-size: 20px">{!! $publicAdvertisementLikeCounts !!}</sup></h3>

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
                    
                            @foreach($publicAdvertisementLikes as $publicAdvertisementLike)
  
                              <tr role="row" class="odd">
                              
                                <td class=""> {!! $publicAdvertisementLike->name !!} </td>
                                
                                @if(isset($user_id))
                                
                                  <td class=""> {!! $publicAdvertisementLike->email !!} </td>
                                
                                @endif
                                
                                <td class=""> {!! $publicAdvertisementLike->datetime !!} </td>
                  
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
          
          <div class = "tab-pane" id = "public_advertisement_views_history">

            <div class="box box-primary" style="margin-bottom: 0;">

              <div class="box-body">
              
                <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">

                  <div class="row">

                    <div class="col-sm-12">
          
                      <div class="small-box bg-green">
              
                        <div class="inner">
              
                          <h3><sup style="font-size: 20px">{!! $publicAdvertisement -> views_quantity !!}</sup></h3>

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
                    
                            @foreach($publicAdvertisementViews as $publicAdvertisementView)
  
                              <tr role="row" class="odd">
                              
                                <td class=""> {!! $publicAdvertisementView->name !!} </td>
                                
                                @if(isset($user_id))
                                
                                  <td class=""> {!! $publicAdvertisementView->email !!} </td>
                                
                                @endif
                                
                                <td class=""> {!! $publicAdvertisementView->datetime !!} </td>
                  
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