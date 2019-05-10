<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projectTopicSectionTodolistUpdates-table">
      
    <thead>
          
      <tr>
              
        <th>Actual Name</th>
        <th>Past Name</th>
        <th>Datetime</th>
        <th>User Id</th>
        <th>P T S T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
    
    </thead>
      
    <tbody>
      
      @foreach($projectTopicSectionTodolistUpdates as $projectTopicSectionTodolistUpdate)
          
        <tr>
              
          <td>{!! $projectTopicSectionTodolistUpdate->actual_name !!}</td>
          <td>{!! $projectTopicSectionTodolistUpdate->past_name !!}</td>
          <td>{!! $projectTopicSectionTodolistUpdate->datetime !!}</td>
          <td>{!! $projectTopicSectionTodolistUpdate->user_id !!}</td>
          <td>{!! $projectTopicSectionTodolistUpdate->p_t_s_t_id !!}</td>
              
          <td>
                  
            <div class='btn-group'>
              
              <a href="{!! route('projectTSTodolistUpdates.show', [$projectTopicSectionTodolistUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
        
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>