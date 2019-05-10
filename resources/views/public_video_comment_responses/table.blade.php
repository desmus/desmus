<table class="table table-responsive" id="publicVideoCommentResponses-table">
    
  <thead>
        
    <tr>
            
      <th>Content</th>
      <th>Status</th>
      <th>Datetime</th>
      <th>Public Video Comment Id</th>
      <th>User Id</th>
      <th colspan="3">Action</th>
        
    </tr>
    
  </thead>
    
  <tbody>
    
    @foreach($publicVideoCommentResponses as $publicVideoCommentResponse)
        
      <tr>
            
        <td>{!! $publicVideoCommentResponse->content !!}</td>
        <td>{!! $publicVideoCommentResponse->status !!}</td>
        <td>{!! $publicVideoCommentResponse->datetime !!}</td>
        <td>{!! $publicVideoCommentResponse->public_video_comment_id !!}</td>
        <td>{!! $publicVideoCommentResponse->user_id !!}</td>
            
        <td>
                
          {!! Form::open(['route' => ['publicVideoCommentResponses.destroy', $publicVideoCommentResponse->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('publicVideoCommentResponses.show', [$publicVideoCommentResponse->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('publicVideoCommentResponses.edit', [$publicVideoCommentResponse->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                
            </div>
                
          {!! Form::close() !!}
            
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>

</table>