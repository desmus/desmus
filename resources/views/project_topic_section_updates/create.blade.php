<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projectTopicSectionTodolists-table">
      
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
      
      @foreach($projectTopicSectionTodolists as $projectTopicSectionTodolist)
          
        <tr>
              
          <td>{!! $projectTopicSectionTodolist->name !!}</td>
          <td>{!! $projectTopicSectionTodolist->description !!}</td>
          <td>{!! $projectTopicSectionTodolist->views_quantity !!}</td>
          <td>{!! $projectTopicSectionTodolist->updates_quantity !!}</td>
          <td>{!! $projectTopicSectionTodolist->status !!}</td>
          <td>{!! $projectTopicSectionTodolist->datetime !!}</td>
          <td>{!! $projectTopicSectionTodolist->project_id !!}</td>
              
          <td>
                  
            <div class='btn-group'>
                      
              <a href="{!! route('projectTopicSectionTodolists.show', [$projectTopicSectionTodolist->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>