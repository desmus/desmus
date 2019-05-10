<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userPersonalDataTSNotes-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>Description</th>
        <th>Status</th>
        <th>Permissions</th>
        <th>User Id</th>
        <th>Personal Data T S Note Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userPersonalDataTSNotes as $userPersonalDataTSNote)
          
        <tr>
              
          <td>{!! $userPersonalDataTSNote->datetime !!}</td>
          <td>{!! $userPersonalDataTSNote->description !!}</td>
          <td>{!! $userPersonalDataTSNote->status !!}</td>
          <td>{!! $userPersonalDataTSNote->permissions !!}</td>
          <td>{!! $userPersonalDataTSNote->user_id !!}</td>
          <td>{!! $userPersonalDataTSNote->personal_data_t_s_note_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userPersonalDataTSNotes.show', [$userPersonalDataTSNote->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>