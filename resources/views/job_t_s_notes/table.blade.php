<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobTSNotes-table">
    
    <thead>
          
      <tr>
              
        <th>Name</th>
        <th>Description</th>
        <th>Content</th>
        <th>Views Quantity</th>
        <th>Updates Quantity</th>
        <th>Status</th>
        <th>Job Topic Section Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($jobTSNotes as $jobTSNote)
          
        <tr>
              
          <td>{!! $jobTSNote->name !!}</td>
          <td>{!! $jobTSNote->description !!}</td>
          <td>{!! $jobTSNote->content !!}</td>
          <td>{!! $jobTSNote->views_quantity !!}</td>
          <td>{!! $jobTSNote->updates_quantity !!}</td>
          <td>{!! $jobTSNote->status !!}</td>
          <td>{!! $jobTSNote->job_topic_section_id !!}</td>
              
          <td>
                  
            <div class='btn-group'>
                      
              <a href="{!! route('jobTSNotes.show', [$jobTSNote->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
          
            </div>
        
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>