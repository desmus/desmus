<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="personalDataTSNoteDeletes-table">
    
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>Personal Data T S Note Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($personalDataTSNoteDeletes as $personalDataTSNoteDelete)
          
        <tr>
              
          <td>{!! $personalDataTSNoteDelete->datetime !!}</td>
          <td>{!! $personalDataTSNoteDelete->user_id !!}</td>
          <td>{!! $personalDataTSNoteDelete->personal_data_t_s_note_id !!}</td>
              
          <td>
                  
            <div class='btn-group'>
              
              <a href="{!! route('personalDataTSNoteDeletes.show', [$personalDataTSNoteDelete->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>