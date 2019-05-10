<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="personalDataTSToolTodolistUpdates-table">
      
    <thead>
          
      <tr>
              
        <th>Actual Name</th>
        <th>Past Name</th>
        <th>Datetime</th>
        <th>User Id</th>
        <th>P D T S T T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($personalDataTSToolTodolistUpdates as $personalDataTSToolTodolistUpdate)
          
        <tr>
              
          <td>{!! $personalDataTSToolTodolistUpdate->actual_name !!}</td>
          <td>{!! $personalDataTSToolTodolistUpdate->past_name !!}</td>
          <td>{!! $personalDataTSToolTodolistUpdate->datetime !!}</td>
          <td>{!! $personalDataTSToolTodolistUpdate->user_id !!}</td>
          <td>{!! $personalDataTSToolTodolistUpdate->p_d_t_s_t_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('personalDataTSToolTodolistUpdates.show', [$personalDataTSToolTodolistUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>