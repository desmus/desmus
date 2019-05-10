<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projectTSToolFileTodolists-table">
      
    <thead>
          
      <tr>
              
        <th>Name</th>
        <th>Description</th>
        <th>Views Quantity</th>
        <th>Updates Quantity</th>
        <th>Status</th>
        <th>Datetime</th>
        <th>P T S T F Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($projectTSToolFileTodolists as $projectTSToolFileTodolist)
          
        <tr>
              
          <td>{!! $projectTSToolFileTodolist->name !!}</td>
          <td>{!! $projectTSToolFileTodolist->description !!}</td>
          <td>{!! $projectTSToolFileTodolist->views_quantity !!}</td>
          <td>{!! $projectTSToolFileTodolist->updates_quantity !!}</td>
          <td>{!! $projectTSToolFileTodolist->status !!}</td>
          <td>{!! $projectTSToolFileTodolist->datetime !!}</td>
          <td>{!! $projectTSToolFileTodolist->p_t_s_t_f_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('projectTSToolFileTodolists.show', [$projectTSToolFileTodolist->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>