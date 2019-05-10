<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userProjectTopics-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>Description</th>
        <th>Status</th>
        <th>Permissions</th>
        <th>User Id</th>
        <th>Project Topic Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userProjectTopics as $userProjectTopic)
          
        <tr>
              
          <td>{!! $userProjectTopic->datetime !!}</td>
          <td>{!! $userProjectTopic->description !!}</td>
          <td>{!! $userProjectTopic->status !!}</td>
          <td>{!! $userProjectTopic->permissions !!}</td>
          <td>{!! $userProjectTopic->user_id !!}</td>
          <td>{!! $userProjectTopic->project_topic_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userProjectTopics.show', [$userProjectTopic->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>