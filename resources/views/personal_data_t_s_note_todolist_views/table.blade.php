<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="personalDataTSNoteTodolistViews-table">
    
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>P D T S N T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($personalDataTSNoteTodolistViews as $personalDataTSNoteTodolistView)
          
        <tr>
              
          <td>{!! $personalDataTSNoteTodolistView->datetime !!}</td>
          <td>{!! $personalDataTSNoteTodolistView->user_id !!}</td>
          <td>{!! $personalDataTSNoteTodolistView->p_d_t_s_n_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('personalDataTSNoteTodolistViews.show', [$personalDataTSNoteTodolistView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>