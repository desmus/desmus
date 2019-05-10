<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeTSToolFileTodolistDeletes-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>C T S T F T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
    
    </thead>
      
    <tbody>
      
      @foreach($collegeTSToolFileTodolistDeletes as $collegeTSToolFileTodolistDelete)
          
        <tr>
              
          <td>{!! $collegeTSToolFileTodolistDelete->datetime !!}</td>
          <td>{!! $collegeTSToolFileTodolistDelete->user_id !!}</td>
          <td>{!! $collegeTSToolFileTodolistDelete->c_t_s_t_f_t_id !!}</td>
          
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('collegeTSToolFileTodolistDeletes.show', [$collegeTSToolFileTodolistDelete->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>