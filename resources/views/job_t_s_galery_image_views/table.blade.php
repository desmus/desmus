<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobTSGaleryImageViews-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>Job T S G Image Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($jobTSGaleryImageViews as $jobTSGaleryImageView)
          
        <tr>
              
          <td>{!! $jobTSGaleryImageView->datetime !!}</td>
          <td>{!! $jobTSGaleryImageView->user_id !!}</td>
          <td>{!! $jobTSGaleryImageView->job_t_s_g_image_id !!}</td>
          
          <td>
                  
            <div class='btn-group'>
              
              <a href="{!! route('jobTSGaleryImageViews.show', [$jobTSGaleryImageView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
        
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>