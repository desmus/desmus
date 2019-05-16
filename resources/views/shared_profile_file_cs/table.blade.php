<table class="table table-responsive" id="sharedProfileFileCs-table">
    
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
    
    @foreach($sharedProfileFileCs as $sharedProfileFileC)
        
      <tr>
            
        <td>{!! $sharedProfileFileC->content !!}</td>
        <td>{!! $sharedProfileFileC->status !!}</td>
        <td>{!! $sharedProfileFileC->datetime !!}</td>
        <td>{!! $sharedProfileFileC->s_p_f_id !!}</td>
        <td>{!! $sharedProfileFileC->user_id !!}</td>
            
        <td>
                
          {!! Form::open(['route' => ['sharedProfileFileCs.destroy', $sharedProfileFileC->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('sharedProfileFileCs.show', [$sharedProfileFileC->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('sharedProfileFileCs.edit', [$sharedProfileFileC->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                
            </div>
                
          {!! Form::close() !!}
            
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>

</table>