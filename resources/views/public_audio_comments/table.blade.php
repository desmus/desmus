<table class="table table-responsive" id="publicAudioComments-table">
    
  <thead>
        
    <tr>
            
      <th>Content</th>
      <th>Status</th>
      <th>Datetime</th>
      <th>Public Audio Id</th>
      <th>User Id</th>
      <th colspan="3">Action</th>
        
    </tr>
    
  </thead>
    
  <tbody>
    
    @foreach($publicAudioComments as $publicAudioComment)
        
      <tr>
            
        <td>{!! $publicAudioComment->content !!}</td>
        <td>{!! $publicAudioComment->status !!}</td>
        <td>{!! $publicAudioComment->datetime !!}</td>
        <td>{!! $publicAudioComment->public_audio_id !!}</td>
        <td>{!! $publicAudioComment->user_id !!}</td>
            
        <td>
                
          {!! Form::open(['route' => ['publicAudioComments.destroy', $publicAudioComment->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('publicAudioComments.show', [$publicAudioComment->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('publicAudioComments.edit', [$publicAudioComment->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
              
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                
            </div>
                
          {!! Form::close() !!}
            
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>

</table>