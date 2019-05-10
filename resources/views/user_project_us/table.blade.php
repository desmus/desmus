<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userProjectUs-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>User P Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userProjectUs as $userProjectU)
          
        <tr>
              
          <td>{!! $userProjectU->datetime !!}</td>
          <td>{!! $userProjectU->user_id !!}</td>
          <td>{!! $userProjectU->user_p_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
                      
              <a href="{!! route('userProjectUs.show', [$userProjectU->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>