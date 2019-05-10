<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobTSPlaylists-table">
      
    <thead>
          
      <tr>
              
        <th>Name</th>
        <th>Description</th>
        <th>Views Quantity</th>
        <th>Updates Quantity</th>
        <th>Status</th>
        <th>J T S Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($jobTSPlaylists as $jobTSPlaylist)
      
        <tr>
              
          <td>{!! $jobTSPlaylist->name !!}</td>
          <td>{!! $jobTSPlaylist->description !!}</td>
          <td>{!! $jobTSPlaylist->views_quantity !!}</td>
          <td>{!! $jobTSPlaylist->updates_quantity !!}</td>
          <td>{!! $jobTSPlaylist->status !!}</td>
          <td>{!! $jobTSPlaylist->j_t_s_id !!}</td>
          
          <td>
                  
            <div class='btn-group'>
                      
              <a href="{!! route('jobTSPlaylists.show', [$jobTSPlaylist->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>