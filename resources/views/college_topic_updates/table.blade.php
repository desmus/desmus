<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeTopicUpdates-table">
    
    <thead>
          
      <tr>
              
        <th>Actual Name</th>
        <th>Past Name</th>
        <th>Datetime</th>
        <th>User Id</th>
        <th>College Topic Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($collegeTopicUpdates as $collegeTopicUpdate)
          
        <tr>
              
          <td>{!! $collegeTopicUpdate->actual_name !!}</td>
          <td>{!! $collegeTopicUpdate->past_name !!}</td>
          <td>{!! $collegeTopicUpdate->datetime !!}</td>
          <td>{!! $collegeTopicUpdate->user_id !!}</td>
          <td>{!! $collegeTopicUpdate->college_topic_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
            
              <a href="{!! route('collegeTopicUpdates.show', [$collegeTopicUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>