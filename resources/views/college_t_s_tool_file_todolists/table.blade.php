<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeTSToolFileTodolists-table">
      
    <thead>
          
      <tr>
              
        <th>Name</th>
        <th>Description</th>
        <th>Views Quantity</th>
        <th>Updates Quantity</th>
        <th>Status</th>
        <th>Datetime</th>
        <th>C T S T F Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($collegeTSToolFileTodolists as $collegeTSToolFileTodolist)
          
        <tr>
              
          <td>{!! $collegeTSToolFileTodolist->name !!}</td>
          <td>{!! $collegeTSToolFileTodolist->description !!}</td>
          <td>{!! $collegeTSToolFileTodolist->views_quantity !!}</td>
          <td>{!! $collegeTSToolFileTodolist->updates_quantity !!}</td>
          <td>{!! $collegeTSToolFileTodolist->status !!}</td>
          <td>{!! $collegeTSToolFileTodolist->datetime !!}</td>
          <td>{!! $collegeTSToolFileTodolist->c_t_s_t_f_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('collegeTSToolFileTodolists.show', [$collegeTSToolFileTodolist->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>