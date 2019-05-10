<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobTopicSectionTodolists-table">
      
    <thead>
          
      <tr>
              
        <th>Name</th>
        <th>Description</th>
        <th>Views Quantity</th>
        <th>Updates Quantity</th>
        <th>Status</th>
        <th>Datetime</th>
        <th>Job Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($jobTopicSectionTodolists as $jobTopicSectionTodolist)
          
        <tr>
              
          <td>{!! $jobTopicSectionTodolist->name !!}</td>
          <td>{!! $jobTopicSectionTodolist->description !!}</td>
          <td>{!! $jobTopicSectionTodolist->views_quantity !!}</td>
          <td>{!! $jobTopicSectionTodolist->updates_quantity !!}</td>
          <td>{!! $jobTopicSectionTodolist->status !!}</td>
          <td>{!! $jobTopicSectionTodolist->datetime !!}</td>
          <td>{!! $jobTopicSectionTodolist->job_id !!}</td>
              
          <td>
                  
            {!! Form::open(['route' => ['jobTopicSectionTodolists.destroy', $jobTopicSectionTodolist->id], 'method' => 'delete']) !!}
                  
              <div class='btn-group'>
                      
                <a href="{!! route('jobTopicSectionTodolists.show', [$jobTopicSectionTodolist->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                <a href="{!! route('jobTopicSectionTodolists.edit', [$jobTopicSectionTodolist->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                      
                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                  
              </div>
                  
            {!! Form::close() !!}
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>