<table class="table table-responsive" id="sharedProfileAudioComments-table">
    
  <thead>
        
    <tr>
            
      <th>Content</th>
      <th>Status</th>
      <th>Datetime</th>
      <th>Shared Profile Audio Id</th>
      <th>User Id</th>
      <th colspan="3">Action</th>
        
    </tr>
    
  </thead>
    
  <tbody>
    
    @foreach($sharedProfileAudioComments as $sharedProfileAudioComment)
        
      <tr>
            
        <td>{!! $sharedProfileAudioComment->content !!}</td>
        <td>{!! $sharedProfileAudioComment->status !!}</td>
        <td>{!! $sharedProfileAudioComment->datetime !!}</td>
        <td>{!! $sharedProfileAudioComment->shared_profile_audio_id !!}</td>
        <td>{!! $sharedProfileAudioComment->user_id !!}</td>
            
        <td>
                
          {!! Form::open(['route' => ['sharedProfileAudioComments.destroy', $sharedProfileAudioComment->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('sharedProfileAudioComments.show', [$sharedProfileAudioComment->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('sharedProfileAudioComments.edit', [$sharedProfileAudioComment->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
              
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                
            </div>
                
          {!! Form::close() !!}
            
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>

</table>