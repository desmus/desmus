<div class="table-responsive">

  <table class="table table-responsive" id="userProjectTSPAudios-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>Description</th>
        <th>Status</th>
        <th>Permissions</th>
        <th>User Id</th>
        <th>P T S P A Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userProjectTSPAudios as $userProjectTSPAudio)
          
        <tr>
              
          <td>{!! $userProjectTSPAudio->datetime !!}</td>
          <td>{!! $userProjectTSPAudio->description !!}</td>
          <td>{!! $userProjectTSPAudio->status !!}</td>
          <td>{!! $userProjectTSPAudio->permissions !!}</td>
          <td>{!! $userProjectTSPAudio->user_id !!}</td>
          <td>{!! $userProjectTSPAudio->p_t_s_p_a_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userProjectTSPAudios.show', [$userProjectTSPAudio->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>