<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobTSGaleryImages-table">
    
    <thead>
          
      <tr>
              
        <th>Name</th>
        <th>Description</th>
        <th>File Type</th>
        <th>Views Quantity</th>
        <th>Updates Quantity</th>
        <th>Status</th>
        <th>Job T S G Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($jobTSGaleryImages as $jobTSGaleryImage)
            
        <tr>
              
          <td>{!! $jobTSGaleryImage->name !!}</td>
          <td>{!! $jobTSGaleryImage->description !!}</td>
          <td>{!! $jobTSGaleryImage->file_type !!}</td>
          <td>{!! $jobTSGaleryImage->views_quantity !!}</td>
          <td>{!! $jobTSGaleryImage->updates_quantity !!}</td>
          <td>{!! $jobTSGaleryImage->status !!}</td>
          <td>{!! $jobTSGaleryImage->job_t_s_g_id !!}</td>
          
          <td>
            
            <div class='btn-group'>
            
              <a href="{!! route('jobTSGaleryImages.show', [$jobTSGaleryImage->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>