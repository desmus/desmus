<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="personalDataTopicTodolistDeletes-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>P D C T T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($personalDataTopicTodolistDeletes as $personalDataTopicTodolistDelete)
          
        <tr>
              
          <td>{!! $personalDataTopicTodolistDelete->datetime !!}</td>
          <td>{!! $personalDataTopicTodolistDelete->user_id !!}</td>
          <td>{!! $personalDataTopicTodolistDelete->p_d_c_t_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('personalDataTopicTodolistDeletes.show', [$personalDataTopicTodolistDelete->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
    
  </table>
  
</div>