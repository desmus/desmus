<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="personalDataTSTFTodolistCreates-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>P D T S T F T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($personalDataTSTFTodolistCreates as $personalDataTSTFTodolistCreate)
          
        <tr>
              
          <td>{!! $personalDataTSTFTodolistCreate->datetime !!}</td>
          <td>{!! $personalDataTSTFTodolistCreate->user_id !!}</td>
          <td>{!! $personalDataTSTFTodolistCreate->p_d_t_s_t_f_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('personalDataTSTFTodolistCreates.show', [$personalDataTSTFTodolistCreate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>