<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="personalDataTSTodolistViews-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>P D T S T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
    
    </thead>
      
    <tbody>
      
      @foreach($personalDataTSTodolistViews as $personalDataTSTodolistView)
          
        <tr>
              
          <td>{!! $personalDataTSTodolistView->datetime !!}</td>
          <td>{!! $personalDataTSTodolistView->user_id !!}</td>
          <td>{!! $personalDataTSTodolistView->p_d_t_s_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('personalDataTSTodolistViews.show', [$personalDataTSTodolistView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>