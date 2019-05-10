<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userPersonalDataTSGaleryImageCs-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>U P D T S G I Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
    
    <tbody>
      
      @foreach($userPersonalDataTSGaleryImageCs as $userPersonalDataTSGaleryImageC)
          
        <tr>
              
          <td>{!! $userPersonalDataTSGaleryImageC->datetime !!}</td>
          <td>{!! $userPersonalDataTSGaleryImageC->user_id !!}</td>
          <td>{!! $userPersonalDataTSGaleryImageC->u_p_d_t_s_g_i_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userPersonalDataTSGaleryImageCs.show', [$userPersonalDataTSGaleryImageC->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>