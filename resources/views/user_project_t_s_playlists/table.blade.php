<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userProjectTSPlaylists-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>Description</th>
        <th>Status</th>
        <th>Permissions</th>
        <th>User Id</th>
        <th>P T S P Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userProjectTSPlaylists as $userProjectTSPlaylist)
          
        <tr>
              
          <td>{!! $userProjectTSPlaylist->datetime !!}</td>
          <td>{!! $userProjectTSPlaylist->description !!}</td>
          <td>{!! $userProjectTSPlaylist->status !!}</td>
          <td>{!! $userProjectTSPlaylist->permissions !!}</td>
          <td>{!! $userProjectTSPlaylist->user_id !!}</td>
          <td>{!! $userProjectTSPlaylist->p_t_s_p_id !!}</td>
          
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userProjectTSPlaylists.show', [$userProjectTSPlaylist->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>