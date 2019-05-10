<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projectTSToolFileTodolistUpdates-table">
      
    <thead>
          
      <tr>
              
        <th>Actual Name</th>
        <th>Past Name</th>
        <th>Datetime</th>
        <th>User Id</th>
        <th>P T S T F T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
    
    <tbody>
      
      @foreach($projectTSToolFileTodolistUpdates as $projectTSToolFileTodolistUpdate)
          
        <tr>
              
          <td>{!! $projectTSToolFileTodolistUpdate->actual_name !!}</td>
          <td>{!! $projectTSToolFileTodolistUpdate->past_name !!}</td>
          <td>{!! $projectTSToolFileTodolistUpdate->datetime !!}</td>
          <td>{!! $projectTSToolFileTodolistUpdate->user_id !!}</td>
          <td>{!! $projectTSToolFileTodolistUpdate->p_t_s_t_f_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('projectTSToolFileTodolistUpdates.show', [$projectTSToolFileTodolistUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>