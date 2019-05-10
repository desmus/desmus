<div class="table-responsive">

  <table class="table table-responsive" id="jobTSGaleryTodolistViews-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>J T S G T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($jobTSGaleryTodolistViews as $jobTSGaleryTodolistView)
          
        <tr>
              
          <td>{!! $jobTSGaleryTodolistView->datetime !!}</td>
          <td>{!! $jobTSGaleryTodolistView->user_id !!}</td>
          <td>{!! $jobTSGaleryTodolistView->c_t_s_g_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              <a href="{!! route('jobTSGaleryTodolistViews.show', [$jobTSGaleryTodolistView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
    
    </tbody>
  
  </table>
  
</div>