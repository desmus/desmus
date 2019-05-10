<table class="table table-responsive" id="shared-profile-video-likes-table">
    
  <thead>
        
    <tr>
            
      <th>Status</th>
      <th>Datetime</th>
      <th>Shared Profile Video Id</th>
      <th>User Id</th>
      <th colspan="3">Action</th>
        
    </tr>
    
  </thead>
    
  <tbody>
    
    @foreach($sharedProfileVideoLikes as $sharedProfileVideoLike)
        
      <tr>
            
        <td>{!! $sharedProfileVideoLike->status !!}</td>
        <td>{!! $sharedProfileVideoLike->datetime !!}</td>
        <td>{!! $sharedProfileVideoLike->shared_profile_video_id !!}</td>
        <td>{!! $sharedProfileVideoLike->user_id !!}</td>
            
        <td>
                
          {!! Form::open(['route' => ['sharedProfileVideoLikes.destroy', $sharedProfileVideoLike->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('sharedProfileVideoLikes.show', [$sharedProfileVideoLike->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('sharedProfileVideoLikes.edit', [$sharedProfileVideoLike->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                
            </div>
                
          {!! Form::close() !!}
            
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>

</table>