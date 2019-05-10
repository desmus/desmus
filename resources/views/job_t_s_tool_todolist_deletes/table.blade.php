<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobTSToolTodolistDeletes-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>J T S T T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($jobTSToolTodolistDeletes as $jobTSToolTodolistDelete)
        
        <tr>
              
          <td>{!! $jobTSToolTodolistDelete->datetime !!}</td>
          <td>{!! $jobTSToolTodolistDelete->user_id !!}</td>
          <td>{!! $jobTSToolTodolistDelete->j_t_s_t_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('jobTSToolTodolistDeletes.show', [$jobTSToolTodolistDelete->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>