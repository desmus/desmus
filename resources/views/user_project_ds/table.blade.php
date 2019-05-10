<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userProjectDs-table">
    
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>User P Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userProjectDs as $userProjectD)
          
        <tr>
              
          <td>{!! $userProjectD->datetime !!}</td>
          <td>{!! $userProjectD->user_id !!}</td>
          <td>{!! $userProjectD->user_p_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userProjectDs.show', [$userProjectD->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>