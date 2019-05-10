<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userPersonalDataTopics-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>Description</th>
        <th>Status</th>
        <th>Permissions</th>
        <th>User Id</th>
        <th>Personal Data Topic Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userPersonalDataTopics as $userPersonalDataTopic)
          
        <tr>
              
          <td>{!! $userPersonalDataTopic->datetime !!}</td>
          <td>{!! $userPersonalDataTopic->description !!}</td>
          <td>{!! $userPersonalDataTopic->status !!}</td>
          <td>{!! $userPersonalDataTopic->permissions !!}</td>
          <td>{!! $userPersonalDataTopic->user_id !!}</td>
          <td>{!! $userPersonalDataTopic->personal_data_topic_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userPersonalDataTopics.show', [$userPersonalDataTopic->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>