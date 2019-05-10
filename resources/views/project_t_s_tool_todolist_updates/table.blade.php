<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projectTSToolTodolistUpdates-table">
      
    <thead>
          
      <tr>
              
        <th>Actual Name</th>
        <th>Past Name</th>
        <th>Datetime</th>
        <th>User Id</th>
        <th>P T S T T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($projectTSToolTodolistUpdates as $projectTSToolTodolistUpdate)
        
        <tr>
              
          <td>{!! $projectTSToolTodolistUpdate->actual_name !!}</td>
          <td>{!! $projectTSToolTodolistUpdate->past_name !!}</td>
          <td>{!! $projectTSToolTodolistUpdate->datetime !!}</td>
          <td>{!! $projectTSToolTodolistUpdate->user_id !!}</td>
          <td>{!! $projectTSToolTodolistUpdate->p_t_s_t_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('projectTSToolTodolistUpdates.show', [$projectTSToolTodolistUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
    
      @endforeach
      
    </tbody>
  
  </table>
  
</div>