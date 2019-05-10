<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobTopics-table">
      
    <thead>
          
      <tr>
              
        <th>Name</th>
        <th>User</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
    
      @foreach($jobTopics as $jobTopic)
          
        <tr>
              
          <td><a> <a href = "{!! route('jobTopics.show', [$jobTopic->id]) !!}"> {!! $jobTopic->name !!} </a> </td>
          <td>{!! $jobTopic->job_id !!}</td>
          
          <td>
                  
            <div class='btn-group'>
                      
              <a href="{!! route('jobTopics.show', [$jobTopic->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                 
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>