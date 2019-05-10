<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userCollegeTSToolFiles-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>Description</th>
        <th>Status</th>
        <th>Permissions</th>
        <th>User Id</th>
        <th>College T S T File Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userCollegeTSToolFiles as $userCollegeTSToolFile)
          
        <tr>
              
          <td>{!! $userCollegeTSToolFile->datetime !!}</td>
          <td>{!! $userCollegeTSToolFile->description !!}</td>
          <td>{!! $userCollegeTSToolFile->status !!}</td>
          <td>{!! $userCollegeTSToolFile->permissions !!}</td>
          <td>{!! $userCollegeTSToolFile->user_id !!}</td>
          <td>{!! $userCollegeTSToolFile->college_t_s_t_file_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
                      
              <a href="{!! route('userCollegeTSToolFiles.show', [$userCollegeTSToolFile->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
    
  </table>
  
</div>