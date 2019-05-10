<div class="table-responsive">

  <table class="table table-responsive" id="projectTSGaleryTodolistViews-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>P T S G T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($projectTSGaleryTodolistViews as $projectTSGaleryTodolistView)
          
        <tr>
              
          <td>{!! $projectTSGaleryTodolistView->datetime !!}</td>
          <td>{!! $projectTSGaleryTodolistView->user_id !!}</td>
          <td>{!! $projectTSGaleryTodolistView->p_t_s_g_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              <a href="{!! route('projectTSGaleryTodolistViews.show', [$projectTSGaleryTodolistView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
    
    </tbody>
  
  </table>
  
</div>