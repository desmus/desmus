<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobTopicUpdates-table">
    
    <thead>
          
      <tr>
              
        <th>Actual Name</th>
        <th>Past Name</th>
        <th>Datetime</th>
        <th>User Id</th>
        <th>Job Topic Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($jobTopicUpdates as $jobTopicUpdate)
          
        <tr>
              
          <td>{!! $jobTopicUpdate->actual_name !!}</td>
          <td>{!! $jobTopicUpdate->past_name !!}</td>
          <td>{!! $jobTopicUpdate->datetime !!}</td>
          <td>{!! $jobTopicUpdate->user_id !!}</td>
          <td>{!! $jobTopicUpdate->job_topic_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
            
              <a href="{!! route('jobTopicUpdates.show', [$jobTopicUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>