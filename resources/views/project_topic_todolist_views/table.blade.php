<div class="table-responsive">

  <table class="table table-responsive" id="projectTopicTodolistViews-table">
    
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>P T T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($projectTopicTodolistViews as $projectTopicTodolistView)
          
        <tr>
              
          <td>{!! $projectTopicTodolistView->datetime !!}</td>
          <td>{!! $projectTopicTodolistView->user_id !!}</td>
          <td>{!! $projectTopicTodolistView->p_t_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('projectTopicTodolistViews.show', [$projectTopicTodolistView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
        
        </tr>
      
      @endforeach
      
    </tbody>
    
  </table>
  
</div>