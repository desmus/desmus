<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="personalDataTSGTodolistViews-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>P D T S G T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($personalDataTSGaleryTodolistViews as $personalDataTSGaleryTodolistView)
          
        <tr>
              
          <td>{!! $personalDataTSGaleryTodolistView->datetime !!}</td>
          <td>{!! $personalDataTSGaleryTodolistView->user_id !!}</td>
          <td>{!! $personalDataTSGaleryTodolistView->p_d_t_s_g_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('personalDataTSGTodolistViews.show', [$personalDataTSGaleryTodolistView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>