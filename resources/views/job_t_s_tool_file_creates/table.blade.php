<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobTSToolFileCreates-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>Job T S T File Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($jobTSToolFileCreates as $jobTSToolFileCreate)
          
        <tr>
              
          <td>{!! $jobTSToolFileCreate->datetime !!}</td>
          <td>{!! $jobTSToolFileCreate->user_id !!}</td>
          <td>{!! $jobTSToolFileCreate->job_t_s_t_file_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('jobTSToolFileCreates.show', [$jobTSToolFileCreate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>