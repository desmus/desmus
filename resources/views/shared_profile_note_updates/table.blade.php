<table class="table table-responsive" id="sharedProfileNoteUpdates-table">
    
  <thead>
        
    <tr>
            
      <th>Actual Name</th>
      <th>Past Name</th>
      <th>Datetime</th>
      <th>User Id</th>
      <th>Shared Profile Note Id</th>
      <th colspan="3">Action</th>
        
    </tr>
    
  </thead>
    
  <tbody>
  
    @foreach($sharedProfileNoteUpdates as $sharedProfileNoteUpdate)
        
      <tr>
            
        <td>{!! $sharedProfileNoteUpdate->actual_name !!}</td>
        <td>{!! $sharedProfileNoteUpdate->past_name !!}</td>
        <td>{!! $sharedProfileNoteUpdate->datetime !!}</td>
        <td>{!! $sharedProfileNoteUpdate->user_id !!}</td>
        <td>{!! $sharedProfileNoteUpdate->shared_profile_note_id !!}</td>
            
        <td>
                
          {!! Form::open(['route' => ['sharedProfileNoteUpdates.destroy', $sharedProfileNoteUpdate->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('sharedProfileNoteUpdates.show', [$sharedProfileNoteUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('sharedProfileNoteUpdates.edit', [$sharedProfileNoteUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
              
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
            
            </div>
                
          {!! Form::close() !!}
            
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>
  
</table>