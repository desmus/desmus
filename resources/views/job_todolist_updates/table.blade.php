<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobTodolistUpdates-table">
      
    <thead>
          
      <tr>
              
        <th>Actual Name</th>
        <th>Past Name</th>
        <th>Datetime</th>
        <th>User Id</th>
        <th>J T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($jobTodolistUpdates as $jobTodolistUpdate)
          
        <tr>
              
          <td>{!! $jobTodolistUpdate->actual_name !!}</td>
          <td>{!! $jobTodolistUpdate->past_name !!}</td>
          <td>{!! $jobTodolistUpdate->datetime !!}</td>
          <td>{!! $jobTodolistUpdate->user_id !!}</td>
          <td>{!! $jobTodolistUpdate->j_t_id !!}</td>
              
          <td>
                  
            <div class='btn-group'>
                      
              <a href="{!! route('jobTodolistUpdates.show', [$jobTodolistUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                                      
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>

</div>