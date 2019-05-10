<table class="table table-responsive" id="publicImageCommentResponses-table">
    
  <thead>
        
    <tr>
            
      <th>Content</th>
      <th>Status</th>
      <th>Datetime</th>
      <th>Public Image Comment Id</th>
      <th>User Id</th>
      <th colspan="3">Action</th>
        
    </tr>
    
  </thead>
    
  <tbody>
    
    @foreach($publicImageCommentResponses as $publicImageCommentResponse)
        
      <tr>
            
        <td>{!! $publicImageCommentResponse->content !!}</td>
        <td>{!! $publicImageCommentResponse->status !!}</td>
        <td>{!! $publicImageCommentResponse->datetime !!}</td>
        <td>{!! $publicImageCommentResponse->public_image_comment_id !!}</td>
        <td>{!! $publicImageCommentResponse->user_id !!}</td>
            
        <td>
                
          {!! Form::open(['route' => ['publicImageCommentResponses.destroy', $publicImageCommentResponse->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('publicImageCommentResponses.show', [$publicImageCommentResponse->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('publicImageCommentResponses.edit', [$publicImageCommentResponse->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                
            </div>
                
          {!! Form::close() !!}
            
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>

</table>