<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="personalDataTSTodolistDeletes-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>P D T S T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($personalDataTSTodolistDeletes as $personalDataTSTodolistDelete)
          
        <tr>
              
          <td>{!! $personalDataTSTodolistDelete->datetime !!}</td>
          <td>{!! $personalDataTSTodolistDelete->user_id !!}</td>
          <td>{!! $personalDataTSTodolistDelete->p_d_t_s_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('personalDataTSTodolistDeletes.show', [$personalDataTSTodolistDelete->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>