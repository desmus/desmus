<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="personalDataTopicTodolistCreates-table">
    
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>P D T T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
    
    </thead>
      
    <tbody>
      
      @foreach($personalDataTopicTodolistCreates as $personalDataTopicTodolistCreate)
          
        <tr>
              
          <td>{!! $personalDataTopicTodolistCreate->datetime !!}</td>
          <td>{!! $personalDataTopicTodolistCreate->user_id !!}</td>
          <td>{!! $personalDataTopicTodolistCreate->p_d_t_t_id !!}</td>
              
          <td>
                  
            <div class='btn-group'>
              
              <a href="{!! route('personalDataTopicTodolistCreates.show', [$personalDataTopicTodolistCreate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>