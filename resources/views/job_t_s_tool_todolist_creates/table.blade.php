<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobTSToolTodolistCreates-table">
      
    <thead>
      
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>J T S T T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($jobTSToolTodolistCreates as $jobTSToolTodolistCreate)
          
        <tr>
              
          <td>{!! $jobTSToolTodolistCreate->datetime !!}</td>
          <td>{!! $jobTSToolTodolistCreate->user_id !!}</td>
          <td>{!! $jobTSToolTodolistCreate->j_t_s_t_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('jobTSToolTodolistCreates.show', [$jobTSToolTodolistCreate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>