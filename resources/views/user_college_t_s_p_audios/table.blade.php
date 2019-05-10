<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userCollegeTSPAudios-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>Description</th>
        <th>Status</th>
        <th>Permissions</th>
        <th>User Id</th>
        <th>C T S P A Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userCollegeTSPAudios as $userCollegeTSPAudio)
          
        <tr>
              
          <td>{!! $userCollegeTSPAudio->datetime !!}</td>
          <td>{!! $userCollegeTSPAudio->description !!}</td>
          <td>{!! $userCollegeTSPAudio->status !!}</td>
          <td>{!! $userCollegeTSPAudio->permissions !!}</td>
          <td>{!! $userCollegeTSPAudio->user_id !!}</td>
          <td>{!! $userCollegeTSPAudio->c_t_s_p_a_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userCollegeTSPAudios.show', [$userCollegeTSPAudio->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>