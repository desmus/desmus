<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="personalDataTSTFTodolistUpdates-table">
      
    <thead>
          
      <tr>
              
        <th>Actual Name</th>
        <th>Past Name</th>
        <th>Datetime</th>
        <th>User Id</th>
        <th>P D T S T F T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($personalDataTSTFTodolistUpdates as $personalDataTSTFTodolistUpdate)
          
        <tr>
              
          <td>{!! $personalDataTSTFTodolistUpdate->actual_name !!}</td>
          <td>{!! $personalDataTSTFTodolistUpdate->past_name !!}</td>
          <td>{!! $personalDataTSTFTodolistUpdate->datetime !!}</td>
          <td>{!! $personalDataTSTFTodolistUpdate->user_id !!}</td>
          <td>{!! $personalDataTSTFTodolistUpdate->p_d_t_s_t_f_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('personalDataTSTFTodolistUpdates.show', [$personalDataTSTFTodolistUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>