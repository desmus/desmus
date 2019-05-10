<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projectTSFileTodolistCreates-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>P T S F T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($projectTSFileTodolistCreates as $projectTSFileTodolistCreate)
          
        <tr>
              
          <td>{!! $projectTSFileTodolistCreate->datetime !!}</td>
          <td>{!! $projectTSFileTodolistCreate->user_id !!}</td>
          <td>{!! $projectTSFileTodolistCreate->p_t_s_f_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
                      
              <a href="{!! route('projectTSFileTodolistCreates.show', [$projectTSFileTodolistCreate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>