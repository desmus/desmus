<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projectTopicSectionTodolistViews-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>P T S T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($projectTopicSectionTodolistViews as $projectTopicSectionTodolistView)
          
        <tr>
            
          <td>{!! $projectTopicSectionTodolistView->datetime !!}</td>
          <td>{!! $projectTopicSectionTodolistView->user_id !!}</td>
          <td>{!! $projectTopicSectionTodolistView->c_t_s_t_id !!}</td>
          
          <td>
                  
            <div class='btn-group'>
              
              <a href="{!! route('projectTSTodolistViews.show', [$projectTopicSectionTodolistView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
              
          </td>
        
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>