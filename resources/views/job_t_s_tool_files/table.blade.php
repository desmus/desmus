<div class="table-responsive">
  
  <table class="table table-bordered table-striped dataTable" id="jobTSToolFiles-table">
      
    <thead>
          
      <tr>
              
        <th>Name</th>
        <th>Description</th>
        <th>File Type</th>
        <th>Views Quantity</th>
        <th>Updates Quantity</th>
        <th>Status</th>
        <th>Job T S T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($jobTSToolFiles as $jobTSToolFile)
          
        <tr>
              
          <td>{!! $jobTSToolFile->name !!}</td>
          <td>{!! $jobTSToolFile->description !!}</td>
          <td>{!! $jobTSToolFile->file_type !!}</td>
          <td>{!! $jobTSToolFile->views_quantity !!}</td>
          <td>{!! $jobTSToolFile->updates_quantity !!}</td>
          <td>{!! $jobTSToolFile->status !!}</td>
          <td>{!! $jobTSToolFile->job_t_s_t_id !!}</td>
              
          <td>
                  
            <div class='btn-group'>
              
              <a href="{!! route('jobTSToolFiles.show', [$jobTSToolFile->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div><div class="table-responsive">
  
  <table class="table table-bordered table-striped dataTable" id="jobTSToolFiles-table">
      
    <thead>
          
      <tr>
              
        <th>Name</th>
        <th>Description</th>
        <th>File Type</th>
        <th>Views Quantity</th>
        <th>Updates Quantity</th>
        <th>Status</th>
        <th>Job T S T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($jobTSToolFiles as $jobTSToolFile)
          
        <tr>
              
          <td>{!! $jobTSToolFile->name !!}</td>
          <td>{!! $jobTSToolFile->description !!}</td>
          <td>{!! $jobTSToolFile->file_type !!}</td>
          <td>{!! $jobTSToolFile->views_quantity !!}</td>
          <td>{!! $jobTSToolFile->updates_quantity !!}</td>
          <td>{!! $jobTSToolFile->status !!}</td>
          <td>{!! $jobTSToolFile->job_t_s_t_id !!}</td>
              
          <td>
                  
            <div class='btn-group'>
              
              <a href="{!! route('jobTSToolFiles.show', [$jobTSToolFile->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>