<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="personalDataTodolistCreates-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>P D T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($personalDataTodolistCreates as $personalDataTodolistCreate)
          
        <tr>
              
          <td>{!! $personalDataTodolistCreate->datetime !!}</td>
          <td>{!! $personalDataTodolistCreate->user_id !!}</td>
          <td>{!! $personalDataTodolistCreate->p_d_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('personalDataTodolistCreates.show', [$personalDataTodolistCreate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>