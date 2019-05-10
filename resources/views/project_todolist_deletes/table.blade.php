<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projectTodolistDeletes-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>P T Id</th>
        <th colspan="3">Action</th>
        
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($projectTodolistDeletes as $projectTodolistDelete)
          
        <tr>
            
          <td>{!! $projectTodolistDelete->datetime !!}</td>
          <td>{!! $projectTodolistDelete->user_id !!}</td>
          <td>{!! $projectTodolistDelete->p_t_id !!}</td>
          
          <td>
                  
            <div class='btn-group'>
                      
              <a href="{!! route('projectTodolistDeletes.show', [$projectTodolistDelete->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
            
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
    
  </table>
  
</div>