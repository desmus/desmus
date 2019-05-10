<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="personalDataTSPlaylists-table">
      
    <thead>
          
      <tr>
              
        <th>Name</th>
        <th>Description</th>
        <th>Views Quantity</th>
        <th>Updates Quantity</th>
        <th>Status</th>
        <th>P D T S Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($personalDataTSPlaylists as $personalDataTSPlaylist)
          
        <tr>
              
          <td>{!! $personalDataTSPlaylist->name !!}</td>
          <td>{!! $personalDataTSPlaylist->description !!}</td>
          <td>{!! $personalDataTSPlaylist->views_quantity !!}</td>
          <td>{!! $personalDataTSPlaylist->updates_quantity !!}</td>
          <td>{!! $personalDataTSPlaylist->status !!}</td>
          <td>{!! $personalDataTSPlaylist->p_d_t_s_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('personalDataTSPlaylists.show', [$personalDataTSPlaylist->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
        
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>