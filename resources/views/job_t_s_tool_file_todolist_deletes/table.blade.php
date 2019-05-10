<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobTSToolFileTodolistDeletes-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>J T S T F T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
    
    </thead>
      
    <tbody>
      
      @foreach($jobTSToolFileTodolistDeletes as $jobTSToolFileTodolistDelete)
          
        <tr>
              
          <td>{!! $jobTSToolFileTodolistDelete->datetime !!}</td>
          <td>{!! $jobTSToolFileTodolistDelete->user_id !!}</td>
          <td>{!! $jobTSToolFileTodolistDelete->j_t_s_t_f_t_id !!}</td>
          
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('jobTSToolFileTodolistDeletes.show', [$jobTSToolFileTodolistDelete->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>