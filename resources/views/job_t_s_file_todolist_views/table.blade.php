<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobTSFileTodolistViews-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>J T S F T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($jobTSFileTodolistViews as $jobTSFileTodolistView)
          
        <tr>
          
          <td>{!! $jobTSFileTodolistView->datetime !!}</td>
          <td>{!! $jobTSFileTodolistView->user_id !!}</td>
          <td>{!! $jobTSFileTodolistView->c_t_s_f_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('jobTSFileTodolistViews.show', [$jobTSFileTodolistView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>