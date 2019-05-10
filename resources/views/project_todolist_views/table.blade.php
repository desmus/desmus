<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projectTodolistViews-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>P T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($projectTodolistViews as $projectTodolistView)
          
        <tr>
              
          <td>{!! $projectTodolistView->datetime !!}</td>
          <td>{!! $projectTodolistView->user_id !!}</td>
          <td>{!! $projectTodolistView->p_t_id !!}</td>
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('projectTodolistViews.show', [$projectTodolistView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>