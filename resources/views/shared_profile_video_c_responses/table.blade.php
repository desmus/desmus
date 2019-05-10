<table class="table table-responsive" id="sharedProfileVideoCommentResponses-table">
    
  <thead>
        
    <tr>
            
      <th>Content</th>
      <th>Status</th>
      <th>Datetime</th>
      <th>Shared Profile Video Comment Id</th>
      <th>User Id</th>
      <th colspan="3">Action</th>
        
    </tr>
    
  </thead>
    
  <tbody>
    
    @foreach($sharedProfileVideoCommentResponses as $sharedProfileVideoCommentResponse)
        
      <tr>
            
        <td>{!! $sharedProfileVideoCommentResponse->content !!}</td>
        <td>{!! $sharedProfileVideoCommentResponse->status !!}</td>
        <td>{!! $sharedProfileVideoCommentResponse->datetime !!}</td>
        <td>{!! $sharedProfileVideoCommentResponse->shared_profile_video_comment_id !!}</td>
        <td>{!! $sharedProfileVideoCommentResponse->user_id !!}</td>
            
        <td>
                
          {!! Form::open(['route' => ['sharedProfileVideoCommentResponses.destroy', $sharedProfileVideoCommentResponse->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('sharedProfileVideoCommentResponses.show', [$sharedProfileVideoCommentResponse->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('sharedProfileVideoCommentResponses.edit', [$sharedProfileVideoCommentResponse->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                
            </div>
                
          {!! Form::close() !!}
            
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>

</table>