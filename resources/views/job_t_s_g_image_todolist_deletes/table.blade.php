<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobTSGImageTodolistDeletes-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>J T S G I T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($jobTSGImageTodolistDeletes as $jobTSGImageTodolistDelete)
          
        <tr>
              
          <td>{!! $jobTSGImageTodolistDelete->datetime !!}</td>
          <td>{!! $jobTSGImageTodolistDelete->user_id !!}</td>
          <td>{!! $jobTSGImageTodolistDelete->j_t_s_g_i_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('jobTSGImageTodolistDeletes.show', [$jobTSGImageTodolistDelete->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
    
  </table>
  
</div>