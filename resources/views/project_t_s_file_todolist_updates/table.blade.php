<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projectTSFileTodolistUpdates-table">
      
    <thead>
          
      <tr>
        
        <th>Actual Name</th>
        <th>Past Name</th>
        <th>Datetime</th>
        <th>User Id</th>
        <th>P T S F T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($projectTSFileTodolistUpdates as $projectTSFileTodolistUpdate)
          
        <tr>
              
          <td>{!! $projectTSFileTodolistUpdate->actual_name !!}</td>
          <td>{!! $projectTSFileTodolistUpdate->past_name !!}</td>
          <td>{!! $projectTSFileTodolistUpdate->datetime !!}</td>
          <td>{!! $projectTSFileTodolistUpdate->user_id !!}</td>
          <td>{!! $projectTSFileTodolistUpdate->p_t_s_f_t_id !!}</td>
          
          <td>
                  
            <div class='btn-group'>
              
              <a href="{!! route('projectTSFileTodolistUpdates.show', [$projectTSFileTodolistUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
        
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>

</div>