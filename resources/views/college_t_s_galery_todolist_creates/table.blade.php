<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeTSGaleryTodolistCreates-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>C T S G T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($collegeTSGaleryTodolistCreates as $collegeTSGaleryTodolistCreate)
          
        <tr>
              
          <td>{!! $collegeTSGaleryTodolistCreate->datetime !!}</td>
          <td>{!! $collegeTSGaleryTodolistCreate->user_id !!}</td>
          <td>{!! $collegeTSGaleryTodolistCreate->c_t_s_g_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
                      
              <a href="{!! route('collegeTSGaleryTodolistCreates.show', [$collegeTSGaleryTodolistCreate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
    
    </tbody>
  
  </table>
  
</div>