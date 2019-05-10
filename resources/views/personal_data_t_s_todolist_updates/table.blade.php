<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="personalDataTSTodolistUpdates-table">
      
    <thead>
          
      <tr>
              
        <th>Actual Name</th>
        <th>Past Name</th>
        <th>Datetime</th>
        <th>User Id</th>
        <th>P D T S T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($personalDataTSTodolistUpdates as $personalDataTSTodolistUpdate)
          
        <tr>
              
          <td>{!! $personalDataTSTodolistUpdate->actual_name !!}</td>
          <td>{!! $personalDataTSTodolistUpdate->past_name !!}</td>
          <td>{!! $personalDataTSTodolistUpdate->datetime !!}</td>
          <td>{!! $personalDataTSTodolistUpdate->user_id !!}</td>
          <td>{!! $personalDataTSTodolistUpdate->p_d_t_s_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('personalDataTSTodolistUpdates.show', [$personalDataTSTodolistUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
          
            </div>
        
          </td>
          
        </tr>
      
      @endforeach
    
    </tbody>
  
  </table>
  
</div>