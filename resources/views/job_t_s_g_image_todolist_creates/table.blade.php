<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobTSGImageTodolistCreates-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>J T S G I T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($jobTSGImageTodolistCreates as $jobTSGImageTodolistCreate)
          
        <tr>
              
          <td>{!! $jobTSGImageTodolistCreate->datetime !!}</td>
          <td>{!! $jobTSGImageTodolistCreate->user_id !!}</td>
          <td>{!! $jobTSGImageTodolistCreate->j_t_s_g_i_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
                      
              <a href="{!! route('jobTSGImageTodolistCreates.show', [$jobTSGImageTodolistCreate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>