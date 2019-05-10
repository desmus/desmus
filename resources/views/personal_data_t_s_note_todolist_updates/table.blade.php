<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="personalDataTSNoteTodolistUpdates-table">
      
    <thead>
          
      <tr>
              
        <th>Actual Name</th>
        <th>Past Name</th>
        <th>Datetime</th>
        <th>User Id</th>
        <th>P D T S N T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($personalDataTSNoteTodolistUpdates as $personalDataTSNoteTodolistUpdate)
          
        <tr>
              
          <td>{!! $personalDataTSNoteTodolistUpdate->actual_name !!}</td>
          <td>{!! $personalDataTSNoteTodolistUpdate->past_name !!}</td>
          <td>{!! $personalDataTSNoteTodolistUpdate->datetime !!}</td>
          <td>{!! $personalDataTSNoteTodolistUpdate->user_id !!}</td>
          <td>{!! $personalDataTSNoteTodolistUpdate->p_d_t_s_n_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('personalDataTSNoteTodolistUpdates.show', [$personalDataTSNoteTodolistUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
    
    </tbody>
  
  </table>
  
</div>