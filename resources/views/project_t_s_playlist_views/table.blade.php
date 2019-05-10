<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projectTSPlaylistViews-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>P T S P Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($projectTSPlaylistViews as $projectTSPlaylistView)
          
        <tr>
              
          <td>{!! $projectTSPlaylistView->datetime !!}</td>
          <td>{!! $projectTSPlaylistView->user_id !!}</td>
          <td>{!! $projectTSPlaylistView->p_t_s_p_id !!}</td>
          
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('projectTSPlaylistViews.show', [$projectTSPlaylistView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>