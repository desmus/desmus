<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobTopicSectionTodolistUpdates-table">
      
    <thead>
          
      <tr>
              
        <th>Actual Name</th>
        <th>Past Name</th>
        <th>Datetime</th>
        <th>User Id</th>
        <th>J T S T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
    
    </thead>
      
    <tbody>
      
      @foreach($jobTopicSectionTodolistUpdates as $jobTopicSectionTodolistUpdate)
          
        <tr>
              
          <td>{!! $jobTopicSectionTodolistUpdate->actual_name !!}</td>
          <td>{!! $jobTopicSectionTodolistUpdate->past_name !!}</td>
          <td>{!! $jobTopicSectionTodolistUpdate->datetime !!}</td>
          <td>{!! $jobTopicSectionTodolistUpdate->user_id !!}</td>
          <td>{!! $jobTopicSectionTodolistUpdate->c_t_s_t_id !!}</td>
              
          <td>
                  
            <div class='btn-group'>
              
              <a href="{!! route('jobTopicSectionTodolistUpdates.show', [$jobTopicSectionTodolistUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
        
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>