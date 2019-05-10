<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userPDTSPAudios-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>Description</th>
        <th>Status</th>
        <th>Permissions</th>
        <th>User Id</th>
        <th>P D T S P A Id</th>
        <th colspan="3">Action</th>
          
      </tr>
    
    </thead>
      
    <tbody>
      
      @foreach($userPDTSPAudios as $userPDTSPAudio)
          
        <tr>
              
          <td>{!! $userPDTSPAudio->datetime !!}</td>
          <td>{!! $userPDTSPAudio->description !!}</td>
          <td>{!! $userPDTSPAudio->status !!}</td>
          <td>{!! $userPDTSPAudio->permissions !!}</td>
          <td>{!! $userPDTSPAudio->user_id !!}</td>
          <td>{!! $userPDTSPAudio->p_d_t_s_p_a_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userPDTSPAudios.show', [$userPDTSPAudio->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>