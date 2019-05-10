<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobTopicSectionTodolistCreates-table">
    
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>J T S T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($jobTopicSectionTodolistCreates as $jobTopicSectionTodolistCreate)
          
        <tr>
              
          <td>{!! $jobTopicSectionTodolistCreate->datetime !!}</td>
          <td>{!! $jobTopicSectionTodolistCreate->user_id !!}</td>
          <td>{!! $jobTopicSectionTodolistCreate->j_t_s_t_id !!}</td>
              
          <td>
                  
            <div class='btn-group'>
            
              <a href="{!! route('jobTopicSectionTodolistCreates.show', [$jobTopicSectionTodolistCreate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>