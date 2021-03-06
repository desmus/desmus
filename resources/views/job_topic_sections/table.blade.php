<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobTopicSections-table">
      
    <thead>
          
      <tr>
              
        <th>Name</th>
        <th>User</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($jobTopicSections as $jobTopicSection)
          
        <tr>
              
          <td>{!! $jobTopicSection->name !!}</td>
          <td>{!! $jobTopicSection->job_topic_id !!}</td>
              
          <td>
                  
            <div class='btn-group'>
                      
              <a href="{!! route('jobTopicSections.show', [$jobTopicSection->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
    
  </table>

</div>