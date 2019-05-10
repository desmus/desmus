<div class="table-responsive">

  <table class="table table-responsive" id="collegeTopicTodolistViews-table">
    
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>C T T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($collegeTopicTodolistViews as $collegeTopicTodolistView)
          
        <tr>
              
          <td>{!! $collegeTopicTodolistView->datetime !!}</td>
          <td>{!! $collegeTopicTodolistView->user_id !!}</td>
          <td>{!! $collegeTopicTodolistView->c_t_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('collegeTopicTodolistViews.show', [$collegeTopicTodolistView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
        
        </tr>
      
      @endforeach
      
    </tbody>
    
  </table>
  
</div>