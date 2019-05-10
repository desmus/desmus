<table class="table table-responsive" id="sharedProfileFileUpdates-table">
    
  <thead>
        
    <tr>
            
      <th>Actual Name</th>
      <th>Past Name</th>
      <th>Datetime</th>
      <th>User Id</th>
      <th>Shared Profile File Id</th>
      <th colspan="3">Action</th>
        
    </tr>
    
  </thead>
    
  <tbody>
    
    @foreach($sharedProfileFileUpdates as $sharedProfileFileUpdate)
        
      <tr>
            
        <td>{!! $sharedProfileFileUpdate->actual_name !!}</td>
        <td>{!! $sharedProfileFileUpdate->past_name !!}</td>
        <td>{!! $sharedProfileFileUpdate->datetime !!}</td>
        <td>{!! $sharedProfileFileUpdate->user_id !!}</td>
        <td>{!! $sharedProfileFileUpdate->shared_profile_file_id !!}</td>
            
        <td>
                
          {!! Form::open(['route' => ['sharedProfileFileUpdates.destroy', $sharedProfileFileUpdate->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('sharedProfileFileUpdates.show', [$sharedProfileFileUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('sharedProfileFileUpdates.edit', [$sharedProfileFileUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                
            </div>
                
          {!! Form::close() !!}
            
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>

</table>