<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobTSTools-table">
      
    <thead>
          
      <tr>
              
        <th>Name</th>
        <th>Description</th>
        <th>Views Quantity</th>
        <th>Updates Quantity</th>
        <th>Status</th>
        <th>Job Topic Section Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($jobTSTools as $jobTSTool)
          
        <tr>
              
          <td>{!! $jobTSTool->name !!}</td>
          <td>{!! $jobTSTool->description !!}</td>
          <td>{!! $jobTSTool->views_quantity !!}</td>
          <td>{!! $jobTSTool->updates_quantity !!}</td>
          <td>{!! $jobTSTool->status !!}</td>
          <td>{!! $jobTSTool->job_topic_section_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('jobTSTools.show', [$jobTSTool->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>