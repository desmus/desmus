<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projectTopicSectionUpdates-table">
      
    <thead>
          
      <tr>
              
        <th>Actual Name</th>
        <th>Past Name</th>
        <th>Datetime</th>
        <th>User Id</th>
        <th>Project Topic Section Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
    
      @foreach($projectTopicSectionUpdates as $projectTopicSectionUpdate)
          
        <tr>
              
          <td>{!! $projectTopicSectionUpdate->actual_name !!}</td>
          <td>{!! $projectTopicSectionUpdate->past_name !!}</td>
          <td>{!! $projectTopicSectionUpdate->datetime !!}</td>
          <td>{!! $projectTopicSectionUpdate->user_id !!}</td>
          <td>{!! $projectTopicSectionUpdate->project_topic_section_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
            
              <a href="{!! route('projectTopicSectionUpdates.show', [$projectTopicSectionUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
    
    </tbody>
  
  </table>
  
</div>