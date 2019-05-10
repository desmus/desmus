<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projectTSNoteTodolists-table">
      
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
      
      @foreach($projectTSNoteTodolists as $projectTSNoteTodolist)
          
        <tr>
              
          <td>{!! $projectTSNoteTodolist->name !!}</td>
          <td>{!! $projectTSNoteTodolist->description !!}</td>
          <td>{!! $projectTSNoteTodolist->views_quantity !!}</td>
          <td>{!! $projectTSNoteTodolist->updates_quantity !!}</td>
          <td>{!! $projectTSNoteTodolist->status !!}</td>
          <td>{!! $projectTSNoteTodolist->datetime !!}</td>
          <td>{!! $projectTSNoteTodolist->project_id !!}</td>
              
          <td>
                  
            <div class='btn-group'>
                      
              <a href="{!! route('projectTSNoteTodolists.show', [$projectTSNoteTodolist->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                 
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>