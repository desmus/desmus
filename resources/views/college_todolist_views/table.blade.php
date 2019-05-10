<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeTodolistViews-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>C T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($collegeTodolistViews as $collegeTodolistView)
          
        <tr>
              
          <td>{!! $collegeTodolistView->datetime !!}</td>
          <td>{!! $collegeTodolistView->user_id !!}</td>
          <td>{!! $collegeTodolistView->c_t_id !!}</td>
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('collegeTodolistViews.show', [$collegeTodolistView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>