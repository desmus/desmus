<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userPersonalDataTSGaleryImageDs-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>U P D T S G I Id</th>
        <th colspan="3">Action</th>
      
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userPersonalDataTSGaleryImageDs as $userPersonalDataTSGaleryImageD)
          
        <tr>
              
          <td>{!! $userPersonalDataTSGaleryImageD->datetime !!}</td>
          <td>{!! $userPersonalDataTSGaleryImageD->user_id !!}</td>
          <td>{!! $userPersonalDataTSGaleryImageD->u_p_d_t_s_g_i_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userPersonalDataTSGaleryImageDs.show', [$userPersonalDataTSGaleryImageD->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>