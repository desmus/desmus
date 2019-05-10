<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobTSFileTodolistCreates-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>C T S F T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($jobTSFileTodolistCreates as $jobTSFileTodolistCreate)
          
        <tr>
              
          <td>{!! $jobTSFileTodolistCreate->datetime !!}</td>
          <td>{!! $jobTSFileTodolistCreate->user_id !!}</td>
          <td>{!! $jobTSFileTodolistCreate->j_t_s_f_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
                      
              <a href="{!! route('jobTSFileTodolistCreates.show', [$jobTSFileTodolistCreate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>