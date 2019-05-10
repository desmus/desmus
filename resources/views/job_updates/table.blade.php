<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobUpdates-table">
      
    <thead>
          
      <tr>
              
        <th>Actual Name</th>
        <th>Past Name</th>
        <th>Datetime</th>
        <th>User Id</th>
        <th>Job Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($jobUpdates as $jobUpdate)
          
        <tr>
              
          <td>{!! $jobUpdate->actual_name !!}</td>
          <td>{!! $jobUpdate->past_name !!}</td>
          <td>{!! $jobUpdate->datetime !!}</td>
          <td>{!! $jobUpdate->user_id !!}</td>
          <td>{!! $jobUpdate->job_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('jobUpdates.show', [$jobUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>