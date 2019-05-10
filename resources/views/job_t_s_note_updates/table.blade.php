<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobTSNoteUpdates-table">
      
    <thead>
          
      <tr>
              
        <th>Actual Name</th>
        <th>Past Name</th>
        <th>Datetime</th>
        <th>User Id</th>
        <th>Job T S Note Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
    
    <tbody>
      
      @foreach($jobTSNoteUpdates as $jobTSNoteUpdate)
          
        <tr>
              
          <td>{!! $jobTSNoteUpdate->actual_name !!}</td>
          <td>{!! $jobTSNoteUpdate->past_name !!}</td>
          <td>{!! $jobTSNoteUpdate->datetime !!}</td>
          <td>{!! $jobTSNoteUpdate->user_id !!}</td>
          <td>{!! $jobTSNoteUpdate->job_t_s_note_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
                      
              <a href="{!! route('jobTSNoteUpdates.show', [$jobTSNoteUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>