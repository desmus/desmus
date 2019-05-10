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
    
    @foreach($sharedProfileAudioCommentResponses as $sharedProfileAudioCommentResponse)
        
      <tr>
            
        <td>{!! $sharedProfileAudioCommentResponse->content !!}</td>
        <td>{!! $sharedProfileAudioCommentResponse->status !!}</td>
        <td>{!! $sharedProfileAudioCommentResponse->datetime !!}</td>
        <td>{!! $sharedProfileAudioCommentResponse->shared_profile_audio_comment_id !!}</td>
        <td>{!! $sharedProfileAudioCommentResponse->user_id !!}</td>
            
        <td>
                
          {!! Form::open(['route' => ['sharedProfileAudioCommentResponses.destroy', $sharedProfileAudioCommentResponse->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('sharedProfileAudioCommentResponses.show', [$sharedProfileAudioCommentResponse->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('sharedProfileAudioCommentResponses.edit', [$sharedProfileAudioCommentResponse->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
            
            </div>
                
          {!! Form::close() !!}
            
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>

</table>