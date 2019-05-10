<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projectTSNoteTodolistDeletes-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>P T S N T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($projectTSNoteTodolistDeletes as $projectTSNoteTodolistDelete)
          
        <tr>
              
          <td>{!! $projectTSNoteTodolistDelete->datetime !!}</td>
          <td>{!! $projectTSNoteTodolistDelete->user_id !!}</td>
          <td>{!! $projectTSNoteTodolistDelete->p_t_s_n_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
                      
              <a href="{!! route('projectTSNoteTodolistDeletes.show', [$projectTSNoteTodolistDelete->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
            
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>