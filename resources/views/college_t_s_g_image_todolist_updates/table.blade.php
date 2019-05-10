<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeTSGImageTodolistUpdates-table">
      
    <thead>
          
      <tr>
              
        <th>Actual Name</th>
        <th>Past Name</th>
        <th>Datetime</th>
        <th>User Id</th>
        <th>C T S G I T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($collegeTSGImageTodolistUpdates as $collegeTSGImageTodolistUpdate)
        
        <tr>
              
          <td>{!! $collegeTSGImageTodolistUpdate->actual_name !!}</td>
          <td>{!! $collegeTSGImageTodolistUpdate->past_name !!}</td>
          <td>{!! $collegeTSGImageTodolistUpdate->datetime !!}</td>
          <td>{!! $collegeTSGImageTodolistUpdate->user_id !!}</td>
          <td>{!! $collegeTSGImageTodolistUpdate->c_t_s_g_i_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('collegeTSGImageTodolistUpdates.show', [$collegeTSGImageTodolistUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>