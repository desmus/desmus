<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobTodolistViews-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>J T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($jobTodolistViews as $jobTodolistView)
          
        <tr>
              
          <td>{!! $jobTodolistView->datetime !!}</td>
          <td>{!! $jobTodolistView->user_id !!}</td>
          <td>{!! $jobTodolistView->j_t_id !!}</td>
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('jobTodolistViews.show', [$jobTodolistView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>