<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeTSToolTodolistDeletes-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>C T S T T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($collegeTSToolTodolistDeletes as $collegeTSToolTodolistDelete)
        
        <tr>
              
          <td>{!! $collegeTSToolTodolistDelete->datetime !!}</td>
          <td>{!! $collegeTSToolTodolistDelete->user_id !!}</td>
          <td>{!! $collegeTSToolTodolistDelete->c_t_s_t_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('collegeTSToolTodolistDeletes.show', [$collegeTSToolTodolistDelete->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>