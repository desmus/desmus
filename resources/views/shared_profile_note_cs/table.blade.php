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
    
    @foreach($sharedProfileNoteCs as $sharedProfileNoteC)
        
      <tr>
            
        <td>{!! $sharedProfileNoteC->content !!}</td>
        <td>{!! $sharedProfileNoteC->status !!}</td>
        <td>{!! $sharedProfileNoteC->datetime !!}</td>
        <td>{!! $sharedProfileNoteC->shared_profile_note_id !!}</td>
        <td>{!! $sharedProfileNoteC->user_id !!}</td>
            
        <td>
          
          {!! Form::open(['route' => ['sharedProfileNoteCs.destroy', $sharedProfileNoteC->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('sharedProfileNoteCs.show', [$sharedProfileNoteC->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('sharedProfileNoteCs.edit', [$sharedProfileNoteC->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                
            </div>
                
          {!! Form::close() !!}
            
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>

</table>