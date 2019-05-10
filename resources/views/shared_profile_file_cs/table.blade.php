<table class="table table-responsive" id="sharedProfileFileComments-table">
    
  <thead>
        
    <tr>
            
      <th>Content</th>
      <th>Status</th>
      <th>Datetime</th>
      <th>Shared Profile File Id</th>
      <th>User Id</th>
      <th colspan="3">Action</th>
        
    </tr>
    
  </thead>
    
  <tbody>
    
    @foreach($sharedProfileFileComments as $sharedProfileFileComment)
        
      <tr>
            
        <td>{!! $sharedProfileFileComment->content !!}</td>
        <td>{!! $sharedProfileFileComment->status !!}</td>
        <td>{!! $sharedProfileFileComment->datetime !!}</td>
        <td>{!! $sharedProfileFileComment->s_p_f_id !!}</td>
        <td>{!! $sharedProfileFileComment->user_id !!}</td>
            
        <td>
                
          {!! Form::open(['route' => ['sharedProfileFileComments.destroy', $sharedProfileFileComment->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('sharedProfileFileComments.show', [$sharedProfileFileComment->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('sharedProfileFileComments.edit', [$sharedProfileFileComment->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                
            </div>
                
          {!! Form::close() !!}
            
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>

</table>