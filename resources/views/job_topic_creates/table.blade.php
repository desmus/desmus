<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobTopicCreates-table">
      
    <thead>
      
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>Job Topic Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($jobTopicCreates as $jobTopicCreate)
          
        <tr>
              
          <td>{!! $jobTopicCreate->datetime !!}</td>
          <td>{!! $jobTopicCreate->user_id !!}</td>
          <td>{!! $jobTopicCreate->job_topic_id !!}</td>
              
          <td>
                  
            <div class='btn-group'>
                      
              <a href="{!! route('jobTopicCreates.show', [$jobTopicCreate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>