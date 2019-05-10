<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projectTSGaleryTodolists-table">
      
    <thead>
          
      <tr>
              
        <th>Name</th>
        <th>Description</th>
        <th>Views Quantity</th>
        <th>Updates Quantity</th>
        <th>Status</th>
        <th>Datetime</th>
        <th>College Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($projectTSGaleryTodolists as $projectTSGaleryTodolist)
          
        <tr>
              
          <td>{!! $projectTSGaleryTodolist->name !!}</td>
          <td>{!! $projectTSGaleryTodolist->description !!}</td>
          <td>{!! $projectTSGaleryTodolist->views_quantity !!}</td>
          <td>{!! $projectTSGaleryTodolist->updates_quantity !!}</td>
          <td>{!! $projectTSGaleryTodolist->status !!}</td>
          <td>{!! $projectTSGaleryTodolist->datetime !!}</td>
          <td>{!! $projectTSGaleryTodolist->project_id !!}</td>
              
          <td>
                  
            <div class='btn-group'>
                      
              <a href="{!! route('projectTSGaleryTodolists.show', [$projectTSGaleryTodolist->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>