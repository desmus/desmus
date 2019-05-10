<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="personalDataTSGITodolistUpdates-table">
      
    <thead>
          
      <tr>
              
        <th>Actual Name</th>
        <th>Past Name</th>
        <th>Datetime</th>
        <th>User Id</th>
        <th>P D T S G I T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($personalDataTSGITodolistUpdates as $personalDataTSGITodolistUpdate)
          
        <tr>
              
          <td>{!! $personalDataTSGITodolistUpdate->actual_name !!}</td>
          <td>{!! $personalDataTSGITodolistUpdate->past_name !!}</td>
          <td>{!! $personalDataTSGITodolistUpdate->datetime !!}</td>
          <td>{!! $personalDataTSGITodolistUpdate->user_id !!}</td>
          <td>{!! $personalDataTSGITodolistUpdate->p_d_t_s_g_i_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('personalDataTSGITodolistUpdates.show', [$personalDataTSGITodolistUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
        
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>