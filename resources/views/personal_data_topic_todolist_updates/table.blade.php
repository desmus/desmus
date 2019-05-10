<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="personalDataTopicTodolistUpdates-table">
      
    <thead>
          
      <tr>
              
        <th>Actual Name</th>
        <th>Past Name</th>
        <th>Datetime</th>
        <th>User Id</th>
        <th>P D T T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($personalDataTopicTodolistUpdates as $personalDataTopicTodolistUpdate)
          
        <tr>
              
          <td>{!! $personalDataTopicTodolistUpdate->actual_name !!}</td>
          <td>{!! $personalDataTopicTodolistUpdate->past_name !!}</td>
          <td>{!! $personalDataTopicTodolistUpdate->datetime !!}</td>
          <td>{!! $personalDataTopicTodolistUpdate->user_id !!}</td>
          <td>{!! $personalDataTopicTodolistUpdate->p_d_t_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('personalDataTopicTodolistUpdates.show', [$personalDataTopicTodolistUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>