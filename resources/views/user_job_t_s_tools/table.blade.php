<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userJobTSTools-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>Description</th>
        <th>Status</th>
        <th>Permissions</th>
        <th>User Id</th>
        <th>Job T S Tool Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userJobTSTools as $userJobTSTool)
          
        <tr>
              
          <td>{!! $userJobTSTool->datetime !!}</td>
          <td>{!! $userJobTSTool->description !!}</td>
          <td>{!! $userJobTSTool->status !!}</td>
          <td>{!! $userJobTSTool->permissions !!}</td>
          <td>{!! $userJobTSTool->user_id !!}</td>
          <td>{!! $userJobTSTool->job_t_s_tool_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userJobTSTools.show', [$userJobTSTool->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>