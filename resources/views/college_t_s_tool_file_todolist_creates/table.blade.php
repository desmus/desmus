<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeTSToolFileTodolistCreates-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>C T S T F T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($collegeTSToolFileTodolistCreates as $collegeTSToolFileTodolistCreate)
          
        <tr>
              
          <td>{!! $collegeTSToolFileTodolistCreate->datetime !!}</td>
          <td>{!! $collegeTSToolFileTodolistCreate->user_id !!}</td>
          <td>{!! $collegeTSToolFileTodolistCreate->c_t_s_t_f_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('collegeTSToolFileTodolistCreates.show', [$collegeTSToolFileTodolistCreate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>