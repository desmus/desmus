<table class="table table-responsive" id="sharedProfileImageUpdates-table">
    
  <thead>
        
    <tr>
            
      <th>Actual Name</th>
      <th>Past Name</th>
      <th>Datetime</th>
      <th>User Id</th>
      <th>Shared Profile Image Id</th>
      <th colspan="3">Action</th>
        
    </tr>
    
  </thead>
    
  <tbody>
    
    @foreach($sharedProfileImageUpdates as $sharedProfileImageUpdate)
        
      <tr>
            
        <td>{!! $sharedProfileImageUpdate->actual_name !!}</td>
        <td>{!! $sharedProfileImageUpdate->past_name !!}</td>
        <td>{!! $sharedProfileImageUpdate->datetime !!}</td>
        <td>{!! $sharedProfileImageUpdate->user_id !!}</td>
        <td>{!! $sharedProfileImageUpdate->shared_profile_image_id !!}</td>
            
        <td>
                
          {!! Form::open(['route' => ['sharedProfileImageUpdates.destroy', $sharedProfileImageUpdate->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('sharedProfileImageUpdates.show', [$sharedProfileImageUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('sharedProfileImageUpdates.edit', [$sharedProfileImageUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
              
            </div>
          
          {!! Form::close() !!}
            
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>

</table>