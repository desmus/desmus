<div class="table-responsive">
  
  <table class="table table-bordered table-striped dataTable" id="projectTSToolFiles-table">
      
    <thead>
          
      <tr>
              
        <th>Name</th>
        <th>Description</th>
        <th>File Type</th>
        <th>Views Quantity</th>
        <th>Updates Quantity</th>
        <th>Status</th>
        <th>Project T S T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($projectTSToolFiles as $projectTSToolFile)
          
        <tr>
              
          <td>{!! $projectTSToolFile->name !!}</td>
          <td>{!! $projectTSToolFile->description !!}</td>
          <td>{!! $projectTSToolFile->file_type !!}</td>
          <td>{!! $projectTSToolFile->views_quantity !!}</td>
          <td>{!! $projectTSToolFile->updates_quantity !!}</td>
          <td>{!! $projectTSToolFile->status !!}</td>
          <td>{!! $projectTSToolFile->project_t_s_t_id !!}</td>
              
          <td>
                  
            <div class='btn-group'>
              
              <a href="{!! route('projectTSToolFiles.show', [$projectTSToolFile->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>