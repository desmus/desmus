<div class="table-responsive">
  
  <table class="table table-bordered table-striped dataTable" id="jobTSToolFileTodolistViews-table">
      
    <thead>
      
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>J T S T F T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
    
    </thead>
      
    <tbody>
      
      @foreach($jobTSToolFileTodolistViews as $jobTSToolFileTodolistView)
          
        <tr>
              
          <td>{!! $jobTSToolFileTodolistView->datetime !!}</td>
          <td>{!! $jobTSToolFileTodolistView->user_id !!}</td>
          <td>{!! $jobTSToolFileTodolistView->j_t_s_t_f_t_id !!}</td>
            
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('jobTSToolFileTodolistViews.show', [$jobTSToolFileTodolistView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>