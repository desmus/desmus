<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeTSPlaylistViews-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>C T S P Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($collegeTSPlaylistViews as $collegeTSPlaylistView)
          
        <tr>
              
          <td>{!! $collegeTSPlaylistView->datetime !!}</td>
          <td>{!! $collegeTSPlaylistView->user_id !!}</td>
          <td>{!! $collegeTSPlaylistView->c_t_s_p_id !!}</td>
          
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('collegeTSPlaylistViews.show', [$collegeTSPlaylistView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>