<table class="table table-responsive" id="publicAdvertisementUpdates-table">
    
  <thead>
        
    <tr>
            
      <th>Actual Name</th>
      <th>Past Name</th>
      <th>Datetime</th>
      <th>User Id</th>
      <th>Public Advertisement Id</th>
      <th colspan="3">Action</th>
        
    </tr>
    
  </thead>
    
  <tbody>
    
    @foreach($publicAdvertisementUpdates as $publicAdvertisementUpdate)
        
      <tr>
            
        <td>{!! $publicAdvertisementUpdate->actual_name !!}</td>
        <td>{!! $publicAdvertisementUpdate->past_name !!}</td>
        <td>{!! $publicAdvertisementUpdate->datetime !!}</td>
        <td>{!! $publicAdvertisementUpdate->user_id !!}</td>
        <td>{!! $publicAdvertisementUpdate->public_advertisement_id !!}</td>
            
        <td>
                
          {!! Form::open(['route' => ['publicAdvertisementUpdates.destroy', $publicAdvertisementUpdate->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('publicAdvertisementUpdates.show', [$publicAdvertisementUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('publicAdvertisementUpdates.edit', [$publicAdvertisementUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
              
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                
            </div>
                
          {!! Form::close() !!}
            
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>

</table>