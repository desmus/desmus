<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userCollegeTopics-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>Description</th>
        <th>Status</th>
        <th>Permissions</th>
        <th>User Id</th>
        <th>College Topic Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userCollegeTopics as $userCollegeTopic)
          
        <tr>
              
          <td>{!! $userCollegeTopic->datetime !!}</td>
          <td>{!! $userCollegeTopic->description !!}</td>
          <td>{!! $userCollegeTopic->status !!}</td>
          <td>{!! $userCollegeTopic->permissions !!}</td>
          <td>{!! $userCollegeTopic->user_id !!}</td>
          <td>{!! $userCollegeTopic->college_topic_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userCollegeTopics.show', [$userCollegeTopic->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>