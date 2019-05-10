<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobTSNoteViews-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>Job T S Note Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($jobTSNoteViews as $jobTSNoteView)
          
        <tr>
              
          <td>{!! $jobTSNoteView->datetime !!}</td>
          <td>{!! $jobTSNoteView->user_id !!}</td>
          <td>{!! $jobTSNoteView->job_t_s_note_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
                      
              <a href="{!! route('jobTSNoteViews.show', [$jobTSNoteView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
                  
          </td>
          
        </tr>
      
      @endforeach
    
    </tbody>
  
  </table>
  
</div>