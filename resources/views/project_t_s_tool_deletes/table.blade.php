<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projectTSToolDeletes-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>Project T S Tool Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($projectTSToolDeletes as $projectTSToolDelete)
          
        <tr>
              
          <td>{!! $projectTSToolDelete->datetime !!}</td>
          <td>{!! $projectTSToolDelete->user_id !!}</td>
          <td>{!! $projectTSToolDelete->project_t_s_tool_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('projectTSToolDeletes.show', [$projectTSToolDelete->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>