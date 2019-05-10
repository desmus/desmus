<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userPersonalDataTSTools-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>Description</th>
        <th>Status</th>
        <th>Permissions</th>
        <th>User Id</th>
        <th>Personal Data T S Tool Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userPersonalDataTSTools as $userPersonalDataTSTool)
          
        <tr>
              
          <td>{!! $userPersonalDataTSTool->datetime !!}</td>
          <td>{!! $userPersonalDataTSTool->description !!}</td>
          <td>{!! $userPersonalDataTSTool->status !!}</td>
          <td>{!! $userPersonalDataTSTool->permissions !!}</td>
          <td>{!! $userPersonalDataTSTool->user_id !!}</td>
          <td>{!! $userPersonalDataTSTool->personal_data_t_s_tool_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
                      
              <a href="{!! route('userPersonalDataTSTools.show', [$userPersonalDataTSTool->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>