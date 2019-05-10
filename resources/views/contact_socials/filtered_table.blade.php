<table class="table table-hover table-bordered table-striped dataTable" id="contactSocials-filtered_table" style="margin-bottom: 0;">
  
  <thead>
        
    <tr>
            
      <th>Social Media Link</th>
      <th colspan="3">Action</th>
        
    </tr>
    
  </thead>
    
  <tbody>
    
    @foreach($contactSocials as $contactSocial)
    
      <tr>
            
        <td> <a href = "{!! route('contactSocials.show', [$contactSocial->id]) !!}"> {!! $contactSocial->link !!} </a> </td>
            
        <td>
                
          {!! Form::open(['route' => ['contactSocials.destroy', $contactSocial->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('contactSocials.show', [$contactSocial->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('contactSocials.edit', [$contactSocial->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                
            </div>
                
          {!! Form::close() !!}
            
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>

</table>