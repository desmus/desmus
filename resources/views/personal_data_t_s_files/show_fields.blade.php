<section class="content">

  <div class="row">
 
    <div class="col-md-12">
          
      <div class="nav-tabs-custom" style="margin-bottom: 0;">
            
        <ul class="nav nav-tabs">

          <li class = "active"><a href="#personal_data_topic_section_file_info" data-toggle="tab"> File Information </a></li>
          <li><a href="#personal_data_topic_section_file_views_history" data-toggle="tab"> Views History </a></li>
          <li><a href="#personal_data_topic_section_file_updates_history" data-toggle="tab"> Updates History </a></li>
          <li><a href="/files/personalDatas/file_{!! $personalDataTSFile -> id !!}.{!! $personalDataTSFile -> file_type !!}" download> Download </a></li>

        </ul>

        <div class="tab-content clearfix">
          
          <div class = "tab-pane active" id = "personal_data_topic_section_file_info">

            <div class="form-group">
              {!! Form::label('name', 'Name:') !!}
              <p>{!! $personalDataTSFile->name !!}</p>
            </div>
            
            <div class="form-group">
              {!! Form::label('description', 'Description:') !!}
              <p>{!! $personalDataTSFile->description !!}</p>
            </div>
            
            <div class="form-group">
              {!! Form::label('file_type', 'File Type:') !!}
              <p>{!! $personalDataTSFile->file_type !!}</p>
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
              <p>{!! $personalDataTSFile->created_at !!}</p>
            </div>
            
            <div class="form-group">
              {!! Form::label('updated_at', 'Updated At:') !!}
              <p>{!! $personalDataTSFile->updated_at !!}</p>
            </div>
            
          </div>
          
          <div class = "tab-pane" id = "personal_data_topic_section_file_views_history">

            <div class="box box-primary" style="margin-bottom: 0;">

              <div class="box-body">
              
                <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">

                  <div class="row">

                    <div class="col-sm-12">
          
                      <div class="small-box bg-green">
              
                        <div class="inner">
              
                          <h3><sup style="font-size: 20px">{!! $personalDataTSFile -> views_quantity !!}</sup></h3>

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
                    
                            @foreach($personalDataTSFileViews as $personalDataTSFileView)
  
                              <tr role="row" class="odd">
                              
                                <td class=""> {!! $personalDataTSFileView->name !!} </td>
                                <td class=""> {!! $personalDataTSFileView->email !!} </td>
                                <td class=""> {!! $personalDataTSFileView->datetime !!} </td>
                  
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

          <div class = "tab-pane" id = "personal_data_topic_section_file_updates_history">

            <div class="box box-primary" style="margin-bottom: 0;">

              <div class="box-body">
              
                <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">

                  <div class="row">

                    <div class="col-sm-12">
          
                      <div class="small-box bg-red">
              
                        <div class="inner">
              
                          <h3><sup style="font-size: 20px">{!! $personalDataTSFile -> updates_quantity !!}</sup></h3>

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
                            
                            @foreach($personalDataTSFileUpdates as $personalDataTSFileUpdate)
  
                              <tr role="row" class="odd">
                              
                                <td class=""> {!! $personalDataTSFileUpdate->actual_name !!} </td>
                                <td class=""> {!! $personalDataTSFileUpdate->past_name !!} </td>
                                <td class=""> {!! $personalDataTSFileUpdate->name !!} </td>
                                <td class=""> {!! $personalDataTSFileUpdate->email !!} </td>
                                <td class="sorting_1"> {!! $personalDataTSFileUpdate->datetime !!} </td>
                  
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