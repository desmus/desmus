<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeTopicSectionTodolistViews-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>C T S T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($collegeTopicSectionTodolistViews as $collegeTopicSectionTodolistView)
          
        <tr>
            
          <td>{!! $collegeTopicSectionTodolistView->datetime !!}</td>
          <td>{!! $collegeTopicSectionTodolistView->user_id !!}</td>
          <td>{!! $collegeTopicSectionTodolistView->c_t_s_t_id !!}</td>
          
          <td>
                  
            <div class='btn-group'>
              
              <a href="{!! route('collegeTSTodolistViews.show', [$collegeTopicSectionTodolistView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
              
          </td>
        
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>