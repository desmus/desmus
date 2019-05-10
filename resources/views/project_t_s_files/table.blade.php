<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projectTSFiles-table">
      
    <thead>
          
      <tr>
              
        <th>Name</th>
        <th>Description</th>
        <th>File Type</th>
        <th>Views Quantity</th>
        <th>Updates Quantity</th>
        <th>Status</th>
        <th>Project Topic Section Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($projectTSFiles as $projectTSFile)
          
        <tr>
              
          <td>{!! $projectTSFile->name !!}</td>
          <td>{!! $projectTSFile->description !!}</td>
          <td>{!! $projectTSFile->file_type !!}</td>
          <td>{!! $projectTSFile->views_quantity !!}</td>
          <td>{!! $projectTSFile->updates_quantity !!}</td>
          <td>{!! $projectTSFile->status !!}</td>
          <td>{!! $projectTSFile->project_topic_section_id !!}</td>
          
          <td>
                  
            <div class='btn-group'>
                      
              <a href="{!! route('projectTSFiles.show', [$projectTSFile->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>