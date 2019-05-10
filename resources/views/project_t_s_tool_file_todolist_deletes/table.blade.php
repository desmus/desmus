<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projectTSToolFileTodolistDeletes-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>P T S T F T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
    
    </thead>
      
    <tbody>
      
      @foreach($projectTSToolFileTodolistDeletes as $projectTSToolFileTodolistDelete)
          
        <tr>
              
          <td>{!! $projectTSToolFileTodolistDelete->datetime !!}</td>
          <td>{!! $projectTSToolFileTodolistDelete->user_id !!}</td>
          <td>{!! $projectTSToolFileTodolistDelete->p_t_s_t_f_t_id !!}</td>
          
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('projectTSToolFileTodolistDeletes.show', [$projectTSToolFileTodolistDelete->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>