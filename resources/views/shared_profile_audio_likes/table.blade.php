<table class="table table-responsive" id="sharedProfileAudioLikes-table">
    
  <thead>
        
    <tr>
            
      <th>Status</th>
      <th>Datetime</th>
      <th>Shared Profile Audio Id</th>
      <th>User Id</th>
      <th colspan="3">Action</th>
        
    </tr>
    
  </thead>
    
  <tbody>
    
    @foreach($sharedProfileAudioLikes as $sharedProfileAudioLike)
        
      <tr>
            
        <td>{!! $sharedProfileAudioLike->status !!}</td>
        <td>{!! $sharedProfileAudioLike->datetime !!}</td>
        <td>{!! $sharedProfileAudioLike->shared_profile_audio_id !!}</td>
        <td>{!! $sharedProfileAudioLike->user_id !!}</td>
            
        <td>
                
          {!! Form::open(['route' => ['sharedProfileAudioLikes.destroy', $sharedProfileAudioLike->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('sharedProfileAudioLikes.show', [$sharedProfileAudioLike->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('sharedProfileAudioLikes.edit', [$sharedProfileAudioLike->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                
            </div>
                
          {!! Form::close() !!}
            
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>

</table>