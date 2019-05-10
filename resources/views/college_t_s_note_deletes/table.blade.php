<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeTSNoteDeletes-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>College T S Note Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
    
      @foreach($collegeTSNoteDeletes as $collegeTSNoteDelete)
          
        <tr>
              
          <td>{!! $collegeTSNoteDelete->datetime !!}</td>
          <td>{!! $collegeTSNoteDelete->user_id !!}</td>
          <td>{!! $collegeTSNoteDelete->college_t_s_note_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('collegeTSNoteDeletes.show', [$collegeTSNoteDelete->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>