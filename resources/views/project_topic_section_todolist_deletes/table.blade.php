<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projectTopicSectionTodolistDeletes-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>P T S T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($projectTopicSectionTodolistDeletes as $projectTopicSectionTodolistDelete)
          
        <tr>
              
          <td>{!! $projectTopicSectionTodolistDelete->datetime !!}</td>
          <td>{!! $projectTopicSectionTodolistDelete->user_id !!}</td>
          <td>{!! $projectTopicSectionTodolistDelete->p_t_s_t_id !!}</td>
              
          <td>
                  
            <div class='btn-group'>
              
              <a href="{!! route('projectTSTodolistDeletes.show', [$projectTopicSectionTodolistDelete->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
              
          </td>
        
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>