<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projectTSGImageTodolistDeletes-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>P T S G I T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($projectTSGImageTodolistDeletes as $projectTSGImageTodolistDelete)
          
        <tr>
              
          <td>{!! $projectTSGImageTodolistDelete->datetime !!}</td>
          <td>{!! $projectTSGImageTodolistDelete->user_id !!}</td>
          <td>{!! $projectTSGImageTodolistDelete->p_t_s_g_i_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('projectTSGImageTodolistDeletes.show', [$projectTSGImageTodolistDelete->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
    
  </table>
  
</div>