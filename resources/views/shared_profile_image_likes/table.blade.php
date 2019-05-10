<table class="table table-responsive" id="sharedProfileImageLikes-table">
    
  <thead>
        
    <tr>
            
      <th>Status</th>
      <th>Datetime</th>
      <th>Shared Profile Image Id</th>
      <th>User Id</th>
      <th colspan="3">Action</th>
        
    </tr>
    
  </thead>
    
  <tbody>
    
    @foreach($sharedProfileImageLikes as $sharedProfileImageLike)
        
      <tr>
            
        <td>{!! $sharedProfileImageLike->status !!}</td>
        <td>{!! $sharedProfileImageLike->datetime !!}</td>
        <td>{!! $sharedProfileImageLike->shared_profile_image_id !!}</td>
        <td>{!! $sharedProfileImageLike->user_id !!}</td>
            
        <td>
                
          {!! Form::open(['route' => ['sharedProfileImageLikes.destroy', $sharedProfileImageLike->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('sharedProfileImageLikes.show', [$sharedProfileImageLike->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('sharedProfileImageLikes.edit', [$sharedProfileImageLike->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                
            </div>
                
          {!! Form::close() !!}
            
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>

</table>