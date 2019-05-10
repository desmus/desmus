<table class="table table-responsive" id="sharedProfileVideoUpdates-table">
    
  <thead>
        
    <tr>
            
      <th>Actual Name</th>
      <th>Past Name</th>
      <th>Datetime</th>
      <th>User Id</th>
      <th>Shared Profile Video Id</th>
      <th colspan="3">Action</th>
        
    </tr>
    
  </thead>
    
  <tbody>
    
    @foreach($sharedProfileVideoUpdates as $sharedProfileVideoUpdate)
        
      <tr>
            
        <td>{!! $sharedProfileVideoUpdate->actual_name !!}</td>
        <td>{!! $sharedProfileVideoUpdate->past_name !!}</td>
        <td>{!! $sharedProfileVideoUpdate->datetime !!}</td>
        <td>{!! $sharedProfileVideoUpdate->user_id !!}</td>
        <td>{!! $sharedProfileVideoUpdate->shared_profile_video_id !!}</td>
            
        <td>
                
          {!! Form::open(['route' => ['sharedProfileVideoUpdates.destroy', $sharedProfileVideoUpdate->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('sharedProfileVideoUpdates.show', [$sharedProfileVideoUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('sharedProfileVideoUpdates.edit', [$sharedProfileVideoUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                
            </div>
          
          {!! Form::close() !!}
            
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>

</table>