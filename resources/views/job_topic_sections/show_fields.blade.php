{!! Form::open(['route' => 'jobTopicSectionTodolists.store', 'id' => 'job_topic_section_todolist_create']) !!}

  {{ csrf_field() }}

  <div id="add_task" class="modal fade" role="dialog">
      
    <div class="modal-dialog modal-lg">
        
      <div class="modal-content">
          
        <div class="modal-header">
            
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              
            <span aria-hidden="true">×</span>
            
          </button>
            
          <h4 class="modal-title"> Add Task </h4>
            
        </div>
          
        <div class="modal-body">
            
          <div class = "row">
              
            <div class="form-group col-sm-12">
              {!! Form::label('name', 'Name:') !!}
              {!! Form::text('name', null, ['class' => 'form-control'], array('required' => 'required', 'id' => 'name')) !!}
            </div>
              
            <div class="form-group col-sm-12 col-lg-12">
              {!! Form::label('description', 'Description:') !!}
              {!! Form::textarea('description', 'Add a description ...', ['class' => 'form-control'], array('required' => 'required', 'id' => 'description')) !!}
            </div>
              
            <div class="form-group col-sm-12">
              {!! Form::label('datetime', 'Datetime:') !!}
              {!! Form::datetimelocal('datetime', $now, ['class' => 'form-control'], array('required' => 'required', 'id' => 'datetime')) !!}
            </div>
            
            {!! Form::hidden('views_quantity', 'Views Quantity:') !!}
            {!! Form::hidden('views_quantity', 0, ['class' => 'form-control']) !!}
            
            {!! Form::hidden('updates_quantity', 'Updates Quantity:') !!}
            {!! Form::hidden('updates_quantity', 0, ['class' => 'form-control']) !!}
              
            {!! Form::hidden('status', 'Status:') !!}
            {!! Form::hidden('status', 'active', ['class' => 'form-control']) !!}
              
            {!! Form::hidden('j_t_s_id', 'Job Topic Section Id:') !!}
            {!! Form::hidden('j_t_s_id', $id, ['class' => 'form-control']) !!}
              
          </div>
            
        </div>
          
        <div class="modal-footer">
            
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Create Task</button>
            
        </div>
          
      </div>
        
    </div>
      
  </div>
    
{!! Form::close() !!}

