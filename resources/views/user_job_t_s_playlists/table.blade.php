<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userJobTSPlaylists-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>Description</th>
        <th>Status</th>
        <th>Permissions</th>
        <th>User Id</th>
        <th>J T S P Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userJobTSPlaylists as $userJobTSPlaylist)
          
        <tr>
              
          <td>{!! $userJobTSPlaylist->datetime !!}</td>
          <td>{!! $userJobTSPlaylist->description !!}</td>
          <td>{!! $userJobTSPlaylist->status !!}</td>
          <td>{!! $userJobTSPlaylist->permissions !!}</td>
          <td>{!! $userJobTSPlaylist->user_id !!}</td>
          <td>{!! $userJobTSPlaylist->j_t_s_p_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userJobTSPlaylists.show', [$userJobTSPlaylist->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>