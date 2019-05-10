<table class="table table-responsive" id="publicAdvertisementCResponses-table">
    
  <thead>
        
    <tr>
            
      <th>Content</th>
      <th>Status</th>
      <th>Datetime</th>
      <th>Public A C Id</th>
      <th>User Id</th>
      <th colspan="3">Action</th>
        
    </tr>
    
  </thead>
    
  <tbody>
    
    @foreach($publicAdvertisementCResponses as $publicAdvertisementCResponse)
        
      <tr>
            
        <td>{!! $publicAdvertisementCResponse->content !!}</td>
        <td>{!! $publicAdvertisementCResponse->status !!}</td>
        <td>{!! $publicAdvertisementCResponse->datetime !!}</td>
        <td>{!! $publicAdvertisementCResponse->public_a_c_id !!}</td>
        <td>{!! $publicAdvertisementCResponse->user_id !!}</td>
    
        <td>
                
          {!! Form::open(['route' => ['publicAdvertisementCResponses.destroy', $publicAdvertisementCResponse->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('publicAdvertisementCResponses.show', [$publicAdvertisementCResponse->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('publicAdvertisementCResponses.edit', [$publicAdvertisementCResponse->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                
            </div>
                
          {!! Form::close() !!}
            
        </td>
      
      </tr>
    
    @endforeach
    
  </tbody>

</table>