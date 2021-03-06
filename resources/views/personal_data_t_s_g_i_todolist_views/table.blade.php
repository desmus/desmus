<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="personalDataTSGITodolistViews-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>P D T S G I T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($personalDataTSGITodolistViews as $personalDataTSGITodolistView)
          
        <tr>
              
          <td>{!! $personalDataTSGITodolistView->datetime !!}</td>
          <td>{!! $personalDataTSGITodolistView->user_id !!}</td>
          <td>{!! $personalDataTSGITodolistView->p_d_t_s_g_i_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('personalDataTSGITodolistViews.show', [$personalDataTSGITodolistView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
    
    </tbody>
  
  </table>
  
</div>