<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projectTopicTodolists-table">
      
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
      
      @foreach($projectTopicTodolists as $projectTopicTodolist)
          
        <tr>
              
          <td>{!! $projectTopicTodolist->name !!}</td>
          <td>{!! $projectTopicTodolist->description !!}</td>
          <td>{!! $projectTopicTodolist->views_quantity !!}</td>
          <td>{!! $projectTopicTodolist->updates_quantity !!}</td>
          <td>{!! $projectTopicTodolist->status !!}</td>
          <td>{!! $projectTopicTodolist->datetime !!}</td>
          <td>{!! $projectTopicTodolist->project_id !!}</td>
              
          <td>
                  
            <div class='btn-group'>
                      
              <a href="{!! route('projectTopicTodolists.show', [$projectTopicTodolist->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>