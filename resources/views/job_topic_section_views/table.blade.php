<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobTopicSectionViews-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>Job Topic Section Id</th>
        <th colspan="3">Action</th>
          
      </tr>
    
    </thead>
      
    <tbody>
      
      @foreach($jobTopicSectionViews as $jobTopicSectionView)
          
        <tr>
              
          <td>{!! $jobTopicSectionView->datetime !!}</td>
          <td>{!! $jobTopicSectionView->user_id !!}</td>
          <td>{!! $jobTopicSectionView->job_topic_section_id !!}</td>
          
          <td>
            
            <div class='btn-group'>
              <a href="{!! route('jobTopicSectionViews.show', [$jobTopicSectionView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            </div>
              
          </td>
        
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>