<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projectTopicUpdates-table">
    
    <thead>
          
      <tr>
              
        <th>Actual Name</th>
        <th>Past Name</th>
        <th>Datetime</th>
        <th>User Id</th>
        <th>Project Topic Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($projectTopicUpdates as $projectTopicUpdate)
          
        <tr>
              
          <td>{!! $projectTopicUpdate->actual_name !!}</td>
          <td>{!! $projectTopicUpdate->past_name !!}</td>
          <td>{!! $projectTopicUpdate->datetime !!}</td>
          <td>{!! $projectTopicUpdate->user_id !!}</td>
          <td>{!! $projectTopicUpdate->project_topic_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
            
              <a href="{!! route('projectTopicUpdates.show', [$projectTopicUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>