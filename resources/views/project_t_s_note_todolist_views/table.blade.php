<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projectTSNoteTodolistViews-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>P T S N T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($projectTSNoteTodolistViews as $projectTSNoteTodolistView)
          
        <tr>
              
          <td>{!! $projectTSNoteTodolistView->datetime !!}</td>
          <td>{!! $projectTSNoteTodolistView->user_id !!}</td>
          <td>{!! $projectTSNoteTodolistView->p_t_s_n_t_id !!}</td>
          
          <td>
            
            <div class='btn-group'>
                      
              <a href="{!! route('projectTSNoteTodolistViews.show', [$projectTSNoteTodolistView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>