<section class="content">

  <div class="row">
 
    <div class="col-md-12">
          
      <div class="nav-tabs-custom">
            
        <ul class="nav nav-tabs">

          <li class = "active"><a href="#job_topic_section_info" data-toggle="tab"> Information </a></li>
          <li><a href="#job_topic_section_specific_info" data-toggle="tab"> Specific Information </a></li>
          <li><a href="#job_topic_section_tasks" data-toggle="tab"> Tasks </a></li>
          <li><a href="#job_topic_section_statistics" data-toggle="tab"> Statistics </a></li>
          <li><a href="#job_topic_section_views_history" data-toggle="tab"> Views History </a></li>
          <li><a href="#job_topic_section_updates_history" data-toggle="tab"> Updates History </a></li>

        </ul>

        <div class="tab-content clearfix">
          
          <div class = "tab-pane active" id = "job_topic_section_info">
            
            <div class="form-group">
              {!! Form::label('name', 'Name:') !!}
              <p>{!! $jobTopicSection->name !!}</p>
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
                <p>{!! $jobTopicSection->created_at !!}</p>
            </div>

            <div class="form-group">
              {!! Form::label('updated_at', 'Updated At:') !!}
              <p>{!! $jobTopicSection->updated_at !!}</p>
            </div>
            
          </div>

          <div class = "tab-pane" id = "job_topic_section_specific_info">

            <div id="toolbar-container"></div>

            {!! Form::model($jobTopicSection, ['route' => ['jobTopicSections.update', $jobTopicSection->id], 'method' => 'patch']) !!}

              <div class = "form-group" id="editor"> {!! $jobTopicSection->specific_info !!} </div>

              <textarea id = "text" name = "specific_info" hidden> </textarea>
              
              <input type = "datetime" name = "updated_at" value = "{!! $now !!}" hidden>

              <div class="form-group col-sm-12" style="margin-bottom: 0;">
                {!! Form::submit('Save', ['class' => 'btn btn-primary pull-right']) !!}
              </div>

            {!! Form::close() !!}

          </div>
          
          <div class = "tab-pane" id = "job_topic_section_tasks">
          
            <div class="box box-primary" style="position: relative; left: 0px; top: 0px;">
          
              <div class="box-header ui-sortable-handle" style="cursor: move;">
              
                <i class="ion ion-clipboard"></i>
                <h3 class="box-title">To Do List</h3>
                
              </div>
              
              <div class="box-body">
                
                <ul class="todo-list ui-sortable">
                  
                  @foreach($jobTopicSectionTodolist as $task)
                  
                    <a href = "{!! route('jobTopicSectionTodolists.show', [$task->id]) !!}">
                  
                      <li>
                        
                        <span class="handle ui-sortable-handle">
                          
                          <i class="fa fa-ellipsis-v"></i>
                          <i class="fa fa-ellipsis-v"></i>
                          
                        </span>
                        
                        <span class="text">{{ $task -> name }}   ---   {{ $task -> datetime }}</span>
                        
                        <div class="tools">
                          
                          {!! Form::open(['route' => ['jobTopicSectionTodolists.destroy', $task->id], 'method' => 'delete']) !!}
                          
                            <a class='btn btn-default btn-xs' href = "{!! route('jobTopicSectionTodolists.edit', [$task->id]) !!}"> <i class="fa fa-edit"></i> </a>
                            {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                            
                          {!! Form::close() !!}
                    
                        </div>
                  
                      </li>
                  
                    </a>
                  
                  @endforeach
              
                </ul>
            
              </div>
            
              <div class="box-footer clearfix no-border">
              
                <a href = "" class="btn btn-default pull-right" data-toggle="modal" data-target="#add_task"><i class="fa fa-plus"></i> Add task </a>
            
              </div>
          
            </div>
            
            <div class="box box-primary" style="position: relative; left: 0px; top: 0px; margin-bottom: 10px;">
          
              <div class="box-header ui-sortable-handle" style="cursor: move;">
              
                <i class="ion ion-clipboard"></i>
                <h3 class="box-title">Finished Tasks</h3>
                
              </div>
              
              <div class="box-body">
                
                <ul class="todo-list ui-sortable">
                  
                  @foreach($jobTopicSectionTodolistCompleted as $task)
                  
                    <a href = "{!! route('jobTopicSectionTodolists.show', [$task->id]) !!}">
                  
                      <li>
                        
                        <span class="handle ui-sortable-handle">
                          
                          <i class="fa fa-ellipsis-v"></i>
                          <i class="fa fa-ellipsis-v"></i>
                          
                        </span>
                        
                        <span class="text">{{ $task -> name }}   ---   {{ $task -> datetime }}</span>
                        
                        <div class="tools">
                          
                          {!! Form::open(['route' => ['jobTopicSectionTodolists.destroy', $task->id], 'method' => 'delete']) !!}
                          
                            <a class='btn btn-default btn-xs' href = "{!! route('jobTopicSectionTodolists.edit', [$task->id]) !!}"> <i class="fa fa-edit"></i> </a>
                            {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                            
                          {!! Form::close() !!}
                    
                        </div>
                  
                      </li>
                  
                    </a>
                  
                  @endforeach
              
                </ul>
            
              </div>
          
            </div>
            
          </div>

          <div class = "tab-pane" id = "job_topic_section_statistics">

            <div class="col-md-3 col-sm-6 col-xs-12">
          
              <div class="info-box bg-aqua">
            
                <span class="info-box-icon"><i class="glyphicon glyphicon-file"></i></span>

                <div class="info-box-content">
              
                  <span class="info-box-text"> Number of <br> Files </span>
                  <span class="info-box-number"> {!! $jobTopicSectionFileCount !!} </span>

                  <div class="progress">
                
                    <div class="progress-bar" style="width: 70%"></div>
              
                  </div>
            
                </div>
          
              </div>
        
            </div>

            <div class="col-md-3 col-sm-6 col-xs-12">
          
              <div class="info-box bg-green">
            
                <span class="info-box-icon"><i class="glyphicon glyphicon-book"></i></span>

                <div class="info-box-content">
              
                  <span class="info-box-text"> Number of <br> Notes </span>
                  <span class="info-box-number"> {!! $jobTopicSectionNoteCount !!} </span>

                  <div class="progress">
                
                    <div class="progress-bar" style="width: 70%"></div>
              
                  </div>
            
                </div>
          
              </div>
        
            </div>

            <div class="col-md-3 col-sm-6 col-xs-12">
          
              <div class="info-box bg-yellow">
            
                <span class="info-box-icon"><i class="glyphicon glyphicon-picture"></i></span>

                <div class="info-box-content">
              
                  <span class="info-box-text"> Number of <br> Galeries </span>
                  <span class="info-box-number"> {!! $jobTopicSectionGaleryCount !!} </span>

                  <div class="progress">
                
                    <div class="progress-bar" style="width: 70%"></div>
              
                  </div>
            
                </div>
          
              </div>
        
            </div>

            <div class="col-md-3 col-sm-6 col-xs-12">
          
              <div class="info-box bg-red">
            
                <span class="info-box-icon"><i class="glyphicon glyphicon-wrench"></i></span>

                <div class="info-box-content">
              
                  <span class="info-box-text"> Number of <br> Tools </span>
                  <span class="info-box-number"> {!! $jobTopicSectionToolCount !!} </span>

                  <div class="progress">
                          
                    <div class="progress-bar" style="width: 70%"></div>
                          
                  </div>
            
                </div>

              </div>
        
            </div>

            <div class="col-lg-6 col-xs-6">
          
              <div class="small-box bg-green" style="margin-bottom: 0;">
            
                <div class="inner">
              
                  <h3><sup style="font-size: 20px">{!! $jobTopicSection -> views_quantity !!}</sup></h3>

                  <p>Views Quantity</p>
            
                </div>
            
                <div class="icon">
              
                  <i class="ion ion-stats-bars"></i>
            
                </div>
                
                <a href = "#job_topic_section_views_history" data-toggle="tab" class="small-box-footer">
            
                  More Information
            
                </a>
          
              </div>
        
            </div>

            <div class="col-lg-6 col-xs-6">
          
              <div class="small-box bg-red" style="margin-bottom: 0;">
            
                <div class="inner">
              
                  <h3><sup style="font-size: 20px">{!! $jobTopicSection -> updates_quantity !!}</sup></h3>

                  <p>Updates Quantity</p>
            
                </div>
            
                <div class="icon">
              
                  <i class="ion ion-pie-graph"></i>
            
                </div>
            
                <a href = "#job_topic_section_updates_history" data-toggle="tab" class="small-box-footer">
            
                  More Information
            
                </a>
          
              </div>
        
            </div>

          </div>

          <div class = "tab-pane" id = "job_topic_section_views_history">

            <div class="box box-primary" style="margin-bottom: 0;">

              <div class="box-body">
              
                <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">

                  <div class="row">

                    <div class="col-sm-12">
                      
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
                    
                            @foreach($jobTopicSectionViews as $jobTopicSectionView)
  
                              <tr role="row" class="odd">
                              
                                <td class=""> {!! $jobTopicSectionView->name !!} </td>
                                <td class=""> {!! $jobTopicSectionView->email !!} </td>
                                <td class=""> {!! $jobTopicSectionView->datetime !!} </td>
                  
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

          <div class = "tab-pane" id = "job_topic_section_updates_history">

            <div class="box box-primary" style="margin-bottom: 0;">

              <div class="box-body">
              
                <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">

                  <div class="row">

                    <div class="col-sm-12">
                      
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
                            
                            @foreach($jobTopicSectionUpdates as $jobTopicSectionUpdate)
  
                              <tr role="row" class="odd">
                              
                                <td class=""> {!! $jobTopicSectionUpdate->actual_name !!} </td>
                                <td class=""> {!! $jobTopicSectionUpdate->past_name !!} </td>
                                <td class=""> {!! $jobTopicSectionUpdate->name !!} </td>
                                <td class=""> {!! $jobTopicSectionUpdate->email !!} </td>
                                <td class="sorting_1"> {!! $jobTopicSectionUpdate->datetime !!} </td>
                  
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
    
    <div class="col-md-12">
          
      <div class="nav-tabs-custom" style="margin-bottom: 0;">
            
        <ul class="nav nav-tabs">

          <li class = "active"><a href="#job_topic_section_section_files" data-toggle="tab"> Job Files </a></li>
          <li><a href="#job_topic_section_section_notes" data-toggle="tab"> Job Notes </a></li>
          <li><a href="#job_topic_section_section_galeries" data-toggle="tab"> Job Galeries </a></li>
          <li><a href="#job_topic_section_section_playlists" data-toggle="tab"> Job Playlists </a></li>
          <li><a href="#job_topic_section_section_tools" data-toggle="tab"> Job Tools </a></li>

        </ul>
            
        <div class="tab-content">

          <div class = "tab-pane active" id = "job_topic_section_section_files">

            @include('job_t_s_files.filtered_table')
            
            <div class="mailbox-controls" style="margin: 10px 0;">
                              
              <div class="btn-group">
                                  
              </div>
                                
              <div class="pull-right">
                                
                1-50
                                  
                <div class="btn-group">
                                    
                  @if($job_file_p < 1)
                        
                    <a href = "http://desmus-jmsp.c9users.io/jobTopicSections/{!! $id !!}?job_file_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                    <a href = "http://desmus-jmsp.c9users.io/jobTopicSections/{!! $id !!}?job_file_p=2" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                        
                  @endif
                        
                  @if($job_file_p == 1)
                                    
                    <a href = "http://desmus-jmsp.c9users.io/jobTopicSections/{!! $id !!}?job_file_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                    <a href = "http://desmus-jmsp.c9users.io/jobTopicSections/{!! $id !!}?job_file_p={!! $job_file_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>

                  @endif
                        
                  @if($job_file_p > 1)
                        
                    <a href = "http://desmus-jmsp.c9users.io/jobTopicSections/{!! $id !!}?job_file_p={!! $job_file_p - 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                    <a href = "http://desmus-jmsp.c9users.io/jobTopicSections/{!! $id !!}?job_file_p={!! $job_file_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                          
                  @endif
                                    
                </div>
                                
              </div>
                                
            </div>

          </div>

          <div class = "tab-pane" id = "job_topic_section_section_notes">

            @include('job_t_s_notes.filtered_table')
            
            <div class="mailbox-controls" style="margin: 10px 0;">
                              
              <div class="btn-group">
                                  
              </div>
                                
              <div class="pull-right">
                                
                1-50
                                  
                <div class="btn-group">
                                    
                  @if($job_note_p < 1)
                        
                    <a href = "http://desmus-jmsp.c9users.io/jobTopicSections/{!! $id !!}?job_note_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                    <a href = "http://desmus-jmsp.c9users.io/jobTopicSections/{!! $id !!}?job_note_p=2" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                        
                  @endif
                        
                  @if($job_note_p == 1)
                                    
                    <a href = "http://desmus-jmsp.c9users.io/jobTopicSections/{!! $id !!}?job_note_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                    <a href = "http://desmus-jmsp.c9users.io/jobTopicSections/{!! $id !!}?job_note_p={!! $job_note_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>

                  @endif
                        
                  @if($job_note_p > 1)
                        
                    <a href = "http://desmus-jmsp.c9users.io/jobTopicSections/{!! $id !!}?job_note_p={!! $job_note_p - 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                    <a href = "http://desmus-jmsp.c9users.io/jobTopicSections/{!! $id !!}?job_note_p={!! $job_note_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                          
                  @endif
                                    
                </div>
                                
              </div>
                                
            </div>

          </div>

          <div class = "tab-pane" id = "job_topic_section_section_galeries">

            @include('job_t_s_galeries.filtered_table')
            
            <div class="mailbox-controls" style="margin: 10px 0;">
                              
              <div class="btn-group">
                                  
              </div>
                                
              <div class="pull-right">
                                
                1-50
                                  
                <div class="btn-group">
                                    
                  @if($job_galery_p < 1)
                        
                    <a href = "http://desmus-jmsp.c9users.io/jobTopicSections/{!! $id !!}?job_galery_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                    <a href = "http://desmus-jmsp.c9users.io/jobTopicSections/{!! $id !!}?job_galery_p=2" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                        
                  @endif
                        
                  @if($job_galery_p == 1)
                                    
                    <a href = "http://desmus-jmsp.c9users.io/jobTopicSections/{!! $id !!}?job_galery_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                    <a href = "http://desmus-jmsp.c9users.io/jobTopicSections/{!! $id !!}?job_galery_p={!! $job_galery_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>

                  @endif
                        
                  @if($job_galery_p > 1)
                        
                    <a href = "http://desmus-jmsp.c9users.io/jobTopicSections/{!! $id !!}?job_galery_p={!! $job_galery_p - 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                    <a href = "http://desmus-jmsp.c9users.io/jobTopicSections/{!! $id !!}?job_galery_p={!! $job_galery_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                          
                  @endif
                                    
                </div>
                                
              </div>
                                
            </div>

          </div>
          
          <div class = "tab-pane" id = "job_topic_section_section_playlists">

            @include('job_t_s_playlists.filtered_table')
            
            <div class="mailbox-controls" style="margin: 10px 0;">
                              
              <div class="btn-group">
                                  
              </div>
                                
              <div class="pull-right">
                                
                1-50
                                  
                <div class="btn-group">
                                    
                  @if($job_playlist_p < 1)
                        
                    <a href = "http://desmus-jmsp.c9users.io/jobTopicSections/{!! $id !!}?job_playlist_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                    <a href = "http://desmus-jmsp.c9users.io/jobTopicSections/{!! $id !!}?job_playlist_p=2" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                        
                  @endif
                        
                  @if($job_playlist_p == 1)
                                    
                    <a href = "http://desmus-jmsp.c9users.io/jobTopicSections/{!! $id !!}?job_playlist_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                    <a href = "http://desmus-jmsp.c9users.io/jobTopicSections/{!! $id !!}?job_playlist_p={!! $job_playlist_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>

                  @endif
                        
                  @if($job_playlist_p > 1)
                        
                    <a href = "http://desmus-jmsp.c9users.io/jobTopicSections/{!! $id !!}?job_playlist_p={!! $job_playlist_p - 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                    <a href = "http://desmus-jmsp.c9users.io/jobTopicSections/{!! $id !!}?job_playlist_p={!! $job_playlist_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                          
                  @endif
                                    
                </div>
                                
              </div>
                                
            </div>

          </div>

          <div class = "tab-pane" id = "job_topic_section_section_tools">

            @include('job_t_s_tools.filtered_table')
            
            <div class="mailbox-controls" style="margin: 10px 0;">
                              
              <div class="btn-group">
                                  
              </div>
                                
              <div class="pull-right">
                                
                1-50
                                  
                <div class="btn-group">
                                    
                  @if($job_tool_p < 1)
                        
                    <a href = "http://desmus-jmsp.c9users.io/jobTopicSections/{!! $id !!}?job_tool_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                    <a href = "http://desmus-jmsp.c9users.io/jobTopicSections/{!! $id !!}?job_tool_p=2" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                        
                  @endif
                        
                  @if($job_tool_p == 1)
                                    
                    <a href = "http://desmus-jmsp.c9users.io/jobTopicSections/{!! $id !!}?job_tool_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                    <a href = "http://desmus-jmsp.c9users.io/jobTopicSections/{!! $id !!}?job_tool_p={!! $job_tool_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>

                  @endif
                        
                  @if($job_tool_p > 1)
                        
                    <a href = "http://desmus-jmsp.c9users.io/jobTopicSections/{!! $id !!}?job_tool_p={!! $job_tool_p - 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                    <a href = "http://desmus-jmsp.c9users.io/jobTopicSections/{!! $id !!}?job_tool_p={!! $job_tool_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                          
                  @endif
                                    
                </div>
                                
              </div>
                                
            </div>

          </div>

        </div>

      </div>
        
    </div>
            
  </div>

</section>