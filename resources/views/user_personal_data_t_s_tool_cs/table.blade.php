<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userPersonalDataTSToolCs-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>U P D T S T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userPersonalDataTSToolCs as $userPersonalDataTSToolC)
          
        <tr>
              
          <td>{!! $userPersonalDataTSToolC->datetime !!}</td>
          <td>{!! $userPersonalDataTSToolC->user_id !!}</td>
          <td>{!! $userPersonalDataTSToolC->u_p_d_t_s_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userPersonalDataTSToolCs.show', [$userPersonalDataTSToolC->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>