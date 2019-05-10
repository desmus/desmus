<table class="table table-responsive" id="publicAudioCommentResponses-table">
    
  <thead>
        
    <tr>
            
      <th>Content</th>
      <th>Status</th>
      <th>Datetime</th>
      <th>Public Audio Comment Id</th>
      <th>User Id</th>
      <th colspan="3">Action</th>
        
    </tr>
    
  </thead>
    
  <tbody>
    
    @foreach($publicAudioCommentResponses as $publicAudioCommentResponse)
        
      <tr>
            
        <td>{!! $publicAudioCommentResponse->content !!}</td>
        <td>{!! $publicAudioCommentResponse->status !!}</td>
        <td>{!! $publicAudioCommentResponse->datetime !!}</td>
        <td>{!! $publicAudioCommentResponse->public_audio_comment_id !!}</td>
        <td>{!! $publicAudioCommentResponse->user_id !!}</td>
            
        <td>
                
          {!! Form::open(['route' => ['publicAudioCommentResponses.destroy', $publicAudioCommentResponse->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('publicAudioCommentResponses.show', [$publicAudioCommentResponse->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('publicAudioCommentResponses.edit', [$publicAudioCommentResponse->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
            
            </div>
                
          {!! Form::close() !!}
            
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>

</table>