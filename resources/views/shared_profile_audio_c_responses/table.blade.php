<table class="table table-responsive" id="sharedProfileAudioCommentResponses-table">
    
  <thead>
        
    <tr>
            
      <th>Content</th>
      <th>Status</th>
      <th>Datetime</th>
      <th>Shared Profile Audio Comment Id</th>
      <th>User Id</th>
      <th colspan="3">Action</th>
        
    </tr>
    
  </thead>
    
  <tbody>
    
    @foreach($sharedProfileAudioCResponses as $sharedProfileAudioCResponse)
        
      <tr>
            
        <td>{!! $sharedProfileAudioCResponse->content !!}</td>
        <td>{!! $sharedProfileAudioCResponse->status !!}</td>
        <td>{!! $sharedProfileAudioCResponse->datetime !!}</td>
        <td>{!! $sharedProfileAudioCResponse->shared_profile_audio_comment_id !!}</td>
        <td>{!! $sharedProfileAudioCResponse->user_id !!}</td>
            
        <td>
                
          {!! Form::open(['route' => ['sharedProfileAudioCResponses.destroy', $sharedProfileAudioCResponse->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('sharedProfileAudioCResponses.show', [$sharedProfileAudioCResponse->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('sharedProfileAudioCResponses.edit', [$sharedProfileAudioCResponse->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
            
            </div>
                
          {!! Form::close() !!}
            
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>

</table>