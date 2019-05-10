<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projectTodolistUpdates-table">
      
    <thead>
          
      <tr>
              
        <th>Actual Name</th>
        <th>Past Name</th>
        <th>Datetime</th>
        <th>User Id</th>
        <th>P T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($projectTodolistUpdates as $projectTodolistUpdate)
          
        <tr>
              
          <td>{!! $projectTodolistUpdate->actual_name !!}</td>
          <td>{!! $projectTodolistUpdate->past_name !!}</td>
          <td>{!! $projectTodolistUpdate->datetime !!}</td>
          <td>{!! $projectTodolistUpdate->user_id !!}</td>
          <td>{!! $projectTodolistUpdate->p_t_id !!}</td>
              
          <td>
                  
            <div class='btn-group'>
                      
              <a href="{!! route('projectTodolistUpdates.show', [$projectTodolistUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                                      
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>

</div>