<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projectTopicTodolistCreates-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>P T T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($projectTopicTodolistCreates as $projectTopicTodolistCreate)
          
        <tr>
              
          <td>{!! $projectTopicTodolistCreate->datetime !!}</td>
          <td>{!! $projectTopicTodolistCreate->user_id !!}</td>
          <td>{!! $projectTopicTodolistCreate->c_t_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('projectTopicTodolistCreates.show', [$projectTopicTodolistCreate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
              
          </td>
        
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>