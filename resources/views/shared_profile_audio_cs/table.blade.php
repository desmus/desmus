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
    
    @foreach($sharedProfileAudioCs as $sharedProfileAudioC)
        
      <tr>
            
        <td>{!! $sharedProfileAudioC->content !!}</td>
        <td>{!! $sharedProfileAudioC->status !!}</td>
        <td>{!! $sharedProfileAudioC->datetime !!}</td>
        <td>{!! $sharedProfileAudioC->shared_profile_audio_id !!}</td>
        <td>{!! $sharedProfileAudioC->user_id !!}</td>
            
        <td>
                
          {!! Form::open(['route' => ['sharedProfileAudioCs.destroy', $sharedProfileAudioC->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('sharedProfileAudioCs.show', [$sharedProfileAudioC->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('sharedProfileAudioCs.edit', [$sharedProfileAudioC->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
              
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                
            </div>
                
          {!! Form::close() !!}
            
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>

</table>