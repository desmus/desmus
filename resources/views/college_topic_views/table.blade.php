<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeTopicViews-table">
    
    <thead>
          
      <tr>
        
        <th>Datetime</th>
        <th>User Id</th>
        <th>College Topic Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($collegeTopicViews as $collegeTopicView)
          
        <tr>
              
          <td>{!! $collegeTopicView->datetime !!}</td>
          <td>{!! $collegeTopicView->user_id !!}</td>
          <td>{!! $collegeTopicView->college_topic_id !!}</td>
              
          <td>
                  
            <div class='btn-group'>
              
              <a href="{!! route('collegeTopicViews.show', [$collegeTopicView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>