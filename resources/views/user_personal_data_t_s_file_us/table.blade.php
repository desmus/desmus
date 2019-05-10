<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userPersonalDataTSFileUs-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>U P D T S F Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userPersonalDataTSFileUs as $userPersonalDataTSFileU)
          
        <tr>
              
          <td>{!! $userPersonalDataTSFileU->datetime !!}</td>
          <td>{!! $userPersonalDataTSFileU->user_id !!}</td>
          <td>{!! $userPersonalDataTSFileU->u_p_d_t_s_f_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userPersonalDataTSFileUs.show', [$userPersonalDataTSFileU->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>