<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userPersonalDataTSGaleries-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>Description</th>
        <th>Status</th>
        <th>Permissions</th>
        <th>User Id</th>
        <th>Personal Data T S G Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userPersonalDataTSGaleries as $userPersonalDataTSGalerie)
          
        <tr>
              
          <td>{!! $userPersonalDataTSGalerie->datetime !!}</td>
          <td>{!! $userPersonalDataTSGalerie->description !!}</td>
          <td>{!! $userPersonalDataTSGalerie->status !!}</td>
          <td>{!! $userPersonalDataTSGalerie->permissions !!}</td>
          <td>{!! $userPersonalDataTSGalerie->user_id !!}</td>
          <td>{!! $userPersonalDataTSGalerie->personal_data_t_s_g_id !!}</td>
          
          <td>
            
            <div class='btn-group'>
                      
              <a href="{!! route('userPersonalDataTSGaleries.show', [$userPersonalDataTSGalerie->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>