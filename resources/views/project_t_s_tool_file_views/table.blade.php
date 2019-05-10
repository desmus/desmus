<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projectTSToolFileViews-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>Project T S T File Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($projectTSToolFileViews as $projectTSToolFileView)
          
        <tr>
              
          <td>{!! $projectTSToolFileView->datetime !!}</td>
          <td>{!! $projectTSToolFileView->user_id !!}</td>
          <td>{!! $projectTSToolFileView->project_t_s_t_file_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('projectTSToolFileViews.show', [$projectTSToolFileView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>