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
  
    @foreach($sharedProfileNoteCResponses as $sharedProfileNoteCResponse)
        
      <tr>
            
        <td>{!! $sharedProfileNoteCResponse->content !!}</td>
        <td>{!! $sharedProfileNoteCResponse->status !!}</td>
        <td>{!! $sharedProfileNoteCResponse->datetime !!}</td>
        <td>{!! $sharedProfileNoteCResponse->shared_profile_note_comment_id !!}</td>
        <td>{!! $sharedProfileNoteCResponse->user_id !!}</td>
            
        <td>
                
          {!! Form::open(['route' => ['sharedProfileNoteCResponses.destroy', $sharedProfileNoteCResponse->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('sharedProfileNoteCResponses.show', [$sharedProfileNoteCResponse->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('sharedProfileNoteCResponses.edit', [$sharedProfileNoteCResponse->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                
            </div>
                
          {!! Form::close() !!}
            
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>

</table>