<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeTodolists-table">
      
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
      
      @foreach($collegeTodolists as $collegeTodolist)
          
        <tr>
              
          <td>{!! $collegeTodolist->name !!}</td>
          <td>{!! $collegeTodolist->description !!}</td>
          <td>{!! $collegeTodolist->views_quantity !!}</td>
          <td>{!! $collegeTodolist->updates_quantity !!}</td>
          <td>{!! $collegeTodolist->status !!}</td>
          <td>{!! $collegeTodolist->datetime !!}</td>
          <td>{!! $collegeTodolist->college_id !!}</td>
              
          <td>
                  
            <div class='btn-group'>
                      
              <a href="{!! route('collegeTodolists.show', [$collegeTodolist->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>