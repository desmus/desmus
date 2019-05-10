<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projectTSPlaylists-table">
      
    <thead>
          
      <tr>
              
        <th>Name</th>
        <th>Description</th>
        <th>Views Quantity</th>
        <th>Updates Quantity</th>
        <th>Status</th>
        <th>P T S Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($projectTSPlaylists as $projectTSPlaylist)
      
        <tr>
              
          <td>{!! $projectTSPlaylist->name !!}</td>
          <td>{!! $projectTSPlaylist->description !!}</td>
          <td>{!! $projectTSPlaylist->views_quantity !!}</td>
          <td>{!! $projectTSPlaylist->updates_quantity !!}</td>
          <td>{!! $projectTSPlaylist->status !!}</td>
          <td>{!! $projectTSPlaylist->p_t_s_id !!}</td>
          
          <td>
                  
            <div class='btn-group'>
                      
              <a href="{!! route('projectTSPlaylists.show', [$projectTSPlaylist->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>