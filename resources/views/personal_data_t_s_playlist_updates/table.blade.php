<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="personalDataTSPlaylistUpdates-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>P D T S P Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($personalDataTSPlaylistUpdates as $personalDataTSPlaylistUpdate)
          
        <tr>
              
          <td>{!! $personalDataTSPlaylistUpdate->datetime !!}</td>
          <td>{!! $personalDataTSPlaylistUpdate->user_id !!}</td>
          <td>{!! $personalDataTSPlaylistUpdate->p_d_t_s_p_id !!}</td>
          
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('personalDataTSPlaylistUpdates.show', [$personalDataTSPlaylistUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>