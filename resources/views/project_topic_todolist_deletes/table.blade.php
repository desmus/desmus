<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projectTopicTodolistDeletes-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>P T T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($projectTopicTodolistDeletes as $projectTopicTodolistDelete)
          
        <tr>
              
          <td>{!! $projectTopicTodolistDelete->datetime !!}</td>
          <td>{!! $projectTopicTodolistDelete->user_id !!}</td>
          <td>{!! $projectTopicTodolistDelete->c_t_t_id !!}</td>
              
          <td>
                  
            <div class='btn-group'>
              
              <a href="{!! route('projectTopicTodolistDeletes.show', [$projectTopicTodolistDelete->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>