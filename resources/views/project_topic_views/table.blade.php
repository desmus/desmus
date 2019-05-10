<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projectTopicViews-table">
    
    <thead>
          
      <tr>
        
        <th>Datetime</th>
        <th>User Id</th>
        <th>Project Topic Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($projectTopicViews as $projectTopicView)
          
        <tr>
              
          <td>{!! $projectTopicView->datetime !!}</td>
          <td>{!! $projectTopicView->user_id !!}</td>
          <td>{!! $projectTopicView->project_topic_id !!}</td>
              
          <td>
                  
            <div class='btn-group'>
              
              <a href="{!! route('projectTopicViews.show', [$projectTopicView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>