<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projectTSNoteViews-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>Project T S Note Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($projectTSNoteViews as $projectTSNoteView)
          
        <tr>
              
          <td>{!! $projectTSNoteView->datetime !!}</td>
          <td>{!! $projectTSNoteView->user_id !!}</td>
          <td>{!! $projectTSNoteView->project_t_s_note_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
                      
              <a href="{!! route('projectTSNoteViews.show', [$projectTSNoteView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
                  
          </td>
          
        </tr>
      
      @endforeach
    
    </tbody>
  
  </table>
  
</div>