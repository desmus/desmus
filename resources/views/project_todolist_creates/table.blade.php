<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projectTodolistCreates-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>P T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($projectTodolistCreates as $projectTodolistCreate)
          
        <tr>
              
          <td>{!! $projectTodolistCreate->datetime !!}</td>
          <td>{!! $projectTodolistCreate->user_id !!}</td>
          <td>{!! $projectTodolistCreate->p_t_id !!}</td>
              
          <td>
                  
            <div class='btn-group'>
                      
              <a href="{!! route('projectTodolistCreates.show', [$projectTodolistCreate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
            
          </td>
          
        </tr>
      
      @endforeach
    
    </tbody>
  
  </table>

</div>