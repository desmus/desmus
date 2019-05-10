<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobTSToolFileDeletes-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>Job T S T File Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($jobTSToolFileDeletes as $jobTSToolFileDelete)
        
        <tr>
              
          <td>{!! $jobTSToolFileDelete->datetime !!}</td>
          <td>{!! $jobTSToolFileDelete->user_id !!}</td>
          <td>{!! $jobTSToolFileDelete->job_t_s_t_file_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('jobTSToolFileDeletes.show', [$jobTSToolFileDelete->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
        
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>