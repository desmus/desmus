<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userPersonalDataTSGaleryImages-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>Description</th>
        <th>Status</th>
        <th>Permissions</th>
        <th>User Id</th>
        <th>P D T S G I Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userPersonalDataTSGaleryImages as $userPersonalDataTSGaleryImage)
          
        <tr>
              
          <td>{!! $userPersonalDataTSGaleryImage->datetime !!}</td>
          <td>{!! $userPersonalDataTSGaleryImage->description !!}</td>
          <td>{!! $userPersonalDataTSGaleryImage->status !!}</td>
          <td>{!! $userPersonalDataTSGaleryImage->permissions !!}</td>
          <td>{!! $userPersonalDataTSGaleryImage->user_id !!}</td>
          <td>{!! $userPersonalDataTSGaleryImage->p_d_t_s_g_i_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userPersonalDataTSGaleryImages.show', [$userPersonalDataTSGaleryImage->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>