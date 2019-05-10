<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobTopicSectionUpdates-table">
      
    <thead>
          
      <tr>
              
        <th>Actual Name</th>
        <th>Past Name</th>
        <th>Datetime</th>
        <th>User Id</th>
        <th>Job Topic Section Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
    
      @foreach($jobTopicSectionUpdates as $jobTopicSectionUpdate)
          
        <tr>
              
          <td>{!! $jobTopicSectionUpdate->actual_name !!}</td>
          <td>{!! $jobTopicSectionUpdate->past_name !!}</td>
          <td>{!! $jobTopicSectionUpdate->datetime !!}</td>
          <td>{!! $jobTopicSectionUpdate->user_id !!}</td>
          <td>{!! $jobTopicSectionUpdate->job_topic_section_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
            
              <a href="{!! route('jobTopicSectionUpdates.show', [$jobTopicSectionUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
    
    </tbody>
  
  </table>
  
</div>