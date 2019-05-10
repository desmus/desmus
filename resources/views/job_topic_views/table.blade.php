<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobTopicViews-table">
    
    <thead>
          
      <tr>
        
        <th>Datetime</th>
        <th>User Id</th>
        <th>Job Topic Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($jobTopicViews as $jobTopicView)
          
        <tr>
              
          <td>{!! $jobTopicView->datetime !!}</td>
          <td>{!! $jobTopicView->user_id !!}</td>
          <td>{!! $jobTopicView->job_topic_id !!}</td>
              
          <td>
                  
            <div class='btn-group'>
              
              <a href="{!! route('jobTopicViews.show', [$jobTopicView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>