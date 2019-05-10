<table class="table table-responsive" id="sharedProfileImageComments-table">
    
  <thead>
        
    <tr>
            
      <th>Content</th>
      <th>Status</th>
      <th>Datetime</th>
      <th>Shared Profile Image Id</th>
      <th>User Id</th>
      <th colspan="3">Action</th>
        
    </tr>
    
  </thead>
    
  <tbody>
    
    @foreach($sharedProfileImageComments as $sharedProfileImageComment)
        
      <tr>
            
        <td>{!! $sharedProfileImageComment->content !!}</td>
        <td>{!! $sharedProfileImageComment->status !!}</td>
        <td>{!! $sharedProfileImageComment->datetime !!}</td>
        <td>{!! $sharedProfileImageComment->shared_profile_image_id !!}</td>
        <td>{!! $sharedProfileImageComment->user_id !!}</td>
            
        <td>
                
          {!! Form::open(['route' => ['sharedProfileImageComments.destroy', $sharedProfileImageComment->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('sharedProfileImageComments.show', [$sharedProfileImageComment->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('sharedProfileImageComments.edit', [$sharedProfileImageComment->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                
            </div>
                
          {!! Form::close() !!}
            
        </td>
      
      </tr>
    
    @endforeach
    
  </tbody>

</table>