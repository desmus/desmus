<table class="table table-responsive" id="publicAdvertisementComments-table">
    
  <thead>
        
    <tr>
            
      <th>Content</th>
      <th>Status</th>
      <th>Datetime</th>
      <th>Public Advertisement Id</th>
      <th>User Id</th>
      <th colspan="3">Action</th>
        
    </tr>
    
  </thead>
    
  <tbody>
    
    @foreach($publicAdvertisementComments as $publicAdvertisementComment)
        
      <tr>
            
        <td>{!! $publicAdvertisementComment->content !!}</td>
        <td>{!! $publicAdvertisementComment->status !!}</td>
        <td>{!! $publicAdvertisementComment->datetime !!}</td>
        <td>{!! $publicAdvertisementComment->public_advertisement_id !!}</td>
        <td>{!! $publicAdvertisementComment->user_id !!}</td>
            
        <td>
                
          {!! Form::open(['route' => ['publicAdvertisementComments.destroy', $publicAdvertisementComment->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('publicAdvertisementComments.show', [$publicAdvertisementComment->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('publicAdvertisementComments.edit', [$publicAdvertisementComment->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                
            </div>
                
          {!! Form::close() !!}
            
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>
  
</table>