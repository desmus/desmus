<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projectTSToolFileCreates-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>Project T S T File Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($projectTSToolFileCreates as $projectTSToolFileCreate)
          
        <tr>
              
          <td>{!! $projectTSToolFileCreate->datetime !!}</td>
          <td>{!! $projectTSToolFileCreate->user_id !!}</td>
          <td>{!! $projectTSToolFileCreate->project_t_s_t_file_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('projectTSToolFileCreates.show', [$projectTSToolFileCreate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>