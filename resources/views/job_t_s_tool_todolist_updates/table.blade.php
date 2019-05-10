<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobTSToolTodolistUpdates-table">
      
    <thead>
          
      <tr>
              
        <th>Actual Name</th>
        <th>Past Name</th>
        <th>Datetime</th>
        <th>User Id</th>
        <th>J T S T T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($jobTSToolTodolistUpdates as $jobTSToolTodolistUpdate)
        
        <tr>
              
          <td>{!! $jobTSToolTodolistUpdate->actual_name !!}</td>
          <td>{!! $jobTSToolTodolistUpdate->past_name !!}</td>
          <td>{!! $jobTSToolTodolistUpdate->datetime !!}</td>
          <td>{!! $jobTSToolTodolistUpdate->user_id !!}</td>
          <td>{!! $jobTSToolTodolistUpdate->j_t_s_t_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('jobTSToolTodolistUpdates.show', [$jobTSToolTodolistUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
    
      @endforeach
      
    </tbody>
  
  </table>
  
</div>