<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userPersonalDataTSFileCs-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>U P D T S F Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userPersonalDataTSFileCs as $userPersonalDataTSFileC)
          
        <tr>
              
          <td>{!! $userPersonalDataTSFileC->datetime !!}</td>
          <td>{!! $userPersonalDataTSFileC->user_id !!}</td>
          <td>{!! $userPersonalDataTSFileC->u_p_d_t_s_f_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userPersonalDataTSFileCs.show', [$userPersonalDataTSFileC->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>