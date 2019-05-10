<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeTSToolFileTodolistUpdates-table">
      
    <thead>
          
      <tr>
              
        <th>Actual Name</th>
        <th>Past Name</th>
        <th>Datetime</th>
        <th>User Id</th>
        <th>C T S T F T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
    
    <tbody>
      
      @foreach($collegeTSToolFileTodolistUpdates as $collegeTSToolFileTodolistUpdate)
          
        <tr>
              
          <td>{!! $collegeTSToolFileTodolistUpdate->actual_name !!}</td>
          <td>{!! $collegeTSToolFileTodolistUpdate->past_name !!}</td>
          <td>{!! $collegeTSToolFileTodolistUpdate->datetime !!}</td>
          <td>{!! $collegeTSToolFileTodolistUpdate->user_id !!}</td>
          <td>{!! $collegeTSToolFileTodolistUpdate->c_t_s_t_f_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('collegeTSToolFileTodolistUpdates.show', [$collegeTSToolFileTodolistUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>