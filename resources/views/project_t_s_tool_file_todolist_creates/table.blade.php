<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projectTSToolFileTodolistCreates-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>P T S T F T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($projectTSToolFileTodolistCreates as $projectTSToolFileTodolistCreate)
          
        <tr>
              
          <td>{!! $projectTSToolFileTodolistCreate->datetime !!}</td>
          <td>{!! $projectTSToolFileTodolistCreate->user_id !!}</td>
          <td>{!! $projectTSToolFileTodolistCreate->p_t_s_t_f_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('projectTSToolFileTodolistCreates.show', [$projectTSToolFileTodolistCreate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>