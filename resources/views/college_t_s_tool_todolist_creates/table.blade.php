<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeTSToolTodolistCreates-table">
      
    <thead>
      
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>C T S T T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($collegeTSToolTodolistCreates as $collegeTSToolTodolistCreate)
          
        <tr>
              
          <td>{!! $collegeTSToolTodolistCreate->datetime !!}</td>
          <td>{!! $collegeTSToolTodolistCreate->user_id !!}</td>
          <td>{!! $collegeTSToolTodolistCreate->c_t_s_t_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('collegeTSToolTodolistCreates.show', [$collegeTSToolTodolistCreate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>