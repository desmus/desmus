<table class="table table-responsive" id="publicAudioUpdates-table">
    
  <thead>
        
    <tr>
            
      <th>Actual Name</th>
      <th>Past Name</th>
      <th>Datetime</th>
      <th>User Id</th>
      <th>Public Audio Id</th>
      <th colspan="3">Action</th>
        
    </tr>
    
  </thead>
    
  <tbody>
    
    @foreach($publicAudioUpdates as $publicAudioUpdate)
        
      <tr>
            
        <td>{!! $publicAudioUpdate->actual_name !!}</td>
        <td>{!! $publicAudioUpdate->past_name !!}</td>
        <td>{!! $publicAudioUpdate->datetime !!}</td>
        <td>{!! $publicAudioUpdate->user_id !!}</td>
        <td>{!! $publicAudioUpdate->public_audio_id !!}</td>
            
        <td>
                
          {!! Form::open(['route' => ['publicAudioUpdates.destroy', $publicAudioUpdate->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('publicAudioUpdates.show', [$publicAudioUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('publicAudioUpdates.edit', [$publicAudioUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                
            </div>
                
          {!! Form::close() !!}
            
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>

</table>