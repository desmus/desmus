<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeTSPlaylists-table">
      
    <thead>
          
      <tr>
              
        <th>Name</th>
        <th>Description</th>
        <th>Views Quantity</th>
        <th>Updates Quantity</th>
        <th>Status</th>
        <th>C T S Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($collegeTSPlaylists as $collegeTSPlaylist)
      
        <tr>
              
          <td>{!! $collegeTSPlaylist->name !!}</td>
          <td>{!! $collegeTSPlaylist->description !!}</td>
          <td>{!! $collegeTSPlaylist->views_quantity !!}</td>
          <td>{!! $collegeTSPlaylist->updates_quantity !!}</td>
          <td>{!! $collegeTSPlaylist->status !!}</td>
          <td>{!! $collegeTSPlaylist->c_t_s_id !!}</td>
          
          <td>
                  
            <div class='btn-group'>
                      
              <a href="{!! route('collegeTSPlaylists.show', [$collegeTSPlaylist->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>