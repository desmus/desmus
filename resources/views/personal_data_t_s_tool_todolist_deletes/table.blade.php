<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="personalDataTSToolTodolistDeletes-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>P D T S T T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($personalDataTSToolTodolistDeletes as $personalDataTSToolTodolistDelete)
          
        <tr>
              
          <td>{!! $personalDataTSToolTodolistDelete->datetime !!}</td>
          <td>{!! $personalDataTSToolTodolistDelete->user_id !!}</td>
          <td>{!! $personalDataTSToolTodolistDelete->p_d_t_s_t_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('personalDataTSToolTodolistDeletes.show', [$personalDataTSToolTodolistDelete->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>