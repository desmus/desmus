<table class="table table-responsive" id="publicFileUpdates-table">
    
  <thead>
        
    <tr>
            
      <th>Actual Name</th>
      <th>Past Name</th>
      <th>Datetime</th>
      <th>User Id</th>
      <th>Public File Id</th>
      <th colspan="3">Action</th>
        
    </tr>
    
  </thead>
    
  <tbody>
    
    @foreach($publicFileUpdates as $publicFileUpdate)
        
      <tr>
            
        <td>{!! $publicFileUpdate->actual_name !!}</td>
        <td>{!! $publicFileUpdate->past_name !!}</td>
        <td>{!! $publicFileUpdate->datetime !!}</td>
        <td>{!! $publicFileUpdate->user_id !!}</td>
        <td>{!! $publicFileUpdate->public_file_id !!}</td>
            
        <td>
                
          {!! Form::open(['route' => ['publicFileUpdates.destroy', $publicFileUpdate->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('publicFileUpdates.show', [$publicFileUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('publicFileUpdates.edit', [$publicFileUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                
            </div>
                
          {!! Form::close() !!}
            
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>

</table>