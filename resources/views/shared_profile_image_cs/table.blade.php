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
    
    @foreach($sharedProfileImageCs as $sharedProfileImageC)
        
      <tr>
            
        <td>{!! $sharedProfileImageC->content !!}</td>
        <td>{!! $sharedProfileImageC->status !!}</td>
        <td>{!! $sharedProfileImageC->datetime !!}</td>
        <td>{!! $sharedProfileImageC->shared_profile_image_id !!}</td>
        <td>{!! $sharedProfileImageC->user_id !!}</td>
            
        <td>
                
          {!! Form::open(['route' => ['sharedProfileImageCs.destroy', $sharedProfileImageC->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('sharedProfileImageCs.show', [$sharedProfileImageC->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('sharedProfileImageCs.edit', [$sharedProfileImageC->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                
            </div>
                
          {!! Form::close() !!}
            
        </td>
      
      </tr>
    
    @endforeach
    
  </tbody>

</table>