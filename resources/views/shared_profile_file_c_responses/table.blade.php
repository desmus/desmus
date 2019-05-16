<table class="table table-responsive" id="sharedProfileFileCResponses-table">
    
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
    
    @foreach($sharedProfileFileCResponses as $sharedProfileFileCResponse)
        
      <tr>
            
        <td>{!! $sharedProfileFileCResponse->content !!}</td>
        <td>{!! $sharedProfileFileCResponse->status !!}</td>
        <td>{!! $sharedProfileFileCResponse->datetime !!}</td>
        <td>{!! $sharedProfileFileCResponse->shared_profile_file_comment_id !!}</td>
        <td>{!! $sharedProfileFileCResponse->user_id !!}</td>
            
        <td>
                
          {!! Form::open(['route' => ['sharedProfileFileCResponses.destroy', $sharedProfileFileCResponse->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('sharedProfileFileCResponses.show', [$sharedProfileFileCResponse->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('sharedProfileFileCResponses.edit', [$sharedProfileFileCResponse->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                
            </div>
                
          {!! Form::close() !!}
            
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>

</table>