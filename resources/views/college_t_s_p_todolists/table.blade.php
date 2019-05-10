<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeTSPTodolists-table">
      
    <thead>
          
      <tr>
              
        <th>Name</th>
        <th>Description</th>
        <th>Views Quantity</th>
        <th>Updates Quantity</th>
        <th>Status</th>
        <th>Datetime</th>
        <th>C T S P Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($collegeTSPTodolists as $collegeTSPTodolist)
          
        <tr>
              
          <td>{!! $collegeTSPTodolist->name !!}</td>
          <td>{!! $collegeTSPTodolist->description !!}</td>
          <td>{!! $collegeTSPTodolist->views_quantity !!}</td>
          <td>{!! $collegeTSPTodolist->updates_quantity !!}</td>
          <td>{!! $collegeTSPTodolist->status !!}</td>
          <td>{!! $collegeTSPTodolist->datetime !!}</td>
          <td>{!! $collegeTSPTodolist->c_t_s_p_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('collegeTSPTodolists.show', [$collegeTSPTodolist->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
        
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>