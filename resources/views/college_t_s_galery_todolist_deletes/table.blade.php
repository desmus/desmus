<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeTSGaleryTodolistDeletes-table">
    
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>C T S G T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
    
    </thead>
      
    <tbody>
      
      @foreach($collegeTSGaleryTodolistDeletes as $collegeTSGaleryTodolistDelete)
          
        <tr>
              
          <td>{!! $collegeTSGaleryTodolistDelete->datetime !!}</td>
          <td>{!! $collegeTSGaleryTodolistDelete->user_id !!}</td>
          <td>{!! $collegeTSGaleryTodolistDelete->c_t_s_g_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('collegeTSGaleryTodolistDeletes.show', [$collegeTSGaleryTodolistDelete->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
        
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>