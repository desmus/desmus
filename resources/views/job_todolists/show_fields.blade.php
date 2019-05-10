<section class="content">

  <div class="row">
 
    <div class="col-md-12">
          
      <div class="nav-tabs-custom">
            
        <ul class="nav nav-tabs">

          <li class = "active"><a href="#todolist_info" data-toggle="tab"> Information </a></li>
          <li><a href="#todolist_statistics" data-toggle="tab"> Statistics </a></li>
          <li><a href="#todolist_views_history" data-toggle="tab"> Views History </a></li>
          <li><a href="#todolist_updates_history" data-toggle="tab"> Updates History </a></li>

        </ul>

        <div class="tab-content clearfix">
          
          <div class = "tab-pane active" id = "todolist_info">
            
            <div class="form-group">
                {!! Form::label('name', 'Name:') !!}
                <p>{!! $jobTodolist->name !!}</p>
            </div>
            
            <div class="form-group">
                {!! Form::label('description', 'Description:') !!}
                <p>{!! $jobTodolist->description !!}</p>
            </div>
            
            <div class="form-group">
                {!! Form::label('datetime', 'Datetime:') !!}
                <p>{!! $jobTodolist->datetime !!}</p>
            </div>
            
            <div class="form-group">
                {!! Form::label('created_at', 'Created At:') !!}
                <p>{!! $jobTodolist->created_at !!}</p>
            </div>
            
            <div class="form-group">
                {!! Form::label('updated_at', 'Updated At:') !!}
                <p>{!! $jobTodolist->updated_at !!}</p>
            </div>
            
          </div>
          
          <div class = "tab-pane" id = "todolist_tasks">
            
          </div>
          
          <div class = "tab-pane" id = "todolist_statistics">
            
            <div class="col-lg-6 col-xs-6">
              
              <div class="small-box bg-green">
                
                <div class="inner">
                  
                  <h3> {!! $jobTodolist -> views_quantity !!} <sup style="font-size: 20px"></sup></h3>
                  
                  <p>Views Quantity</p>
                  
                </div>
                
                <div class="icon">
                  
                  <i class="ion ion-stats-bars"></i>
                  
                </div>
                
                <a href = "#todolist_views_history" data-toggle="tab" class="small-box-footer">
                  
                  More Information
                  
                </a>
                
              </div>
              
            </div>
            
            <div class="col-lg-6 col-xs-6">
              
              <div class="small-box bg-red">
                
                <div class="inner">
                  
                  <h3> {!! $jobTodolist -> updates_quantity !!} </h3>
                  
                  <p>Updates Quantity</p>
                  
                </div>
                
                <div class="icon">
                  
                  <i class="ion ion-stats-bars"></i>
                  
                </div>
                
                <a href = "#todolist_updates_history" data-toggle="tab" class="small-box-footer">
                  
                  More Information
                  
                </a>
                
              </div>
              
            </div>
            
          </div>
          
          <div class = "tab-pane" id = "todolist_views_history">
            
            <div class="box">
              
              <div class="box-body">
              
                <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                  
                  <div class="row">
                    
                    <div class="col-sm-12">
                      
                      <div class="table-responsive">
                        
                        <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                          
                          <thead>
                            
                            <tr role="row">
                              
                              <th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 224px;" aria-sort="descending"> Username </th>
                              <th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 224px;" aria-sort="descending"> Email </th>
                              <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending" style="width: 182px;"> Datetime </th>
                              
                            </tr>
                            
                          </thead>
                          
                          <tbody>
                            
                            @foreach($jobTodolistViews as $jobTodolistView)
                            
                              <tr role="row" class="odd">
                                
                                <td class=""> {!! $jobTodolistView->name !!} </td>
                                <td class=""> {!! $jobTodolistView->email !!} </td>
                                <td class=""> {!! $jobTodolistView->datetime !!} </td>
                                
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
          
          <div class = "tab-pane" id = "todolist_updates_history">
            
            <div class="box">
              
              <div class="box-body">
              
                <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                  
                  <div class="row">
                    
                    <div class="col-sm-12">
                      
                      <div class="table-responsive">
                        
                        <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                          
                          <thead>
                            
                            <tr role="row">
                              
                              <th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 224px;" aria-sort="descending"> Actual Name </th>
                              <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending" style="width: 182px;"> Past Name </th>
                              <th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 224px;" aria-sort="descending"> Username </th>
                              <th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 224px;" aria-sort="descending"> Email </th>
                              <th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 224px;" aria-sort="descending"> Datetime Update </th>
                              
                            </tr>
                            
                          </thead>
                          
                          <tbody>
                            
                            @foreach($jobTodolistUpdates as $jobTodolistUpdate)
                            
                              <tr role="row" class="odd">
                              
                                <td class=""> {!! $jobTodolistUpdate->actual_name !!} </td>
                                <td class=""> {!! $jobTodolistUpdate->past_name !!} </td>
                                <td class=""> {!! $jobTodolistUpdate->name !!} </td>
                                <td class=""> {!! $jobTodolistUpdate->email !!} </td>
                                <td class=""> {!! $jobTodolistUpdate->datetime !!} </td>
                                
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