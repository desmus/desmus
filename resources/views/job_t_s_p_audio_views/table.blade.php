<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobTSPAudioViews-table">
      
    <thead>
      
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>J T S P A Id</th>
        <th colspan="3">Action</th>
      
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($jobTSPAudioViews as $jobTSPAudioView)
          
        <tr>
              
          <td>{!! $jobTSPAudioView->datetime !!}</td>
          <td>{!! $jobTSPAudioView->user_id !!}</td>
          <td>{!! $jobTSPAudioView->j_t_s_p_a_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('jobTSPAudioViews.show', [$jobTSPAudioView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>