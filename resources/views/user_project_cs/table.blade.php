<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userProjectCs-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>User P Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
    
      @foreach($userProjectCs as $userProjectC)
          
        <tr>
              
          <td>{!! $userProjectC->datetime !!}</td>
          <td>{!! $userProjectC->user_id !!}</td>
          <td>{!! $userProjectC->user_p_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userProjectCs.show', [$userProjectC->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>