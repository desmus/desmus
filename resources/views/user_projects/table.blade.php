<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userProjects-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>Description</th>
        <th>Status</th>
        <th>Permissions</th>
        <th>User Id</th>
        <th>Project Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userProjects as $userProject)
          
        <tr>
              
          <td>{!! $userProject->datetime !!}</td>
          <td>{!! $userProject->description !!}</td>
          <td>{!! $userProject->status !!}</td>
          <td>{!! $userProject->permissions !!}</td>
          <td>{!! $userProject->user_id !!}</td>
          <td>{!! $userProject->project_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userProjects.show', [$userProject->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>