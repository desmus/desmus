<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="personalDataTSNoteTodolistDeletes-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>P D T S N T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($personalDataTSNoteTodolistDeletes as $personalDataTSNoteTodolistDelete)
          
        <tr>
              
          <td>{!! $personalDataTSNoteTodolistDelete->datetime !!}</td>
          <td>{!! $personalDataTSNoteTodolistDelete->user_id !!}</td>
          <td>{!! $personalDataTSNoteTodolistDelete->p_d_t_s_n_t_id !!}</td>
            
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('personalDataTSNoteTodolistDeletes.show', [$personalDataTSNoteTodolistDelete->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>