<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userPersonalDataTSGalerieDs-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>U P D T S G Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userPersonalDataTSGalerieDs as $userPersonalDataTSGalerieD)
          
        <tr>
              
          <td>{!! $userPersonalDataTSGalerieD->datetime !!}</td>
          <td>{!! $userPersonalDataTSGalerieD->user_id !!}</td>
          <td>{!! $userPersonalDataTSGalerieD->u_p_d_t_s_g_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userPersonalDataTSGalerieDs.show', [$userPersonalDataTSGalerieD->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>