<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projectTSGaleryTodolistUpdates-table">
      
    <thead>
          
      <tr>
              
        <th>Actual Name</th>
        <th>Past Name</th>
        <th>Datetime</th>
        <th>User Id</th>
        <th>P T S G T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($projectTSGaleryTodolistUpdates as $projectTSGaleryTodolistUpdate)
          
        <tr>
              
          <td>{!! $projectTSGaleryTodolistUpdate->actual_name !!}</td>
          <td>{!! $projectTSGaleryTodolistUpdate->past_name !!}</td>
          <td>{!! $projectTSGaleryTodolistUpdate->datetime !!}</td>
          <td>{!! $projectTSGaleryTodolistUpdate->user_id !!}</td>
          <td>{!! $projectTSGaleryTodolistUpdate->p_t_s_g_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
            
              <a href="{!! route('projectTSGaleryTodolistUpdates.show', [$projectTSGaleryTodolistUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>