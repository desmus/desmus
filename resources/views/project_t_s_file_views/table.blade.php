<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projectTSFileViews-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>Project T S File Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($projectTSFileViews as $projectTSFileView)
          
        <tr>
              
          <td>{!! $projectTSFileView->datetime !!}</td>
          <td>{!! $projectTSFileView->user_id !!}</td>
          <td>{!! $projectTSFileView->project_t_s_file_id !!}</td>
              
          <td>
                  
            <div class='btn-group'>
            
              <a href="{!! route('projectTSFileViews.show', [$projectTSFileView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>