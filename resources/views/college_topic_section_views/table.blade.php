<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeTopicSectionViews-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>College Topic Section Id</th>
        <th colspan="3">Action</th>
          
      </tr>
    
    </thead>
      
    <tbody>
      
      @foreach($collegeTopicSectionViews as $collegeTopicSectionView)
          
        <tr>
              
          <td>{!! $collegeTopicSectionView->datetime !!}</td>
          <td>{!! $collegeTopicSectionView->user_id !!}</td>
          <td>{!! $collegeTopicSectionView->college_topic_section_id !!}</td>
          
          <td>
            
            <div class='btn-group'>
              <a href="{!! route('collegeTopicSectionViews.show', [$collegeTopicSectionView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            </div>
              
          </td>
        
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>