<table class="table table-hover table-bordered table-striped dataTable" id="contactWebs-filtered_table" style="margin-bottom: 0;">
  
  <thead>
        
    <tr>
            
      <th>Web Page Link</th>
      <th colspan="3">Action</th>
        
    </tr>
    
  </thead>
    
  <tbody>
    
    @foreach($contactWebs as $contactWeb)
    
      <tr>
            
        <td> <a href = "{!! route('contactWebs.show', [$contactWeb->id]) !!}"> {!! $contactWeb->link !!} </a> </td>
            
        <td>
                
          {!! Form::open(['route' => ['contactWebs.destroy', $contactWeb->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('contactWebs.show', [$contactWeb->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('contactWebs.edit', [$contactWeb->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                
            </div>
                
          {!! Form::close() !!}
            
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>

</table>