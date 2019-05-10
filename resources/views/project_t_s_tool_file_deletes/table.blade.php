<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projectTSToolFileDeletes-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>Project T S T File Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($projectTSToolFileDeletes as $projectTSToolFileDelete)
        
        <tr>
              
          <td>{!! $projectTSToolFileDelete->datetime !!}</td>
          <td>{!! $projectTSToolFileDelete->user_id !!}</td>
          <td>{!! $projectTSToolFileDelete->project_t_s_t_file_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('projectTSToolFileDeletes.show', [$projectTSToolFileDelete->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
        
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>