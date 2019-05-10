<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeTSGImageTodolistDeletes-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>C T S G I T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($collegeTSGImageTodolistDeletes as $collegeTSGImageTodolistDelete)
          
        <tr>
              
          <td>{!! $collegeTSGImageTodolistDelete->datetime !!}</td>
          <td>{!! $collegeTSGImageTodolistDelete->user_id !!}</td>
          <td>{!! $collegeTSGImageTodolistDelete->c_t_s_g_i_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('collegeTSGImageTodolistDeletes.show', [$collegeTSGImageTodolistDelete->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
    
  </table>
  
</div>