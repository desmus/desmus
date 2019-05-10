<table class="table table-responsive" id="publicFileCommentResponses-table">
    
  <thead>
        
    <tr>
            
      <th>Content</th>
      <th>Status</th>
      <th>Datetime</th>
      <th>Public File Comment Id</th>
      <th>User Id</th>
      <th colspan="3">Action</th>
        
    </tr>
    
  </thead>
    
  <tbody>
    
    @foreach($publicFileCommentResponses as $publicFileCommentResponse)
        
      <tr>
            
        <td>{!! $publicFileCommentResponse->content !!}</td>
        <td>{!! $publicFileCommentResponse->status !!}</td>
        <td>{!! $publicFileCommentResponse->datetime !!}</td>
        <td>{!! $publicFileCommentResponse->public_file_comment_id !!}</td>
        <td>{!! $publicFileCommentResponse->user_id !!}</td>
            
        <td>
                
          {!! Form::open(['route' => ['publicFileCommentResponses.destroy', $publicFileCommentResponse->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('publicFileCommentResponses.show', [$publicFileCommentResponse->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('publicFileCommentResponses.edit', [$publicFileCommentResponse->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                
            </div>
                
          {!! Form::close() !!}
            
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>

</table>