<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobTSGaleryImageDeletes-table">
      
    <thead>
          
      <tr>
        
        <th>Datetime</th>
        <th>User Id</th>
        <th>Job T S G Image Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($jobTSGaleryImageDeletes as $jobTSGaleryImageDelete)
          
        <tr>
              
          <td>{!! $jobTSGaleryImageDelete->datetime !!}</td>
          <td>{!! $jobTSGaleryImageDelete->user_id !!}</td>
          <td>{!! $jobTSGaleryImageDelete->job_t_s_g_image_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
            
              <a href="{!! route('jobTSGaleryImageDeletes.show', [$jobTSGaleryImageDelete->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
    
    </tbody>
  
  </table>
  
</div>