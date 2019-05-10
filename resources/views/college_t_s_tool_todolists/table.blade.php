<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeTSToolTodolists-table">
      
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
      
      @foreach($collegeTSToolTodolists as $collegeTSToolTodolist)
          
        <tr>
              
          <td>{!! $collegeTSToolTodolist->name !!}</td>
          <td>{!! $collegeTSToolTodolist->description !!}</td>
          <td>{!! $collegeTSToolTodolist->views_quantity !!}</td>
          <td>{!! $collegeTSToolTodolist->updates_quantity !!}</td>
          <td>{!! $collegeTSToolTodolist->status !!}</td>
          <td>{!! $collegeTSToolTodolist->datetime !!}</td>
          <td>{!! $collegeTSToolTodolist->college_id !!}</td>
              
          <td>
                  
            <div class='btn-group'>
                      
              <a href="{!! route('collegeTSToolTodolists.show', [$collegeTSToolTodolist->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>