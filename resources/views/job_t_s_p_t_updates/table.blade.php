<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobTSPTUpdates-table">
      
    <thead>
          
      <tr>
              
        <th>Actual Name</th>
        <th>Past Name</th>
        <th>Datetime</th>
        <th>User Id</th>
        <th>J T S P T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($jobTSPTUpdates as $jobTSPTUpdate)
          
        <tr>
          
          <td>{!! $jobTSPTUpdate->actual_name !!}</td>
          <td>{!! $jobTSPTUpdate->past_name !!}</td>
          <td>{!! $jobTSPTUpdate->datetime !!}</td>
          <td>{!! $jobTSPTUpdate->user_id !!}</td>
          <td>{!! $jobTSPTUpdate->j_t_s_p_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('jobTSPTUpdates.show', [$jobTSPTUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>