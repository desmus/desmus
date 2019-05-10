<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userProjectTSNotes-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>Description</th>
        <th>Status</th>
        <th>Permissions</th>
        <th>User Id</th>
        <th>Project T S Note Id</th>
        <th colspan="3">Action</th>
          
      </tr>
    
    </thead>
      
    <tbody>
      
      @foreach($userProjectTSNotes as $userProjectTSNote)
          
        <tr>
              
          <td>{!! $userProjectTSNote->datetime !!}</td>
          <td>{!! $userProjectTSNote->description !!}</td>
          <td>{!! $userProjectTSNote->status !!}</td>
          <td>{!! $userProjectTSNote->permissions !!}</td>
          <td>{!! $userProjectTSNote->user_id !!}</td>
          <td>{!! $userProjectTSNote->project_t_s_note_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userProjectTSNotes.show', [$userProjectTSNote->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
        
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>