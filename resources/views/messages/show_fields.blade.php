<section class="content" style="padding-bottom: 0;">

  <div class="row">
 
    <div class="col-md-12">
          
      <div class="nav-tabs-custom">
            
        <ul class="nav nav-tabs">
          
          <li class = "active"><a href="#message_info" data-toggle="tab"> Information </a></li>
          <li><a href="#message_views_history" data-toggle="tab"> Views History </a></li>
          
        </ul>
        
        <div class="tab-content clearfix">
          
          <div class = "tab-pane active" id = "message_info">
            
            <div class="form-group">
              {!! Form::label('subject', 'Subject:') !!}
              <p>{!! $message->subject !!}</p>
            </div>
            
            <div class="form-group">
              {!! Form::label('content', 'Content:') !!}
              <p>{!! $message->content !!}</p>
            </div>
            
            <div class="form-group">
              {!! Form::label('datetime', 'Datetime:') !!}
              <p>{!! $message->datetime !!}</p>
            </div>
            
            <div class="form-group">
              {!! Form::label('importance', 'Importance:') !!}
              <p>{!! $message->importance !!}</p>
            </div>
            
            <div class="form-group">
              {!! Form::label('created_at', 'Created At:') !!}
              <p>{!! $message->created_at !!}</p>
            </div>
            
            <div class="form-group">
              {!! Form::label('updated_at', 'Updated At:') !!}
              <p>{!! $message->updated_at !!}</p>
            </div>
            
          </div>
          
          <div class = "tab-pane" id = "message_views_history">
            
            <div class="box box-primary" style="margin-bottom: 0;">
              
              <div class="box-body">
              
                <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                  
                  <div class="row">
                    
                    <div class="col-sm-12">
                      
                      <div class="col-lg-12 col-xs-12">
                        
                        <div class="small-box bg-green">
                          
                          <div class="inner">
                            
                            <h3><sup style="font-size: 20px">{!! $message -> views_quantity !!}</sup></h3>
                            
                            <p>Views Quantity</p>
                            
                          </div>
                          
                          <div class="icon">
                            
                            <i class="ion ion-stats-bars"></i>
                            
                          </div>
                          
                          <a href = "#message_views_history" data-toggle="tab" class="small-box-footer">
                            
                          </a>
                          
                        </div>
                        
                      </div>
                      
                      <div class="row">

                        <div class="col-sm-12">
                      
                          <div class="table-responsive" style="margin-bottom: 0;">
                      
                            <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info" style="margin-bottom: 0;">
                              
                              <thead>
                                
                                <tr role="row">
                                  
                                  <th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 224px;" aria-sort="descending"> Username </th>
                                  <th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 224px;" aria-sort="descending"> Email </th>
                                  <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending" style="width: 182px;"> Datetime </th>
                                  
                                </tr>
                                
                              </thead>
                              
                              <tbody>
                                
                                @foreach($messageViews as $messageView)
                                
                                  <tr role="row" class="odd">
                                  
                                    <td class=""> {!! $messageView->name !!} </td>
                                    <td class=""> {!! $messageView->email !!} </td>
                                    <td class=""> {!! $messageView->datetime !!} </td>
                                    
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
      
    </div>
    
  </div>
  
</section>