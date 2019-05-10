<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobTSPlaylistCreates-table">
      
    <thead>
          
      <tr>
        
        <th>Datetime</th>
        <th>User Id</th>
        <th>J T S P Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($jobTSPlaylistCreates as $jobTSPlaylistCreate)
          
        <tr>
              
          <td>{!! $jobTSPlaylistCreate->datetime !!}</td>
          <td>{!! $jobTSPlaylistCreate->user_id !!}</td>
          <td>{!! $jobTSPlaylistCreate->c_t_s_p_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('jobTSPlaylistCreates.show', [$jobTSPlaylistCreate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>