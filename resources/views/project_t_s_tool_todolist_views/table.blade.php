<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projectTSToolTodolistViews-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>P T S T T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($projectTSToolTodolistViews as $projectTSToolTodolistView)
          
        <tr>
              
          <td>{!! $projectTSToolTodolistView->datetime !!}</td>
          <td>{!! $projectTSToolTodolistView->user_id !!}</td>
          <td>{!! $projectTSToolTodolistView->p_t_s_t_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('projectTSToolTodolistViews.show', [$projectTSToolTodolistView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>