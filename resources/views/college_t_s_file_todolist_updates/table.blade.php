<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeTSFileTodolistUpdates-table">
      
    <thead>
          
      <tr>
        
        <th>Actual Name</th>
        <th>Past Name</th>
        <th>Datetime</th>
        <th>User Id</th>
        <th>C T S F T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($collegeTSFileTodolistUpdates as $collegeTSFileTodolistUpdate)
          
        <tr>
              
          <td>{!! $collegeTSFileTodolistUpdate->actual_name !!}</td>
          <td>{!! $collegeTSFileTodolistUpdate->past_name !!}</td>
          <td>{!! $collegeTSFileTodolistUpdate->datetime !!}</td>
          <td>{!! $collegeTSFileTodolistUpdate->user_id !!}</td>
          <td>{!! $collegeTSFileTodolistUpdate->c_t_s_f_t_id !!}</td>
          
          <td>
                  
            <div class='btn-group'>
              
              <a href="{!! route('collegeTSFileTodolistUpdates.show', [$collegeTSFileTodolistUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
        
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>

</div>