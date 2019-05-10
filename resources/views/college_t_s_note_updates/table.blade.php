<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeTSNoteUpdates-table">
      
    <thead>
          
      <tr>
              
        <th>Actual Name</th>
        <th>Past Name</th>
        <th>Datetime</th>
        <th>User Id</th>
        <th>College T S Note Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
    
    <tbody>
      
      @foreach($collegeTSNoteUpdates as $collegeTSNoteUpdate)
          
        <tr>
              
          <td>{!! $collegeTSNoteUpdate->actual_name !!}</td>
          <td>{!! $collegeTSNoteUpdate->past_name !!}</td>
          <td>{!! $collegeTSNoteUpdate->datetime !!}</td>
          <td>{!! $collegeTSNoteUpdate->user_id !!}</td>
          <td>{!! $collegeTSNoteUpdate->college_t_s_note_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
                      
              <a href="{!! route('collegeTSNoteUpdates.show', [$collegeTSNoteUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>