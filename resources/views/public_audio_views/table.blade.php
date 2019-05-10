<table class="table table-responsive" id="publicAudioViews-table">
    
  <thead>
        
    <tr>
            
      <th>Datetime</th>
      <th>User Id</th>
      <th>Public Audio Id</th>
      <th colspan="3">Action</th>
    
    </tr>
    
  </thead>
    
  <tbody>
    
    @foreach($publicAudioViews as $publicAudioView)
        
      <tr>
            
        <td>{!! $publicAudioView->datetime !!}</td>
        <td>{!! $publicAudioView->user_id !!}</td>
        <td>{!! $publicAudioView->public_audio_id !!}</td>
            
        <td>
                
          {!! Form::open(['route' => ['publicAudioViews.destroy', $publicAudioView->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('publicAudioViews.show', [$publicAudioView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('publicAudioViews.edit', [$publicAudioView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                
            </div>
                
          {!! Form::close() !!}
            
        </td>
        
      </tr>
  
    @endforeach
    
  </tbody>

</table>