<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projectTSGImageTodolists-table">
      
    <thead>
          
      <tr>
              
        <th>Name</th>
        <th>Description</th>
        <th>Views Quantity</th>
        <th>Updates Quantity</th>
        <th>Status</th>
        <th>Datetime</th>
        <th>P T S G I Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
    
      @foreach($projectTSGImageTodolists as $projectTSGImageTodolist)
          
        <tr>
              
          <td>{!! $projectTSGImageTodolist->name !!}</td>
          <td>{!! $projectTSGImageTodolist->description !!}</td>
          <td>{!! $projectTSGImageTodolist->views_quantity !!}</td>
          <td>{!! $projectTSGImageTodolist->updates_quantity !!}</td>
          <td>{!! $projectTSGImageTodolist->status !!}</td>
          <td>{!! $projectTSGImageTodolist->datetime !!}</td>
          <td>{!! $projectTSGImageTodolist->p_t_s_g_i_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
            
              <a href="{!! route('projectTSGImageTodolists.show', [$projectTSGImageTodolist->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>