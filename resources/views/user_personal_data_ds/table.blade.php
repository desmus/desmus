<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userPersonalDataDs-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>U P D Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userPersonalDataDs as $userPersonalDataD)
          
        <tr>
              
          <td>{!! $userPersonalDataD->datetime !!}</td>
          <td>{!! $userPersonalDataD->user_id !!}</td>
          <td>{!! $userPersonalDataD->u_p_d_id !!}</td>
              
          <td>
                  
            <div class='btn-group'>
              
              <a href="{!! route('userPersonalDataDs.show', [$userPersonalDataD->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>