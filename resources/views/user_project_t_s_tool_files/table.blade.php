<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userProjectTSToolFiles-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>Description</th>
        <th>Status</th>
        <th>Permissions</th>
        <th>User Id</th>
        <th>Project T S T File Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userProjectTSToolFiles as $userProjectTSToolFile)
          
        <tr>
              
          <td>{!! $userProjectTSToolFile->datetime !!}</td>
          <td>{!! $userProjectTSToolFile->description !!}</td>
          <td>{!! $userProjectTSToolFile->status !!}</td>
          <td>{!! $userProjectTSToolFile->permissions !!}</td>
          <td>{!! $userProjectTSToolFile->user_id !!}</td>
          <td>{!! $userProjectTSToolFile->project_t_s_t_file_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userProjectTSToolFiles.show', [$userProjectTSToolFile->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>