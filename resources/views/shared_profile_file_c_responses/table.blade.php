<table class="table table-responsive" id="sharedProfileFileCommentResponses-table">
    
  <thead>
        
    <tr>
            
      <th>Content</th>
      <th>Status</th>
      <th>Datetime</th>
      <th>Shared Profile File Comment Id</th>
      <th>User Id</th>
      <th colspan="3">Action</th>
        
    </tr>
    
  </thead>
    
  <tbody>
    
    @foreach($sharedProfileFileCommentResponses as $sharedProfileFileCommentResponse)
        
      <tr>
            
        <td>{!! $sharedProfileFileCommentResponse->content !!}</td>
        <td>{!! $sharedProfileFileCommentResponse->status !!}</td>
        <td>{!! $sharedProfileFileCommentResponse->datetime !!}</td>
        <td>{!! $sharedProfileFileCommentResponse->shared_profile_file_comment_id !!}</td>
        <td>{!! $sharedProfileFileCommentResponse->user_id !!}</td>
            
        <td>
                
          {!! Form::open(['route' => ['sharedProfileFileCommentResponses.destroy', $sharedProfileFileCommentResponse->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('sharedProfileFileCommentResponses.show', [$sharedProfileFileCommentResponse->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('sharedProfileFileCommentResponses.edit', [$sharedProfileFileCommentResponse->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                
            </div>
                
          {!! Form::close() !!}
            
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>

</table>