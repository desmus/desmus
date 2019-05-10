<section class="content">

  <div class="row">
 
    <div class="col-md-12">
          
      <div class="nav-tabs-custom" style="margin-bottom: 0;">
            
        <ul class="nav nav-tabs">

          <li class = "active"><a href="#job_topic_section_tool_file_info" data-toggle="tab"> File Information </a></li>
          <!--<li><a href="#job_topic_section_tool_file_preview" data-toggle="tab"> File Preview </a></li>
          <li><a href="#job_topic_section_tool_file_update_data" data-toggle="tab"> Update Data </a></li>-->
          <li><a href="#job_topic_section_tool_file_views_history" data-toggle="tab"> Views History </a></li>
          <li><a href="#job_topic_section_tool_file_updates_history" data-toggle="tab"> Updates History </a></li>
          <li><a href="/tools/jobs/file_{!! $jobTSToolFile -> id !!}.{!! $jobTSToolFile -> file_type !!}" download> Download File </a></li>
          <li><a href="/tools/jobs/file_{!! $jobTSToolFile->id !!}.{!! $jobTSToolFile->file_type !!}"> Execute Tool </a></li>

        </ul>

        <div class="tab-content clearfix">

          <div class = "tab-pane active" id = "job_topic_section_tool_file_info">
            
            <div class="form-group">
              {!! Form::label('name', 'Name:') !!}
              <p>{!! $jobTSToolFile->name !!}</p>
            </div>
            
            <div class="form-group">
              {!! Form::label('description', 'Description:') !!}
              <p>{!! $jobTSToolFile->description !!}</p>
            </div>
            
            <div class="form-group">
              {!! Form::label('file_type', 'File Type:') !!}
              <p>{!! $jobTSToolFile->file_type !!}</p>
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
                <p>{!! $jobTSToolFile->created_at !!}</p>
            </div>
            
            <div class="form-group">
                {!! Form::label('updated_at', 'Updated At:') !!}
                <p>{!! $jobTSToolFile->updated_at !!}</p>
            </div>

          </div>
          
          <!--<div class = "tab-pane" id = "job_topic_section_tool_file_preview">
            
            <div class = "row">
  
              <div class="col-sm-12">
    
                <div id = "chart"> </div>
      
              </div>
    
            </div>
            
          </div>
          
          <div class = "tab-pane" id = "job_topic_section_tool_file_update_data">
          
            <form action = "{!! URL::to('/store_job_tool_file_data') !!}" enctype = "multipart/form-data" method = "post">
            
              <div class="modal-body">
            
                <div class = "row">
            
                  {{ csrf_field() }}
                
                  <div class="form-group col-sm-12">
                    {!! Form::label('file', 'File Type:') !!}
                    {!! Form::file('file', null, ['class' => 'form-control']) !!}
                  </div>
                    
                  {!! Form::hidden('j_t_s_t_id', 'Job Topic Section Id:') !!}
                  {!! Form::hidden('j_t_s_t_id', null, ['class' => 'form-control']) !!}
                
                </div>
            
              </div>
            
              <div class="modal-footer">
            
                <div class="col-sm-12">
                  {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                </div>
            
              </div>
            
            </form>
            
          </div>-->
          
          <div class = "tab-pane" id = "job_topic_section_tool_file_views_history">

            <div class="box box-primary" style="margin-bottom: 0;">

              <div class="box-body">
              
                <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">

                  <div class="row">

                    <div class="col-sm-12">
          
                      <div class="small-box bg-green">
              
                        <div class="inner">
              
                          <h3><sup style="font-size: 20px">{!! $jobTSToolFile -> views_quantity !!}</sup></h3>

                          <p>Views Quantity</p>
            
                        </div>
            
                        <div class="icon">
              
                          <i class="ion ion-stats-bars"></i>
            
                        </div>
              
                      </div>
                      
                      <div class="table-responsive">

                        <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info" style="margin-bottom: 0;">
                  
                          <thead>
                  
                            <tr role="row">
  
                              <th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 224px;" aria-sort="descending"> Username </th>
                              <th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 224px;" aria-sort="descending"> Email </th>
                              <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending" style="width: 182px;"> Datetime </th>
                              
                            </tr>
                  
                          </thead>
                  
                          <tbody>
                    
                            @foreach($jobTSTFileViews as $jobTSTFileView)
  
                              <tr role="row" class="odd">
                              
                                <td class=""> {!! $jobTSTFileView->name !!} </td>
                                <td class=""> {!! $jobTSTFileView->email !!} </td>
                                <td class=""> {!! $jobTSTFileView->datetime !!} </td>
                  
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

          <div class = "tab-pane" id = "job_topic_section_tool_file_updates_history">

            <div class="box box-primary" style="margin-bottom: 0;">

              <div class="box-body">
              
                <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">

                  <div class="row">

                    <div class="col-sm-12">
          
                      <div class="small-box bg-red">
              
                        <div class="inner">
              
                          <h3><sup style="font-size: 20px">{!! $jobTSToolFile -> updates_quantity !!}</sup></h3>

                          <p>Updates Quantity</p>
            
                        </div>
            
                        <div class="icon">
              
                          <i class="ion ion-stats-bars"></i>
            
                        </div>
              
                      </div>
                      
                      <div class="table-responsive">

                        <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info" style="margin-bottom: 0;">
                  
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
                            
                            @foreach($jobTSTFileUpdates as $jobTSTFileUpdate)
  
                              <tr role="row" class="odd">
                              
                                <td class=""> {!! $jobTSTFileUpdate->actual_name !!} </td>
                                <td class=""> {!! $jobTSTFileUpdate->past_name !!} </td>
                                <td class=""> {!! $jobTSTFileUpdate->name !!} </td>
                                <td class=""> {!! $jobTSTFileUpdate->email !!} </td>
                                <td class="sorting_1"> {!! $jobTSTFileUpdate->datetime !!} </td>
                  
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