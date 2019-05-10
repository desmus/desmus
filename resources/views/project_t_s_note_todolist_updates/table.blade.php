<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projectTSNoteTodolistUpdates-table">
      
    <thead>
          
      <tr>
              
        <th>Actual Name</th>
        <th>Past Name</th>
        <th>Datetime</th>
        <th>User Id</th>
        <th>P T S N T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
    
    </thead>
      
    <tbody>
      
      @foreach($projectTSNoteTodolistUpdates as $projectTSNoteTodolistUpdate)
          
        <tr>
              
          <td>{!! $projectTSNoteTodolistUpdate->actual_name !!}</td>
          <td>{!! $projectTSNoteTodolistUpdate->past_name !!}</td>
          <td>{!! $projectTSNoteTodolistUpdate->datetime !!}</td>
          <td>{!! $projectTSNoteTodolistUpdate->user_id !!}</td>
          <td>{!! $projectTSNoteTodolistUpdate->p_t_s_n_t_id !!}</td>
              
          <td>
                  
            <div class='btn-group'>
                      
              <a href="{!! route('projectTSNoteTodolistUpdates.show', [$projectTSNoteTodolistUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>