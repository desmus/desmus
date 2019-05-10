<section class="content" style="min-height: 30px;">
  
  <script src="//platform-api.sharethis.com/js/sharethis.js#property=5c4b656080b4ba001b1eeb04&product=inline-share-buttons"></script>
  
  <div class="sharethis-inline-share-buttons"></div>

  <div class="row">
 
    <div class="col-md-12">
          
      <div class="nav-tabs-custom" style="margin-bottom: 0;">
            
        <ul class="nav nav-tabs">

          <li><a href="#public_note_info" data-toggle="tab"> Note Information </a></li>
          <li class = "active"><a href="#public_note" data-toggle="tab"> Note </a></li>
          
          @if(isset($user_id))
          
            <li><a href="#public_image_text" data-toggle="tab"> Image to Text </a></li>
          
          @endif
          
          <li><a href="#public_note_comments" data-toggle="tab"> Comments </a></li>
          <li><a href="#public_note_likes" data-toggle="tab"> Likes </a></li>
          <li><a href="#public_note_views_history" data-toggle="tab"> Views History </a></li>
          
        </ul>

        <div class="tab-content clearfix">
          
          <div class = "tab-pane" id = "public_note_info">
            
            <div class="form-group">
              {!! Form::label('name', 'Name:') !!}
              <p>{!! $publicNote->name !!}</p>
            </div>
            
            <div class="form-group">
              {!! Form::label('description', 'Description:') !!}
              <p>{!! $publicNote->description !!}</p>
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
              <p>{!! $publicNote->created_at !!}</p>
            </div>
            
            <div class="form-group">
              {!! Form::label('updated_at', 'Updated At:') !!}
              <p>{!! $publicNote->updated_at !!}</p>
            </div>
            
          </div>
          
          <div class = "tab-pane" id = "public_note_comments">
            
            <span class="pull-right text-muted" style="background: rgba(0,0,0,0.2); color: #fff; margin: 10px; padding: 0 5px;">
                                
              {!! $publicNoteCommentCounts !!} comments
                                
            </span>

            <div class="box-footer box-comments" style="padding-top: 40px;">
              
              @foreach($publicNoteComments as $publicNoteComment)
              
                @if($publicNote -> id == $publicNoteComment -> public_note_id)
              
                    <div class="box-comment">
                      
                      @foreach($publicNoteCommentUsers as $publicNoteCommentUser)
                                  
                        @if($publicNoteComment -> user_id == $publicNoteCommentUser -> user_id && $publicNoteComment -> id == $publicNoteCommentUser -> id)

                          <img class="img-circle" src="/images/users/image_{!! $publicNoteComment -> user_id !!}.{!! $publicNoteCommentUser -> image_type !!}" alt="User Image">
        
                        @endif

                      @endforeach
        
                      <div class="comment-text" style="text-align:justify; padding-right: 10px;">
                        
                        <a href="{!! route('publicUser.show', [$publicNoteComment -> user_id]) !!}">
                              
                          <span class="username">
                                              
                            @foreach($publicNoteCommentUsers as $publicNoteCommentUser)
                                    
                              @if($publicNoteComment -> user_id == $publicNoteCommentUser -> user_id && $publicNoteComment -> id == $publicNoteCommentUser -> id)
                                      
                                {!! $publicNoteCommentUser -> name !!}
                                          
                                <?php break; ?>
                                      
                              @endif
                                  
                            @endforeach
                                  
                            <span class="text-muted pull-right" style="background: rgba(0,0,0,0.1); color: #000; padding: 0 5px;">{!! $publicNoteComment -> datetime !!}</span>
                                
                          </span>
                        
                        </a>
                          
                        {!! $publicNoteComment -> content !!}
                                          
                      </div>
                                        
                      @foreach($publicNoteCommentResponses as $publicNoteCommentResponseArray)
              
                        @foreach($publicNoteCommentResponseArray as $publicNoteCommentResponse)
              
                          @if($publicNoteComment -> id == $publicNoteCommentResponse -> public_note_comment_id)
                                        
                            <div style="margin-left: 30px;" class="box-comment">
                              
                              @foreach($publicNoteCommentResponseUsers as $publicNoteCommentResponseUserArray)
                                  
                                @foreach($publicNoteCommentResponseUserArray as $publicNoteCommentResponseUser)
                                          
                                  @if($publicNoteCommentResponse -> user_id == $publicNoteCommentResponseUser -> user_id && $publicNoteCommentResponse -> id == $publicNoteCommentResponseUser -> id)

                                    <img class="img-circle" src="/images/users/image_{!! $publicNoteCommentResponse -> user_id !!}.{!! $publicNoteCommentResponseUser -> image_type !!}" alt="User Image">
                                    
                                  @endif
                                  
                                @endforeach
                                
                              @endforeach
                                                
                              <div class="comment-text" style="text-align:justify; padding-right: 10px;">
                                
                                <a href="{!! route('publicUser.show', [$publicNoteCommentResponse -> user_id]) !!}">
                                      
                                  <span class="username">
                                                      
                                    @foreach($publicNoteCommentResponseUsers as $publicNoteCommentResponseUserArray)
                                    
                                      @foreach($publicNoteCommentResponseUserArray as $publicNoteCommentResponseUser)
                                            
                                        @if($publicNoteCommentResponse -> user_id == $publicNoteCommentResponseUser -> user_id && $publicNoteCommentResponse -> id == $publicNoteCommentResponseUser -> id)
                                              
                                          {!! $publicNoteCommentResponseUser -> name !!}
                                                  
                                          <?php break; ?>
                                              
                                        @endif
                                                          
                                      @endforeach
                                          
                                    @endforeach
                                          
                                    <span class="text-muted pull-right" style="background: rgba(0,0,0,0.1); color: #000; padding: 0 5px;">{!! $publicNoteCommentResponse -> datetime !!}</span>
                                        
                                  </span>
                                  
                                </a>
                                  
                                {!! $publicNoteCommentResponse -> content !!}
                                                  
                              </div>
                              
                            </div>
                                        
                          @endif
                                    
                        @endforeach
                                
                      @endforeach
                      
                    </div>
                                      
                    <div class="box-footer">
                      
                      @if(isset($user_id))
                              
                        <form id = "public_note_comment_response_{!! $publicNoteComment -> id !!}" action = "{!! URL::to('/store_public_note_comment_response') !!}" method = "post">
                      
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
              
            </div>
            
            <div class="box-footer">
            
              @if(isset($user_id))         
              
                <form id = "public_note_comment" action = "{!! URL::to('/store_public_note_comment') !!}" method = "post">
              
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
          
          <div class = "tab-pane" id = "public_note_likes">

            <div class="box box-primary" style="margin-bottom: 0;">

              <div class="box-body">
              
                <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">

                  <div class="row">

                    <div class="col-sm-12">
                      
                      <div class="small-box bg-green">
              
                        <div class="inner">
              
                          <h3><sup style="font-size: 20px">{!! $publicNoteLikeCounts !!}</sup></h3>

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
                    
                            @foreach($publicNoteLikes as $publicNoteLike)
  
                              <tr role="row" class="odd">
                              
                                <td class=""> {!! $publicNoteLike->name !!} </td>
                                
                                @if(isset($user_id))
                                
                                  <td class=""> {!! $publicNoteLike->email !!} </td>
                                
                                @endif
                                
                                <td class=""> {!! $publicNoteLike->datetime !!} </td>
                  
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
          
          <div class = "tab-pane active" id = "public_note">

            <div id="toolbar-container"></div>

            {!! Form::model($publicNote, ['route' => ['publicNotes.update', $publicNote->id], 'method' => 'patch']) !!}

              @if($text == '')

                <div class = "form-group" id="editor"> {!! $publicNote -> content!!} </div>

              @endif

              @if($text != '')
              
                <div class = "form-group" id="editor"> {!! $text!!} </div>
              
              @endif

              <textarea id = "text" name = "content" hidden> </textarea>

              <input type = "datetime" name = "updated_at" value = "{!! $now !!}" hidden>

              <div class="form-group col-sm-12" style="margin-bottom: 0;">
                {!! Form::submit('Save', ['class' => 'btn btn-primary pull-right']) !!}
              </div>

            {!! Form::close() !!}

          </div>
          
          <div class = "tab-pane" id = "public_image_text">

            <div id="toolbar-container"></div>

            <form role="form" method="POST" action="{!! URL::to('/annotatePublicNote/'.$id) !!}" enctype="multipart/form-data">
                              
                {{ csrf_field() }}
                                  
                <div class="form-group col-sm-12">
                
                  {!! Form::label('image', 'Image Note:') !!}
                  {!! Form::file('image', null, ['class' => 'form-control']) !!}
                    
                </div>
                
                <div class="form-group col-sm-12" style="margin-bottom: 0;">
                  
                  {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
  
                </div>              
                  
              </form>

          </div>
          
          <div class = "tab-pane" id = "public_note_views_history">

            <div class="box box-primary" style="margin-bottom: 0;">

              <div class="box-body">
              
                <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">

                  <div class="row">

                    <div class="col-sm-12">
          
                      <div class="small-box bg-green">
              
                        <div class="inner">
              
                          <h3><sup style="font-size: 20px">{!! $publicNote -> views_quantity !!}</sup></h3>

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
                    
                            @foreach($publicNoteViews as $publicNoteView)
  
                              <tr role="row" class="odd">
                              
                                <td class=""> {!! $publicNoteView->name !!} </td>
                                
                                @if(isset($user_id))
                                
                                  <td class=""> {!! $publicNoteView->email !!} </td>
                                
                                @endif
                                
                                <td class=""> {!! $publicNoteView->datetime !!} </td>
                  
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