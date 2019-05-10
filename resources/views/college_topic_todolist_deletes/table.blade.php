<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeTopicTodolistDeletes-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>C T T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($collegeTopicTodolistDeletes as $collegeTopicTodolistDelete)
          
        <tr>
              
          <td>{!! $collegeTopicTodolistDelete->datetime !!}</td>
          <td>{!! $collegeTopicTodolistDelete->user_id !!}</td>
          <td>{!! $collegeTopicTodolistDelete->c_t_t_id !!}</td>
              
          <td>
                  
            <div class='btn-group'>
              
              <a href="{!! route('collegeTopicTodolistDeletes.show', [$collegeTopicTodolistDelete->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>