<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeTSNoteTodolists-table">
      
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
      
      @foreach($collegeTSNoteTodolists as $collegeTSNoteTodolist)
          
        <tr>
              
          <td>{!! $collegeTSNoteTodolist->name !!}</td>
          <td>{!! $collegeTSNoteTodolist->description !!}</td>
          <td>{!! $collegeTSNoteTodolist->views_quantity !!}</td>
          <td>{!! $collegeTSNoteTodolist->updates_quantity !!}</td>
          <td>{!! $collegeTSNoteTodolist->status !!}</td>
          <td>{!! $collegeTSNoteTodolist->datetime !!}</td>
          <td>{!! $collegeTSNoteTodolist->college_id !!}</td>
              
          <td>
                  
            <div class='btn-group'>
                      
              <a href="{!! route('collegeTSNoteTodolists.show', [$collegeTSNoteTodolist->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                 
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>