<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobTSGaleries-table">
    
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
      
      @foreach($jobTSGaleries as $jobTSGalerie)
      
        <tr>
          
          <td>{!! $jobTSGalerie->name !!}</td>
          <td>{!! $jobTSGalerie->description !!}</td>
          <td>{!! $jobTSGalerie->views_quantity !!}</td>
          <td>{!! $jobTSGalerie->updates_quantity !!}</td>
          <td>{!! $jobTSGalerie->status !!}</td>
          <td>{!! $jobTSGalerie->job_topic_section_id !!}</td>
          <td>
            
            <div class='btn-group'>
                
              <a href="{!! route('jobTSGaleries.show', [$jobTSGalerie->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
            
          </td>
        
        </tr>
      
      @endforeach
      
    </tbody>
    
  </table>
  
</div>