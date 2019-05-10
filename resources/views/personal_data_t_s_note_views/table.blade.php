<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="personalDataTSNoteViews-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>Personal Data T S Note Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($personalDataTSNoteViews as $personalDataTSNoteView)
          
        <tr>
              
          <td>{!! $personalDataTSNoteView->datetime !!}</td>
          <td>{!! $personalDataTSNoteView->user_id !!}</td>
          <td>{!! $personalDataTSNoteView->personal_data_t_s_note_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
                      
              <a href="{!! route('personalDataTSNoteViews.show', [$personalDataTSNoteView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>