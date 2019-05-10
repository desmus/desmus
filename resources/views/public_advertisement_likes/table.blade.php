<table class="table table-responsive" id="publicAdvertisementLikes-table">
    
  <thead>
        
    <tr>
            
      <th>Status</th>
      <th>Datetime</th>
      <th>Public Advertisement Id</th>
      <th>User Id</th>
      <th colspan="3">Action</th>
        
    </tr>
    
  </thead>
    
  <tbody>
    
    @foreach($publicAdvertisementLikes as $publicAdvertisementLike)
        
      <tr>
        
        <td>{!! $publicAdvertisementLike->status !!}</td>
        <td>{!! $publicAdvertisementLike->datetime !!}</td>
        <td>{!! $publicAdvertisementLike->public_advertisement_id !!}</td>
        <td>{!! $publicAdvertisementLike->user_id !!}</td>
            
        <td>
                
          {!! Form::open(['route' => ['publicAdvertisementLikes.destroy', $publicAdvertisementLike->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('publicAdvertisementLikes.show', [$publicAdvertisementLike->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('publicAdvertisementLikes.edit', [$publicAdvertisementLike->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                
            </div>
                
          {!! Form::close() !!}
            
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>
  
</table>