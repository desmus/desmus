<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeTSGaleryTodolists-table">
      
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
      
      @foreach($collegeTSGaleryTodolists as $collegeTSGaleryTodolist)
          
        <tr>
              
          <td>{!! $collegeTSGaleryTodolist->name !!}</td>
          <td>{!! $collegeTSGaleryTodolist->description !!}</td>
          <td>{!! $collegeTSGaleryTodolist->views_quantity !!}</td>
          <td>{!! $collegeTSGaleryTodolist->updates_quantity !!}</td>
          <td>{!! $collegeTSGaleryTodolist->status !!}</td>
          <td>{!! $collegeTSGaleryTodolist->datetime !!}</td>
          <td>{!! $collegeTSGaleryTodolist->college_id !!}</td>
              
          <td>
                  
            <div class='btn-group'>
                      
              <a href="{!! route('collegeTSGaleryTodolists.show', [$collegeTSGaleryTodolist->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>