<div class="table-responsive">
  
  <table class="table table-bordered table-striped dataTable" id="personalDataTodolistUpdates-table">
      
    <thead>
          
      <tr>
              
        <th>Actual Name</th>
        <th>Past Name</th>
        <th>Datetime</th>
        <th>User Id</th>
        <th>P D T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($personalDataTodolistUpdates as $personalDataTodolistUpdate)
          
        <tr>
              
          <td>{!! $personalDataTodolistUpdate->actual_name !!}</td>
          <td>{!! $personalDataTodolistUpdate->past_name !!}</td>
          <td>{!! $personalDataTodolistUpdate->datetime !!}</td>
          <td>{!! $personalDataTodolistUpdate->user_id !!}</td>
          <td>{!! $personalDataTodolistUpdate->p_d_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('personalDataTodolistUpdates.show', [$personalDataTodolistUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
    
  </table>
  
</div>