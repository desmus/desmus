<div class="table-responsive">
  
  <table class="table table-bordered table-striped dataTable" id="jobTSPlaylistUpdates-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>J T S P Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
    
    <tbody>
      
      @foreach($jobTSPlaylistUpdates as $jobTSPlaylistUpdate)
          
        <tr>
              
          <td>{!! $jobTSPlaylistUpdate->datetime !!}</td>
          <td>{!! $jobTSPlaylistUpdate->user_id !!}</td>
          <td>{!! $jobTSPlaylistUpdate->j_t_s_p_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('jobTSPlaylistUpdates.show', [$jobTSPlaylistUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
    
    </tbody>
  
  </table>
  
</div>