<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeTSNoteCreates-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>College T S Note Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($collegeTSNoteCreates as $collegeTSNoteCreate)
          
        <tr>
              
          <td>{!! $collegeTSNoteCreate->datetime !!}</td>
          <td>{!! $collegeTSNoteCreate->user_id !!}</td>
          <td>{!! $collegeTSNoteCreate->college_t_s_note_id !!}</td>
          
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('collegeTSNoteCreates.show', [$collegeTSNoteCreate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>