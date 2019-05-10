<div class="table-responsive">
  
  <table class="table table-bordered table-striped dataTable" id="collegeTSToolFileTodolistViews-table">
      
    <thead>
      
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>C T S T F T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
    
    </thead>
      
    <tbody>
      
      @foreach($collegeTSToolFileTodolistViews as $collegeTSToolFileTodolistView)
          
        <tr>
              
          <td>{!! $collegeTSToolFileTodolistView->datetime !!}</td>
          <td>{!! $collegeTSToolFileTodolistView->user_id !!}</td>
          <td>{!! $collegeTSToolFileTodolistView->c_t_s_t_f_t_id !!}</td>
            
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('collegeTSToolFileTodolistViews.show', [$collegeTSToolFileTodolistView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>