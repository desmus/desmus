<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userJobTopics-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>Description</th>
        <th>Status</th>
        <th>Permissions</th>
        <th>User Id</th>
        <th>Job Topic Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userJobTopics as $userJobTopic)
          
        <tr>
              
          <td>{!! $userJobTopic->datetime !!}</td>
          <td>{!! $userJobTopic->description !!}</td>
          <td>{!! $userJobTopic->status !!}</td>
          <td>{!! $userJobTopic->permissions !!}</td>
          <td>{!! $userJobTopic->user_id !!}</td>
          <td>{!! $userJobTopic->job_topic_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userJobTopics.show', [$userJobTopic->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>