<table class="table table-responsive" id="sharedProfileVideoComments-table">
    
  <thead>
        
    <tr>
            
      <th>Content</th>
      <th>Status</th>
      <th>Datetime</th>
      <th>Shared Profile Video Id</th>
      <th>User Id</th>
      <th colspan="3">Action</th>
        
    </tr>
    
  </thead>
    
  <tbody>
    
    @foreach($sharedProfileVideoComments as $sharedProfileVideoComment)
        
      <tr>
            
        <td>{!! $sharedProfileVideoComment->content !!}</td>
        <td>{!! $sharedProfileVideoComment->status !!}</td>
        <td>{!! $sharedProfileVideoComment->datetime !!}</td>
        <td>{!! $sharedProfileVideoComment->shared_profile_video_id !!}</td>
        <td>{!! $sharedProfileVideoComment->user_id !!}</td>
            
        <td>
                
          {!! Form::open(['route' => ['sharedProfileVideoComments.destroy', $sharedProfileVideoComment->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('sharedProfileVideoComments.show', [$sharedProfileVideoComment->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('sharedProfileVideoComments.edit', [$sharedProfileVideoComment->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                
            </div>
                
          {!! Form::close() !!}
            
        </td>
      
      </tr>
    
    @endforeach
    
  </tbody>

</table>