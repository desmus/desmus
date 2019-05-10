<table class="table table-responsive" id="sharedProfileAudioUpdates-table">
    
  <thead>
        
    <tr>
            
      <th>Actual Name</th>
      <th>Past Name</th>
      <th>Datetime</th>
      <th>User Id</th>
      <th>Shared Profile Audio Id</th>
      <th colspan="3">Action</th>
        
    </tr>
    
  </thead>
    
  <tbody>
    
    @foreach($sharedProfileAudioUpdates as $sharedProfileAudioUpdate)
        
      <tr>
            
        <td>{!! $sharedProfileAudioUpdate->actual_name !!}</td>
        <td>{!! $sharedProfileAudioUpdate->past_name !!}</td>
        <td>{!! $sharedProfileAudioUpdate->datetime !!}</td>
        <td>{!! $sharedProfileAudioUpdate->user_id !!}</td>
        <td>{!! $sharedProfileAudioUpdate->shared_profile_audio_id !!}</td>
            
        <td>
                
          {!! Form::open(['route' => ['sharedProfileAudioUpdates.destroy', $sharedProfileAudioUpdate->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('sharedProfileAudioUpdates.show', [$sharedProfileAudioUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('sharedProfileAudioUpdates.edit', [$sharedProfileAudioUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                
            </div>
                
          {!! Form::close() !!}
            
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>

</table>