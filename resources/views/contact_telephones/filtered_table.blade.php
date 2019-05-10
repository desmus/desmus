<table class="table table-hover table-bordered table-striped dataTable" id="contactTelephones-filtered_table" style="margin-bottom: 0;">
  
  <thead>
        
    <tr>
            
      <th>Number</th>
      <th>Type</th>
      <th colspan="3">Action</th>
        
    </tr>
    
  </thead>
    
  <tbody>
    
    @foreach($contactTelephones as $contactTelephone)
    
      <tr>
    
        <td> <a href = "{!! route('contactTelephones.show', [$contactTelephone->id]) !!}"> {!! $contactTelephone->telephone !!} </a> </td>
        <td> {!! $contactTelephone->type !!} </td>
            
        <td>
                
          {!! Form::open(['route' => ['contactTelephones.destroy', $contactTelephone->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('contactTelephones.show', [$contactTelephone->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('contactTelephones.edit', [$contactTelephone->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                
            </div>
                
          {!! Form::close() !!}
            
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>

</table>