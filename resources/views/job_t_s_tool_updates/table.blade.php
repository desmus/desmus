<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobTSToolUpdates-table">
      
    <thead>
          
      <tr>
              
        <th>Actual Name</th>
        <th>Past Name</th>
        <th>Datetime</th>
        <th>User Id</th>
        <th>Job T S Tool Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($jobTSToolUpdates as $jobTSToolUpdate)
          
        <tr>
              
          <td>{!! $jobTSToolUpdate->actual_name !!}</td>
          <td>{!! $jobTSToolUpdate->past_name !!}</td>
          <td>{!! $jobTSToolUpdate->datetime !!}</td>
          <td>{!! $jobTSToolUpdate->user_id !!}</td>
          <td>{!! $jobTSToolUpdate->job_t_s_tool_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('jobTSToolUpdates.show', [$jobTSToolUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>