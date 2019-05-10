<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobTSGaleryUpdates-table">
      
    <thead>
          
      <tr>
              
        <th>Actual Name</th>
        <th>Past Name</th>
        <th>Datetime</th>
        <th>User Id</th>
        <th>Job T S Galery Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($jobTSGaleryUpdates as $jobTSGaleryUpdate)
          
        <tr>
              
          <td>{!! $jobTSGaleryUpdate->actual_name !!}</td>
          <td>{!! $jobTSGaleryUpdate->past_name !!}</td>
          <td>{!! $jobTSGaleryUpdate->datetime !!}</td>
          <td>{!! $jobTSGaleryUpdate->user_id !!}</td>
          <td>{!! $jobTSGaleryUpdate->job_t_s_galery_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('jobTSGaleryUpdates.show', [$jobTSGaleryUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
    
  </table>
  
</div>