<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userPersonalDataTSToolUs-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>U P D T S T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userPersonalDataTSToolUs as $userPersonalDataTSToolU)
          
        <tr>
              
          <td>{!! $userPersonalDataTSToolU->datetime !!}</td>
          <td>{!! $userPersonalDataTSToolU->user_id !!}</td>
          <td>{!! $userPersonalDataTSToolU->u_p_d_t_s_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userPersonalDataTSToolUs.show', [$userPersonalDataTSToolU->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>