<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userProjectTSGaleryImages-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>Description</th>
        <th>Status</th>
        <th>Permissions</th>
        <th>User Id</th>
        <th>Project T S G Image Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userProjectTSGaleryImages as $userProjectTSGaleryImage)
          
        <tr>
              
          <td>{!! $userProjectTSGaleryImage->datetime !!}</td>
          <td>{!! $userProjectTSGaleryImage->description !!}</td>
          <td>{!! $userProjectTSGaleryImage->status !!}</td>
          <td>{!! $userProjectTSGaleryImage->permissions !!}</td>
          <td>{!! $userProjectTSGaleryImage->user_id !!}</td>
          <td>{!! $userProjectTSGaleryImage->project_t_s_g_image_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userProjectTSGaleryImages.show', [$userProjectTSGaleryImage->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>