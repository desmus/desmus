<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobTSGaleryTodolistUpdates-table">
      
    <thead>
          
      <tr>
              
        <th>Actual Name</th>
        <th>Past Name</th>
        <th>Datetime</th>
        <th>User Id</th>
        <th>J T S G T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($jobTSGaleryTodolistUpdates as $jobTSGaleryTodolistUpdate)
          
        <tr>
              
          <td>{!! $jobTSGaleryTodolistUpdate->actual_name !!}</td>
          <td>{!! $jobTSGaleryTodolistUpdate->past_name !!}</td>
          <td>{!! $jobTSGaleryTodolistUpdate->datetime !!}</td>
          <td>{!! $jobTSGaleryTodolistUpdate->user_id !!}</td>
          <td>{!! $jobTSGaleryTodolistUpdate->c_t_s_g_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
            
              <a href="{!! route('jobTSGaleryTodolistUpdates.show', [$jobTSGaleryTodolistUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>