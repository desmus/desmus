<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userPersonalDataTSFiles-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>Description</th>
        <th>Status</th>
        <th>Permissions</th>
        <th>User Id</th>
        <th>Personal Data T S File Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userPersonalDataTSFiles as $userPersonalDataTSFile)
          
        <tr>
              
          <td>{!! $userPersonalDataTSFile->datetime !!}</td>
          <td>{!! $userPersonalDataTSFile->description !!}</td>
          <td>{!! $userPersonalDataTSFile->status !!}</td>
          <td>{!! $userPersonalDataTSFile->permissions !!}</td>
          <td>{!! $userPersonalDataTSFile->user_id !!}</td>
          <td>{!! $userPersonalDataTSFile->personal_data_t_s_file_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userPersonalDataTSFiles.show', [$userPersonalDataTSFile->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>