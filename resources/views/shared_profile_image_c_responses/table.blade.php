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
    
    @foreach($sharedProfileImageCommentResponses as $sharedProfileImageCommentResponse)
        
      <tr>
            
        <td>{!! $sharedProfileImageCommentResponse->content !!}</td>
        <td>{!! $sharedProfileImageCommentResponse->status !!}</td>
        <td>{!! $sharedProfileImageCommentResponse->datetime !!}</td>
        <td>{!! $sharedProfileImageCommentResponse->shared_profile_image_comment_id !!}</td>
        <td>{!! $sharedProfileImageCommentResponse->user_id !!}</td>
            
        <td>
                
          {!! Form::open(['route' => ['sharedProfileImageCommentResponses.destroy', $sharedProfileImageCommentResponse->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('sharedProfileImageCommentResponses.show', [$sharedProfileImageCommentResponse->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('sharedProfileImageCommentResponses.edit', [$sharedProfileImageCommentResponse->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                
            </div>
                
          {!! Form::close() !!}
            
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>

</table>