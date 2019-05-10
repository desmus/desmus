<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeTSToolTodolistUpdates-table">
      
    <thead>
          
      <tr>
              
        <th>Actual Name</th>
        <th>Past Name</th>
        <th>Datetime</th>
        <th>User Id</th>
        <th>C T S T T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($collegeTSToolTodolistUpdates as $collegeTSToolTodolistUpdate)
        
        <tr>
              
          <td>{!! $collegeTSToolTodolistUpdate->actual_name !!}</td>
          <td>{!! $collegeTSToolTodolistUpdate->past_name !!}</td>
          <td>{!! $collegeTSToolTodolistUpdate->datetime !!}</td>
          <td>{!! $collegeTSToolTodolistUpdate->user_id !!}</td>
          <td>{!! $collegeTSToolTodolistUpdate->c_t_s_t_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('collegeTSToolTodolistUpdates.show', [$collegeTSToolTodolistUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
    
      @endforeach
      
    </tbody>
  
  </table>
  
</div>