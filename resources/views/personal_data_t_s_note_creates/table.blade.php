<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="personalDataTSNoteCreates-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>Personal Data T S Note Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($personalDataTSNoteCreates as $personalDataTSNoteCreate)
          
        <tr>
              
          <td>{!! $personalDataTSNoteCreate->datetime !!}</td>
          <td>{!! $personalDataTSNoteCreate->user_id !!}</td>
          <td>{!! $personalDataTSNoteCreate->personal_data_t_s_note_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('personalDataTSNoteCreates.show', [$personalDataTSNoteCreate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>