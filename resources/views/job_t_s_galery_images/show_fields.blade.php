<section class="content">

  <div class="row">
 
    <div class="col-md-12">
          
      <div class="nav-tabs-custom" style="margin-bottom: 0;">
            
        <ul class="nav nav-tabs">

          <li><a href="#job_topic_section_galery_image_info" data-toggle="tab"> Image Information </a></li>
          <li class = "active"><a href="#job_topic_section_galery_image_preview" data-toggle="tab"> Image Preview </a></li>
          <li><a href="#job_topic_section_galery_image_views_history" data-toggle="tab"> Views History </a></li>
          <li><a href="#job_topic_section_galery_image_updates_history" data-toggle="tab"> Updates History </a></li>
          <li><a href ="{!! route('jobTSGaleryImages.edit', [$jobTSGaleryImage->id]) !!}"> Update Image </a></li>
          <li><a href="{!! route('userJobTSGaleryImages.show', [$jobTSGaleryImage->id]) !!}"> Share Image </a></li>
          <li><a href ="{!! route('jobTSGaleryImages.destroy', [$jobTSGaleryImage->id]) !!}" onclick = "return confirm('Are you sure?')"> Delete Image </a></li>
          <li><a href="/images/jobs/image_{!! $jobTSGaleryImage -> id !!}.{!! $jobTSGaleryImage -> file_type !!}" download> Download Image </a></li>

        </ul>

        <div class="tab-content clearfix">

          <div class = "tab-pane active" id = "job_topic_section_galery_image_preview">

            <div class="col-md-12" style="padding-left: 0; padding-right: 0;">
    
              <div class="widget-container" style="margin-bottom: 0;">
        
                <div class="widget row image-tile">
          
                  <img src = "/images/jobs/image_{!! $jobTSGaleryImage -> id !!}.{!! $jobTSGaleryImage -> file_type !!}" width = "100%">
          
                </div>
    
              </div>

            </div>

          </div>

          <div class = "tab-pane" id = "job_topic_section_galery_image_info">

            <div class="form-group">
                {!! Form::label('name', 'Name:') !!}
                <p>{!! $jobTSGaleryImage->name !!}</p>
            </div>
            
            <div class="form-group">
                {!! Form::label('description', 'Description:') !!}
                <p>{!! $jobTSGaleryImage->description !!}</p>
            </div>
            
            <div class="form-group">
                {!! Form::label('file_type', 'File Type:') !!}
                <p>{!! $jobTSGaleryImage->file_type !!}</p>
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
                <p>{!! $jobTSGaleryImage->created_at !!}</p>
            </div>
            
            <div class="form-group">
                {!! Form::label('updated_at', 'Updated At:') !!}
                <p>{!! $jobTSGaleryImage->updated_at !!}</p>
            </div>

          </div>
          
          <div class = "tab-pane" id = "job_topic_section_galery_image_views_history">

            <div class="box box-primary" style="margin-bottom: 0;">

              <div class="box-body">
              
                <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">

                  <div class="row">

                    <div class="col-sm-12">
          
                      <div class="small-box bg-green">
              
                        <div class="inner">
              
                          <h3><sup style="font-size: 20px">{!! $jobTSGaleryImage -> views_quantity !!}</sup></h3>

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
                    
                            @foreach($jobTSGImageViews as $jobTSGImageView)
  
                              <tr role="row" class="odd">
                              
                                <td class=""> {!! $jobTSGImageView->name !!} </td>
                                <td class=""> {!! $jobTSGImageView->email !!} </td>
                                <td class=""> {!! $jobTSGImageView->datetime !!} </td>
                  
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

          <div class = "tab-pane" id = "job_topic_section_galery_image_updates_history">

            <div class="box box-primary" style="margin-bottom: 0;">

              <div class="box-body">
              
                <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">

                  <div class="row">

                    <div class="col-sm-12">
          
                      <div class="small-box bg-red">
              
                        <div class="inner">
              
                          <h3><sup style="font-size: 20px">{!! $jobTSGaleryImage -> updates_quantity !!}</sup></h3>

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
                            
                            @foreach($jobTSGImageUpdates as $jobTSGImageUpdate)
  
                              <tr role="row" class="odd">
                              
                                <td class=""> {!! $jobTSGImageUpdate->actual_name !!} </td>
                                <td class=""> {!! $jobTSGImageUpdate->past_name !!} </td>
                                <td class=""> {!! $jobTSGImageUpdate->name !!} </td>
                                <td class=""> {!! $jobTSGImageUpdate->email !!} </td>
                                <td class="sorting_1"> {!! $jobTSGImageUpdate->datetime !!} </td>
                  
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