<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projectTSGImageTodolistCreates-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>P T S G I T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($projectTSGImageTodolistCreates as $projectTSGImageTodolistCreate)
          
        <tr>
              
          <td>{!! $projectTSGImageTodolistCreate->datetime !!}</td>
          <td>{!! $projectTSGImageTodolistCreate->user_id !!}</td>
          <td>{!! $projectTSGImageTodolistCreate->p_t_s_g_i_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
                      
              <a href="{!! route('projectTSGImageTodolistCreates.show', [$projectTSGImageTodolistCreate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>