<table class="table table-responsive" id="publicImageComments-table">
    
  <thead>
        
    <tr>
            
      <th>Content</th>
      <th>Status</th>
      <th>Datetime</th>
      <th>Public Image Id</th>
      <th>User Id</th>
      <th colspan="3">Action</th>
        
    </tr>
    
  </thead>
    
  <tbody>
    
    @foreach($publicImageComments as $publicImageComment)
        
      <tr>
            
        <td>{!! $publicImageComment->content !!}</td>
        <td>{!! $publicImageComment->status !!}</td>
        <td>{!! $publicImageComment->datetime !!}</td>
        <td>{!! $publicImageComment->public_image_id !!}</td>
        <td>{!! $publicImageComment->user_id !!}</td>
            
        <td>
                
          {!! Form::open(['route' => ['publicImageComments.destroy', $publicImageComment->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('publicImageComments.show', [$publicImageComment->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('publicImageComments.edit', [$publicImageComment->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                
            </div>
                
          {!! Form::close() !!}
            
        </td>
      
      </tr>
    
    @endforeach
    
  </tbody>

</table>