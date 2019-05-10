<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="personalDataTSTFTodolistViews-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>P D T S T F T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($personalDataTSTFTodolistViews as $personalDataTSTFTodolistView)
          
        <tr>
              
          <td>{!! $personalDataTSTFTodolistView->datetime !!}</td>
          <td>{!! $personalDataTSTFTodolistView->user_id !!}</td>
          <td>{!! $personalDataTSTFTodolistView->p_d_t_s_t_f_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('personalDataTSTFTodolistViews.show', [$personalDataTSTFTodolistView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>