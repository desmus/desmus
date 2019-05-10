<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobTSFileUpdates-table">
    
    <thead>
      
      <tr>
              
        <th>Actual Name</th>
        <th>Past Name</th>
        <th>Datetime</th>
        <th>User Id</th>
        <th>Job T S File Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($jobTSFileUpdates as $jobTSFileUpdate)
          
        <tr>
              
          <td>{!! $jobTSFileUpdate->actual_name !!}</td>
          <td>{!! $jobTSFileUpdate->past_name !!}</td>
          <td>{!! $jobTSFileUpdate->datetime !!}</td>
          <td>{!! $jobTSFileUpdate->user_id !!}</td>
          <td>{!! $jobTSFileUpdate->job_t_s_file_id !!}</td>
          
          <td>
                  
            <div class='btn-group'>
                      
              <a href="{!! route('jobTSFileUpdates.show', [$jobTSFileUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>