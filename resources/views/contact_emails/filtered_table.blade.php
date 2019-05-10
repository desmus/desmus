<table class="table table-hover table-bordered table-striped dataTable" id="contactEmails-filtered_table" style="margin-bottom: 0;">
  
  <thead>
        
    <tr>
            
      <th>Email</th>
      <th>Type</th>
      <th colspan="3">Action</th>
        
    </tr>
    
  </thead>
    
  <tbody>
    
    @foreach($contactEmails as $contactEmail)
    
      <tr>
            
        <td> <a href = "{!! route('contactEmails.show', [$contactEmail->id]) !!}"> {!! $contactEmail->email !!} </a> </td>
        <td> {!! $contactEmail->type !!} </a> </td>
            
        <td>
                
          {!! Form::open(['route' => ['contactEmails.destroy', $contactEmail->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('contactEmails.show', [$contactEmail->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('contactEmails.edit', [$contactEmail->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                
            </div>
                
          {!! Form::close() !!}
            
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>

</table>