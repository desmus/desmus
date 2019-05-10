<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projectTSToolTodolistCreates-table">
      
    <thead>
      
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>P T S T T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($projectTSToolTodolistCreates as $projectTSToolTodolistCreate)
          
        <tr>
              
          <td>{!! $projectTSToolTodolistCreate->datetime !!}</td>
          <td>{!! $projectTSToolTodolistCreate->user_id !!}</td>
          <td>{!! $projectTSToolTodolistCreate->p_t_s_t_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('projectTSToolTodolistCreates.show', [$projectTSToolTodolistCreate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>