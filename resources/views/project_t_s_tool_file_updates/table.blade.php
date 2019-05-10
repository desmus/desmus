<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projectTSToolFileUpdates-table">
      
    <thead>
          
      <tr>
              
        <th>Actual Name</th>
        <th>Past Name</th>
        <th>Datetime</th>
        <th>User Id</th>
        <th>Project T S T File Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($projectTSToolFileUpdates as $projectTSToolFileUpdate)
          
        <tr>
              
          <td>{!! $projectTSToolFileUpdate->actual_name !!}</td>
          <td>{!! $projectTSToolFileUpdate->past_name !!}</td>
          <td>{!! $projectTSToolFileUpdate->datetime !!}</td>
          <td>{!! $projectTSToolFileUpdate->user_id !!}</td>
          <td>{!! $projectTSToolFileUpdate->project_t_s_t_file_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('projectTSToolFileUpdates.show', [$projectTSToolFileUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>