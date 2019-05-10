<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="personalDataTSPlaylistViews-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>P D T S P Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($personalDataTSPlaylistViews as $personalDataTSPlaylistView)
        
        <tr>
          
          <td>{!! $personalDataTSPlaylistView->datetime !!}</td>
          <td>{!! $personalDataTSPlaylistView->user_id !!}</td>
          <td>{!! $personalDataTSPlaylistView->p_d_t_s_p_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
                      
              <a href="{!! route('personalDataTSPlaylistViews.show', [$personalDataTSPlaylistView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>