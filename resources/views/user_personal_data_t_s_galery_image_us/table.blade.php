<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userPersonalDataTSGaleryImageUs-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>U P D T S G I Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userPersonalDataTSGaleryImageUs as $userPersonalDataTSGaleryImageU)
          
        <tr>
              
          <td>{!! $userPersonalDataTSGaleryImageU->datetime !!}</td>
          <td>{!! $userPersonalDataTSGaleryImageU->user_id !!}</td>
          <td>{!! $userPersonalDataTSGaleryImageU->u_p_d_t_s_g_i_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userPersonalDataTSGaleryImageUs.show', [$userPersonalDataTSGaleryImageU->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>