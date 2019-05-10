<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projectTodolists-table">
      
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
      
      @foreach($projectTodolists as $projectTodolist)
          
        <tr>
              
          <td>{!! $projectTodolist->name !!}</td>
          <td>{!! $projectTodolist->description !!}</td>
          <td>{!! $projectTodolist->views_quantity !!}</td>
          <td>{!! $projectTodolist->updates_quantity !!}</td>
          <td>{!! $projectTodolist->status !!}</td>
          <td>{!! $projectTodolist->datetime !!}</td>
          <td>{!! $projectTodolist->project_id !!}</td>
              
          <td>
                  
            <div class='btn-group'>
                      
              <a href="{!! route('projectTodolists.show', [$projectTodolist->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>