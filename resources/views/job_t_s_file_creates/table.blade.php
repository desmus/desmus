<div class="table-responsive">
  
  <table class="table table-bordered table-striped dataTable" id="jobTSFileCreates-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>Job T S File Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($jobTSFileCreates as $jobTSFileCreate)
          
        <tr>
          
          <td>{!! $jobTSFileCreate->datetime !!}</td>
          <td>{!! $jobTSFileCreate->user_id !!}</td>
          <td>{!! $jobTSFileCreate->job_t_s_file_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
            
              <a href="{!! route('jobTSFileCreates.show', [$jobTSFileCreate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>