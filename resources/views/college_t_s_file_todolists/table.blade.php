<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeTSFileTodolists-table">
      
    <thead>
          
      <tr>
              
        <th>Name</th>
        <th>Description</th>
        <th>Views Quantity</th>
        <th>Updates Quantity</th>
        <th>Status</th>
        <th>Datetime</th>
        <th>C T S F Id</th>
        <th colspan="3">Action</th>
      
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($collegeTSFileTodolists as $collegeTSFileTodolist)
          
        <tr>
              
          <td>{!! $collegeTSFileTodolist->name !!}</td>
          <td>{!! $collegeTSFileTodolist->description !!}</td>
          <td>{!! $collegeTSFileTodolist->views_quantity !!}</td>
          <td>{!! $collegeTSFileTodolist->updates_quantity !!}</td>
          <td>{!! $collegeTSFileTodolist->status !!}</td>
          <td>{!! $collegeTSFileTodolist->datetime !!}</td>
          <td>{!! $collegeTSFileTodolist->c_t_s_f_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
                      
              <a href="{!! route('collegeTSFileTodolists.show', [$collegeTSFileTodolist->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
            
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>