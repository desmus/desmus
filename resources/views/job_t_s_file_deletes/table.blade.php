<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobTSFileDeletes-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>Job T S File Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($jobTSFileDeletes as $jobTSFileDelete)
        
        <tr>
              
          <td>{!! $jobTSFileDelete->datetime !!}</td>
          <td>{!! $jobTSFileDelete->user_id !!}</td>
          <td>{!! $jobTSFileDelete->job_t_s_file_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
            
              <a href="{!! route('jobTSFileDeletes.show', [$jobTSFileDelete->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>