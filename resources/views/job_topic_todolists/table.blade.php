<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobTopicTodolists-table">
      
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
      
      @foreach($jobTopicTodolists as $jobTopicTodolist)
          
        <tr>
              
          <td>{!! $jobTopicTodolist->name !!}</td>
          <td>{!! $jobTopicTodolist->description !!}</td>
          <td>{!! $jobTopicTodolist->views_quantity !!}</td>
          <td>{!! $jobTopicTodolist->updates_quantity !!}</td>
          <td>{!! $jobTopicTodolist->status !!}</td>
          <td>{!! $jobTopicTodolist->datetime !!}</td>
          <td>{!! $jobTopicTodolist->job_id !!}</td>
              
          <td>
                  
            <div class='btn-group'>
                      
              <a href="{!! route('jobTopicTodolists.show', [$jobTopicTodolist->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>