<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userPersonalDataCs-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>U P D Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userPersonalDataCs as $userPersonalDataC)
          
        <tr>
              
          <td>{!! $userPersonalDataC->datetime !!}</td>
          <td>{!! $userPersonalDataC->user_id !!}</td>
          <td>{!! $userPersonalDataC->u_p_d_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userPersonalDataCs.show', [$userPersonalDataC->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>