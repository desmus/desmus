<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userJobTSGaleryImages-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>Description</th>
        <th>Status</th>
        <th>Permissions</th>
        <th>User Id</th>
        <th>Job T S G Image Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userJobTSGaleryImages as $userJobTSGaleryImage)
          
        <tr>
              
          <td>{!! $userJobTSGaleryImage->datetime !!}</td>
          <td>{!! $userJobTSGaleryImage->description !!}</td>
          <td>{!! $userJobTSGaleryImage->status !!}</td>
          <td>{!! $userJobTSGaleryImage->permissions !!}</td>
          <td>{!! $userJobTSGaleryImage->user_id !!}</td>
          <td>{!! $userJobTSGaleryImage->job_t_s_g_image_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userJobTSGaleryImages.show', [$userJobTSGaleryImage->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
    
    </tbody>
  
  </table>
  
</div>