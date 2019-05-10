<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobTopicSectionTodolistViews-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>J T S T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($jobTopicSectionTodolistViews as $jobTopicSectionTodolistView)
          
        <tr>
            
          <td>{!! $jobTopicSectionTodolistView->datetime !!}</td>
          <td>{!! $jobTopicSectionTodolistView->user_id !!}</td>
          <td>{!! $jobTopicSectionTodolistView->j_t_s_t_id !!}</td>
          
          <td>
                  
            <div class='btn-group'>
              
              <a href="{!! route('jobTopicSectionTodolistViews.show', [$jobTopicSectionTodolistView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
              
          </td>
        
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>