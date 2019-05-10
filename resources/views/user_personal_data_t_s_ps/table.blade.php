<table class="table table-responsive" id="userPersonalDataTSPs-table">
    
  <thead>
        
    <tr>
            
      <th>Datetime</th>
      <th>Description</th>
      <th>Status</th>
      <th>Permissions</th>
      <th>User Id</th>
      <th>P D T S P Id</th>
      <th colspan="3">Action</th>
        
    </tr>
    
  </thead>
    
  <tbody>
    
    @foreach($userPersonalDataTSPs as $userPersonalDataTSP)
        
      <tr>
            
        <td>{!! $userPersonalDataTSP->datetime !!}</td>
        <td>{!! $userPersonalDataTSP->description !!}</td>
        <td>{!! $userPersonalDataTSP->status !!}</td>
        <td>{!! $userPersonalDataTSP->permissions !!}</td>
        <td>{!! $userPersonalDataTSP->user_id !!}</td>
        <td>{!! $userPersonalDataTSP->p_d_t_s_p_id !!}</td>
            
        <td>
            
          <div class='btn-group'>
                    
            <a href="{!! route('userPersonalDataTSPs.show', [$userPersonalDataTSP->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
          
          </div>
        
        </td>
        
      </tr>
    
    @endforeach
  
  </tbody>

</table>