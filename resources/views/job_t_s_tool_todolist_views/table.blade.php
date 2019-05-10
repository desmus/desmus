<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobTSToolTodolistViews-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>J T S T T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($jobTSToolTodolistViews as $jobTSToolTodolistView)
          
        <tr>
              
          <td>{!! $jobTSToolTodolistView->datetime !!}</td>
          <td>{!! $jobTSToolTodolistView->user_id !!}</td>
          <td>{!! $jobTSToolTodolistView->c_t_s_t_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('jobTSToolTodolistViews.show', [$jobTSToolTodolistView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>