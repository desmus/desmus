<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projectTopicTodolistUpdates-table">
      
    <thead>
          
      <tr>
              
        <th>Actual Name</th>
        <th>Past Name</th>
        <th>Datetime</th>
        <th>User Id</th>
        <th>P T T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($projectTopicTodolistUpdates as $projectTopicTodolistUpdate)
          
        <tr>
              
          <td>{!! $projectTopicTodolistUpdate->actual_name !!}</td>
          <td>{!! $projectTopicTodolistUpdate->past_name !!}</td>
          <td>{!! $projectTopicTodolistUpdate->datetime !!}</td>
          <td>{!! $projectTopicTodolistUpdate->user_id !!}</td>
          <td>{!! $projectTopicTodolistUpdate->p_t_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
                      
              <a href="{!! route('projectTopicTodolistUpdates.show', [$projectTopicTodolistUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
            
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>