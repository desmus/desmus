<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projectTSToolTodolists-table">
      
    <thead>
          
      <tr>
              
        <th>Name</th>
        <th>Description</th>
        <th>Views Quantity</th>
        <th>Updates Quantity</th>
        <th>Status</th>
        <th>Datetime</th>
        <th>Project Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($projectTSToolTodolists as $projectTSToolTodolist)
          
        <tr>
              
          <td>{!! $projectTSToolTodolist->name !!}</td>
          <td>{!! $projectTSToolTodolist->description !!}</td>
          <td>{!! $projectTSToolTodolist->views_quantity !!}</td>
          <td>{!! $projectTSToolTodolist->updates_quantity !!}</td>
          <td>{!! $projectTSToolTodolist->status !!}</td>
          <td>{!! $projectTSToolTodolist->datetime !!}</td>
          <td>{!! $projectTSToolTodolist->project_id !!}</td>
              
          <td>
                  
            <div class='btn-group'>
                      
              <a href="{!! route('projectTSToolTodolists.show', [$projectTSToolTodolist->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>