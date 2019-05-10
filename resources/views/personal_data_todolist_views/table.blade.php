<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="personalDataTodolistViews-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>P D T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($personalDataTodolistViews as $personalDataTodolistView)
          
        <tr>
              
          <td>{!! $personalDataTodolistView->datetime !!}</td>
          <td>{!! $personalDataTodolistView->user_id !!}</td>
          <td>{!! $personalDataTodolistView->p_d_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('personalDataTodolistViews.show', [$personalDataTodolistView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
        
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>