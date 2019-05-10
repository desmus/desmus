{!! Form::open(['route' => 'projectTSPTodolists.store', 'id' => 'project_t_s_p_todolist_create']) !!}

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
              
            <div class="form-group col-sm-6">
              {!! Form::hidden('p_t_s_p_id', 'Id:') !!}
              {!! Form::hidden('p_t_s_p_id', $id, ['class' => 'form-control']) !!}
            </div>
              
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

<section class="content" style="min-height: 30px;">

  <div class="row">
 
    <div class="col-md-12">
          
      <div class="nav-tabs-custom" style="margin-bottom: 0;">
            
        <ul class="nav nav-tabs">

          <li><a href="#project_topic_section_playlist_info" data-toggle="tab"> Playlist Information </a></li>
          <li class = "active"><a href="#project_topic_section_playlist_preview" data-toggle="tab"> Playlist Preview </a></li>
          <li><a href="#project_topic_section_playlist_tasks" data-toggle="tab"> Tasks </a></li>
          <li><a href="#project_topic_section_playlist_views_history" data-toggle="tab"> Views History </a></li>
          <li><a href="#project_topic_section_playlist_updates_history" data-toggle="tab"> Updates History </a></li>
          
          @if($user[0] -> id == $user_id)
          
            <li><a href="{!! route('projectTSPAudios.create', [$projectTSPlaylist->id]) !!}"> Add Audio </a></li>
          
          @endif

        </ul>

        <div class="tab-content clearfix">

          <div class = "tab-pane active" id = "project_topic_section_playlist_preview">

            <div class="col-md-12" style="padding: 0;">
  
              @include('project_t_s_p_audios.filtered_table')
              
              <div class="mailbox-controls" style="margin-top: 10px;">
                              
                <div class="btn-group">
                                    
                </div>
                                  
                <div class="pull-right">
                                  
                  1-50
                                    
                  <div class="btn-group">
                                      
                    @if($project_audio_p < 1)
                        
                      <a href = "http://desmus-jmsp.c9users.io/projectTSPlaylists/{!! $id !!}?project_audio_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                      <a href = "http://desmus-jmsp.c9users.io/projectTSPlaylists/{!! $id !!}?project_audio_p=2" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                          
                    @endif
                          
                    @if($project_audio_p == 1)
                                      
                      <a href = "http://desmus-jmsp.c9users.io/projectTSPlaylists/{!! $id !!}?project_audio_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                      <a href = "http://desmus-jmsp.c9users.io/projectTSPlaylists/{!! $id !!}?project_audio_p={!! $project_audio_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
  
                    @endif
                          
                    @if($project_audio_p > 1)
                          
                      <a href = "http://desmus-jmsp.c9users.io/projectTSPlaylists/{!! $id !!}?project_audio_p={!! $project_audio_p - 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                      <a href = "http://desmus-jmsp.c9users.io/projectTSPlaylists/{!! $id !!}?project_audio_p={!! $project_audio_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                            
                    @endif
                                      
                  </div>
                                  
                </div>
                                  
              </div>

            </div>
            
          </div>
          
          <div class = "tab-pane" id = "project_topic_section_playlist_info">
            
            <div class="form-group">
                {!! Form::label('name', 'Name:') !!}
                <p>{!! $projectTSPlaylist->name !!}</p>
            </div>
            
            <div class="form-group">
                {!! Form::label('description', 'Description:') !!}
                <p>{!! $projectTSPlaylist->description !!}</p>
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
                <p>{!! $projectTSPlaylist->created_at !!}</p>
            </div>
            
            <div class="form-group">
                {!! Form::label('updated_at', 'Updated At:') !!}
                <p>{!! $projectTSPlaylist->updated_at !!}</p>
            </div>

          </div>
          
          <div class = "tab-pane" id = "project_topic_section_playlist_tasks">
          
            <div class="box box-primary" style="position: relative; left: 0px; top: 0px;">
          
              <div class="box-header ui-sortable-handle" style="cursor: move;">
              
                <i class="ion ion-clipboard"></i>
                <h3 class="box-title">To Do List</h3>
                
              </div>
              
              <div class="box-body">
                
                <ul class="todo-list ui-sortable">
                  
                  @foreach($projectTSPTodolist as $task)
                  
                    <a href = "{!! route('projectTSPTodolists.show', [$task->id]) !!}">
                  
                      <li>
                        
                        <span class="handle ui-sortable-handle">
                          
                          <i class="fa fa-ellipsis-v"></i>
                          <i class="fa fa-ellipsis-v"></i>
                          
                        </span>
                        
                        <span class="text">{{ $task -> name }}   ---   {{ $task -> datetime }}</span>
                        
                        <div class="tools">
                          
                          {!! Form::open(['route' => ['projectTSPTodolists.destroy', $task->id], 'method' => 'delete']) !!}
                          
                            <a class='btn btn-default btn-xs' href = "{!! route('projectTSPTodolists.edit', [$task->id]) !!}"> <i class="fa fa-edit"></i> </a>
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
                  
                  @foreach($projectTSPTodolistCompleted as $task)
                  
                    <a href = "{!! route('projectTSPTodolists.show', [$task->id]) !!}">
                  
                      <li>
                        
                        <span class="handle ui-sortable-handle">
                          
                          <i class="fa fa-ellipsis-v"></i>
                          <i class="fa fa-ellipsis-v"></i>
                          
                        </span>
                        
                        <span class="text">{{ $task -> name }}   ---   {{ $task -> datetime }}</span>
                        
                        <div class="tools">
                          
                          {!! Form::open(['route' => ['projectTSPTodolists.destroy', $task->id], 'method' => 'delete']) !!}
                          
                            <a class='btn btn-default btn-xs' href = "{!! route('projectTSPTodolists.edit', [$task->id]) !!}"> <i class="fa fa-edit"></i> </a>
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
          
          <div class = "tab-pane" id = "project_topic_section_playlist_views_history">
            
            <div class="box box-primary" style="margin-bottom: 0;">
              
              <div class="box-body">
                
                <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                  
                  <div class="row">
                    
                    <div class="col-sm-12">
                      
                      <div class="small-box bg-green">
                        
                        <div class="inner">
                          
                          <h3><sup style="font-size: 20px">{!! $projectTSPlaylist -> views_quantity !!}</sup></h3>
                          
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
                              <th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 224px;" aria-sort="descending"> Email </th>
                              <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending" style="width: 182px;"> Datetime </th>
                              
                            </tr>
                            
                          </thead>
                          
                          <tbody>
                            
                            @foreach($projectTSPlaylistViews as $projectTSPlaylistView)
                            
                              <tr role="row" class="odd">
                                
                                <td class=""> {!! $projectTSPlaylistView->name !!} </td>
                                <td class=""> {!! $projectTSPlaylistView->email !!} </td>
                                <td class=""> {!! $projectTSPlaylistView->datetime !!} </td>
                                
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
          
          <div class = "tab-pane" id = "project_topic_section_playlist_updates_history">

            <div class="box box-primary" style="margin-bottom: 0;">

              <div class="box-body">
              
                <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">

                  <div class="row">

                    <div class="col-sm-12">
          
                      <div class="small-box bg-red">
              
                        <div class="inner">
              
                          <h3><sup style="font-size: 20px">{!! $projectTSPlaylist -> updates_quantity !!}</sup></h3>

                          <p>Updates Quantity</p>
            
                        </div>
            
                        <div class="icon">
              
                          <i class="ion ion-stats-bars"></i>
            
                        </div>
        
                      </div>
                      
                      <div class="table-responsive" style="margin-bottom: 0;">

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
                            
                            @foreach($projectTSPlaylistUpdates as $projectTSPlaylistUpdate)
  
                              <tr role="row" class="odd">
                              
                                <td class=""> {!! $projectTSPlaylistUpdate->actual_name !!} </td>
                                <td class=""> {!! $projectTSPlaylistUpdate->past_name !!} </td>
                                <td class=""> {!! $projectTSPlaylistUpdate->name !!} </td>
                                <td class=""> {!! $projectTSPlaylistUpdate->email !!} </td>
                                <td class="sorting_1"> {!! $projectTSPlaylistUpdate->datetime !!} </td>
                  
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