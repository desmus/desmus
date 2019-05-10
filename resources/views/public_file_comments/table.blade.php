<table class="table table-responsive" id="publicFileComments-table">
    
  <thead>
        
    <tr>
            
      <th>Content</th>
      <th>Status</th>
      <th>Datetime</th>
      <th>Public File Id</th>
      <th>User Id</th>
      <th colspan="3">Action</th>
        
    </tr>
    
  </thead>
    
  <tbody>
    
    @foreach($publicFileComments as $publicFileComment)
        
      <tr>
            
        <td>{!! $publicFileComment->content !!}</td>
        <td>{!! $publicFileComment->status !!}</td>
        <td>{!! $publicFileComment->datetime !!}</td>
        <td>{!! $publicFileComment->public_file_id !!}</td>
        <td>{!! $publicFileComment->user_id !!}</td>
            
        <td>
                
          {!! Form::open(['route' => ['publicFileComments.destroy', $publicFileComment->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('publicFileComments.show', [$publicFileComment->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('publicFileComments.edit', [$publicFileComment->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                
            </div>
                
          {!! Form::close() !!}
            
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>

</table>