<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobTopicDeletes-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>Job Topic Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
    
    <tbody>
      
      @foreach($jobTopicDeletes as $jobTopicDelete)
          
        <tr>
              
          <td>{!! $jobTopicDelete->datetime !!}</td>
          <td>{!! $jobTopicDelete->user_id !!}</td>
          <td>{!! $jobTopicDelete->job_topic_id !!}</td>
          
          <td>
            
            <div class='btn-group'>
                      
              <a href="{!! route('jobTopicDeletes.show', [$jobTopicDelete->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>