<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobTSFileTodolistUpdates-table">
      
    <thead>
          
      <tr>
        
        <th>Actual Name</th>
        <th>Past Name</th>
        <th>Datetime</th>
        <th>User Id</th>
        <th>J T S F T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($jobTSFileTodolistUpdates as $jobTSFileTodolistUpdate)
          
        <tr>
              
          <td>{!! $jobTSFileTodolistUpdate->actual_name !!}</td>
          <td>{!! $jobTSFileTodolistUpdate->past_name !!}</td>
          <td>{!! $jobTSFileTodolistUpdate->datetime !!}</td>
          <td>{!! $jobTSFileTodolistUpdate->user_id !!}</td>
          <td>{!! $jobTSFileTodolistUpdate->j_t_s_f_t_id !!}</td>
          
          <td>
                  
            <div class='btn-group'>
              
              <a href="{!! route('jobTSFileTodolistUpdates.show', [$jobTSFileTodolistUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
        
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>

</div>