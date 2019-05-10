<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobTSPAudioCreates-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>J T S P A Id</th>
        <th colspan="3">Action</th>
          
      </tr>
    
    </thead>
      
    <tbody>
      
      @foreach($jobTSPAudioCreates as $jobTSPAudioCreate)
          
        <tr>
              
          <td>{!! $jobTSPAudioCreate->datetime !!}</td>
          <td>{!! $jobTSPAudioCreate->user_id !!}</td>
          <td>{!! $jobTSPAudioCreate->j_t_s_p_a_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('jobTSPAudioCreates.show', [$jobTSPAudioCreate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>