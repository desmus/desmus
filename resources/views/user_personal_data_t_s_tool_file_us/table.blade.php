<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userPersonalDataTSToolFileUs-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>U P D T S T F Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userPersonalDataTSToolFileUs as $userPersonalDataTSToolFileU)
          
        <tr>
              
          <td>{!! $userPersonalDataTSToolFileU->datetime !!}</td>
          <td>{!! $userPersonalDataTSToolFileU->user_id !!}</td>
          <td>{!! $userPersonalDataTSToolFileU->u_p_d_t_s_t_f_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userPersonalDataTSToolFileUs.show', [$userPersonalDataTSToolFileU->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>