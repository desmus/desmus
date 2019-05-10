<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobTSFiles-table">
      
    <thead>
          
      <tr>
              
        <th>Name</th>
        <th>Description</th>
        <th>File Type</th>
        <th>Views Quantity</th>
        <th>Updates Quantity</th>
        <th>Status</th>
        <th>Job Topic Section Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($jobTSFiles as $jobTSFile)
          
        <tr>
              
          <td>{!! $jobTSFile->name !!}</td>
          <td>{!! $jobTSFile->description !!}</td>
          <td>{!! $jobTSFile->file_type !!}</td>
          <td>{!! $jobTSFile->views_quantity !!}</td>
          <td>{!! $jobTSFile->updates_quantity !!}</td>
          <td>{!! $jobTSFile->status !!}</td>
          <td>{!! $jobTSFile->job_topic_section_id !!}</td>
          
          <td>
                  
            <div class='btn-group'>
                      
              <a href="{!! route('jobTSFiles.show', [$jobTSFile->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>