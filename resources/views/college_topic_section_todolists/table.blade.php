<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeTopicSectionTodolists-table">
      
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
      
      @foreach($collegeTopicSectionTodolists as $collegeTopicSectionTodolist)
          
        <tr>
              
          <td>{!! $collegeTopicSectionTodolist->name !!}</td>
          <td>{!! $collegeTopicSectionTodolist->description !!}</td>
          <td>{!! $collegeTopicSectionTodolist->views_quantity !!}</td>
          <td>{!! $collegeTopicSectionTodolist->updates_quantity !!}</td>
          <td>{!! $collegeTopicSectionTodolist->status !!}</td>
          <td>{!! $collegeTopicSectionTodolist->datetime !!}</td>
          <td>{!! $collegeTopicSectionTodolist->college_id !!}</td>
              
          <td>
                  
            <div class='btn-group'>
                      
              <a href="{!! route('collegeTopicSectionTodolists.show', [$collegeTopicSectionTodolist->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>