<div class="table-responsive">

  <table class="table table-responsive" id="collegeTSGaleryTodolistViews-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>C T S G T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($collegeTSGaleryTodolistViews as $collegeTSGaleryTodolistView)
          
        <tr>
              
          <td>{!! $collegeTSGaleryTodolistView->datetime !!}</td>
          <td>{!! $collegeTSGaleryTodolistView->user_id !!}</td>
          <td>{!! $collegeTSGaleryTodolistView->c_t_s_g_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              <a href="{!! route('collegeTSGaleryTodolistViews.show', [$collegeTSGaleryTodolistView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
    
    </tbody>
  
  </table>
  
</div>