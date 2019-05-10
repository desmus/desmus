<table class="table table-responsive" id="publicImageLikes-table">
    
  <thead>
        
    <tr>
            
      <th>Status</th>
      <th>Datetime</th>
      <th>Public Image Id</th>
      <th>User Id</th>
      <th colspan="3">Action</th>
        
    </tr>
    
  </thead>
    
  <tbody>
    
    @foreach($publicImageLikes as $publicImageLike)
        
      <tr>
            
        <td>{!! $publicImageLike->status !!}</td>
        <td>{!! $publicImageLike->datetime !!}</td>
        <td>{!! $publicImageLike->public_image_id !!}</td>
        <td>{!! $publicImageLike->user_id !!}</td>
            
        <td>
                
          {!! Form::open(['route' => ['publicImageLikes.destroy', $publicImageLike->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('publicImageLikes.show', [$publicImageLike->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('publicImageLikes.edit', [$publicImageLike->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                
            </div>
                
          {!! Form::close() !!}
            
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>

</table>