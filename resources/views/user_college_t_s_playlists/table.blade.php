<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userCollegeTSPlaylists-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>Description</th>
        <th>Status</th>
        <th>Permissions</th>
        <th>User Id</th>
        <th>C T S P Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userCollegeTSPlaylists as $userCollegeTSPlaylist)
          
        <tr>
              
          <td>{!! $userCollegeTSPlaylist->datetime !!}</td>
          <td>{!! $userCollegeTSPlaylist->description !!}</td>
          <td>{!! $userCollegeTSPlaylist->status !!}</td>
          <td>{!! $userCollegeTSPlaylist->permissions !!}</td>
          <td>{!! $userCollegeTSPlaylist->user_id !!}</td>
          <td>{!! $userCollegeTSPlaylist->c_t_s_p_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userCollegeTSPlaylists.show', [$userCollegeTSPlaylist->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>