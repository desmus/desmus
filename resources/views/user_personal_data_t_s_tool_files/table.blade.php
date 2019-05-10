<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userPersonalDataTSToolFiles-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>Description</th>
        <th>Status</th>
        <th>Permissions</th>
        <th>User Id</th>
        <th>Personal D T S T F Id</th>
        <th colspan="3">Action</th>
      
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userPersonalDataTSToolFiles as $userPersonalDataTSToolFile)
          
        <tr>
          
          <td>{!! $userPersonalDataTSToolFile->datetime !!}</td>
          <td>{!! $userPersonalDataTSToolFile->description !!}</td>
          <td>{!! $userPersonalDataTSToolFile->status !!}</td>
          <td>{!! $userPersonalDataTSToolFile->permissions !!}</td>
          <td>{!! $userPersonalDataTSToolFile->user_id !!}</td>
          <td>{!! $userPersonalDataTSToolFile->personal_d_t_s_t_f_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userPersonalDataTSToolFiles.show', [$userPersonalDataTSToolFile->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
       
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>