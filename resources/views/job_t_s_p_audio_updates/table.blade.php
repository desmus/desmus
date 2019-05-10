<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobTSPAudioUpdates-table">
      
    <thead>
          
      <tr>
              
        <th>Actual Name</th>
        <th>Past Name</th>
        <th>Datetime</th>
        <th>User Id</th>
        <th>J T S P A Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($jobTSPAudioUpdates as $jobTSPAudioUpdate)
          
        <tr>
              
          <td>{!! $jobTSPAudioUpdate->actual_name !!}</td>
          <td>{!! $jobTSPAudioUpdate->past_name !!}</td>
          <td>{!! $jobTSPAudioUpdate->datetime !!}</td>
          <td>{!! $jobTSPAudioUpdate->user_id !!}</td>
          <td>{!! $jobTSPAudioUpdate->j_t_s_p_a_id !!}</td>
              
          <td>
                  
            <div class='btn-group'>
                      
              <a href="{!! route('jobTSPAudioUpdates.show', [$jobTSPAudioUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>