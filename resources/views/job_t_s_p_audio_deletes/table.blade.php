<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobTSPAudioDeletes-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>J T S P A Id</th>
        <th colspan="3">Action</th>
          
      </tr>
    
    </thead>
      
    <tbody>
      
      @foreach($jobTSPAudioDeletes as $jobTSPAudioDelete)
          
        <tr>
              
          <td>{!! $jobTSPAudioDelete->datetime !!}</td>
          <td>{!! $jobTSPAudioDelete->user_id !!}</td>
          <td>{!! $jobTSPAudioDelete->j_t_s_p_a_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('jobTSPAudioDeletes.show', [$jobTSPAudioDelete->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>