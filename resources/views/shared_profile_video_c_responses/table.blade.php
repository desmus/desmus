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
    
    @foreach($sharedProfileVideoCResponses as $sharedProfileVideoCResponse)
        
      <tr>
            
        <td>{!! $sharedProfileVideoCResponse->content !!}</td>
        <td>{!! $sharedProfileVideoCResponse->status !!}</td>
        <td>{!! $sharedProfileVideoCResponse->datetime !!}</td>
        <td>{!! $sharedProfileVideoCResponse->shared_profile_video_comment_id !!}</td>
        <td>{!! $sharedProfileVideoCResponse->user_id !!}</td>
            
        <td>
                
          {!! Form::open(['route' => ['sharedProfileVideoCResponses.destroy', $sharedProfileVideoCResponse->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('sharedProfileVideoCResponses.show', [$sharedProfileVideoCResponse->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('sharedProfileVideoCResponses.edit', [$sharedProfileVideoCResponse->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                
            </div>
                
          {!! Form::close() !!}
            
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>

</table>