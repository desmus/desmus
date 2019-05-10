<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeTSNoteViews-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>College T S Note Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($collegeTSNoteViews as $collegeTSNoteView)
          
        <tr>
              
          <td>{!! $collegeTSNoteView->datetime !!}</td>
          <td>{!! $collegeTSNoteView->user_id !!}</td>
          <td>{!! $collegeTSNoteView->college_t_s_note_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
                      
              <a href="{!! route('collegeTSNoteViews.show', [$collegeTSNoteView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
                  
          </td>
          
        </tr>
      
      @endforeach
    
    </tbody>
  
  </table>
  
</div>