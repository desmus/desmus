<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userPersonalDataTSToolDs-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>U P D T S T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userPersonalDataTSToolDs as $userPersonalDataTSToolD)
          
        <tr>
              
          <td>{!! $userPersonalDataTSToolD->datetime !!}</td>
          <td>{!! $userPersonalDataTSToolD->user_id !!}</td>
          <td>{!! $userPersonalDataTSToolD->u_p_d_t_s_t_id !!}</td>
            
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userPersonalDataTSToolDs.show', [$userPersonalDataTSToolD->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>