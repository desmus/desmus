<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobTSToolFileUpdates-table">
      
    <thead>
          
      <tr>
              
        <th>Actual Name</th>
        <th>Past Name</th>
        <th>Datetime</th>
        <th>User Id</th>
        <th>Job T S T File Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($jobTSToolFileUpdates as $jobTSToolFileUpdate)
          
        <tr>
              
          <td>{!! $jobTSToolFileUpdate->actual_name !!}</td>
          <td>{!! $jobTSToolFileUpdate->past_name !!}</td>
          <td>{!! $jobTSToolFileUpdate->datetime !!}</td>
          <td>{!! $jobTSToolFileUpdate->user_id !!}</td>
          <td>{!! $jobTSToolFileUpdate->job_t_s_t_file_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('jobTSToolFileUpdates.show', [$jobTSToolFileUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>