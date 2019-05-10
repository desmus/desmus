<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobTSNoteCreates-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>Job T S Note Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($jobTSNoteCreates as $jobTSNoteCreate)
          
        <tr>
              
          <td>{!! $jobTSNoteCreate->datetime !!}</td>
          <td>{!! $jobTSNoteCreate->user_id !!}</td>
          <td>{!! $jobTSNoteCreate->job_t_s_note_id !!}</td>
          
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('jobTSNoteCreates.show', [$jobTSNoteCreate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>