<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobTopicTodolistUpdates-table">
      
    <thead>
          
      <tr>
              
        <th>Actual Name</th>
        <th>Past Name</th>
        <th>Datetime</th>
        <th>User Id</th>
        <th>J T T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($jobTopicTodolistUpdates as $jobTopicTodolistUpdate)
          
        <tr>
              
          <td>{!! $jobTopicTodolistUpdate->actual_name !!}</td>
          <td>{!! $jobTopicTodolistUpdate->past_name !!}</td>
          <td>{!! $jobTopicTodolistUpdate->datetime !!}</td>
          <td>{!! $jobTopicTodolistUpdate->user_id !!}</td>
          <td>{!! $jobTopicTodolistUpdate->c_t_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
                      
              <a href="{!! route('jobTopicTodolistUpdates.show', [$jobTopicTodolistUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
            
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>