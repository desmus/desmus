<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobTSToolFileTodolistUpdates-table">
      
    <thead>
          
      <tr>
              
        <th>Actual Name</th>
        <th>Past Name</th>
        <th>Datetime</th>
        <th>User Id</th>
        <th>J T S T F T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
    
    <tbody>
      
      @foreach($jobTSToolFileTodolistUpdates as $jobTSToolFileTodolistUpdate)
          
        <tr>
              
          <td>{!! $jobTSToolFileTodolistUpdate->actual_name !!}</td>
          <td>{!! $jobTSToolFileTodolistUpdate->past_name !!}</td>
          <td>{!! $jobTSToolFileTodolistUpdate->datetime !!}</td>
          <td>{!! $jobTSToolFileTodolistUpdate->user_id !!}</td>
          <td>{!! $jobTSToolFileTodolistUpdate->j_t_s_t_f_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('jobTSToolFileTodolistUpdates.show', [$jobTSToolFileTodolistUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>