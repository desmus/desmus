<table class="table table-responsive" id="sharedProfileImageViews-table">
    
  <thead>
        
    <tr>
            
      <th>Datetime</th>
      <th>User Id</th>
      <th>Shared Profile Image Id</th>
      <th colspan="3">Action</th>
        
    </tr>
    
  </thead>
    
  <tbody>
    
    @foreach($sharedProfileImageViews as $sharedProfileImageView)
        
      <tr>
            
        <td>{!! $sharedProfileImageView->datetime !!}</td>
        <td>{!! $sharedProfileImageView->user_id !!}</td>
        <td>{!! $sharedProfileImageView->shared_profile_image_id !!}</td>
            
        <td>
                
          {!! Form::open(['route' => ['sharedProfileImageViews.destroy', $sharedProfileImageView->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('sharedProfileImageViews.show', [$sharedProfileImageView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('sharedProfileImageViews.edit', [$sharedProfileImageView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                
            </div>
                
          {!! Form::close() !!}
            
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>
  
</table>