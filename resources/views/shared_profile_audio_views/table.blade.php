<table class="table table-responsive" id="sharedProfileAudioViews-table">
    
  <thead>
        
    <tr>
            
      <th>Datetime</th>
      <th>User Id</th>
      <th>Shared Profile Audio Id</th>
      <th colspan="3">Action</th>
    
    </tr>
    
  </thead>
    
  <tbody>
    
    @foreach($sharedProfileAudioViews as $sharedProfileAudioView)
        
      <tr>
            
        <td>{!! $sharedProfileAudioView->datetime !!}</td>
        <td>{!! $sharedProfileAudioView->user_id !!}</td>
        <td>{!! $sharedProfileAudioView->shared_profile_audio_id !!}</td>
            
        <td>
                
          {!! Form::open(['route' => ['sharedProfileAudioViews.destroy', $sharedProfileAudioView->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('sharedProfileAudioViews.show', [$sharedProfileAudioView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('sharedProfileAudioViews.edit', [$sharedProfileAudioView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                
            </div>
                
          {!! Form::close() !!}
            
        </td>
        
      </tr>
  
    @endforeach
    
  </tbody>

</table>