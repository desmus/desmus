<table class="table table-responsive" id="publicNoteCommentResponses-table">
    
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
  
    @foreach($publicNoteCommentResponses as $publicNoteCommentResponse)
        
      <tr>
            
        <td>{!! $publicNoteCommentResponse->content !!}</td>
        <td>{!! $publicNoteCommentResponse->status !!}</td>
        <td>{!! $publicNoteCommentResponse->datetime !!}</td>
        <td>{!! $publicNoteCommentResponse->public_note_comment_id !!}</td>
        <td>{!! $publicNoteCommentResponse->user_id !!}</td>
            
        <td>
                
          {!! Form::open(['route' => ['publicNoteCommentResponses.destroy', $publicNoteCommentResponse->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('publicNoteCommentResponses.show', [$publicNoteCommentResponse->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('publicNoteCommentResponses.edit', [$publicNoteCommentResponse->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                
            </div>
                
          {!! Form::close() !!}
            
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>

</table>