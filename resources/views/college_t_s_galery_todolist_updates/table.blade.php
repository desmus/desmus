<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeTSGaleryTodolistUpdates-table">
      
    <thead>
          
      <tr>
              
        <th>Actual Name</th>
        <th>Past Name</th>
        <th>Datetime</th>
        <th>User Id</th>
        <th>C T S G T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($collegeTSGaleryTodolistUpdates as $collegeTSGaleryTodolistUpdate)
          
        <tr>
              
          <td>{!! $collegeTSGaleryTodolistUpdate->actual_name !!}</td>
          <td>{!! $collegeTSGaleryTodolistUpdate->past_name !!}</td>
          <td>{!! $collegeTSGaleryTodolistUpdate->datetime !!}</td>
          <td>{!! $collegeTSGaleryTodolistUpdate->user_id !!}</td>
          <td>{!! $collegeTSGaleryTodolistUpdate->c_t_s_g_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
            
              <a href="{!! route('collegeTSGaleryTodolistUpdates.show', [$collegeTSGaleryTodolistUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>