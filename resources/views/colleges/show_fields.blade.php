{!! Form::open(['route' => 'collegeTodolists.store', 'id' => 'college_todolist_create']) !!}

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
              
            {!! Form::hidden('college_id', 'College Id:') !!}
            {!! Form::hidden('college_id', $id, ['class' => 'form-control']) !!}
              
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

          <li class = "active"><a href="#college_topic" data-toggle="tab"> Topics </a></li>
          <li><a href="#college_info" data-toggle="tab"> Information </a></li>
          <li><a href="#college_specific_info" data-toggle="tab"> Specific Information </a></li>
          <li><a href="#college_tasks" data-toggle="tab"> Tasks </a></li>
          <li><a href="#college_statistics" data-toggle="tab"> Statistics </a></li>
          <li><a href="#college_most_viewed" data-toggle="tab"> Most Viewed </a></li>
          <li><a href="#college_views_history" data-toggle="tab"> Views History </a></li>
          <li><a href="#college_updates_history" data-toggle="tab"> Updates History </a></li>

        </ul>

        <div class="tab-content clearfix">

          <div class = "tab-pane active" id = "college_topic">

            @include('college_topics.filtered_table')
            
            <div class="mailbox-controls" style="margin-top: 10px;">
                              
              <div class="btn-group">
                                  
              </div>
                                
              <div class="pull-right">
                                
                1-50
                                  
                <div class="btn-group">
                                    
                  @if($college_topic_p < 1)
                        
                    <a href = "http://desmus-jmsp.c9users.io/colleges/{!! $id !!}?college_topic_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                    <a href = "http://desmus-jmsp.c9users.io/colleges/{!! $id !!}?college_topic_p=2" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                        
                  @endif
                        
                  @if($college_topic_p == 1)
                                    
                    <a href = "http://desmus-jmsp.c9users.io/colleges/{!! $id !!}?college_topic_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                    <a href = "http://desmus-jmsp.c9users.io/colleges/{!! $id !!}?college_topic_p={!! $college_topic_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>

                  @endif
                        
                  @if($college_topic_p > 1)
                        
                    <a href = "http://desmus-jmsp.c9users.io/colleges/{!! $id !!}?college_topic_p={!! $college_topic_p - 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                    <a href = "http://desmus-jmsp.c9users.io/colleges/{!! $id !!}?college_topic_p={!! $college_topic_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                          
                  @endif
                                    
                </div>
                                
              </div>
                                
            </div>

          </div>
          
          <div class = "tab-pane" id = "college_info">
            
            <div class="form-group">
              {!! Form::label('name', 'Name:') !!}
              <p>{!! $college->name !!}</p>
            </div>
            
            <div class="form-group">
              {!! Form::label('user_name', 'User Name:') !!}
              <p>{!! $user[0]->name !!}</p>
            </div>
            
            <div class="form-group">
              {!! Form::label('user_email', 'User Email:') !!}
              <p>{!! $user[0]->email !!}</p>
            </div>
            
            <div class="form-group">
              {!! Form::label('created_at', 'Created At:') !!}
              <p>{!! $college->created_at !!}</p>
            </div>
            
            <div class="form-group">
              {!! Form::label('updated_at', 'Updated At:') !!}
              <p>{!! $college->updated_at !!}</p>
            </div>
            
          </div>

          <div class = "tab-pane" id = "college_specific_info">

            <div id="toolbar-container"></div>

            {!! Form::model($college, ['route' => ['colleges.update', $college->id], 'method' => 'patch']) !!}

              <div class = "form-group" id="editor"> {!! $college->specific_info !!} </div>

              <textarea id = "text" name = "specific_info" hidden> </textarea>

              <input type = "datetime" name = "updated_at" value = "{!! $now !!}" hidden>

              <div class="form-group col-sm-12" style="margin-bottom: 0;">
                {!! Form::submit('Save', ['class' => 'btn btn-primary pull-right']) !!}
              </div>

            {!! Form::close() !!}

          </div>

          <div class = "tab-pane" id = "college_tasks">
          
            <div class="box box-primary" style="position: relative; left: 0px; top: 0px;">
          
              <div class="box-header ui-sortable-handle" style="cursor: move;">
              
                <i class="ion ion-clipboard"></i>
                <h3 class="box-title">To Do List</h3>
                
              </div>
              
              <div class="box-body">
                
                <ul class="todo-list ui-sortable">
                  
                  @foreach($collegeTodolist as $task)
                  
                    <a href = "{!! route('collegeTodolists.show', [$task->id]) !!}">
                  
                      <li>
                        
                        <span class="handle ui-sortable-handle">
                          
                          <i class="fa fa-ellipsis-v"></i>
                          <i class="fa fa-ellipsis-v"></i>
                          
                        </span>
                        
                        <span class="text">{{ $task -> name }}   ---   {{ $task -> datetime }}</span>
                        
                        <div class="tools">
                          
                          {!! Form::open(['route' => ['collegeTodolists.destroy', $task->id], 'method' => 'delete']) !!}
                          
                            <a class='btn btn-default btn-xs' href = "{!! route('collegeTodolists.edit', [$task->id]) !!}"> <i class="fa fa-edit"></i> </a>
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
                  
                  @foreach($collegeTodolistCompleted as $task)
                  
                    <a href = "{!! route('collegeTodolists.show', [$task->id]) !!}">
                  
                      <li>
                        
                        <span class="handle ui-sortable-handle">
                          
                          <i class="fa fa-ellipsis-v"></i>
                          <i class="fa fa-ellipsis-v"></i>
                          
                        </span>
                        
                        <span class="text">{{ $task -> name }}   ---   {{ $task -> datetime }}</span>
                        
                        <div class="tools">
                          
                          {!! Form::open(['route' => ['collegeTodolists.destroy', $task->id], 'method' => 'delete']) !!}
                          
                            <a class='btn btn-default btn-xs' href = "{!! route('collegeTodolists.edit', [$task->id]) !!}"> <i class="fa fa-edit"></i> </a>
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

          <div class = "tab-pane" id = "college_statistics">

            <div class="col-lg-4 col-xs-4">
          
              <div class="small-box bg-yellow" style="margin-bottom: 0;">
            
                <div class="inner">
              
                  <h3><sup style="font-size: 20px">{!! $collegeTopicCount !!}</sup></h3>

                  <p>Topics Quantity</p>
            
                </div>
            
                <div class="icon">
              
                  <i class="ion ion-stats-bars"></i>
            
                </div>
            
                <a href = "#college_topic" data-toggle="tab" class="small-box-footer">
            
                  More Information
            
                </a>
          
              </div>
        
            </div>

            <div class="col-lg-4 col-xs-4">
          
              <div class="small-box bg-green" style="margin-bottom: 0;">
            
                <div class="inner">
              
                  <h3><sup style="font-size: 20px">{!! $college -> views_quantity !!}</sup></h3>

                  <p>Views Quantity</p>
            
                </div>
            
                <div class="icon">
              
                  <i class="ion ion-stats-bars"></i>
            
                </div>
            
                <a href = "#college_views_history" data-toggle="tab" class="small-box-footer">
            
                  More Information
            
                </a>
          
              </div>
        
            </div>

            <div class="col-lg-4 col-xs-4">
          
              <div class="small-box bg-red" style="margin-bottom: 0;">
            
                <div class="inner">
              
                  <h3><sup style="font-size: 20px">{!! $college -> updates_quantity !!}</sup></h3>

                  <p>Updates Quantity</p>
            
                </div>
            
                <div class="icon">
              
                  <i class="ion ion-stats-bars"></i>
            
                </div>
            
                <a href = "#college_updates_history" data-toggle="tab" class="small-box-footer">
            
                  More Information
            
                </a>
          
              </div>
        
            </div>

          </div>

          <div class = "tab-pane" id = "college_most_viewed">

            <div class="box box-primary col-sm-6">
            
              <div class="box-header with-border">
              
                <h3 class="box-title">Most Viewed Topics</h3>
            
              </div>

              <div class="box-body">
              
                <ul class="products-list product-list-in-box">

                  @foreach($collegeTopicList as $topic)
                
                    <li class="item">
                  
                      <div class="product-info">
                    
                        <a href="{!! route('collegeTopics.show', [$topic -> id]) !!}" class="product-title">       
                          <span class="label label-warning pull-right">{!! $topic -> views_quantity !!}</span>
                        </a>
                
                        <a href = "{!! route('collegeTopics.show', [$topic -> id]) !!}">
                          <span class="product-description">
                            {!! $topic->name !!}
                          </span>
                        </a>
                  
                      </div>
                
                    </li>

                  @endforeach
        
                </ul>
            
              </div>
          
            </div>

            <div class="box box-primary col-sm-6" style="margin-bottom: 10px;">
            
              <div class="box-header with-border">
              
                <h3 class="box-title">Most Viewed Sections</h3>
            
              </div>

              <div class="box-body">
              
                <ul class="products-list product-list-in-box">

                  @foreach($collegeTopicSectionList as $section)
                
                    <li class="item">
                  
                      <div class="product-info">
                    
                        <a href="{!! route('collegeTopicSections.show', [$section -> id]) !!}" class="product-title">       
                          <span class="label label-warning pull-right">{!! $section -> views_quantity !!}</span>
                        </a>
                
                        <a href = "{!! route('collegeTopicSections.show', [$section -> id]) !!}">
                          <span class="product-description">
                            {!! $section->name !!}
                          </span>
                        </a>
                  
                      </div>
                
                    </li>

                  @endforeach
        
                </ul>
            
              </div>
          
            </div>

          </div>
          
          <div class = "tab-pane" id = "college_views_history">

            <div class="box box-primary" style="margin-bottom: 0;">

              <div class="box-body">
              
                <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">

                  <div class="row">

                    <div class="col-sm-12">
                      
                      <div class="table-responsive">

                        <table id="example1" class="table table-hover table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info" style="margin-bottom: 0;">
                  
                          <thead>
                  
                            <tr role="row">
  
                              <th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 224px;" aria-sort="descending"> Username </th>
                              <th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 224px;" aria-sort="descending"> Email </th>
                              <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending" style="width: 182px;"> Datetime </th>
                              
                            </tr>
                  
                          </thead>
                  
                          <tbody>
                    
                            @foreach($collegeViews as $collegeView)
  
                              <tr role="row" class="odd">
                              
                                <td class=""> {!! $collegeView->name !!} </td>
                                <td class=""> {!! $collegeView->email !!} </td>
                                <td class=""> {!! $collegeView->datetime !!} </td>
                  
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

          <div class = "tab-pane" id = "college_updates_history">

            <div class="box box-primary" style="margin-bottom: 0;">

              <div class="box-body">
              
                <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">

                  <div class="row">

                    <div class="col-sm-12">
                      
                      <div class="table-responsive">

                        <table id="example1" class="table table-hover table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info" style="margin-bottom: 0;">
                  
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
                    
                            @foreach($collegeUpdates as $collegeUpdate)
  
                              <tr role="row" class="odd">
                              
                                <td class=""> {!! $collegeUpdate->actual_name !!} </td>
                                <td class=""> {!! $collegeUpdate->past_name !!} </td>
                                <td class=""> {!! $collegeUpdate->name !!} </td>
                                <td class=""> {!! $collegeUpdate->email !!} </td>
                                <td class="sorting_1"> {!! $collegeUpdate->datetime !!} </td>
                  
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