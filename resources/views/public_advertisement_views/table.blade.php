<table class="table table-responsive" id="publicAdvertisementViews-table">
    
  <thead>
        
    <tr>
            
      <th>Datetime</th>
      <th>User Id</th>
      <th>Public Advertisement Id</th>
      <th colspan="3">Action</th>
        
    </tr>
    
  </thead>
    
  <tbody>
    
    @foreach($publicAdvertisementViews as $publicAdvertisementView)
        
      <tr>
            
        <td>{!! $publicAdvertisementView->datetime !!}</td>
        <td>{!! $publicAdvertisementView->user_id !!}</td>
        <td>{!! $publicAdvertisementView->public_advertisement_id !!}</td>
            
        <td>
                
          {!! Form::open(['route' => ['publicAdvertisementViews.destroy', $publicAdvertisementView->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('publicAdvertisementViews.show', [$publicAdvertisementView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('publicAdvertisementViews.edit', [$publicAdvertisementView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
              
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                
            </div>
                
          {!! Form::close() !!}
            
        </td>
      
      </tr>
    
    @endforeach
    
  </tbody>

</table>