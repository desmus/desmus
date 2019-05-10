<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projectTSToolUpdates-table">
      
    <thead>
          
      <tr>
              
        <th>Actual Name</th>
        <th>Past Name</th>
        <th>Datetime</th>
        <th>User Id</th>
        <th>Project T S Tool Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($projectTSToolUpdates as $projectTSToolUpdate)
          
        <tr>
              
          <td>{!! $projectTSToolUpdate->actual_name !!}</td>
          <td>{!! $projectTSToolUpdate->past_name !!}</td>
          <td>{!! $projectTSToolUpdate->datetime !!}</td>
          <td>{!! $projectTSToolUpdate->user_id !!}</td>
          <td>{!! $projectTSToolUpdate->project_t_s_tool_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('projectTSToolUpdates.show', [$projectTSToolUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>