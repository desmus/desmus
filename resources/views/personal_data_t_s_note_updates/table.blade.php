<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="personalDataTSNoteUpdates-table">
      
    <thead>
          
      <tr>
              
        <th>Actual Name</th>
        <th>Past Name</th>
        <th>Datetime</th>
        <th>User Id</th>
        <th>Personal Data T S Note Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($personalDataTSNoteUpdates as $personalDataTSNoteUpdate)
          
        <tr>
              
          <td>{!! $personalDataTSNoteUpdate->actual_name !!}</td>
          <td>{!! $personalDataTSNoteUpdate->past_name !!}</td>
          <td>{!! $personalDataTSNoteUpdate->datetime !!}</td>
          <td>{!! $personalDataTSNoteUpdate->user_id !!}</td>
          <td>{!! $personalDataTSNoteUpdate->personal_data_t_s_note_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('personalDataTSNoteUpdates.show', [$personalDataTSNoteUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>