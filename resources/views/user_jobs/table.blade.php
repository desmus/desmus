<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userJobs-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>Description</th>
        <th>Status</th>
        <th>Permissions</th>
        <th>User Id</th>
        <th>Job Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userJobs as $userJob)
          
        <tr>
              
          <td>{!! $userJob->datetime !!}</td>
          <td>{!! $userJob->description !!}</td>
          <td>{!! $userJob->status !!}</td>
          <td>{!! $userJob->permissions !!}</td>
          <td>{!! $userJob->user_id !!}</td>
          <td>{!! $userJob->job_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
                      
              <a href="{!! route('userJobs.show', [$userJob->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>