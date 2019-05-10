<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeTSGImageTodolists-table">
      
    <thead>
          
      <tr>
              
        <th>Name</th>
        <th>Description</th>
        <th>Views Quantity</th>
        <th>Updates Quantity</th>
        <th>Status</th>
        <th>Datetime</th>
        <th>C T S G I Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
    
      @foreach($collegeTSGImageTodolists as $collegeTSGImageTodolist)
          
        <tr>
              
          <td>{!! $collegeTSGImageTodolist->name !!}</td>
          <td>{!! $collegeTSGImageTodolist->description !!}</td>
          <td>{!! $collegeTSGImageTodolist->views_quantity !!}</td>
          <td>{!! $collegeTSGImageTodolist->updates_quantity !!}</td>
          <td>{!! $collegeTSGImageTodolist->status !!}</td>
          <td>{!! $collegeTSGImageTodolist->datetime !!}</td>
          <td>{!! $collegeTSGImageTodolist->c_t_s_g_i_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
            
              <a href="{!! route('collegeTSGImageTodolists.show', [$collegeTSGImageTodolist->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>