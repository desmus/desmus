<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projectTSNoteDeletes-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>Project T S Note Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
    
      @foreach($projectTSNoteDeletes as $projectTSNoteDelete)
          
        <tr>
              
          <td>{!! $projectTSNoteDelete->datetime !!}</td>
          <td>{!! $projectTSNoteDelete->user_id !!}</td>
          <td>{!! $projectTSNoteDelete->project_t_s_note_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('projectTSNoteDeletes.show', [$projectTSNoteDelete->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>