<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="personalDataTSToolTodolistCreates-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>P D T S T T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($personalDataTSToolTodolistCreates as $personalDataTSToolTodolistCreate)
          
        <tr>
              
          <td>{!! $personalDataTSToolTodolistCreate->datetime !!}</td>
          <td>{!! $personalDataTSToolTodolistCreate->user_id !!}</td>
          <td>{!! $personalDataTSToolTodolistCreate->p_d_t_s_t_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('personalDataTSToolTodolistCreates.show', [$personalDataTSToolTodolistCreate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
    
    </tbody>
  
  </table>

</div>