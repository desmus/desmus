<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userProjectTSTools-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>Description</th>
        <th>Status</th>
        <th>Permissions</th>
        <th>User Id</th>
        <th>Project T S Tool Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userProjectTSTools as $userProjectTSTool)
          
        <tr>
              
          <td>{!! $userProjectTSTool->datetime !!}</td>
          <td>{!! $userProjectTSTool->description !!}</td>
          <td>{!! $userProjectTSTool->status !!}</td>
          <td>{!! $userProjectTSTool->permissions !!}</td>
          <td>{!! $userProjectTSTool->user_id !!}</td>
          <td>{!! $userProjectTSTool->project_t_s_tool_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userProjectTSTools.show', [$userProjectTSTool->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>