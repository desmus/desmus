<table class="table table-responsive" id="publicImageViews-table">
    
  <thead>
        
    <tr>
            
      <th>Datetime</th>
      <th>User Id</th>
      <th>Public Image Id</th>
      <th colspan="3">Action</th>
        
    </tr>
    
  </thead>
    
  <tbody>
    
    @foreach($publicImageViews as $publicImageView)
        
      <tr>
            
        <td>{!! $publicImageView->datetime !!}</td>
        <td>{!! $publicImageView->user_id !!}</td>
        <td>{!! $publicImageView->public_image_id !!}</td>
            
        <td>
                
          {!! Form::open(['route' => ['publicImageViews.destroy', $publicImageView->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('publicImageViews.show', [$publicImageView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('publicImageViews.edit', [$publicImageView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                
            </div>
                
          {!! Form::close() !!}
            
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>
  
</table>