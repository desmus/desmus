<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeTopicTodolists-table">
      
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
      
      @foreach($collegeTopicTodolists as $collegeTopicTodolist)
          
        <tr>
              
          <td>{!! $collegeTopicTodolist->name !!}</td>
          <td>{!! $collegeTopicTodolist->description !!}</td>
          <td>{!! $collegeTopicTodolist->views_quantity !!}</td>
          <td>{!! $collegeTopicTodolist->updates_quantity !!}</td>
          <td>{!! $collegeTopicTodolist->status !!}</td>
          <td>{!! $collegeTopicTodolist->datetime !!}</td>
          <td>{!! $collegeTopicTodolist->college_id !!}</td>
              
          <td>
                  
            <div class='btn-group'>
                      
              <a href="{!! route('collegeTopicTodolists.show', [$collegeTopicTodolist->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>