<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userJobTSToolFiles-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>Description</th>
        <th>Status</th>
        <th>Permissions</th>
        <th>User Id</th>
        <th>Job T S T File Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userJobTSToolFiles as $userJobTSToolFile)
          
        <tr>
              
          <td>{!! $userJobTSToolFile->datetime !!}</td>
          <td>{!! $userJobTSToolFile->description !!}</td>
          <td>{!! $userJobTSToolFile->status !!}</td>
          <td>{!! $userJobTSToolFile->permissions !!}</td>
          <td>{!! $userJobTSToolFile->user_id !!}</td>
          <td>{!! $userJobTSToolFile->job_t_s_t_file_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userJobTSToolFiles.show', [$userJobTSToolFile->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
    
    </tbody>
  
  </table>
  
</div>