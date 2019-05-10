<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projectTSFileUpdates-table">
    
    <thead>
      
      <tr>
              
        <th>Actual Name</th>
        <th>Past Name</th>
        <th>Datetime</th>
        <th>User Id</th>
        <th>Project T S File Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($projectTSFileUpdates as $projectTSFileUpdate)
          
        <tr>
              
          <td>{!! $projectTSFileUpdate->actual_name !!}</td>
          <td>{!! $projectTSFileUpdate->past_name !!}</td>
          <td>{!! $projectTSFileUpdate->datetime !!}</td>
          <td>{!! $projectTSFileUpdate->user_id !!}</td>
          <td>{!! $projectTSFileUpdate->project_t_s_file_id !!}</td>
          
          <td>
                  
            <div class='btn-group'>
                      
              <a href="{!! route('projectTSFileUpdates.show', [$projectTSFileUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>