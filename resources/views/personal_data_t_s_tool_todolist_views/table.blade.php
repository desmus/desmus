<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="personalDataTSToolTodolistViews-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>P D T S T T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($personalDataTSToolTodolistViews as $personalDataTSToolTodolistView)
          
        <tr>
              
          <td>{!! $personalDataTSToolTodolistView->datetime !!}</td>
          <td>{!! $personalDataTSToolTodolistView->user_id !!}</td>
          <td>{!! $personalDataTSToolTodolistView->p_d_t_s_t_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('personalDataTSToolTodolistViews.show', [$personalDataTSToolTodolistView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>