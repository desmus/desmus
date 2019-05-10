<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobTSPlaylistDeletes-table">
      
    <thead>
      
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>J T S P Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($jobTSPlaylistDeletes as $jobTSPlaylistDelete)
          
        <tr>
              
          <td>{!! $jobTSPlaylistDelete->datetime !!}</td>
          <td>{!! $jobTSPlaylistDelete->user_id !!}</td>
          <td>{!! $jobTSPlaylistDelete->j_t_s_p_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('jobTSPlaylistDeletes.show', [$jobTSPlaylistDelete->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>