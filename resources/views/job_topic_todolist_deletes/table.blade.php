<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobTopicTodolistDeletes-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>J T T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($jobTopicTodolistDeletes as $jobTopicTodolistDelete)
          
        <tr>
              
          <td>{!! $jobTopicTodolistDelete->datetime !!}</td>
          <td>{!! $jobTopicTodolistDelete->user_id !!}</td>
          <td>{!! $jobTopicTodolistDelete->c_t_t_id !!}</td>
              
          <td>
                  
            <div class='btn-group'>
              
              <a href="{!! route('jobTopicTodolistDeletes.show', [$jobTopicTodolistDelete->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>