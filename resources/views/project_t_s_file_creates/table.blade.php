<div class="table-responsive">
  
  <table class="table table-bordered table-striped dataTable" id="projectTSFileCreates-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>Project T S File Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($projectTSFileCreates as $projectTSFileCreate)
          
        <tr>
          
          <td>{!! $projectTSFileCreate->datetime !!}</td>
          <td>{!! $projectTSFileCreate->user_id !!}</td>
          <td>{!! $projectTSFileCreate->project_t_s_file_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
            
              <a href="{!! route('projectTSFileCreates.show', [$projectTSFileCreate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>