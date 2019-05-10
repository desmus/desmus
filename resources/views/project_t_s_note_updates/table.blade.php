<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projectTSNoteUpdates-table">
      
    <thead>
          
      <tr>
              
        <th>Actual Name</th>
        <th>Past Name</th>
        <th>Datetime</th>
        <th>User Id</th>
        <th>Project T S Note Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
    
    <tbody>
      
      @foreach($projectTSNoteUpdates as $projectTSNoteUpdate)
          
        <tr>
              
          <td>{!! $projectTSNoteUpdate->actual_name !!}</td>
          <td>{!! $projectTSNoteUpdate->past_name !!}</td>
          <td>{!! $projectTSNoteUpdate->datetime !!}</td>
          <td>{!! $projectTSNoteUpdate->user_id !!}</td>
          <td>{!! $projectTSNoteUpdate->project_t_s_note_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
                      
              <a href="{!! route('projectTSNoteUpdates.show', [$projectTSNoteUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>