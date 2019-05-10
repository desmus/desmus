<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projectTSGaleryTodolistDeletes-table">
    
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>P T S G T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
    
    </thead>
      
    <tbody>
      
      @foreach($projectTSGaleryTodolistDeletes as $projectTSGaleryTodolistDelete)
          
        <tr>
              
          <td>{!! $projectTSGaleryTodolistDelete->datetime !!}</td>
          <td>{!! $projectTSGaleryTodolistDelete->user_id !!}</td>
          <td>{!! $projectTSGaleryTodolistDelete->p_t_s_g_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('projectTSGaleryTodolistDeletes.show', [$projectTSGaleryTodolistDelete->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
        
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>