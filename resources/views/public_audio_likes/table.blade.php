<table class="table table-responsive" id="publicAudioLikes-table">
    
  <thead>
        
    <tr>
            
      <th>Status</th>
      <th>Datetime</th>
      <th>Public Audio Id</th>
      <th>User Id</th>
      <th colspan="3">Action</th>
        
    </tr>
    
  </thead>
    
  <tbody>
    
    @foreach($publicAudioLikes as $publicAudioLike)
        
      <tr>
            
        <td>{!! $publicAudioLike->status !!}</td>
        <td>{!! $publicAudioLike->datetime !!}</td>
        <td>{!! $publicAudioLike->public_audio_id !!}</td>
        <td>{!! $publicAudioLike->user_id !!}</td>
            
        <td>
                
          {!! Form::open(['route' => ['publicAudioLikes.destroy', $publicAudioLike->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('publicAudioLikes.show', [$publicAudioLike->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('publicAudioLikes.edit', [$publicAudioLike->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                
            </div>
                
          {!! Form::close() !!}
            
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>

</table>