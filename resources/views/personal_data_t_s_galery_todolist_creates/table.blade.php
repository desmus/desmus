<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="personalDataTSGTodolistCreates-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>P D T S G T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($personalDataTSGaleryTodolistCreates as $personalDataTSGaleryTodolistCreate)
          
        <tr>
              
          <td>{!! $personalDataTSGaleryTodolistCreate->datetime !!}</td>
          <td>{!! $personalDataTSGaleryTodolistCreate->user_id !!}</td>
          <td>{!! $personalDataTSGaleryTodolistCreate->p_d_t_s_g_t_id !!}</td>
            
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('personalDataTSGTodolistCreates.show', [$personalDataTSGaleryTodolistCreate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>