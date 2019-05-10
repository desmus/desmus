<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userJobTSNotes-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>Description</th>
        <th>Status</th>
        <th>Permissions</th>
        <th>User Id</th>
        <th>Job T S Note Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userJobTSNotes as $userJobTSNote)
          
        <tr>
              
          <td>{!! $userJobTSNote->datetime !!}</td>
          <td>{!! $userJobTSNote->description !!}</td>
          <td>{!! $userJobTSNote->status !!}</td>
          <td>{!! $userJobTSNote->permissions !!}</td>
          <td>{!! $userJobTSNote->user_id !!}</td>
          <td>{!! $userJobTSNote->job_t_s_note_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userJobTSNotes.show', [$userJobTSNote->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>