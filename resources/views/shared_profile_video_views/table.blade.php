<table class="table table-responsive" id="sharedProfileVideoViews-table">
    
  <thead>
        
    <tr>
            
      <th>Datetime</th>
      <th>User Id</th>
      <th>Shared Profile Video Id</th>
      <th colspan="3">Action</th>
        
    </tr>
    
  </thead>
    
  <tbody>
    
    @foreach($sharedProfileVideoViews as $sharedProfileVideoView)
        
      <tr>
            
        <td>{!! $sharedProfileVideoView->datetime !!}</td>
        <td>{!! $sharedProfileVideoView->user_id !!}</td>
        <td>{!! $sharedProfileVideoView->shared_profile_video_id !!}</td>
            
        <td>
                
          {!! Form::open(['route' => ['sharedProfileVideoViews.destroy', $sharedProfileVideoView->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('sharedProfileVideoViews.show', [$sharedProfileVideoView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('sharedProfileVideoViews.edit', [$sharedProfileVideoView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
              
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                
            </div>
                
          {!! Form::close() !!}
            
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>

</table>