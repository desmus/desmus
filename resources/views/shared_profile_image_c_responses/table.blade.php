<table class="table table-responsive" id="sharedProfileImageCommentResponses-table">
    
  <thead>
        
    <tr>
            
      <th>Content</th>
      <th>Status</th>
      <th>Datetime</th>
      <th>Shared Profile Image Comment Id</th>
      <th>User Id</th>
      <th colspan="3">Action</th>
        
    </tr>
    
  </thead>
    
  <tbody>
    
    @foreach($sharedProfileImageCResponses as $sharedProfileImageCResponse)
        
      <tr>
            
        <td>{!! $sharedProfileImageCResponse->content !!}</td>
        <td>{!! $sharedProfileImageCResponse->status !!}</td>
        <td>{!! $sharedProfileImageCResponse->datetime !!}</td>
        <td>{!! $sharedProfileImageCResponse->shared_profile_image_comment_id !!}</td>
        <td>{!! $sharedProfileImageCResponse->user_id !!}</td>
            
        <td>
                
          {!! Form::open(['route' => ['sharedProfileImageCResponses.destroy', $sharedProfileImageCResponse->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('sharedProfileImageCResponses.show', [$sharedProfileImageCResponse->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('sharedProfileImageCResponses.edit', [$sharedProfileImageCResponse->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                
            </div>
                
          {!! Form::close() !!}
            
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>

</table>