<table class="table table-responsive" id="sharedProfileNoteComments-table">
    
  <thead>
        
    <tr>
            
      <th>Content</th>
      <th>Status</th>
      <th>Datetime</th>
      <th>Shared Profile Note Id</th>
      <th>User Id</th>
      <th colspan="3">Action</th>
        
    </tr>
    
  </thead>
    
  <tbody>
    
    @foreach($sharedProfileNoteComments as $sharedProfileNoteComment)
        
      <tr>
            
        <td>{!! $sharedProfileNoteComment->content !!}</td>
        <td>{!! $sharedProfileNoteComment->status !!}</td>
        <td>{!! $sharedProfileNoteComment->datetime !!}</td>
        <td>{!! $sharedProfileNoteComment->shared_profile_note_id !!}</td>
        <td>{!! $sharedProfileNoteComment->user_id !!}</td>
            
        <td>
          
          {!! Form::open(['route' => ['sharedProfileNoteComments.destroy', $sharedProfileNoteComment->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('sharedProfileNoteComments.show', [$sharedProfileNoteComment->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('sharedProfileNoteComments.edit', [$sharedProfileNoteComment->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                
            </div>
                
          {!! Form::close() !!}
            
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>

</table>