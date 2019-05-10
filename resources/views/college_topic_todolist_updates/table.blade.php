<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeTopicTodolistUpdates-table">
      
    <thead>
          
      <tr>
              
        <th>Actual Name</th>
        <th>Past Name</th>
        <th>Datetime</th>
        <th>User Id</th>
        <th>C T T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($collegeTopicTodolistUpdates as $collegeTopicTodolistUpdate)
          
        <tr>
              
          <td>{!! $collegeTopicTodolistUpdate->actual_name !!}</td>
          <td>{!! $collegeTopicTodolistUpdate->past_name !!}</td>
          <td>{!! $collegeTopicTodolistUpdate->datetime !!}</td>
          <td>{!! $collegeTopicTodolistUpdate->user_id !!}</td>
          <td>{!! $collegeTopicTodolistUpdate->c_t_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
                      
              <a href="{!! route('collegeTopicTodolistUpdates.show', [$collegeTopicTodolistUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
            
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>