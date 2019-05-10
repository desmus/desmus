<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userCollegeTSGaleryImages-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>Description</th>
        <th>Status</th>
        <th>Permissions</th>
        <th>User Id</th>
        <th>College T S G Image Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userCollegeTSGaleryImages as $userCollegeTSGaleryImage)
          
        <tr>
              
          <td>{!! $userCollegeTSGaleryImage->datetime !!}</td>
          <td>{!! $userCollegeTSGaleryImage->description !!}</td>
          <td>{!! $userCollegeTSGaleryImage->status !!}</td>
          <td>{!! $userCollegeTSGaleryImage->permissions !!}</td>
          <td>{!! $userCollegeTSGaleryImage->user_id !!}</td>
          <td>{!! $userCollegeTSGaleryImage->college_t_s_g_image_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userCollegeTSGaleryImages.show', [$userCollegeTSGaleryImage->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>