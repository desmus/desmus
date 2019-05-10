<table class="table table-responsive" id="sharedProfileNoteCommentResponses-table">
    
  <thead>
        
    <tr>
            
      <th>Content</th>
      <th>Status</th>
      <th>Datetime</th>
      <th>Public Note Comment Id</th>
      <th>User Id</th>
      <th colspan="3">Action</th>
        
    </tr>
    
  </thead>
    
  <tbody>
  
    @foreach($sharedProfileNoteCommentResponses as $sharedProfileNoteCommentResponse)
        
      <tr>
            
        <td>{!! $sharedProfileNoteCommentResponse->content !!}</td>
        <td>{!! $sharedProfileNoteCommentResponse->status !!}</td>
        <td>{!! $sharedProfileNoteCommentResponse->datetime !!}</td>
        <td>{!! $sharedProfileNoteCommentResponse->shared_profile_note_comment_id !!}</td>
        <td>{!! $sharedProfileNoteCommentResponse->user_id !!}</td>
            
        <td>
                
          {!! Form::open(['route' => ['sharedProfileNoteCommentResponses.destroy', $sharedProfileNoteCommentResponse->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('sharedProfileNoteCommentResponses.show', [$sharedProfileNoteCommentResponse->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('sharedProfileNoteCommentResponses.edit', [$sharedProfileNoteCommentResponse->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                
            </div>
                
          {!! Form::close() !!}
            
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>

</table>