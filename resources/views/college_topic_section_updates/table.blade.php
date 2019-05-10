<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeTopicSectionUpdates-table">
      
    <thead>
          
      <tr>
              
        <th>Actual Name</th>
        <th>Past Name</th>
        <th>Datetime</th>
        <th>User Id</th>
        <th>College Topic Section Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
    
      @foreach($collegeTopicSectionUpdates as $collegeTopicSectionUpdate)
          
        <tr>
              
          <td>{!! $collegeTopicSectionUpdate->actual_name !!}</td>
          <td>{!! $collegeTopicSectionUpdate->past_name !!}</td>
          <td>{!! $collegeTopicSectionUpdate->datetime !!}</td>
          <td>{!! $collegeTopicSectionUpdate->user_id !!}</td>
          <td>{!! $collegeTopicSectionUpdate->college_topic_section_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
            
              <a href="{!! route('collegeTopicSectionUpdates.show', [$collegeTopicSectionUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
    
    </tbody>
  
  </table>
  
</div>