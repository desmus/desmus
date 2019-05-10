<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobTSGImageTodolistUpdates-table">
      
    <thead>
          
      <tr>
              
        <th>Actual Name</th>
        <th>Past Name</th>
        <th>Datetime</th>
        <th>User Id</th>
        <th>J T S G I T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($jobTSGImageTodolistUpdates as $jobTSGImageTodolistUpdate)
        
        <tr>
              
          <td>{!! $jobTSGImageTodolistUpdate->actual_name !!}</td>
          <td>{!! $jobTSGImageTodolistUpdate->past_name !!}</td>
          <td>{!! $jobTSGImageTodolistUpdate->datetime !!}</td>
          <td>{!! $jobTSGImageTodolistUpdate->user_id !!}</td>
          <td>{!! $jobTSGImageTodolistUpdate->j_t_s_g_i_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('jobTSGImageTodolistUpdates.show', [$jobTSGImageTodolistUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>