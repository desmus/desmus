<div class="table-responsive">

  <table class="table table-responsive" id="jobTopicTodolistViews-table">
    
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>J T T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($jobTopicTodolistViews as $jobTopicTodolistView)
          
        <tr>
              
          <td>{!! $jobTopicTodolistView->datetime !!}</td>
          <td>{!! $jobTopicTodolistView->user_id !!}</td>
          <td>{!! $jobTopicTodolistView->j_t_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('jobTopicTodolistViews.show', [$jobTopicTodolistView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
        
        </tr>
      
      @endforeach
      
    </tbody>
    
  </table>
  
</div>