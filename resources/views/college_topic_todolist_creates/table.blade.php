<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeTopicTodolistCreates-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>C T T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($collegeTopicTodolistCreates as $collegeTopicTodolistCreate)
          
        <tr>
              
          <td>{!! $collegeTopicTodolistCreate->datetime !!}</td>
          <td>{!! $collegeTopicTodolistCreate->user_id !!}</td>
          <td>{!! $collegeTopicTodolistCreate->c_t_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('collegeTopicTodolistCreates.show', [$collegeTopicTodolistCreate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
              
          </td>
        
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>