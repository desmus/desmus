<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userPersonalDataTSToolFileDs-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>U P D T S T F Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userPersonalDataTSToolFileDs as $userPersonalDataTSToolFileD)
          
        <tr>
              
          <td>{!! $userPersonalDataTSToolFileD->datetime !!}</td>
          <td>{!! $userPersonalDataTSToolFileD->user_id !!}</td>
          <td>{!! $userPersonalDataTSToolFileD->u_p_d_t_s_t_f_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
                      
              <a href="{!! route('userPersonalDataTSToolFileDs.show', [$userPersonalDataTSToolFileD->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>