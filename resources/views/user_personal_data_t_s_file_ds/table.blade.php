<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userPersonalDataTSFileDs-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>U P D T S F Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userPersonalDataTSFileDs as $userPersonalDataTSFileD)
          
        <tr>
              
          <td>{!! $userPersonalDataTSFileD->datetime !!}</td>
          <td>{!! $userPersonalDataTSFileD->user_id !!}</td>
          <td>{!! $userPersonalDataTSFileD->u_p_d_t_s_f_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userPersonalDataTSFileDs.show', [$userPersonalDataTSFileD->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
    
    </tbody>
  
  </table>
  
</div>