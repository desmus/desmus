<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeTSNoteTodolistViews-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>C T S N T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($collegeTSNoteTodolistViews as $collegeTSNoteTodolistView)
          
        <tr>
              
          <td>{!! $collegeTSNoteTodolistView->datetime !!}</td>
          <td>{!! $collegeTSNoteTodolistView->user_id !!}</td>
          <td>{!! $collegeTSNoteTodolistView->c_t_s_n_t_id !!}</td>
          
          <td>
            
            <div class='btn-group'>
                      
              <a href="{!! route('collegeTSNoteTodolistViews.show', [$collegeTSNoteTodolistView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>