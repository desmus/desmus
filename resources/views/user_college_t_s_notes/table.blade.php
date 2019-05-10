<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userCollegeTSNotes-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>Description</th>
        <th>Status</th>
        <th>Permissions</th>
        <th>User Id</th>
        <th>College T S Note Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userCollegeTSNotes as $userCollegeTSNote)
          
        <tr>
              
          <td>{!! $userCollegeTSNote->datetime !!}</td>
          <td>{!! $userCollegeTSNote->description !!}</td>
          <td>{!! $userCollegeTSNote->status !!}</td>
          <td>{!! $userCollegeTSNote->permissions !!}</td>
          <td>{!! $userCollegeTSNote->user_id !!}</td>
          <td>{!! $userCollegeTSNote->college_t_s_note_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userCollegeTSNotes.show', [$userCollegeTSNote->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>