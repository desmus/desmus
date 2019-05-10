<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobTSGaleryImageUpdates-table">
      
    <thead>
          
      <tr>
              
        <th>Actual Name</th>
        <th>Past Name</th>
        <th>Datetime</th>
        <th>User Id</th>
        <th>Job T S G Image Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($jobTSGaleryImageUpdates as $jobTSGaleryImageUpdate)
          
        <tr>
              
          <td>{!! $jobTSGaleryImageUpdate->actual_name !!}</td>
          <td>{!! $jobTSGaleryImageUpdate->past_name !!}</td>
          <td>{!! $jobTSGaleryImageUpdate->datetime !!}</td>
          <td>{!! $jobTSGaleryImageUpdate->user_id !!}</td>
          <td>{!! $jobTSGaleryImageUpdate->job_t_s_g_image_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('jobTSGaleryImageUpdates.show', [$jobTSGaleryImageUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>