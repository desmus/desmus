<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projectTSFileTodolists-table">
      
    <thead>
          
      <tr>
              
        <th>Name</th>
        <th>Description</th>
        <th>Views Quantity</th>
        <th>Updates Quantity</th>
        <th>Status</th>
        <th>Datetime</th>
        <th>P T S F Id</th>
        <th colspan="3">Action</th>
      
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($projectTSFileTodolists as $projectTSFileTodolist)
          
        <tr>
              
          <td>{!! $projectTSFileTodolist->name !!}</td>
          <td>{!! $projectTSFileTodolist->description !!}</td>
          <td>{!! $projectTSFileTodolist->views_quantity !!}</td>
          <td>{!! $projectTSFileTodolist->updates_quantity !!}</td>
          <td>{!! $projectTSFileTodolist->status !!}</td>
          <td>{!! $projectTSFileTodolist->datetime !!}</td>
          <td>{!! $projectTSFileTodolist->p_t_s_f_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
                      
              <a href="{!! route('projectTSFileTodolists.show', [$projectTSFileTodolist->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
            
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>