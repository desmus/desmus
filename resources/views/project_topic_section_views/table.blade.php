<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projectTopicSectionViews-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>Project Topic Section Id</th>
        <th colspan="3">Action</th>
          
      </tr>
    
    </thead>
      
    <tbody>
      
      @foreach($projectTopicSectionViews as $projectTopicSectionView)
          
        <tr>
              
          <td>{!! $projectTopicSectionView->datetime !!}</td>
          <td>{!! $projectTopicSectionView->user_id !!}</td>
          <td>{!! $projectTopicSectionView->project_topic_section_id !!}</td>
          
          <td>
            
            <div class='btn-group'>
              <a href="{!! route('projectTopicSectionViews.show', [$projectTopicSectionView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            </div>
              
          </td>
        
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>