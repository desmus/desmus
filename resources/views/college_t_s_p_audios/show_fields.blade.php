<section class="content">

  <div class="row">
 
    <div class="col-md-12">
          
      <div class="nav-tabs-custom" style="margin-bottom: 0;">
            
        <ul class="nav nav-tabs">

          <li><a href="#college_topic_section_playlist_audio_info" data-toggle="tab"> Audio Information </a></li>
          <li class = "active"><a href="#college_topic_section_playlist_audio_preview" data-toggle="tab"> Audio Preview </a></li>
          <li><a href="#college_topic_section_playlist_audio_views_history" data-toggle="tab"> Views History </a></li>
          <li><a href="#college_topic_section_playlist_audio_updates_history" data-toggle="tab"> Updates History </a></li>
          <li><a href ="{!! route('collegeTSPAudios.edit', [$collegeTSPAudio->id]) !!}"> Update Audio </a></li>
          <li><a href="{!! route('userCollegeTSPAudios.show', [$collegeTSPAudio->id]) !!}"> Share Audio </a></li>
          <li><a href ="{!! route('collegeTSPAudios.destroy', [$collegeTSPAudio->id]) !!}" onclick = "return confirm('Are you sure?')"> Delete Audio </a></li>
          <li><a href="/audios/colleges/audio_{!! $collegeTSPAudio -> id !!}.{!! $collegeTSPAudio -> file_type !!}" download> Download Audio </a></li>
          
        </ul>
        
        <div class="tab-content clearfix">
          
          <div class = "tab-pane active" id = "college_topic_section_playlist_audio_preview">
            
            <div class = "col-md-12">
              
              <div id = "mp3_player">
                
                <div id = "audio_box"> </div>
                
                <canvas id = "analyser"> </canvas>
                
                <input type = "hidden" id = "audio_type" value = "college">
                <input type = "hidden" id = "audio_name" value = "{!! $collegeTSPAudio -> id !!}">
                
              </div>
              
            </div>
            
          </div>
          
          <div class = "tab-pane" id = "college_topic_section_playlist_audio_info">
            
            <div class="form-group">
                {!! Form::label('name', 'Name:') !!}
                <p>{!! $collegeTSPAudio->name !!}</p>
            </div>
            
            <div class="form-group">
                {!! Form::label('description', 'Description:') !!}
                <p>{!! $collegeTSPAudio->description !!}</p>
            </div>
            
            <div class="form-group">
                {!! Form::label('file_type', 'File Type:') !!}
                <p>{!! $collegeTSPAudio->file_type !!}</p>
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
                <p>{!! $collegeTSPAudio->created_at !!}</p>
            </div>
            
            <div class="form-group">
                {!! Form::label('updated_at', 'Updated At:') !!}
                <p>{!! $collegeTSPAudio->updated_at !!}</p>
            </div>

          </div>
          
          <div class = "tab-pane" id = "college_topic_section_playlist_audio_views_history">

            <div class="box box-primary" style="margin-bottom: 0;">

              <div class="box-body">
              
                <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">

                  <div class="row">

                    <div class="col-sm-12">
          
                      <div class="small-box bg-green">
              
                        <div class="inner">
              
                          <h3><sup style="font-size: 20px">{!! $collegeTSPAudio -> views_quantity !!}</sup></h3>

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
                    
                            @foreach($collegeTSPAudioViews as $collegeTSPAudioView)
  
                              <tr role="row" class="odd">
                              
                                <td class=""> {!! $collegeTSPAudioView->name !!} </td>
                                <td class=""> {!! $collegeTSPAudioView->email !!} </td>
                                <td class=""> {!! $collegeTSPAudioView->datetime !!} </td>
                  
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

          <div class = "tab-pane" id = "college_topic_section_playlist_audio_updates_history">

            <div class="box box-primary" style="margin-bottom: 0;">

              <div class="box-body">
              
                <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">

                  <div class="row">

                    <div class="col-sm-12">
                        
                      <div class="small-box bg-red">
              
                        <div class="inner">
              
                          <h3><sup style="font-size: 20px">{!! $collegeTSPAudio -> updates_quantity !!}</sup></h3>

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
                            
                            @foreach($collegeTSPAudioUpdates as $collegeTSPAudioUpdate)
  
                              <tr role="row" class="odd">
                              
                                <td class=""> {!! $collegeTSPAudioUpdate->actual_name !!} </td>
                                <td class=""> {!! $collegeTSPAudioUpdate->past_name !!} </td>
                                <td class=""> {!! $collegeTSPAudioUpdate->name !!} </td>
                                <td class=""> {!! $collegeTSPAudioUpdate->email !!} </td>
                                <td class="sorting_1"> {!! $collegeTSPAudioUpdate->datetime !!} </td>
                  
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