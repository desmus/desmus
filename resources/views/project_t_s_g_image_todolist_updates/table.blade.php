<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projectTSGImageTodolistUpdates-table">
      
    <thead>
          
      <tr>
              
        <th>Actual Name</th>
        <th>Past Name</th>
        <th>Datetime</th>
        <th>User Id</th>
        <th>P T S G I T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($projectTSGImageTodolistUpdates as $projectTSGImageTodolistUpdate)
        
        <tr>
              
          <td>{!! $projectTSGImageTodolistUpdate->actual_name !!}</td>
          <td>{!! $projectTSGImageTodolistUpdate->past_name !!}</td>
          <td>{!! $projectTSGImageTodolistUpdate->datetime !!}</td>
          <td>{!! $projectTSGImageTodolistUpdate->user_id !!}</td>
          <td>{!! $projectTSGImageTodolistUpdate->p_t_s_g_i_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('projectTSGImageTodolistUpdates.show', [$projectTSGImageTodolistUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>