<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobTSToolFileTodolistCreates-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>J T S T F T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($jobTSToolFileTodolistCreates as $jobTSToolFileTodolistCreate)
          
        <tr>
              
          <td>{!! $jobTSToolFileTodolistCreate->datetime !!}</td>
          <td>{!! $jobTSToolFileTodolistCreate->user_id !!}</td>
          <td>{!! $jobTSToolFileTodolistCreate->j_t_s_t_f_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('jobTSToolFileTodolistCreates.show', [$jobTSToolFileTodolistCreate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>