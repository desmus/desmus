<table class="table table-responsive" id="publicImageUpdates-table">
    
  <thead>
        
    <tr>
            
      <th>Actual Name</th>
      <th>Past Name</th>
      <th>Datetime</th>
      <th>User Id</th>
      <th>Public Image Id</th>
      <th colspan="3">Action</th>
        
    </tr>
    
  </thead>
    
  <tbody>
    
    @foreach($publicImageUpdates as $publicImageUpdate)
        
      <tr>
            
        <td>{!! $publicImageUpdate->actual_name !!}</td>
        <td>{!! $publicImageUpdate->past_name !!}</td>
        <td>{!! $publicImageUpdate->datetime !!}</td>
        <td>{!! $publicImageUpdate->user_id !!}</td>
        <td>{!! $publicImageUpdate->public_image_id !!}</td>
            
        <td>
                
          {!! Form::open(['route' => ['publicImageUpdates.destroy', $publicImageUpdate->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('publicImageUpdates.show', [$publicImageUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('publicImageUpdates.edit', [$publicImageUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
              
            </div>
          
          {!! Form::close() !!}
            
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>

</table>