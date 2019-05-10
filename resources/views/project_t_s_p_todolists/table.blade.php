<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projectTSPTodolists-table">
      
    <thead>
          
      <tr>
              
        <th>Name</th>
        <th>Description</th>
        <th>Views Quantity</th>
        <th>Updates Quantity</th>
        <th>Status</th>
        <th>Datetime</th>
        <th>P T S P Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($projectTSPTodolists as $projectTSPTodolist)
          
        <tr>
              
          <td>{!! $projectTSPTodolist->name !!}</td>
          <td>{!! $projectTSPTodolist->description !!}</td>
          <td>{!! $projectTSPTodolist->views_quantity !!}</td>
          <td>{!! $projectTSPTodolist->updates_quantity !!}</td>
          <td>{!! $projectTSPTodolist->status !!}</td>
          <td>{!! $projectTSPTodolist->datetime !!}</td>
          <td>{!! $projectTSPTodolist->p_t_s_p_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('projectTSPTodolists.show', [$projectTSPTodolist->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
        
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>