<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userPersonalDataTSGalerieCs-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>U P D T S G Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userPersonalDataTSGalerieCs as $userPersonalDataTSGalerieC)
          
        <tr>
              
          <td>{!! $userPersonalDataTSGalerieC->datetime !!}</td>
          <td>{!! $userPersonalDataTSGalerieC->user_id !!}</td>
          <td>{!! $userPersonalDataTSGalerieC->u_p_d_t_s_g_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userPersonalDataTSGalerieCs.show', [$userPersonalDataTSGalerieC->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>