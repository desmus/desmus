<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobTSGaleryImageCreates-table">
    
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>Job T S G Image Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($jobTSGaleryImageCreates as $jobTSGaleryImageCreate)
          
        <tr>
              
          <td>{!! $jobTSGaleryImageCreate->datetime !!}</td>
          <td>{!! $jobTSGaleryImageCreate->user_id !!}</td>
          <td>{!! $jobTSGaleryImageCreate->job_t_s_g_image_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('jobTSGaleryImageCreates.show', [$jobTSGaleryImageCreate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
        
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>