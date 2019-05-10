<div class="table-responsive">
  
  <table class="table table-bordered table-striped dataTable" id="projectTSToolFileTodolistViews-table">
      
    <thead>
      
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>P T S T F T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
    
    </thead>
      
    <tbody>
      
      @foreach($projectTSToolFileTodolistViews as $projectTSToolFileTodolistView)
          
        <tr>
              
          <td>{!! $projectTSToolFileTodolistView->datetime !!}</td>
          <td>{!! $projectTSToolFileTodolistView->user_id !!}</td>
          <td>{!! $projectTSToolFileTodolistView->p_t_s_t_f_t_id !!}</td>
            
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('projectTSToolFileTodolistViews.show', [$projectTSToolFileTodolistView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>