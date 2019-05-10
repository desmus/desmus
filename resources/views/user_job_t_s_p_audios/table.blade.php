<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userJobTSPAudios-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>Description</th>
        <th>Status</th>
        <th>Permissions</th>
        <th>User Id</th>
        <th>J T S P A Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userJobTSPAudios as $userJobTSPAudio)
          
        <tr>
              
          <td>{!! $userJobTSPAudio->datetime !!}</td>
          <td>{!! $userJobTSPAudio->description !!}</td>
          <td>{!! $userJobTSPAudio->status !!}</td>
          <td>{!! $userJobTSPAudio->permissions !!}</td>
          <td>{!! $userJobTSPAudio->user_id !!}</td>
          <td>{!! $userJobTSPAudio->j_t_s_p_a_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userJobTSPAudios.show', [$userJobTSPAudio->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>