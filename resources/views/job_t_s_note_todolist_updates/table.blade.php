<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobTSNoteTodolistUpdates-table">
      
    <thead>
          
      <tr>
              
        <th>Actual Name</th>
        <th>Past Name</th>
        <th>Datetime</th>
        <th>User Id</th>
        <th>J T S N T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
    
    </thead>
      
    <tbody>
      
      @foreach($jobTSNoteTodolistUpdates as $jobTSNoteTodolistUpdate)
          
        <tr>
              
          <td>{!! $jobTSNoteTodolistUpdate->actual_name !!}</td>
          <td>{!! $jobTSNoteTodolistUpdate->past_name !!}</td>
          <td>{!! $jobTSNoteTodolistUpdate->datetime !!}</td>
          <td>{!! $jobTSNoteTodolistUpdate->user_id !!}</td>
          <td>{!! $jobTSNoteTodolistUpdate->c_t_s_n_t_id !!}</td>
              
          <td>
                  
            <div class='btn-group'>
                      
              <a href="{!! route('jobTSNoteTodolistUpdates.show', [$jobTSNoteTodolistUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>