<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobTSNoteTodolistViews-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>J T S N T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($jobTSNoteTodolistViews as $jobTSNoteTodolistView)
          
        <tr>
              
          <td>{!! $jobTSNoteTodolistView->datetime !!}</td>
          <td>{!! $jobTSNoteTodolistView->user_id !!}</td>
          <td>{!! $jobTSNoteTodolistView->c_t_s_n_t_id !!}</td>
          
          <td>
            
            <div class='btn-group'>
                      
              <a href="{!! route('jobTSNoteTodolistViews.show', [$jobTSNoteTodolistView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>